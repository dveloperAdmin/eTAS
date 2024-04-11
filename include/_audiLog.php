<?php
include '_dbConnect.php';
$userCode = $_SESSION['user_code'];
$url = $_SERVER['REQUEST_URI'];
$month = date("M");
$year = date("Y");
$in_date = date("Y-m-d");
$timestamp = date("Y-m-d H:i:s");
$log_id = "AUDI-".time();
if($des!=""){

    sqlsrv_query($conn, "insert into audiLogDetails (audiLogId ,  userCode ,  date ,  timeStamp ,  logMonth ,  logYear ,  url ,  description ,  remarks) values ('$log_id','$userCode','$in_date','$timestamp','$month','$year','$url','$des','$rem')"); 
}


//user details
$emp_id ="";
$branch_id ="";
$user_data_sql = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from  loginUser  where  userCode ='$userCode'"), SQLSRV_FETCH_ASSOC);

if($user_data_sql == null){
   

    // logout part
    date_default_timezone_set("Asia/Calcutta");
    $current_date=date("d-M-Y");
    $current_time=date("H:i:s");
    $current_date_time=$current_date." - ".$current_time;
    $log_id = $_SESSION['log_id'];
    $logout_sql = sqlsrv_query($conn,"update logBook set logoutDate='$current_date',logoutTime ='$current_time',logStatus ='OUT' where logID ='$log_id'");
    if($logout_sql){
        $des="Click On Logout Button";
        $rem="Logout Success";
        sqlsrv_query($conn, "insert into audiLogDetails (audiLogId ,  userCode ,  date ,  timeStamp ,  logMonth ,  logYear ,  url ,  description ,  remarks) values ('$log_id','$userCode','$in_date','$timestamp','$month','$year','$url','$des','$rem')"); 

        session_unset();
        session_destroy();
        header("location:index?l=52");
    }
}else{
    $role =  $user_data_sql['userRole'];
    $user_id = $user_data_sql['userCode'];
    $user_name = $user_data_sql['name'];
    $user_role = $user_data_sql['userRole'];
}


// user log details

$user_last_log = sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT *
                                                                FROM (
                                                                    SELECT *,
                                                                        ROW_NUMBER() OVER (ORDER BY sl_no DESC) AS rn
                                                                    FROM logBook where userCode ='$userCode'
                                                                ) AS subquery
                                                                WHERE rn = 2"
                                                    ),SQLSRV_FETCH_ASSOC);
if($user_last_log != null){

    
    if($user_last_log['loginDate'] !=null && $user_last_log['loginTime'] != null){
        $last_login_details = $user_last_log['loginDate']->format("d-m-Y")."&nbsp;&nbsp;&nbsp;".$user_last_log['loginTime']->format("H:i:s");
        
    }else{
        $last_login_details="-/-/- &nbsp; -:-:-";
    }
    if($user_last_log['logoutDate'] !=null && $user_last_log['logoutTime'] != null){
        $last_logout_details = $user_last_log['logoutDate']->format("d-m-Y")."&nbsp;&nbsp;&nbsp;".$user_last_log['logoutTime']->format("H:i:s");
        
    }else{
        $last_logout_details="-/-/- &nbsp; -:-:-";
    }
}else{
     $last_login_details="-/-/- &nbsp; -:-:-";
    $last_logout_details="-/-/- &nbsp; -:-:-";
}



function sql_num_rows($conn, $sql){
    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    if($stmt != false){
        return sqlsrv_num_rows( $stmt );
        
    }else{
        return 0;
    }
    

}