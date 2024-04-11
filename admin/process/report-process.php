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

// audit log report function
function audiLog ($reponseQuery){
   $datatable = "<table border='1' style='text-align:center;'>
  <thead>
    <tr>
        <th>Sl NO</th>
        <th>Log ID</th>
        <th>User Name</th>
        <th>Date Time</th>
        <th>Url</th>
        <th>Description</th>
        <th>Remarks</th>
        
    </tr>
  </thead>";

$setdata = "";
$i=0;
while($rec = sqlsrv_fetch_array($reponseQuery, SQLSRV_FETCH_ASSOC)){
    $i++;

$datatable.="<tr>
        <td>".$i."</td>
        <td>".$rec['audiLogId']."</td>
        <td>".$rec['uname']."</td>
        <td>".$rec['timeStamp']->format('Y-m-d H:i:s')."</td>
        <td>".$rec['url']."</td>
        <td>".$rec['description']."</td>
        <td>".$rec['remarks']."</td>
        
    </tr>";
}
$datatable.="</table>";
 return($datatable);

}
// login report table function 
function logInReport ($reponseQuery){
   $datatable = "<table border='1' style='text-align:center;'>

    <tr>
        <th>Sl NO</th>
        <th>Log ID</th>
        <th>User Name</th>
        <th>Role</th>
        <th>Status</th>
        <th>Login Date</th>
        <th>Login Time</th>
        <th>Logout Date</th>
        <th>Logout Time</th>
        <th>Log Status</th>
    </tr>";

$setdata = "";
$i=0;
while($rec = sqlsrv_fetch_array($reponseQuery,SQLSRV_FETCH_ASSOC)){
  $i++;
  $loginDate = !empty($rec['loginDate']) ? $rec['loginDate']->format('Y-m-d') : '';
  $loginTime = !empty($rec['loginTime']) ? $rec['loginTime']->format('H:i:s') : '';
  $logoutDate = !empty($rec['logoutDate']) ? $rec['logoutDate']->format('Y-m-d') : '';
  $logoutTime = !empty($rec['logoutTime']) ? $rec['logoutTime']->format('H:i:s') : '';

  $datatable.="<tr>
          <td>".$i."</td>
          <td>".$rec['logID']."</td>
          <td>".$rec['name']."</td>
          <td>".$rec['userRole']."</td>
          <td>".$rec['userStatus']."</td>
          <td>".$loginDate."</td>
          <td>".$loginTime."</td>
          <td>".$logoutDate."</td>
          <td>".$logoutTime."</td>
          <td>".$rec['logStatus']."</td>
      </tr>";
  
}
$datatable.="</table>";
 return($datatable);
}

//================================ Audi log report for Admin and developer Role ================================


//user name wise audi log in excel
if(isset($_POST['reportUserEx'])){
  
  $des="load Report-process page for generate audilog excel report";
  $rem="Generate audilog excel report user name wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['reportUser'];
  if($audiUser!=""){
     if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.name like '$audiUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.name like '$audiUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      $fname = "namewise-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}

//user name wise audi log in print
if(isset($_POST['reportUserPd'])){
  
  $des="load Report-process page for generate audilog Pdf report";
  $rem="Generate audilog Pdf report user name wise";
  require_once('../../include/_audiLog.php');
  
  $audiUser=  $_POST['reportUser'];
  if($audiUser!=""){
   
     if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.name like '$audiUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.name like '$audiUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
    
    
  }else{
    $_SESSION['icon_ad']='error' ; 
    $_SESSION['status_ad']='Insuficiant data..' ;
    header("location:report-Audit-Ui");
  }
  
}

//date wise audi log in excel
if(isset($_POST['reportDateEx'])){
  
  $des="load Report-process page for generate audilog excel report";
  $rem="Generate audilog excel report date wise";
  require_once('../../include/_audiLog.php');

  $audiDate=  $_POST['reportDate'];
  if($audiDate!=""){
     if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.date = '$audiDate' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.date = '$audiDate'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      $fname = "dateWise-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}
//date wise audi log in pdf
if(isset($_POST['reportDatePd'])){
  
  $des="load Report-process page for generate audilog Pdf report";
  $rem="Generate audilog Pdf report date wise";
  require_once('../../include/_audiLog.php');

  $audiDate=  $_POST['reportDate'];
  if($audiDate!=""){

    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.date = '$audiDate' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.date = '$audiDate'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
   
     echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}
//month wise audi log in excel
if(isset($_POST['reportMonthEx'])){
  
  $des="load Report-process page for generate audilog Pdf report";
  $rem="Generate audilog Pdf report date wise";
  require_once('../../include/_audiLog.php');

  $audiMonth=  $_POST['reportMonth'];

  
  if($audiMonth!=""){
    $month = date("M",strtotime($audiMonth));
    $year = date("Y",strtotime($audiMonth));
    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.logMonth = '$month' and al.logYear = '$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.logMonth = '$month' and al.logYear = '$year'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
   
      $fname = "monthWise-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}
//month wise audi log in pdf
if(isset($_POST['reportMonthPd'])){
  
  $des="load Report-process page for generate audilog Pdf report";
  $rem="Generate audilog Pdf report date wise";
  require_once('../../include/_audiLog.php');

  $audiMonth=  $_POST['reportMonth'];

  
  if($audiMonth!=""){
    $month = date("M",strtotime($audiMonth));
    $year = date("Y",strtotime($audiMonth));

    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.logMonth = '$month' and al.logYear = '$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where al.logMonth = '$month' and al.logYear = '$year'";

    }

    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
   
     echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}


//==================================== Adudi log report for user Role ================================


//user audit rport  name wise audi log in excel
if(isset($_POST['userreportUserEx'])){
  
  $des="load Report-process page for generate users audilog excel report";
  $rem="Generate users audilog excel report user name wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  if($audiUser!=""){
    
    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      $fname = "user-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}
//user audit rport  name wise audi log in excel
if(isset($_POST['userReportDateEx'])){
  
  $des="load Report-process page for generate users audilog excel report";
  $rem="Generate users audilog excel report user Date wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  $auditDate=  $_POST['userReportDate'];
  if($audiUser!="" && $auditDate!=""){
    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.date ='$auditDate' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.date ='$auditDate' ";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      $fname = "user-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}

//user audit rport  name wise audi log in excel
if(isset($_POST['userReportMonthEx'])){
  
  $des="load Report-process page for generate users audilog excel report";
  $rem="Generate users audilog excel report user Month wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  $audiMonth=  $_POST['UserReportMonth'];
  if($audiUser!="" && $audiMonth!=""){
    $month = date("M",strtotime($audiMonth));
    $year = date("Y",strtotime($audiMonth));
     if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.logMonth ='$month' and al.logYear ='$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.logMonth ='$month' and al.logYear ='$year'";

    }
 
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      $fname = "user-Audi-Log.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}

//user audit rport  name wise audi log in pdf
if(isset($_POST['userreportUserPd'])){
  
  $des="load Report-process page for generate users audilog pdf report";
  $rem="Generate users audilog pdf report user name wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  if($audiUser!=""){
    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
       echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}

//user audit rport  name wise audi log in excel
if(isset($_POST['userReportDatePd'])){
  
  $des="load Report-process page for generate users audilog pdf report";
  $rem="Generate users audilog pdf report user Date wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  $auditDate=  $_POST['userReportDate'];
  if($audiUser!="" && $auditDate!=""){
   
     if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.date ='$auditDate' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.date ='$auditDate' ";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}

//user audit rport  month  wise audi log in pdf
if(isset($_POST['userReportMonthPd'])){
  
  $des="load Report-process page for generate users audilog pdf report";
  $rem="Generate users audilog pdf report user Month wise";
  require_once('../../include/_audiLog.php');

  $audiUser=  $_POST['userreportUserCode'];
  $audiMonth=  $_POST['UserReportMonth'];
  if($audiUser!="" && $audiMonth!=""){
    $month = date("M",strtotime($audiMonth));
    $year = date("Y",strtotime($audiMonth));
    if($user_role != 'Developer'){
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.logMonth ='$month' and al.logYear ='$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.name as uname ,al.* from audiLogDetails as al join loginUser as lu on al.userCode = lu.userCode where lu.userCode = '$audiUser' and al.logMonth ='$month' and al.logYear ='$year'";

    }
    
    
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = audiLog($query);
     echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Audit-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Audit-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Audit-Ui");
  }
}


//==================================== login report for user Role ================================

//user log rport  name wise login in excel
if(isset($_POST['userLogReportUserEx'])){
  
  $des="load Report-process page for generate users Login excel report";
  $rem="Generate users Login excel report user User wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
 
  if($logUser!=""){

    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
     $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}

//user log rport  name wise login in excel
if(isset($_POST['userLogReportDateEx'])){
  
  $des="load Report-process page for generate users Login excel report";
  $rem="Generate users Login excel report user date wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
  $dateReport = $_POST['userLogReportDate'];
 
  if($logUser!="" && $dateReport!=""){

   if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.loginDate='$dateReport' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.loginDate='$dateReport'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}
//user log rport  name wise login in pdf
if(isset($_POST['userLogReportMonthEx'])){
  
  $des="load Report-process page for generate users Login excel report";
  $rem="Generate users Login excel report user Month wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
  $monthReport = $_POST['UserLogReportMonth'];
 
  if($logUser!="" && $monthReport!=""){
    $month = date("M",strtotime($monthReport));
    $year = date("Y",strtotime($monthReport));

    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.logMonth='$month' and lb.logYear = '$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.logMonth='$month' and lb.logYear = '$year'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
       $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}


//user log rport  name wise login in pdf
if(isset($_POST['userLogReportUserPd'])){
  
  $des="load Report-process page for generate users Login pdf report";
  $rem="Generate users Login pdf report user user wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
 
  if($logUser!=""){
    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
     echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}

//user log rport  name wise login in pdf
if(isset($_POST['userLogReportDatePd'])){
  
  $des="load Report-process page for generate users Login pdf report";
  $rem="Generate users Login pdf report user Date wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
  $dateReport = $_POST['userLogReportDate'];
 
  if($logUser!="" && $dateReport!=""){

    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.loginDate='$dateReport' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.loginDate='$dateReport'";

    }
   
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}


//log rport  month wise login in pdf
if(isset($_POST['userLogReportMonthPd'])){
  
  $des="load Report-process page for generate users Login pdf report";
  $rem="Generate users Login pdf report user Month wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['userLogReportUserCode'];
  $monthReport = $_POST['UserLogReportMonth'];
 
  if($logUser!="" && $monthReport!=""){
    $month = date("M",strtotime($monthReport));
    $year = date("Y",strtotime($monthReport));
    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.logMonth='$month' and lb.logYear = '$year' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.userCode = '$logUser' and lb.logMonth='$month' and lb.logYear = '$year'";

    }

   
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}


//======================= Login log report for Admin and developer Role ========================

// login report in excel as name wise 
if(isset($_POST['logReportUserEx'])){
  
  $des="load Report-process page for generate Login excel report";
  $rem="Generate Login excel report user User wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['logreportUser'];
 
  if($logUser!=""){
    if($user_role != 'Developer'){
      $sql = "if (select userRole from loginUser where name like '$logUser' ) != 'Developer'
                begin
                  select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lu.name like '$logUser' and lu.userRole !='Developer'
                end
              ";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lu.name like '$logUser'";

    }
    // if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
     $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    // }else{
      
    //   $_SESSION['icon_ad']='info' ; 
    //   $_SESSION['status_ad']='No data exists according to your input' ;
    //   header("location:report-Log-Ui");
    // }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}
// login report in pdf as name wise 
if(isset($_POST['logReportUserPd'])){
  
  $des="load Report-process page for generate Login pdf report";
  $rem="Generate Login pdf report user User wise";
  require_once('../../include/_audiLog.php');

  $logUser=  $_POST['logreportUser'];
 
  if($logUser!=""){
    if($user_role != 'Developer'){
      $sql = "if (select userRole from loginUser where name like '$logUser') != 'Developer'
              begin
                select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lu.name like '$logUser' and lu.userRole !='Developer'
              end
            ";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lu.name like '$logUser'";

    }
    
    // if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    // }else{
      
    //   $_SESSION['icon_ad']='info' ; 
    //   $_SESSION['status_ad']='No data exists according to your input' ;
    //   header("location:report-Log-Ui");
    // }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}

//login report   date wise login in excel
if(isset($_POST['logReportDateEx'])){
  
  $des="load Report-process page for generate Login excel report";
  $rem="Generate Login excel report user Date wise";
  require_once('../../include/_audiLog.php');

  $dateReport = $_POST['logReportDate'];
  if($dateReport!=""){

    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.loginDate='$dateReport' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.loginDate='$dateReport'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}
//login report date wise login in pdf
if(isset($_POST['logReportDatePd'])){
  
  $des="load Report-process page for generate  Login pdf report";
  $rem="Generate Login pdf report user Date wise";
  require_once('../../include/_audiLog.php');

  $dateReport = $_POST['logReportDate'];
  if($dateReport!=""){
    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.loginDate='$dateReport' and lu.userRole !='Developer'";
      
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.loginDate='$dateReport'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
       echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}


//log report  month wise login in excel
if(isset($_POST['logReportMonthEx'])){
  
  $des="load Report-process page for generate Login excel report";
  $rem="Generate Login excel report user Month wise";
  require_once('../../include/_audiLog.php');

  
  $monthReport = $_POST['logReportMonth'];
 
  if($monthReport!=""){
    $month = date("M",strtotime($monthReport));
    $year = date("Y",strtotime($monthReport));

    if($user_role != 'Developer'){
        $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.logMonth='$month' and lb.logYear = '$year' and lu.userRole !='Developer'";
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.logMonth='$month' and lb.logYear = '$year'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      $fname = "Login-report.xls";
      header('Content-Type:application/octet-stream');
      header('Content-Disposition:attachment; filename='.$fname);
      echo $reponseTable;
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}

//log report  month wise login in pdf
if(isset($_POST['logReportMonthPd'])){
  
  $des="load Report-process page for generate Login excel report";
  $rem="Generate Login excel report user Month wise";
  require_once('../../include/_audiLog.php');

  
  $monthReport = $_POST['logReportMonth'];
 
 
  if($monthReport!=""){
    $month = date("M",strtotime($monthReport));
    $year = date("Y",strtotime($monthReport));
    if($user_role != 'Developer'){
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.logMonth='$month' and lb.logYear = '$year' and lu.userRole !='Developer'";
    }else{
      $sql = "select lu.userCode, lu.name, lu.userRole,lu.userStatus, lb.* from logBook as lb join loginUser as lu on lb.userCode = lu.userCode where lb.logMonth='$month' and lb.logYear = '$year'";

    }
    if(sql_num_rows($conn, $sql) >=1){
      $query = sqlsrv_query($conn, $sql);
      $reponseTable = logInReport($query);
      echo'  <button class="btn-primary" onclick="window.print()">Print</button>
      <a href="report-Log-Ui"><button class="btn-primary" >Back</button></a>
      ';
      echo '<div class="print_container">'.$reponseTable.'</div>';
    }else{
      
      $_SESSION['icon_ad']='info' ; 
      $_SESSION['status_ad']='No data exists according to your input' ;
      header("location:report-Log-Ui");
    }
  }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='Insuficiant data..' ;
      header("location:report-Log-Ui");
  }
}