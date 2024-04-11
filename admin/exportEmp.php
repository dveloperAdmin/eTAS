<?php
include '../include/_dbConnect.php';
include '../include/_session.php';
include '../include/_function.php';
$des="load Import Employee-process page";
$rem="Import Employee process  page";
include '../include/_audiLog.php';
include '../include/_licCheck.php'; 
require '../vendor/autoload.php';


function findValue($columnIndex,$value,$conn){
  $returnValue = "";
  
  switch ($columnIndex) {
    case 4:
      $returnValue = company_find($value, $conn);
      break;
    
    case 5:
      $returnValue = dept_find($value, $conn);
      break;
    case 6:
      $returnValue = sub_dept_find($value, $conn);
      break;
    case 7:
      $returnValue = desig_find($value, $conn);
      break;
    case 8:
      $returnValue = subdesig_find($value, $conn);
      break;
    case 9:
      $returnValue = division_find($value, $conn);
      break;
    case 10:
      $returnValue = subdivision_find($value, $conn);
      break;
    case 11:
      $returnValue = empCat_find($value, $conn);
      break;
    case 12:
      $returnValue = empSCat_find($value, $conn);
      break;
    case 13:
      $returnValue = empType_find($value, $conn);
      break;
    case 14:
      $returnValue = empGrade_find($value, $conn);
      break;
    case 15:
      $returnValue = branch_find($value, $conn);
      break;
    case 16:
      $returnValue = empLoc_find($value, $conn);
      break;
    case 17:
      $returnValue = empTeam_find($value, $conn);
      break;
    
  }
  return $returnValue;

}


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Fill, Font, Border};
use PhpOffice\PhpSpreadsheet\IOFactory;
 
    // $month = $_POST['month_excel'];
    // $year = $_POST['year_excel'];

    // $arr_date = [];
   

    $excel_column = array("SL NO", "Employee Code", "Employee Name", "Company Name", "Department", "Sub-Department ", "Designation", "Sub-Designation", "Division", "Sub-Division", "Employee Category", "Employee Sub-Category", "Employee Type", "Grade","Branch", "Location", "Team Name", "Mobile No", "Gmail Id", "Address","Govt.Id Number","Employee Status");

    
    $spreadsheet = new Spreadsheet();

    // Set some properties for the Excel file
    $spreadsheet->getProperties()
        ->setCreator('Your Name')
        ->setLastModifiedBy('Your Name')
        ->setTitle('Export Employee')
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

    $query = "select * from employeeDetails where empCode!='Emp00lst' order by sl_no asc"; // select query
    $result = sqlsrv_query($conn, $query);
$i=0;
    $rowIndex = 2; // Start populating from the second row
    while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {

        $columnIndex = 1;
        foreach ($row as $key => $value) {

          if (in_array($columnIndex, range(4, 17))) {
            $value = findValue($columnIndex,$value,$conn);
          }
          if($key== "sl_no"){
            $value = ++$i;
          }
          if($columnIndex<count($row)){
            $sheet->setCellValueByColumnAndRow($columnIndex, $rowIndex, $value);

          }
            $columnIndex++;
        }
        $rowIndex++;
    }
    $sheet->freezePane('A2');
    $sheet->freezePane('D2');
    // / Create the response
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Employee Upload.xlsx"');
    header('Cache-Control: max-age=0');
    header('Pragma: public');
    
    // Save the Excel file to the output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
    