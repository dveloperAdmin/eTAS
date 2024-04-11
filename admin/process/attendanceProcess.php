<?php 
include '../../include/_dbConnect.php';
include '../../include/_session.php';

require '../../vendor/autoload.php';
// include '../include/_head.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Fill, Font, Border};
use PhpOffice\PhpSpreadsheet\IOFactory;

if(isset($_POST['attendanceExcelformate'])){
 
  $formatMonth = $_POST['monthFormat'];
  $formatYear = $_POST['yearFormat'];
  $arr_date = [];
  if($formatMonth!="" && $formatYear!=""){
    $des="load attendanceProcess page for Attendance-".$formatMonth."-".$formatYear." Formate download";
    $rem="Download Attendance Excell";
    require_once('../../include/_audiLog.php');

  $excel_column = array("SL NO", "Employee Code");
  
  for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $formatMonth, $formatYear); $i++) {
    array_push($arr_date, sprintf("%02d/%02d/%04d", $i, $formatMonth, $formatYear));
  }
  
  $excel_column =  array_values(array_merge($excel_column, $arr_date));
  
  // Create a new Spreadsheet object
  $spreadsheet = new Spreadsheet();
  
  // Set some properties for the Excel file
  $spreadsheet->getProperties()
  ->setCreator('Your Name')
  ->setLastModifiedBy('Your Name')
  ->setTitle('Example Spreadsheet')
  ->setSubject('Test');
  
  // Add data to the Excel sheet
  $sheet = $spreadsheet->getActiveSheet();
  
  // Set headers based on the array data and apply styles
  $columnIndex = 1;
  foreach ($excel_column as $header) {
    $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
    
    // Apply styles to the header cell
    $headerCell = $sheet->getCellByColumnAndRow($columnIndex, 1);
    $headerCell->getStyle()
    ->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor();
    // ->setARGB('FFFF00'); // Yellow background
    
    $headerCell->getStyle()
    ->getFont()
    ->setBold(true)
    ->getColor()
    ->setARGB('000000'); // Black font color
    
    $sheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);
    
    $styleArray = [
      'borders' => [
        'outline' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
          'color' => ['argb' => '000000'],
        ],
      ],
    ];
    
    $headerCell->getStyle()->applyFromArray($styleArray);
    
    $columnIndex++;
  }
  
  $sqlEmpCode= sqlsrv_query($conn," select * from employeeDetails where empCode !='Emp00lst'");
    
    // Add data rows
  $i=0;
  while($rowData = sqlsrv_fetch_array($sqlEmpCode, SQLSRV_FETCH_ASSOC)) {
    $columnIndex = 1; // Assuming column index 1 (A) for the serial number
    $rowNumber = 2 + $i; // Assuming starting row number 2 and increment for each row

    $slNoCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(1) . $rowNumber;
    $empCodeCoordinate = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(2) . $rowNumber;
    $sheet->setCellValue($slNoCoordinate, ++$i);
    $sheet->setCellValue($empCodeCoordinate, $rowData['empCode']);

        
  }
  
          
    $sheet->freezePane('A2');
    $sheet->freezePane('C2');
    // Create the response
    $fileName=  "Attendance-".$formatMonth."-".$formatYear.".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename='.$fileName);
    header('Cache-Control: max-age=0');
    header('Pragma: public');
    
    // Save the Excel file to the output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
  }else{
    $_SESSION['icon_ad']='warning' ; 
    $_SESSION['status_ad']='Insaficiant Input' ; 
    header("location:../../download-Attendance-Ui");
  }
          
}



// Check if a file was uploaded
if (isset($_FILES['excelFile'])) {
  try{

    $des="load attendanceProcess page for Uploading Attendance";
    $rem="Uploading Attendance Excel";
    require_once('../../include/_audiLog.php');
    
    $file = $_FILES['excelFile']['tmp_name'];
    $month = $_POST['month'];
    if($file!="" && $month!=""){
      $arr_date = [];
      $tempFile = $file;
      $month_upload = date("m",strtotime($month));
      $year = date("Y",strtotime($month));
      $excel_column = array("SL NO", "Employee Code");
      
      for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month_upload, $year); $i++) {
        array_push($arr_date, sprintf("%02d/%02d/%04d", $i, $month_upload, $year));
      }
      
      $excel_column =  array_values(array_merge($excel_column, $arr_date));
      
      $tempspreadsheet = IOFactory::load($tempFile);
      $tempsheet = $tempspreadsheet->getActiveSheet();
      $tempexcelData = $tempsheet->toArray();
      $headerArray = array_shift($tempexcelData); 
      $difference = array_diff($excel_column,$headerArray);
      if(empty($difference)){
        
        
        //processStatus Table data update 
        $processSearch = sqlsrv_fetch_array(sqlsrv_query($conn,"select inProcessStatus from processStatusDetails where processMonth = '$month_upload' AND processYear = '$year'"));
        if($processSearch == null || $processSearch['inProcessStatus'] <1){
          if($processSearch == null){
            sqlsrv_query($conn,"insert into processStatusDetails (processMonth,processYear,numberOfprocess, inProcessStatus) values('$month_upload','$year','0', '0')");
          }
          // Excel sheet processing and HTML table generation
          $htmlTable = generateHtmlTable($file, $month);
          if($htmlTable!=""){
            
            $excel_process = array(
              'checkMsg'=>'yes',
              'tableContent'=>$htmlTable,
              'icon'=>"success",
              'status'=>"Attendance Uploaded.... Click Process Attendance Button",
            );
            echo json_encode($excel_process);
          }else {
            $excel_process = array(
              'checkMsg'=>'No',
              'icon'=>"error",
              'status'=>"Attendance not uploaded",
            );
            echo json_encode($excel_process);
          }
          
        }else {
          $excel_process = array(
            'checkMsg'=>'No',
            'icon'=>"info",
            'status'=>"Another User processing this month Audendance.... Try again later",
            
          );
          echo json_encode($excel_process);
        }
      }else{
        $excel_process = array(
          'checkMsg'=>'No',
          'icon'=>"error",
          'status'=>"File Format Mismatch",
          
        );
        echo json_encode($excel_process);
      }
    }else {
      $excel_process = array(
        'checkMsg'=>'No',
        'icon'=>"error",
        'status'=>"Insufficient Data...",
        
      );
      echo json_encode($excel_process);
    }
  }catch(Exception $e){
    $excel_process = array(
    'checkMsg'=>'No',
    'icon'=>"error",
    'status'=>"Please Properly Upload File",
    
    );
    echo json_encode($excel_process);
  }
}

// Function to generate HTML table from Excel data
function generateHtmlTable($file, $month_upload) {
  include '../../include/_dbConnect.php';

    $month = date("m",strtotime($month_upload));
    $year = date("Y",strtotime($month_upload));

    //processStatus Table data update 
    $processSearch = sqlsrv_fetch_array(sqlsrv_query($conn,"select count(*) as 'row', numberOfprocess, inProcessStatus from processStatusDetails where processMonth = '$month' and processYear = '$year' group by numberOfprocess, inProcessStatus"));
    if($processSearch['row']>=1){
      $count = $processSearch['numberOfprocess']+1;
      sqlsrv_query($conn,"update processStatusDetails set numberOfprocess = '$count', inProcessStatus = '1' where processMonth = '$month' AND processYear = '$year'");
    }else{
       sqlsrv_query($conn,"insert into processStatusDetails (processMonth,processYear,numberOfprocess, inProcessStatus) values('$month','$year','1', '1'");
    }
    
    $tableName = "Attendance_".date("m",strtotime($month_upload))."_".date("Y",strtotime($month_upload));
    $temptable = "tempAttendDetails_".date("m",strtotime($month_upload))."_".date("Y",strtotime($month_upload));
   
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $excelData = $sheet->toArray();
     $extraRow = array();
    for ($i = 0; $i < (cal_days_in_month(CAL_GREGORIAN, $month, $year) + 2); $i++) {
      if($i == 0) {
        $extraRow[] = Count($excelData);
      }else if($i == 1) {
        $extraRow[] = "Emp00lst";
      }else{
          $extraRow[] = "XL";

      }
    }
    $excelData[] = $extraRow;
    


    $htmlTable = '
    <div class="card-body">
    <div class="d-flex align-items-center">
            <h5 class="mb-0">Attendance Month :&nbsp; <span style="font-style:italic; font-size:18px;">'.date("F",strtotime($month_upload)).' - '. date("Y",strtotime($month_upload)).' </span></h5>
            <div class="ms-auto position-relative" style="margin-right: 1rem;">
              
               <button type="click" class="btn btn-secondary backDefroze"  name="empEdit" 
                  style="margin-right:.5rem" >
                  <i class="bi bi-arrow-clockwise"></i>
                 Back
                </button>
           
              
            </div>
            <div class="d-flex" style="justify-content: flex-end;">
            <input type="hidden" name="" id="process-month" value="'.date("m_Y",strtotime($month_upload)).'">
              <button type="submit" class="btn btn-primary" name="processAttend"
                  style="margin-right:.5rem" id = "processInFrozen">
                  <i class="icofont icofont-gears"></i>
                 Process Attendance
                </button>
                
             
            </div>
          </div>
          <div class="table-responsive mt-3 " style="height: 26rem; overflow-y: auto;">
    <table class="table align-middle comTable" id="attendFileTable">';
    
    // Process the header row separately
    $headerRow = array_shift($excelData);
    $formattedHeaderRow = array_map('formatDateColumn', $headerRow);

    //drop the temp table 
    $sql_check_table1= sqlsrv_query($conn,"select count(*) as 'rowCount' from $temptable");
    
    if($sql_check_table1!=null){ 
      $sql_check_table= sqlsrv_fetch_array($sql_check_table1);
      
      if($sql_check_table['rowCount']>0){
        sqlsrv_query($conn,"drop table $temptable");
    }
  }
    
    $htmlTable .= '
              <thead class="table-secondary table-header">
                <tr style="position:sticky; top:0px; background:#fff;">';
     $tableCreationSQL = "if not exists (select 1 from sys.tables where name = '".$tableName."')
        begin
            create table ".$tableName." (sl_no int  not null identity(1,1) primary key,";
    $temptableCreationSQL = "if not exists (select 1 from sys.tables where name = '".$temptable."')
        begin
            create table ".$temptable." (sl_no int  not null identity(1,1) primary key,";
    
    for($i=0; $i<(cal_days_in_month(CAL_GREGORIAN, $month, $year)+2); $i++) {
        $htmlTable .= '<th style="padding: .81rem .81rem;">' . htmlspecialchars($formattedHeaderRow[$i]) . '</th>';
        if($i>1){
            $column=sprintf("%02d", ($i-1)); 
            $tableCreationSQL .= "[".$column."] varchar(150)  null,";
            $temptableCreationSQL .= "[".$column."] varchar(150) not null,";
            
        }else if($i == 1){
            $column="EmployeeCode";
            $tableCreationSQL .= $column." varchar(150) not null,";
            $temptableCreationSQL .= $column." varchar(150) not null,";
        }
    }
    
    $tableCreationSQL = rtrim($tableCreationSQL, ',') . ');';
    $temptableCreationSQL = rtrim($temptableCreationSQL, ',') . ');';
    $tableCreationSQL.='END ; ';
    $temptableCreationSQL.='END ; ';
    $result = sqlsrv_query($conn,$tableCreationSQL);
    sqlsrv_query($conn,$temptableCreationSQL);
    

    $htmlTable .= '</tr></thead>
              <tbody>';    
    $p = 0;
    foreach ($excelData as $row) {
      ++$p;
        $htmlTable .= '<tr>';
        $value="";
        $insertTableSQL = 'insert into '.$temptable.' values';
        for($i=0; $i<(cal_days_in_month(CAL_GREGORIAN, $month, $year)+2);) {
         
          if( $p<count($excelData)){
            $htmlTable .= '<td>' . htmlspecialchars($row[$i]) . '</td>';

          }
          if( ++$i<(cal_days_in_month(CAL_GREGORIAN,  $month, $year)+2)){
              $value.=ltrim("'".$row[$i]."'");
              if($i<(cal_days_in_month(CAL_GREGORIAN,  $month, $year)+1)){
              
                  $value.=", ";
              }
          }
               
            
        }
        // echo $value;
        $insertTableSQL .='('.$value.')';
        $htmlTable .= '</tr>';
        // echo $insertTableSQL."<br>";
        $empCode = $row[1];
        $attendaneTableInsert = "INSERT into $tableName (EmployeeCode)
                                    select '$empCode'
                                    where not exists (
                                        select 1 from $tableName where EmployeeCode = '$empCode'
                                    )";
        sqlsrv_query($conn,$attendaneTableInsert);                       

        
        sqlsrv_query($conn,$insertTableSQL);
    }
    $htmlTable .= '</tody></table></div></div></div>';

    
    return $htmlTable;
    // $sql_table = "select * from $tableName";
    // sql_num_rows($conn, $sql_table);
}

// Function to format date columns
function formatDateColumn($column) {
    if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $column)) {
        // If the column is in the format 'MM/DD/YYYY', format it as 'MM'
        $dateParts = explode('/', $column);
        return sprintf('%02d', $dateParts[0]);
    } else {
        return $column;
    }
}


// Reset Process Status 
if(isset($_POST['processMonth'])){
  $month_upload =$_POST['processMonth'];
  $month_upload = explode("_",$month_upload);
  $month = $month_upload[0];
  $year = $month_upload[1];
  if($month!="" && $year!=""){
    $processSearch = sqlsrv_fetch_array(sqlsrv_query($conn,"select count(*) as 'row' from processStatusDetails where processMonth = '$month' AND processYear = '$year' and inProcessStatus = '1' "));
    if($processSearch!= null && $processSearch['row']>=1){
      sqlsrv_query($conn,"update processStatusDetails set inProcessStatus = '0' where processMonth = '$month' and processYear = '$year'");
    }
  }
}

//chekc shift table activation

if(isset($_POST['checkTimeTable'])){
  $bool = false;
  $checkActivation = sqlsrv_fetch_array(sqlsrv_query($conn,"select count(*) as 'countActive' from shiftDetails where shiftStaus = 'Active'"));
  if($checkActivation!= null && $checkActivation['countActive'] == 1){
    $bool = "success";
  }
  echo $bool;
}


//progree percentage
if(isset($_POST['progreeMonth'])){
  $count = 0;
$progressMonth = $_POST['progreeMonth'];
$table = "tempAttendDetails_".$progressMonth;
$explodMonth = explode("_", $progressMonth);
$month = $explodMonth[0];
$year = $explodMonth[1];

for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $i++) {
  $column = sprintf('%02d', $i);
  $sql_query = "select count(*) as 'rowcount' from $table where EmployeeCode = 'Emp00lst' and [$column] = '1'";
  $result = sqlsrv_query($conn, $sql_query);

  if ($result !== false) {
      $sql_fetch_progress = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

      if (isset($sql_fetch_progress['rowcount']) && $sql_fetch_progress['rowcount'] < 1) {
          break;
      } else {
          $count += $sql_fetch_progress['rowcount'];
      }
  } else {
      // Handle query execution error
  }
}
$abc  = round(($count/cal_days_in_month(CAL_GREGORIAN, $month, $year))*100);

echo $abc . "%";


}