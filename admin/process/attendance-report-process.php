<head>

  <title>eTAS</title>
  <link rel="icon" href="admin/assets/images/bio-logo.png" type="image/png" />
  <style>
  @media print {
    body * {
      visibility: hidden;
      background: white;
    }

    .print_container * {
      visibility: visible;
      background: white;
    }

    .print_container {
      position: absolute;
      left: 0px;
      top: 0px;
    }
  }

  thead {
    position: sticky;
    top: 0;
    background: white;
  }

  .btn-primary {
    width: 5rem;
    height: 2.5rem;
    background-color: #fff;
    border-color: #448aff;
    color: #448aff;
    cursor: pointer;
    -webkit-transition: all ease-in 0.3s;
    transition: all ease-in 0.3s;
    font-size: 1rem;
    font-weight: bold;
  }

  .btn-primary:hover {
    background-color: #77aaff;
    border-color: #77aaff;
    color: #fff;
  }
  </style>
</head>

<?php
include '../../include/_dbConnect.php';
include '../../include/_session.php';
function attendanceTable($processMonth, $processYear, $processSql, $conn, $comName)
{
  include '../../include/_function.php';
  // // header section of the excel sheet
// $processTableName='attendance_'.$processMonth.'_'.$processYear;
// $processInitialDate = "1-".$processMonth.'-'.$processYear;
// $query = "SELECT 1 FROM sys.tables WHERE name = '$processTableName'";
// $result = sqlsrv_query($conn, $query);

  // $arr_date = [];
// $excel_first_header = array("Employee Code","Name","Employeewise  Attendance  Details  For  The  Month  Of  ".date("F, Y",strtotime($processInitialDate))."  From  ".date("01/m/Y",strtotime($processInitialDate))."  To  ".date("t/m/Y",strtotime($processInitialDate))); 
// $excel_particulers = array("In Time", "Out Time","Status","Shift");
// $excel_second_header = array("Particulars",""); // Second header

  // for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear); $i++) {
//     array_push($arr_date, sprintf("%02d", $i));
// }

  // $excel_second_header =  array_values(array_merge($excel_second_header, $arr_date));

  // // Start the HTML table
// $htmlTable = '

  // <table border ="1"style=" width: 100%;" id="reponseTable"> 
//             <thead style="position:sticky; top:0;">';

  // // Output header row
// $htmlTable .=  '<tr>';
// $htmlTable .=  '<th style="padding: 8px;text-align: center; background-color: #f2f2f2; ">' . $excel_first_header[0] . '</th>';
// $htmlTable .=  '<th style="padding: 8px;text-align: center;background-color: #f2f2f2;">' . $excel_first_header[1] . '</th>';
// $htmlTable .=  '<th style="padding: 8px;text-align: center;background-color: #f2f2f2;" colspan = "' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear)) . '">' . $excel_first_header[2] . '</th>';

  // $htmlTable .=  '</tr>';

  // // Output second header row
// $htmlTable .=  '<tr>';
// foreach ($excel_second_header as $header) {
//     $htmlTable .=  '<th style="padding: 8px;text-align: center; background-color: #f2f2f2; ">' . $header . '</th>';
// }
// $htmlTable .=  '</tr>
// </thead>';

  // // Create a new Spreadsheet object


  // // After the header section, add the body section
// $rowIndex = 3; // Start from the third row
// $emp_checksql = "SELECT it_employees.empCode, it_employees.empName,a.*
// FROM (
//   $processSql
//   ) AS it_employees
// JOIN $processTableName AS a ON it_employees.empCode = a.EmployeeCode";

  // $query =sqlsrv_query($conn,$emp_checksql) ;
// $num_data = sql_num_rows($conn,$emp_checksql);
// if($num_data>0){

  //     // Loop through data rows
//     while ($emp_data = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
//         $htmlTable .=  '<tr>';
//         $emp_code = $emp_data["empCode"];
//         $htmlTable .=  '<td style="padding: 8px;text-align: center; font-weight:600;" >' . $emp_code . '</td>';

  //         // Merge cells for the second column spanning from column 2 to 34
//         $htmlTable .=  '<td style="padding: 8px; text-align: left; font-weight:600" colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear)+1) . '" style="    text-align: left; ">' . $emp_data["empName"] . '</td>';
//         $htmlTable .=  '</tr>';

  //         for ($existingRow = 1; $existingRow <= 4; $existingRow++){
//             $htmlTable .=  '<tr>';
//             // Output data for the existing row
//             $htmlTable .=  '<td style="padding: 8px;text-align: left;" >' . $excel_particulers[$existingRow-1] . '</td><td style="padding: 8px;text-align: center;"></td>';

  //             // Output data for the second column
//             for ($col = 3; $col <= (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear)+2); $col++) {
//                 $arry_index = sprintf("%02d", ($col-2));
//                 $data = $emp_data[$arry_index] ;
//                 switch($existingRow){
//                     case 1:
//                         $in_time = explode("\n", $data);
//                         $database_data = $in_time[0]; // Example database data

  //                         // Regular expression to match the time format (HH:MM:SS)
//                         $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

  //                         // Check if the database data matches the time pattern
//                         if (preg_match($time_pattern, $database_data)) {
//                             $data= $database_data;
//                         }else{
//                             $data = "";
//                         }
//                         break;
//                     case 2:
//                       $out_time = explode("\n", $data);
//                         $database_data = $out_time[0]; // Example database data

  //                         // Regular expression to match the time format (HH:MM:SS)
//                         $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

  //                         // Check if the database data matches the time pattern
//                         if (preg_match($time_pattern, $database_data)) {
//                             $data= $out_time[1];
//                         }else{
//                             $data = "";
//                         }
//                         break;
//                    case 3:
//                         $out_time = explode("\n", $data);
//                         $database_data = $out_time[0]; // Example database data

  //                         // Regular expression to match the time format (HH:MM:SS)
//                         $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

  //                         // Check if the database data matches the time pattern
//                         if (preg_match($time_pattern, $database_data)) {

  //                           $data= $out_time[2];
//                         }else{
//                           $data= $out_time[0];
//                         }
//                         break;
//                     case 4:
//                         if($data!=""){
//                           $out_time = explode("\n", $data);
//                           $database_data = $out_time[0]; // Example database data

  //                           // Regular expression to match the time format (HH:MM:SS)
//                           $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

  //                           // Check if the database data matches the time pattern
//                           if (preg_match($time_pattern, $database_data)) {
//                               $data= $out_time[3];
//                           }else{
//                              $data= $out_time[1];
//                           }

  //                         }
//                         break;
//                 }
//                 $htmlTable .=  '<td style="padding: 8px;text-align: center;">' . $data . '</td>';
//             }
//             $htmlTable .=  '</tr>';
//         }
//     }
// } else {
//     // No data message
//     $htmlTable .=  '<tr><td style="padding: 8px;text-align: center;" colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) + 4) . '">No data available</td></tr>';
// }

  // $htmlTable .=  '</table>';
// return $htmlTable;

  $processTableName = 'attendance_' . $processMonth . '_' . $processYear;
  $processInitialDate = "1-" . $processMonth . '-' . $processYear;
  $query = "SELECT 1 FROM sys.tables WHERE name = '$processTableName'";
  $result = sqlsrv_query($conn, $query);

  $arr_date = [];
  $excel_first_header = array("Employee Code", "Name", "Employeewise  Attendance  Details  For  The  Month  Of  " . date("F, Y", strtotime($processInitialDate)) . "  From  " . date("01/m/Y", strtotime($processInitialDate)) . "  To  " . date("t/m/Y", strtotime($processInitialDate)) . "");
  $excel_particulers = array("In Time", "Out Time", "Status", "Shift");
  $excel_second_header = array("Particulars", ""); // Second header

  for ($i = 1; $i <= cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear); $i++) {
    array_push($arr_date, sprintf("%02d", $i));
  }

  $excel_second_header = array_values(array_merge($excel_second_header, $arr_date));

  // Start the HTML table
  $htmlTable = '<table border="1" style="width: 100%;" id="reponseTable"> 
    <thead style="position:sticky; top:0;">
    <tr><th  style="padding: 8px;text-align: center; background-color: #f2f2f2; " colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) + 2) . '">
          ' . $comName . '
        </th>
    </tr>
    <tr>';

  // Output header row
  $htmlTable .= '<th style="padding: 8px;text-align: center; background-color: #f2f2f2; ">' . $excel_first_header[0] . '</th>';
  $htmlTable .= '<th style="padding: 8px;text-align: center;background-color: #f2f2f2;">' . $excel_first_header[1] . '</th>';
  $htmlTable .= '<th style="padding: 8px;text-align: center;background-color: #f2f2f2;" colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear)) . '">' . $excel_first_header[2] . '</th>';
  $htmlTable .= '</tr>';

  // Output second header row
  $htmlTable .= '<tr>';
  foreach ($excel_second_header as $header) {
    $htmlTable .= '<th style="padding: 8px;text-align: center; background-color: #f2f2f2; ">' . $header . '</th>';
  }
  $htmlTable .= '</tr></thead><tbody>'; // Close thead and start tbody

  // Create a new Spreadsheet object

  // After the header section, add the body section
  $rowIndex = 3; // Start from the third row
  $emp_checksql = "SELECT it_employees.empCode, it_employees.empName, it_employees.departmentCode,it_employees.designationCode,a.*
    FROM (
      $processSql
      ) AS it_employees
    JOIN $processTableName AS a ON it_employees.empCode = a.EmployeeCode";

  $query = sqlsrv_query($conn, $emp_checksql);
  $num_data = sql_num_rows($conn, $emp_checksql);
  if ($num_data > 0) {

    // Loop through data rows
    while ($emp_data = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
      $p = 0;
      $L = 0;
      $WO = 0;
      $HD = 0;
      $H = 0;
      $htmlTable .= '<tr>';
      $emp_code = $emp_data["empCode"];
      $htmlTable .= '<td style="padding: 8px;text-align: center; font-weight:600;" >' . $emp_code . '</td>';

      // Merge cells for the second column spanning from column 2 to 34
      $htmlTable .= '<td style="padding: 8px; text-align: left; font-weight:600" colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) + 1) . '" style="text-align: left; ">' . $emp_data["empName"] . "&nbsp;&nbsp;&nbsp;&nbsp; " . desig_find($emp_data["designationCode"], $conn) . " ( " . dept_find($emp_data["departmentCode"], $conn) . " )" . '</td>';
      $htmlTable .= '</tr>';

      for ($existingRow = 1; $existingRow <= 4; $existingRow++) {
        $htmlTable .= '<tr>';
        // Output data for the existing row
        $htmlTable .= '<td style="padding: 8px;text-align: left;" >' . $excel_particulers[$existingRow - 1] . '</td><td style="padding: 8px;text-align: center;"></td>';

        // Output data for the second column
        for ($col = 3; $col <= (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) + 2); $col++) {



          $arry_index = sprintf("%02d", ($col - 2));
          $data = $emp_data[$arry_index];
          switch ($existingRow) {
            case 1:
              $in_time = explode("\n", $data);
              $database_data = $in_time[0]; // Example database data

              // Regular expression to match the time format (HH:MM:SS)
              $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

              // Check if the database data matches the time pattern
              if (preg_match($time_pattern, $database_data)) {
                $data = $database_data;

              } else {
                $data = "";
              }
              break;
            case 2:
              $out_time = explode("\n", $data);
              $database_data = $out_time[0]; // Example database data

              // Regular expression to match the time format (HH:MM:SS)
              $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

              // Check if the database data matches the time pattern
              if (preg_match($time_pattern, $database_data)) {
                $data = $out_time[1];
              } else {
                $data = "";
              }
              break;
            case 3:
              // Handle Status
              $out_time = explode("\n", $data);
              $database_data = $out_time[0]; // Example database data

              // Regular expression to match the time format (HH:MM:SS)
              $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

              // Check if the database data matches the time pattern
              if (preg_match($time_pattern, $database_data)) {

                $data = $out_time[2];
                if ($data == 'P') {
                  ++$p;

                } else if ($data == 'HD') {
                  ++$HD;
                } else if ($data == 'L') {
                  ++$L;
                } else if ($data == 'WO') {
                  ++$WO;

                } else if ($data == 'H') {
                  ++$H;
                }
              } else {
                $data = $out_time[0];
                if ($data == 'L') {
                  ++$L;
                } else if ($data == 'WO') {
                  ++$WO;
                } else if ($data == 'H') {
                  ++$H;
                }
              }

              break;
            case 4:
              if ($data != "") {
                $out_time = explode("\n", $data);
                $database_data = $out_time[0]; // Example database data

                // Regular expression to match the time format (HH:MM:SS)
                $time_pattern = "/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/";

                // Check if the database data matches the time pattern
                if (preg_match($time_pattern, $database_data)) {
                  $data = $out_time[3];
                } else {
                  $data = $out_time[1];
                }

              }
              break;
          }
          $htmlTable .= '<td style="padding: 8px;text-align: center;">' . $data . '</td>';
        }
        $htmlTable .= '</tr>';
      }

      // Insert the count of 'P' in Status column
      $htmlTable .= '<tr>';
      $htmlTable .= '<td style="padding: 8px;text-align: left;">Count:</td>';
      $htmlTable .= '<td style="padding: 8px;text-align: left;"></td>';
      $htmlTable .= '<td style="padding: 8px;text-align: center;font-weight: 900;font-size: 16px;"colspan="4">Present ( P ) :&nbsp;&nbsp;' . $p . '</td>';
      $htmlTable .= '<td style="padding: 8px;text-align: center;font-weight: 900;font-size: 16px;"colspan="4">Half Day( HD ) :&nbsp;&nbsp;' . $HD . '</td>';
      $htmlTable .= '<td style="padding: 8px;text-align: center;font-weight: 900;font-size: 16px;"colspan="4">Leave ( L ) :&nbsp;&nbsp;' . $L . '</td>';
      $htmlTable .= '<td style="padding: 8px;text-align: center;font-weight: 900;font-size: 16px;"colspan="4">Week Off ( WO ) :&nbsp;&nbsp;' . $WO . '</td>';
      $htmlTable .= '<td style="padding: 8px;text-align: center;font-weight: 900;font-size: 16px;"colspan="4">Holiday ( H ) :&nbsp;&nbsp;' . $H . '</td>';
      // $htmlTable .= str_repeat('<td style="padding: 8px;text-align: center;"></td>', cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) - 2); // Adjust for remaining columns
      $htmlTable .= '</tr>';
    }
  } else {
    // No data message
    $htmlTable .= '<tr><td style="padding: 8px;text-align: center;" colspan="' . (cal_days_in_month(CAL_GREGORIAN, $processMonth, $processYear) + 4) . '">No data available</td></tr>';
  }

  $htmlTable .= '</tbody></table>';
  return $htmlTable;
}

//process atendance report according to individual employees in excel
if (isset($_POST['attendSecondReportEx'])) {
  $des = "load attendance-report-process";
  $rem = "generate report acoding to employee name and month in excel";
  require_once ('../../include/_audiLog.php');

  $processMonth = $_POST['attendSecondReportMonth'];
  $processEmpName = $_POST['reportEmpName'];

  if ($processMonth != "" && $processEmpName != "") {
    $month = date("m", strtotime($processMonth));
    $year = date("Y", strtotime($processMonth));
    $sql = "SELECT * FROM employeeDetails WHERE empCode !='Emp00lst'and empName like '$processEmpName' ";
    if (sql_num_rows($conn, $sql) >= 1) {
      $comData = sqlsrv_fetch_array(sqlsrv_query($conn, $sql), SQLSRV_FETCH_ASSOC);
      $comId = $comData['companyCode'];
      $checkSql = "select * from companyDetails where companyCode = '$comId'";
      $comname = sqlsrv_fetch_array(sqlsrv_query($conn, $checkSql), SQLSRV_FETCH_ASSOC);
      $company = $comname['comFName'];
      $reponseTable = attendanceTable($month, $year, $sql, $conn, $company);
      $fname = $month . "_" . $year . "_" . ucfirst($processEmpName) . ".xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename=' . $fname);
      echo $reponseTable;

    } else {
      $_SESSION['icon_ad'] = 'info';
      $_SESSION['status_ad'] = 'No data exists according to your input';
      header("location:report-Attendance-Ui");
    }

  } else {
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Insuficiant data..';
    header("location:report-Attendance-Ui");
  }

}
//process atendance report according to individual employees in pdf 
if (isset($_POST['attendSecondReportPd'])) {
  $des = "load attendance-report-process";
  $rem = "generate report acoding to employee name and month in pdf";
  require_once ('../../include/_audiLog.php');

  $processMonth = $_POST['attendSecondReportMonth'];
  $processEmpName = $_POST['reportEmpName'];

  if ($processMonth != "" && $processEmpName != "") {
    $month = date("m", strtotime($processMonth));
    $year = date("Y", strtotime($processMonth));
    $sql = "SELECT * FROM employeeDetails WHERE empCode !='Emp00lst'and empName like '$processEmpName'";
    if (sql_num_rows($conn, $sql) >= 1) {
      $comData = sqlsrv_fetch_array(sqlsrv_query($conn, $sql), SQLSRV_FETCH_ASSOC);
      $comId = $comData['companyCode'];
      $checkSql = "select * from companyDetails where companyCode = '$comId'";
      $comname = sqlsrv_fetch_array(sqlsrv_query($conn, $checkSql), SQLSRV_FETCH_ASSOC);
      $company = $comname['comFName'];
      $reponseTable = attendanceTable($month, $year, $sql, $conn, $company);
      echo '  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Attendance-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">' . $reponseTable . '</div>';

    } else {
      $_SESSION['icon_ad'] = 'info';
      $_SESSION['status_ad'] = 'No data exists according to your input';
      header("location:report-Attendance-Ui");
    }

  } else {
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Insuficiant data..';
    header("location:report-Attendance-Ui");
  }

}

// filter data sql create 

function filterDataSql($filterData, $conn)
{
  $sql = "";
  $company = "";
  for ($i = 0; $i < 7; $i++) {
    switch ($i) {
      case 0:
        if ($filterData[$i] != "") {
          $comId = $filterData[$i];
          $checkSql = "select * from companyDetails where companyCode = '$comId'";
          if (sql_num_rows($conn, $checkSql) >= 1) {
            $sql .= "companyCode = '$comId' and ";
            $comname = sqlsrv_fetch_array(sqlsrv_query($conn, $checkSql), SQLSRV_FETCH_ASSOC);
            $company = $comname['comFName'];
          } else {
            $_SESSION['icon_ad'] = 'warning';
            $_SESSION['status_ad'] = 'Please Select Company';
            header("location:report-Attendance-Ui");
          }
        } else {
          $_SESSION['icon_ad'] = 'warning';
          $_SESSION['status_ad'] = 'Please Select Company';
          header("location:report-Attendance-Ui");
        }
        break;
      case 1:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $deptId = $filterData[$i];
          $checkSql = "select * from departmentDetails where deptCode = '$deptId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "departmentCode = '$deptId' and ";
          }
        }
        break;
      case 2:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $desigId = $filterData[$i];
          $checkSql = "select * from designationDetails where desigCode = '$desigId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "designationCode = '$desigId' and ";
          }
        }
        break;
      case 3:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $empTypeId = $filterData[$i];
          $checkSql = "select * from empTypeDetails where empTypeCode = '$empTypeId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "empTypeCode = '$empTypeId' and ";
          }
        }
        break;
      case 4:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $empCatId = $filterData[$i];
          $checkSql = "select * from empCategoryDetails where empCatCode = '$empCatId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "empCategoryCode = '$empCatId' and ";
          }
        }
        break;
      case 5:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $gradeId = $filterData[$i];
          $checkSql = "select * from gradeDetails where gradeCode = '$gradeId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "grade = '$gradeId' and ";
          }
        }
        break;
      case 6:
        if ($filterData[$i] != "" || $filterData[$i] != "All") {
          $locId = $filterData[$i];
          $checkSql = "select * from locationDetails where locationCode = '$locId'";
          if (sql_num_rows($conn, $checkSql) == 1) {
            $sql .= "locationCode = '$locId' and ";
          }
        }
        break;
    }

  }

  return [$sql, $company];
}

// filtered report generate in excel 
if (isset($_POST['filteredReportEx'])) {
  $des = "load attendance-report-process";
  $rem = "generate report acoding to Filtered and month in excel";
  require_once ('../../include/_audiLog.php');

  $filterdReportMonth = $_POST['filteredReportMonth'];
  $filterData = $_POST['filtered'];
  if ($filterdReportMonth != "" && $filterData != "") {
    $returnValue = filterDataSql($filterData, $conn);
    $comName = $returnValue[1];
    $month = date("m", strtotime($filterdReportMonth));
    $year = date("Y", strtotime($filterdReportMonth));
    $sql = "SELECT * FROM employeeDetails WHERE ";
    $sql .= $returnValue[0];
    $sql .= "empCode !='Emp00lst'";
    $reponseTable = attendanceTable($month, $year, $sql, $conn, $comName);
    $fname = "Attendance-Report.xls";
    header('Content-Type:application/octet-stream');
    header('Content-Disposition:attachment; filename=' . $fname);
    echo $reponseTable;


  } else {
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Insuficiant data..';
    header("location:report-Attendance-Ui");
  }
}
// filtered report generate in pdf 
if (isset($_POST['filteredReportPd'])) {
  $des = "load attendance-report-process";
  $rem = "generate report acoding to Filtered and month in excel";
  require_once ('../../include/_audiLog.php');

  $filterdReportMonth = $_POST['filteredReportMonth'];
  $filterData = $_POST['filtered'];
  if ($filterdReportMonth != "" && $filterData != "") {
    $returnValue = filterDataSql($filterData, $conn);
    $comName = $returnValue[1];
    $month = date("m", strtotime($filterdReportMonth));
    $year = date("Y", strtotime($filterdReportMonth));
    $sql = "SELECT * FROM employeeDetails WHERE ";
    $sql .= $returnValue[0];
    $sql .= "empCode !='Emp00lst'";
    $reponseTable = attendanceTable($month, $year, $sql, $conn, $comName);
    echo '  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Attendance-Ui"><button class="btn-primary" >Back</button></a>
      ';
    echo '<div class="print_container">' . $reponseTable . '</div>';


  } else {
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Insuficiant data..';
    header("location:report-Attendance-Ui");
  }
}