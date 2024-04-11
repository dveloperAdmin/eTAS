<?php
include '../../include/_session.php'; 
include '../../include/_dbConnect.php';
$des="load User-process page";
$rem="User process page";
include '../../include/_audiLog.php'; 

//user add 
if(isset($_POST['userAdd'])){
  $name=$_POST['UserName'];
  $email=$_POST['userGmail'];
  $phone=$_POST['userMobile'];
  $role=$_POST['userRole'];
  $u_pass = "eTAS".date("Y");
  $last_userCode = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from (
        select *,
            ROW_NUMBER() over (order by sl_no desc) as rn
        from loginUser
    ) as subquery
    where rn = 1"), SQLSRV_FETCH_ASSOC);
    $lastUserCode = explode("00",$last_userCode['userCode']);
  $userCode ="ATS00".((int)$lastUserCode[1]+1);
  if($name!="" && $email!="" && $phone!="" && $role!=""){
    $checkDublicateUserCredential  = sql_num_rows($conn, "select * from loginUser where mobileNO = '$phone'");
    if($checkDublicateUserCredential <1){
      $pass = password_hash($u_pass,PASSWORD_DEFAULT);
      $userQuery = "insert into loginUser(userCode,mobileNO,mailId,logPass,userRole,name) values('$userCode','$phone','$email','$pass','$role','$name')";
      $insertExiqution = sqlsrv_query($conn, $userQuery);
      if($insertExiqution){
        $_SESSION['icon_ad']='success' ; 
        $_SESSION['status_ad']='User Entry Successfull';
        header("location:../../user-Ui"); 

      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='User Entry Failed..';
        header("location:../../user-Ui");
      }

    }else{
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='User Already Exists';
      header("location:../../user-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ; 
    $_SESSION['status_ad']='Insufficient Data';
    header("location:../../user-Ui"); 
  }
}

//user edit 
if(isset($_POST['editUser'])){
  $userCode = $_POST['userCode'];
  $name=$_POST['UserName'];
  $email=$_POST['userGmail'];
  $phone=$_POST['userMobile'];
  $role=$_POST['userRole'];
  $userStatus=$_POST['userSts'];
  $u_pass = "eTAS".date("Y");
 
  if($userCode!=""&&$name!="" && $email!="" && $phone!="" && $role!=""){
    $checkDublicateUserCredential  = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row', userCode from loginUser where mobileNO = '$phone' group by userCode,mobileNO"), SQLSRV_FETCH_ASSOC);
    if($checkDublicateUserCredential!=false && $checkDublicateUserCredential['row'] == 1){
      if($checkDublicateUserCredential['userCode'] != $userCode) {
        // echo $checkDublicateUserCredential['userCode']."->".$userCode;
        $_SESSION['icon_ad']='warning' ; 
        $_SESSION['status_ad']='User Already Exists';
        header("location:../../user-Ui");
        exit();
      }
    }
    $userQuery = "update loginUser set mobileNO ='$phone',mailId='$email',userRole='$role',name='$name',userStatus = '$userStatus' where userCode = '$userCode'";
    $insertExiqution = sqlsrv_query($conn, $userQuery);

    if($insertExiqution){
      $_SESSION['icon_ad']='success' ; 
      $_SESSION['status_ad']='User Details Updated';
      header("location:../../user-Ui"); 

    }else{
      $_SESSION['icon_ad']='error' ; 
      $_SESSION['status_ad']='User Details not Updated';
      header("location:../../user-Ui");
    }
  }else{
    $_SESSION['icon_ad']='warning' ; 
    $_SESSION['status_ad']='Insufficient Data';
    header("location:../../user-Ui"); 
  }
}

//chnage Password

if(isset($_POST['chngPass'])){
  $userCode = $_POST['userCode'];
  $newPass = $_POST['password'];
  $conPass = $_POST['confirmPassword'];
  if($userCode!="" && $newPass!="" && $conPass!=""){
    if($newPass==$conPass){
      $sql_fetch_dbpass = sqlsrv_fetch_array(sqlsrv_query($conn, "select * from loginUser where userCode = '$userCode'"), SQLSRV_FETCH_ASSOC);
      $dbpass = $sql_fetch_dbpass['logPass'];
    
      if (password_verify($conPass, $dbpass)) {
        $_SESSION['icon_ad']='warning' ; 
        $_SESSION['status_ad']="New password cannot be the same as the current password";
        header("location:../../changepassword-Ui");
        exit();
      } else {         
        $newpassword = password_hash($conPass,PASSWORD_DEFAULT);
        $userQuery = "update loginUser set logPass = '$newpassword' where userCode = '$userCode'";
        $insertExiqution = sqlsrv_query($conn, $userQuery);
        if($insertExiqution){
          $_SESSION['chamgePAss_icon']='success' ; 
          $_SESSION['chamgePAss_status']='Password Changed successfully. Please Relogin to Continue your Session';
          header("location:../../changepassword-Ui");  
        }else{
          $_SESSION['icon_ad']='error' ;  
          $_SESSION['status_ad']= 'Failed to Change Password';
          header("location:../../changepassword-Ui");
        }
      }
    }else{
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Password and ConfirmPassword Mismatch';
      header("location:../../changepassword-Ui");
    }

  }else{
    $_SESSION['icon_ad']='warning' ; 
    $_SESSION['status_ad']='Insufficient Data';
    header("location:../../changepassword-Ui");
  }

}