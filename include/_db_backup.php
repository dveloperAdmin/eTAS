<?php
include '_session.php'; 
include '_dbConnect.php';
include '_function.php';
$des="load dbBackup Uipage";
$rem="dbBackup details page";
$header="Database Backup ";
$headerDes="Database";
include '_audiLog.php';


$sql_db_size_cms = sqlsrv_fetch_array(sqlsrv_query($conn, "	SELECT 
    SUM(TotalSpaceMB) as TotalSpaceMB
from (
    select 
        t.name as TableName,
        s.name as SchemaName,
        p.rows,
        SUM(a.total_pages) * 8 as TotalSpaceKB, 
        CAST(ROUND(((SUM(a.total_pages) * 8) / 1024.00), 2) as numeric(36, 2)) as TotalSpaceMB
     
    from 
        sys.tables t
    inner join      
        sys.indexes i on t.object_id = i.object_id
    inner join 
        sys.partitions p on i.object_id = p.object_id and i.index_id = p.index_id
    inner join 
        sys.allocation_units a on p.partition_id = a.container_id
    left outer join 
        sys.schemas s on t.schema_id = s.schema_id
    where 
        t.name not like 'dt%' 
        and t.is_ms_shipped = 0
        and i.object_id > 255 
    group by 
        t.name, s.name, p.rows
) as TotalSpaceByTable"), SQLSRV_FETCH_ASSOC);


if(isset($_POST['backup'])){
  $batFilePath = 'C:\xampp\htdocs\eTAS\backDb\run.bat';

  // Execute the .bat file
  $output = shell_exec($batFilePath);

  // Check if the output is not empty, indicating that the .bat file was executed
  if (!empty($output)) {
    $filePath = 'C:\xampp\htdocs\eTAS\backDb\db\backup_etas.bak';

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));

    // Clear any output buffers to ensure clean download
    ob_clean();

    // Flush system output buffer
    flush();

    // Read the file and output its contents
    if(readfile($filePath)){
      unlink($filePath);

    }

      // Delete the file after download
    } else {
        $_SESSION['status_ad'] ="Database Not Downloaded";
        $_SESSION['icon_ad'] = "error";
    }
  } else {
        $_SESSION['status_ad'] ="Database backup Not done";
        $_SESSION['icon_ad'] = "error";
    }


}

// Reset Database 
if(isset($_POST['resetDb'])){
  $dropTableSql = "declare @tableName nvarchar(100);
declare @sql nvarchar(max);

declare tableCursor cursor for
select name
from sys.tables
where name like 'attendance%' or name like 'tempattenddetails%'; -- Specify the patterns to match table names

open tableCursor;

fetch next from tableCursor into @tableName;

while @@fetch_status = 0
begin
    set @sql = 'drop table ' + quotename(@tableName) + ';'; -- Construct the drop table statement
    exec sp_executesql @sql; -- Execute the drop table statement

    fetch next from tableCursor into @tableName; -- Move to the next table name
end

close tableCursor;
deallocate tableCursor;
";

$truncateSql = "declare @truncateTable nvarchar(100);
declare @truncateSql nvarchar(max);

declare tableCursor cursor for
select quotename(schema_name(schema_id)) + '.' + quotename(name) as tablename
from sys.tables
where type = 'U' and name! = 'activationKeyDetails'; -- select only user tables

open tableCursor;

fetch next from tableCursor into @truncateTable;

while @@fetch_status = 0
begin
    set @truncateSql = 'truncate table ' + @truncateTable + ';'; -- construct the truncate table statement
    exec sp_executesql @truncateSql; -- execute the truncate table statement

    fetch next from tableCursor into @truncateTable; -- move to the next table name
end

close tableCursor;
deallocate tableCursor;
";

$dropTableQuery = sqlsrv_query($conn,$dropTableSql);
$trunacteQuery = sqlsrv_query($conn,$truncateSql);
$insertSystemEmp = sqlsrv_query($conn,"insert into employeeDetails (empCode, empName) values ('Emp00lst','System')");
$pass = "$2y$10"."$"."F0m9k57LGB52UyB1T0E.PeYc49UGRX86KG62ppkZg0pFsWBKbDfV.";
$insertSystemUser = sqlsrv_query($conn,"insert into loginUser (userCode,mobileNO,mailId,logPass,userRole,name,userStatus)values('AST001','6295479738','sAdmin.info@gmail.com','$pass','Developer','Super Admin','Active')
");
$insertSystem2ndUser = sqlsrv_query($conn,"insert into loginUser (userCode,mobileNO,mailId,logPass,userRole,name,userStatus)values('AST002','8927007789','nbLaha.info@gmail.com','$pass','Developer','Nabyendu Laha','Active')
");
if($dropTableQuery && $trunacteQuery && $insertSystemEmp && $insertSystemUser){
  $_SESSION['icon_ad'] = "success";
  $_SESSION['status_ad'] ="Database Reste SuccessFully";
}else{
  $_SESSION['icon_ad'] = "error";
  $_SESSION['status_ad'] ="Database Reste Failed";
}
}






?>

<!DOCTYPE html>
<html lang="en">

<!-- head segment  -->
<?php include '../admin/include/_head.php';?>

<body>
  <!--start wrapper-->
  <div class="wrapper">
    <?php 
      echo $sql_db_size_cms['TotalSpaceMB'];
        // header & navbar 
        include '../admin/include/_headerSection.php';

        // sidebar segment 
        include '../admin/include/_sideBar.php'
    ?>
    <!--start content-->
    <main class="page-content">
      <?php include '../admin/include/_pageHeader.php' ; ?>
      <div class="card" style="padding:1rem">
        <div class="row">
          <div class="dbBack" style="">
            <div class="col-xl-6 mx-auto">
              <h5 class="header-sec" id="bio_sync">
                Database Name
                :-<?php  echo"<span style='color:red; font-size: 16px;  padding-left: 2rem'>".$db_name."</span>" ?>
              </h5>
              <h5 class="header-sec" id="bio_sync">
                Database Size
                :-<?php  echo"<span style='color:red; font-size: 16px;  padding-left: 2rem'>&nbsp;".$sql_db_size_cms['TotalSpaceMB']." Mb</span>" ?>
              </h5>

            </div>
            <div class="col-xl-6 mx-auto">
              <div class="row">
                <div class="col-xl-6 mx-auto" style="margin:1rem;    display: grid;  justify-content: end;">
                  <?php if(strtolower($user_role) === 'developer'){?>
                  <form action="" method="post">
                    <button type="submit" class="btn waves-effect waves-light btn-primary btn-outline-primary"
                      style="padding: 7px 20px; color:yellow;font-family: 'Oswald', sans-serif; font-weight: 500;"
                      name="resetDb"><i class="fa fa-angle-double-up"
                        style="    font-size: 20px;margin-right: 10px;"></i>
                      Reset <?php echo $db_name;?> Database</button>

                  </form>
                  <?php }?>
                </div>
                <div class="col-xl-6 mx-auto" style="margin:1rem">
                  <form action="" method="post">
                    <button type="submit" class="btn waves-effect waves-light btn-primary btn-outline-primary"
                      style="padding: 7px 20px; color:yellow;font-family: 'Oswald', sans-serif; font-weight: 500;"
                      name="backup"><i class="fa fa-angle-double-up"
                        style="    font-size: 20px;margin-right: 10px;"></i>
                      Download <?php echo $db_name;?> Database</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-6" style="">
          </div> -->
          </div>
        </div>


        <!-- mode segment  -->
        <?php include '../admin/include/_switchMode.php';?>
      </div>
  </div>
  </div>
  </div>

</body>

<!-- footer segment  -->
<?php include '../admin/include/_footer_.php';?>

</html>