<?php 
include '_session.php'; 
include '_dbConnect.php';
include '_function.php';
$des = "load dbBackup process page";
$rem = "dbBackup process page";
$header = "Database Backup ";
$headerDes = "Database";
include '_audiLog.php';

$serverName = "YOUR_SERVER_NAME"; // Change this to your SQL Server host
$connectionOptions = array(
    "Database" => $db_name, // Change this to your database name
    "Uid" => $uid, // Change this to your username
    "PWD" => $password // Change this to your password
);

Export_Database($conn,$db_name, $tables = false, $backup_name = false);

function Export_Database($conn, $backupdb_name, $tables = false, $backup_name = false)
{
     $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'";
    $stmt = sqlsrv_query($conn, $sql);
    $target_tables = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $target_tables[] = $row['TABLE_NAME'];
    }

    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }

    $content = "";
    foreach ($target_tables as $table) {
        $sql = "SELECT * FROM $table";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            echo "Error retrieving data from table: $table";
            continue;
        }
        
        $fields = sqlsrv_num_fields($stmt);
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $content .= "INSERT INTO $table VALUES (";
            foreach ($row as $key => $value) {
                // Check if the value is a DateTime object
                if ($value instanceof DateTime) {
                    $value = $value->format('Y-m-d H:i:s'); // Convert DateTime to string
                }
                $content .= "'" . addslashes($value) . "', ";
            }
            $content = rtrim($content, ", ") . ");\n";
        }
        $content .= "\n\n";
        sqlsrv_free_stmt($stmt);
    }

    sqlsrv_close($conn);

    $backup_name = $backup_name ? $backup_name : $backupdb_name . ".sql";
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . $backup_name . "\"");
    echo $content;
    exit;
}
?>