<?php
include '../../include/_dbConnect.php';

function generateRandomTimings($startTime, $endTime, $halfDayTimes,$shiftName,$table_name,$conn,$processMonth,$dataPutTable) {
  $calculateMOnth = explode("_",$processMonth);
  $month = $calculateMOnth[0];
  $year = $calculateMOnth[1];
    // Fetch all employees from the database
    $sqlEmployees = "select e.empCode as 'EmployeeCode' from employeeDetails e join $table_name t on e.empCode = t.EmployeeCode";
    $resultEmployees = sqlsrv_query($conn,$sqlEmployees);

    $row_count = sqlsrv_fetch_array(sqlsrv_query($conn,"select count(EmployeeCode) as 'rowCount' from $table_name"), SQLSRV_FETCH_ASSOC)['rowCount'];
    
    if ($row_count > 0) {
        // Generate random timing for each date
        for ($day = 1; $day <= cal_days_in_month(CAL_GREGORIAN, $month,  $year); $day++) {
            $dateOfMonth = "[".sprintf("%02d", $day)."]"; // Assuming date format d/m/y
            
            // Fetch and update timings for all employees
            $randomTimings = generateRandomTiming($startTime, $endTime, $halfDayTimes, $shiftName,$sqlEmployees, $dateOfMonth,$table_name, $conn,$dataPutTable);
            
            // Update the results into the database
            insertTimingsIntoDatabase($randomTimings, $dateOfMonth, $dataPutTable,$conn, $table_name,$shiftName);
        }
        sqlsrv_query($conn,"update processStatusDetails set inprocessStatus = 0 where processMonth = '$month' and processYear = '$year'");
    }
    
}

function generateRandomTiming($startTime, $endTime, $halfDayTimes,$shiftName, $resultEmployees, $dateOfMonth, $table_name, $conn,$dataPutTable) {
    $randomTimings = [];
    
    $resultEmployees = sqlsrv_query($conn, $resultEmployees);
    // Check if $resultEmployees is a valid SQLSRV resource
    if ($resultEmployees !== false) {
        // Fetch data from the result set
        while ($rowEmployee = sqlsrv_fetch_array($resultEmployees, SQLSRV_FETCH_ASSOC)) {
            $employeeCode = $rowEmployee["EmployeeCode"];
            $sql_num_rows = sqlsrv_query($conn, "SELECT COUNT(*) as 'rowCount', $dateOfMonth as 'day_attend' FROM $table_name WHERE [EmployeeCode] = '$employeeCode' GROUP BY $dateOfMonth");
            
            if ($sql_num_rows !== false) {
                // Fetch the row from the result set
                while ($row = sqlsrv_fetch_array($sql_num_rows, SQLSRV_FETCH_ASSOC)) {
                    $rowCount = $row['rowCount'];
                    $day_attendance = strtoupper($row['day_attend']);

                    if ($rowCount == 1) {
                        if ($day_attendance == 'P') {
                            $entryTime = generateRandomTime($startTime[0], $startTime[1]);
                            $exitTime = generateRandomTime($endTime[0], $endTime[1]);
                            $randomTimings[$employeeCode] = [
                              'entry' => $entryTime,
                              'exit' => $exitTime,
                              'status'=> $day_attendance
                            ];
                        } elseif ($day_attendance == 'HD') {
                            $entryTime = generateRandomTime($startTime[0], $startTime[1]);
                            $exitTime = generateRandomTime($halfDayTimes[0], $halfDayTimes[1]);
                            $randomTimings[$employeeCode] = [
                              'entry' => $entryTime,
                              'exit' => $exitTime,
                              'status'=> $day_attendance
                            ];
                        } else if ($day_attendance == 'XL'){
                            $entryTime = 1;
                            $exitTime = 1;
                            $randomTimings[$employeeCode] = [
                              'entry' => $entryTime,
                              'exit' => $exitTime,
                              'status'=> $day_attendance
                            ];
                        }else{
                            if($day_attendance!=""){
                                $sql = "UPDATE $dataPutTable SET $dateOfMonth = '$day_attendance\n$shiftName' WHERE [EmployeeCode] = '$employeeCode'";
                                sqlsrv_query($conn, $sql);

                            }
                        }
                        

                    }
                }
            }
        }
        
        // Reset the result set to the beginning for future fetches
        sqlsrv_free_stmt($resultEmployees);
    } 

    return $randomTimings;
}



function generateRandomTime($startTime, $endTime) {
    $startTimestamp = strtotime($startTime);
    $endTimestamp = strtotime($endTime);

    $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

    return date("H:i:s", $randomTimestamp);
}

function insertTimingsIntoDatabase($randomTimings, $dateOfMonth, $table_name, $conn,$tempTable,$shiftName) {
    foreach ($randomTimings as $employeeCode => $randomTime) {
        $entry = $randomTime['entry'];
        $exit = $randomTime['exit'];
        $status = $randomTime['status'];
        
        // Update the row for each employee code
        if($employeeCode == 'Emp00lst'){
            $sql = "UPDATE $tempTable SET $dateOfMonth = 1 WHERE [EmployeeCode] = '$employeeCode'";
        }else{

            $sql = "UPDATE $table_name SET $dateOfMonth = '$entry\n$exit\n$status\n$shiftName' WHERE [EmployeeCode] = '$employeeCode'";
        }
        
        sqlsrv_query($conn, $sql);
    }

  
}


if(isset($_POST['processMonth'])){
    $retunValue = false;
    $processMonth=$_POST['processMonth'];
    $table_name = "tempAttendDetails_".$processMonth;
    $dataPutTable = "Attendance_".$processMonth;

   
   
  
    
    $checkActivation = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from shiftDetails where shiftStaus = 'Active'"));
    if($checkActivation!=null){
        try{
        $startTimes = [$checkActivation['checkInFrom'],$checkActivation['checkInTo']];
        $halfDayTimes = [$checkActivation['halfCheckOutFrom'],$checkActivation['halfCheckOutTo']];
        $endTimes = [$checkActivation['FcheckOutFrom'],$checkActivation['FcheckOutTo']];
        $shiftName = $checkActivation['shiftName'];

        // main process function
            generateRandomTimings($startTimes, $endTimes, $halfDayTimes ,$shiftName, $table_name,$conn,$processMonth,$dataPutTable);
            
            $retunValue = "sucessCalculation";
        }catch(Exception $e){
            $retunValue = "processCorupt";
        }    
    }else{
    $retunValue = "shiftProblem";
    }
    echo $retunValue;
}

if(isset($_POST['processDate'])){
    $processDate = $_POST['processDate'];
    $month = date("m",strtotime($processDate));
    $year = date("Y",strtotime($processDate));
    $attendDate = date('d', strtotime($processDate)); 
    $attenTableName = "Attendance_".$month."_".$year;
    $attendaDateProcess = "( ".date("d-M-Y",strtotime($processDate))." )";

    // sql for serach attendance for Dashbord
    $attenCountSql = "declare @tableexists int;

    if exists (select 1 from sys.tables where name = '$attenTableName')
        set @tableexists = 1;
    else
        set @tableexists = 0;

    if @tableexists = 1
        begin
            select
                (select count(*) from $attenTableName where [$attendDate] like '%P%' and EmployeeCode!= 'Emp00lst') as present,
                (select count(*) from $attenTableName where [$attendDate] like '%HD%'and EmployeeCode!= 'Emp00lst') as halfDay,
                (select count(*) from $attenTableName where ([$attendDate] like '%L%' or [$attendDate] is NULL) and EmployeeCode!= 'Emp00lst') as leave,
                (select count(*) from $attenTableName where [$attendDate] like '%WO%'and EmployeeCode!= 'Emp00lst') as weekOff;
        end
    else
        select 0 as 'TableNotFound';";

    $empCountQuery = sqlsrv_fetch_array(sqlsrv_query($conn, $attenCountSql), SQLSRV_FETCH_ASSOC);
    if($empCountQuery == false){
    $present = 0;
    $halfDay = 0;
    $leave = 0;
    $weekOff = 0;
    }else {
    if (isset($empCountQuery['present'])) {
        $present = $empCountQuery['present'];
    } else {
        $present = 0; // Default value if 'present' key is not set
    }

    if (isset($empCountQuery['halfDay'])) {
        $halfDay = $empCountQuery['halfDay'];
    } else {
        $halfDay = 0; // Default value if 'halfDay' key is not set
    }

    if (isset($empCountQuery['leave'])) {
        $leave = $empCountQuery['leave'];
    } else {
        $leave = 0; // Default value if 'leave' key is not set
    }

    if (isset($empCountQuery['weekOff'])) {
        $weekOff = $empCountQuery['weekOff'];
    } else {
        $weekOff = 0; // Default value if 'weekOff' key is not set
    }
    }
    
    $responseArray = array(
        'processDate'=>$attendaDateProcess,
        'present'=>$present,
        'halfDay'=>$halfDay,
        'leave' =>$leave,
        'weekoff'=>$weekOff
    );


    echo json_encode($responseArray);

}