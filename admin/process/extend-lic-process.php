<?php 
include '../../include/_dbConnect.php';
include '../../include/_session.php';
$des="load extend-license-process";
$rem="extended license";
include '../../include/_audiLog.php';


if(isset($_POST['extendLicense'])){
  $key="";
  $blank = 0;

  for($i = 1 ; $i<=29; $i++){
      if($_POST['digit-'.$i] !=""){
          
          $key.= $_POST['digit-'.$i];
      }else{
          $blank+=1;
      }
      
  }
  if($blank == 0 && strlen($key)==29){
   
        // $mac_id = substr($key,2,2)."-".substr($key,10,2)."-".substr($key,18,2)."-".substr($key,22,2)."-".substr($key,14,2)."-".substr($key,6,2) ;
        // $sys_mac_id = mac_id();
        
        // if($mac_id == $sys_mac_id ){
    $ac_co = substr($key,0,2);
    $ac_date = substr($key,4,2 ).substr($key, 8,2). substr($key, 12,2).substr($key,26,3);
    $acm_date = ($ac_date/7);
    $date = substr($acm_date,0,4)."-".substr($acm_date,4,2)."-".substr($acm_date,6,2);
    $ac_user = substr($key,16,2 ).substr($key,20,2 ).substr($key,24,2 ) ;
    $users = (($ac_user/12)-57);
  
    if( date("Y-m-d") < $date && $ac_co == "BT"){
      $myFile = fopen("../../src/license.lic",'r');
      $id="";
      for($i=1; $i<=29;$i++){
          $id.=fgetc($myFile);
      }
      fclose($myFile);
      
      $theData = file("../../src/license.lic");
      
      $id_key =$theData[1];
      $db_code = "";
      $active_key = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from activationKeyDetails where keyId = '$id_key'"),SQLSRV_FETCH_ASSOC);
      if($active_key !=""){
          $db_code = $active_key['activationKey'];
      }
      if(password_verify($id,$db_code)){    
          sqlsrv_query($conn,"truncate activationKeyDetails");

          $fp = fopen("../../src/license.lic", "r+");
          ftruncate($fp, 0);
          fclose($fp);
          
          $key_id = "AK-".time();
          $pass_key =  password_hash($key, PASSWORD_DEFAULT);
          
          sqlsrv_query($conn,"insert into activationKeyDetails(keyId, activationKey, dateOfActivation, dateOfExpire, noOfUsers, status) values ('$key_id','$pass_key',GETUTCDATE(),'$date','$users', 'Active')");
          
          $key_strore = "\n".$key_id;
          $fp = fopen('../../src/license.lic', 'w');
          fwrite($fp, $key);
          fwrite($fp, $key_strore);
          fclose($fp);

          $_SESSION['icon_ad']  = 'success';
          $_SESSION['status_ad']='Your Activation Key Extended'; 
          header("location:../../license-Extend-Ui");
              
      }else{
          
          // session_start();
          $_SESSION['icon_ad'] = 'warning';
          $_SESSION['status_ad']='Somthing Wrong in The Activation Key'; 
          header("location:../../license-Extend-Ui");
          
      }
    }else{
        
        $_SESSION['icon_ad'] = 'error';
        $_SESSION['status_ad']='Activation Key Expired';  
        header("location:../../license-Extend-Ui");
    }
     

        
  }else{
      // session_start();
      $_SESSION['icon_ad'] = 'error';
      $_SESSION['status_ad']='Enter Activation Key CareFully';
      header("location:../../license-Extend-Ui");
  }
    
}