<?php
$serverName = "LAPTOP-085B2EGC"; // Replace with your SQL Server's name or IP address
$connectionOptions = array(
    "Database" => "etas",
    "Uid" => "essl",
    "PWD" => "essl"
);
$db_name = $connectionOptions['Database'];
$uid = $connectionOptions['Uid'];
$password = $connectionOptions['PWD'];
try {
    // Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    
    if (!$conn) {
        $errors = sqlsrv_errors();
        $errorMessage = "Unable to connect the database...";
       
        throw new Exception($errorMessage);
    }
    
} catch (Exception $e) {
    $_SESSION['icon'] = 'error';
    $_SESSION['status'] = $e->getMessage(); // Print exception message
}