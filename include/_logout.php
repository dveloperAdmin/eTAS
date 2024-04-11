<?php
include '_dbConnect.php';
session_start();
date_default_timezone_set("Asia/Calcutta");
$current_date=date("d-M-Y");
$current_time=date("H:i:s");
$current_date_time=$current_date." - ".$current_time;
$log_id = $_SESSION['log_id'];
$logout_sql = sqlsrv_query($conn,"update logBook set logoutDate='$current_date',logoutTime ='$current_time',logStatus ='OUT' where logID ='$log_id'");
if($logout_sql){
    $des="Click On Logout Button";
    $rem="Logout Success";
    include '../include/_audiLog.php';

    session_unset();
    session_destroy();
    header("location:../");
}