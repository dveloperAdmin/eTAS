<?php
include '../../include/_session.php'; 
include '../../include/_dbConnect.php';
$des="load comapny-ui page";
$rem="Company details page";
$header="Comapny Details";
$headerDes="Comapny Entry";
include '../../include/_audiLog.php'; 



// New company Add 
if(isset($_POST['comAdd'])){
  $comRegNo = $_POST['comRegNo'];
  $comapnyName = ucwords($_POST['comFName']);
  $comapnySName = strtolower($_POST['comFName']);
  if($comRegNo!="" && $comapnyName!=""){
    $comCode = "COM-".time();
    $checkDataCount = sql_num_rows($conn,"select * from companyDetails where companyRegNo = '$comRegNo'");
    if($checkDataCount<1){       
      $insert_com_sql = "insert into companyDetails (companyCode,companyRegNo, comFName,comSName) values('$comCode','$comRegNo','$comapnyName','$comapnySName')";
      $inser_stmt = sqlsrv_query($conn, $insert_com_sql);
      if($inser_stmt){

        $_SESSION['icon_ad'] = 'success';
        $_SESSION['status_ad'] = 'Comapny Added Successfully..';
        header("location:../../company-Ui");
      }else{
        $_SESSION['icon_ad'] = 'error';
        $_SESSION['status_ad'] = 'Company Not Added';
        header("location:../../company-Ui");

      }

    }else{
      $_SESSION['icon_ad'] = 'error';
      $_SESSION['status_ad'] = 'Comapny Already Exists';
      header("location:../../company-Ui");
      
    }

  }else{
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Please enter the proper Information';
    header("location:../../company-Ui");
  }
  


}

// company edit section 
 
if(isset($_POST['comEdit'])){
  $comRegNo = $_POST['comRegNo'];
  $comapnyName = $_POST['comFName'];
  $comFName = ucwords($comapnyName);
  $comSName = strtolower($comapnyName);
  if($comRegNo!="" && $comapnyName!=""){
    $checkDataCount = sql_num_rows($conn,"select * from companyDetails where companyRegNo = '$comRegNo' and comFName = '$comFName'");
    if($checkDataCount<1){ 
      $update_com_sql = "update companyDetails set comFName = '$comFName',comSName ='$comSName' where companyRegNo = '$comRegNo'";
      $inser_stmt = sqlsrv_query($conn, $update_com_sql);
      if($inser_stmt){
        $_SESSION['icon_ad'] = 'success';
        $_SESSION['status_ad'] = 'Comapny Updated Successfully..';
        header("location:../../company-Ui");
      }else{
        $_SESSION['icon_ad'] = 'error';
        $_SESSION['status_ad'] = 'Company Not Updated';
        header("location:../../company-Ui");

      }

    }else{
      $_SESSION['icon_ad'] = 'waring';
      $_SESSION['status_ad'] = 'Comapny Name Already Exists';
      header("location:../../company-Ui");
      
    }
  }else{
    $_SESSION['icon_ad'] = 'warning';
    $_SESSION['status_ad'] = 'Please enter the proper Information';
    header("location:../../company-Ui");
  }
}

//com details

if(isset($_POST['regNo'])){
 $regeCode = $_POST['regNo'];
  if($regeCode!="" ){
    $checkDataCount = sql_num_rows($conn,"select * from companyDetails where companyRegNo = '$regeCode'");
    if($checkDataCount>0){ 
      $delete_com_sql = "delete from companyDetails where companyRegNo = '$regeCode'";
      $delete_stmt = sqlsrv_query($conn, $delete_com_sql);
      if($delete_stmt){
        $responseArray= array(
         
            'alertTitle' => 'Deleted SuccessFully.',
            'alertIcon' => 'success',
        
          'redirectUrl'=> 'company-Ui'
        );
        
      }else{
        $responseArray= array(
          
            'alertTitle' => 'Not Deleted....',
            'alertIcon' => 'error',
       
          'redirectUrl'=> 'company-Ui'
        );
        
      }


    }else{
      $responseArray= array(
        
          'alertTitle' => 'Comapny Not Exists',
          'alertIcon' => 'waring',
     
          'redirectUrl'=> 'company-Ui'
        );
    }
  }else{
    $responseArray= array(
          
            'alertTitle' => 'Insuficiant Data...',
            'alertIcon' => 'waring',
          
          'redirectUrl'=> 'company-Ui'
        );
  }
  header('Content-Type: application/json');
echo json_encode($responseArray);
  // echo $checkDataCount;
}



// New branch Add
if(isset($_POST['branchAdd'])){
$branchName = ucwords($_POST['branchName']);

  if($branchName!=""){
    $brnCode = "BRN-".time();
    $checkDataCount = sql_num_rows($conn,"select * from branchDetails where branch = '$branchName'");
    if($checkDataCount<1){ 
      $insert_brn_sql="insert into branchDetails (branchCode,branch) values('$brnCode','$branchName')"; 
      $inser_stmt=sqlsrv_query($conn, $insert_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Branch Added Successfully..' ; 
        header("location:../../branch-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Branch Not Added' ; 
        header("location:../../branch-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Branch Already Exists' ;
      header("location:../../branch-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../branch-Ui"); 
  } 
}
// edit Branch
if(isset($_POST['brnEdit'])){
  $branchName = ucwords($_POST['brnName']);
  $brachCode = $_POST['branchCode'];

  if($branchName!="" && $brachCode!=""){
    
    $checkDataCount = sql_num_rows($conn,"select * from branchDetails where branchCode= '$brachCode' and branch = '$branchName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update branchDetails set branch ='$branchName' where branchCode= '$brachCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Branch Updated Successfully..' ; 
        header("location:../../branch-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Branch Not Update' ; 
        header("location:../../branch-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Branch Already Exists' ;
      header("location:../../branch-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../branch-Ui"); 
  } 
}



//department Add

if(isset($_POST['deptAdd'])){
  $deptName = ucwords($_POST['deptName']);
  if($deptName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from departmentDetails where department = '$deptName'");
    if($checkDataExists<1){
      $deptCode = "DEPT-".time();
      $insertDeptSql= "insert into departmentDetails (deptCode, department) values('$deptCode','$deptName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Department Added Successfully' ; 
        header("location:../../department-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Department Not Added...' ; 
        header("location:../../department-Ui"); 

      }

    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Department Already Exists..' ; 
      header("location:../../department-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../department-Ui"); 
  }
}


// / edit department
if(isset($_POST['deptEdit'])){
  $deptName = ucwords($_POST['deptName']);
  $deptCode = $_POST['deptCode'];

  if($deptName!="" && $deptCode!=""){
    $brnCode = "BRN-".time();
    $checkDataCount = sql_num_rows($conn,"select * from departmentDetails where deptCode= '$deptCode' and department = '$deptName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update departmentDetails set department ='$deptName' where deptCode= '$deptCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Department Updated Successfully..' ; 
        header("location:../../department-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Department Not Update' ; 
        header("location:../../department-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Department Already Exists' ;
      header("location:../../department-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../department-Ui"); 
  } 
}



// Sub department Add

if(isset($_POST['subdeptAdd'])){
  $subDeptName = ucwords($_POST['subdeptName']);
  if($subDeptName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from subDepartmantDetails where subDepartment = '$subDeptName'");
    if($checkDataExists<1){
      $subDeptCode = "SDEPT-".time();
      $insertDeptSql= "insert into subDepartmantDetails (subDeptCode, subDepartment) values('$subDeptCode','$subDeptName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Department Added Successfully' ; 
        header("location:../../subdepartment-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Sub-Department Not Added...' ; 
        header("location:../../subdepartment-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Sub-Department Already Exists..' ; 
      header("location:../../subdepartment-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdepartment-Ui"); 
  }
}

// edit Sub department
if(isset($_POST['subdeptEdit'])){
  $subdeptName = ucwords($_POST['subdeptName']);
  $subdeptCode = $_POST['subdeptCode'];

  if($subdeptName!="" && $subdeptCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from subDepartmantDetails where subDeptCode= '$subdeptCode' and subDepartment = '$subdeptName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update subDepartmantDetails set subDepartment ='$subdeptName' where subDeptCode= '$subdeptCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Department Updated Successfully..' ; 
        header("location:../../subdepartment-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Sub-Department Not Update' ; 
        header("location:../../subdepartment-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Sub-Department Already Exists' ;
      header("location:../../subdepartment-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdepartment-Ui"); 
  } 
}

// Designation Add

if(isset($_POST['desigAdd'])){
  $desigName = ucwords($_POST['desigName']);
  if($desigName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from designationDetails where designation = '$desigName'");
    if($checkDataExists<1){
      $desigCode = "DESIG-".time();
      $insertDeptSql= "insert into designationDetails (desigCode, designation) values('$desigCode','$desigName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Designation Added Successfully' ; 
        header("location:../../designation-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Designation Not Added...' ; 
        header("location:../../designation-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Designation Already Exists..' ; 
      header("location:../../designation-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../designation-Ui"); 
  }
}

// edit designation
if(isset($_POST['desigEdit'])){
  $desigName = ucwords($_POST['desigName']);
  $desigCode = $_POST['desigCode'];

  if($desigName!="" && $desigCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from designationDetails where desigCode= '$desigCode' and designation = '$desigName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update designationDetails set designation ='$desigName' where desigCode= '$desigCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Designation Updated Successfully..' ; 
        header("location:../../designation-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Designation Not Update' ; 
        header("location:../../designation-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Designation Already Exists' ;
      header("location:../../designation-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../designation-Ui"); 
  } 
}


// Sub Designation Add

if(isset($_POST['subdesigAdd'])){
  $subdesigName = ucwords($_POST['subdesigName']);
  if($subdesigName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from subDesignationDetails where subDesignation = '$subdesigName'");
    if($checkDataExists<1){
      $subdesigCode = "SDESIG-".time();
      $insertDeptSql= "insert into subDesignationDetails (subDesigCode, subDesignation) values('$subdesigCode','$subdesigName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Designation Added Successfully' ; 
        header("location:../../subdesignation-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Sub-Designation Not Added...' ; 
        header("location:../../subdesignation-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Sub-Designation Already Exists..' ; 
      header("location:../../subdesignation-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdesignation-Ui"); 
  }
}


// edit Sub Desisgnation
if(isset($_POST['subdesigEdit'])){
  $subdesigName = ucwords($_POST['subdesigName']);
  $subdesigCode = $_POST['subdesigCode'];

  if($subdesigName!="" && $subdesigCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from subDesignationDetails where subDesigCode= '$subdesigCode' and subDesignation = '$subdesigName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update subDesignationDetails set subDesignation ='$subdesigName' where subDesigCode= '$subdesigCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Designation Updated Successfully..' ; 
        header("location:../../subdesignation-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Sub-Designation Not Update' ; 
        header("location:../../subdesignation-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Sub-Designation Already Exists' ;
      header("location:../../subdesignation-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdesignation-Ui"); 
  } 
}



// Division Add

if(isset($_POST['divisionAdd'])){
  $divisionName = ucwords($_POST['divisionName']);
  if($divisionName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from divisionDetails where division = '$divisionName'");
    if($checkDataExists<1){
      $divisionCode = "DIV-".time();
      $insertDeptSql= "insert into divisionDetails (divisionCode, division) values('$divisionCode','$divisionName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Division Added Successfully' ; 
        header("location:../../division-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Division Not Added...' ; 
        header("location:../../division-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Division Already Exists..' ; 
      header("location:../../division-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../division-Ui"); 
  }
}

// edit division
if(isset($_POST['divisionEdit'])){
  $divisionName = ucwords($_POST['divisionName']);
  $divisionCode = $_POST['divisionCode'];

  if($divisionName!="" && $divisionCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from divisionDetails where divisionCode= '$divisionCode' and division = '$divisionName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update divisionDetails set division ='$divisionName' where divisionCode= '$divisionCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Division Updated Successfully..' ; 
        header("location:../../division-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Division Not Update' ; 
        header("location:../../division-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Division Already Exists' ;
      header("location:../../division-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../division-Ui"); 
  } 
}



// Sub Division Add

if(isset($_POST['subdivAdd'])){
  $subdivName = ucwords($_POST['subdivName']);
  if($subdivName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from subDivisionDetails where subDivision = '$subdivName'");
    if($checkDataExists<1){
      $subdivCode = "SDIV-".time();
      $insertDeptSql= "insert into subDivisionDetails (subDiviCode, subDivision) values('$subdivCode','$subdivName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Division Added Successfully' ; 
        header("location:../../subdivision-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Sub-Division Not Added...' ; 
        header("location:../../subdivision-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Sub-Division Already Exists..' ; 
      header("location:../../subdivision-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdivision-Ui"); 
  }
}

// edit Sub division
if(isset($_POST['subdivEdit'])){
  $subdivName = ucwords($_POST['subdivName']);
  $subdivCode = $_POST['subdivCode'];

  if($subdivName!="" && $subdivCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from subDivisionDetails where subDiviCode= '$subdivCode' and subDivision = '$subdivName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update subDivisionDetails set subDivision ='$subdivName' where subDiviCode= '$subdivCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Sub-Division Updated Successfully..' ; 
        header("location:../../subdivision-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Sub-Division Not Update' ; 
        header("location:../../subdivision-Ui");
      }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Sub-Division Already Exists' ;
      header("location:../../subdivision-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../subdivision-Ui"); 
  } 
}

// emp.Categary Add

if(isset($_POST['empcatAdd'])){
  $empcatName = ucwords($_POST['empcatName']);
  if($empcatName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from empCategoryDetails where empCategory = '$empcatName'");
    if($checkDataExists<1){
      $empcatCode = "CATE-".time();
      $insertDeptSql= "insert into empCategoryDetails (empCatCode, empCategory) values('$empcatCode','$empcatName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Category Added Successfully' ; 
        header("location:../../emp.category-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Emp. Category Not Added...' ; 
        header("location:../../emp.category-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Emp. Category Already Exists..' ; 
      header("location:../../emp.category-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.category-Ui"); 
  }
}


// edit emp. Cate
if(isset($_POST['empcatEdit'])){
  $empcatName = ucwords($_POST['empcatName']);
  $empcatCode = $_POST['empcatCode'];

  if($empcatName!="" && $empcatCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from empCategoryDetails where empCatCode = '$empcatCode' and empCategory = '$empcatName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update empCategoryDetails set empCategory ='$empcatName' where empCatCode = '$empcatCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Category Updated Successfully..' ; 
        header("location:../../emp.category-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Emp. Category Not Update' ; 
        header("location:../../emp.category-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Emp. Category Already Exists' ;
      header("location:../../emp.category-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.category-Ui"); 
  } 
}

// emp.SubCategary Add

if(isset($_POST['empsubcatAdd'])){
  $empsubcatName = ucwords($_POST['empsubcatName']);
  if($empsubcatName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from empSubCategoryDetails where empSubCategory = '$empsubcatName'");
    if($checkDataExists<1){
      $empsubcatCode = "SCATE-".time();
      $insertDeptSql= "insert into empSubCategoryDetails (empSubCatCode, empSubCategory) values('$empsubcatCode','$empsubcatName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Sub-Category Added Successfully' ; 
        header("location:../../emp.subcategory-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Emp. Sub-Category Not Added...' ; 
        header("location:../../emp.subcategory-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Emp. Sub-Category Already Exists..' ; 
      header("location:../../emp.subcategory-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.subcategory-Ui"); 
  }
}


// edit emp. subCate

if(isset($_POST['empsubcatEdit'])){
  $empsubcatName = ucwords($_POST['empsubcatName']);
  $empsubcatCode = $_POST['empsubcatCode'];

  if($empsubcatName!="" && $empsubcatCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from empSubCategoryDetails where empSubCatCode = '$empsubcatCode' and empSubCategory = '$empsubcatName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update empSubCategoryDetails set empSubCategory ='$empsubcatName' where empSubCatCode = '$empsubcatCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Sub-Category Updated Successfully..' ; 
        header("location:../../emp.subcategory-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Emp. Sub-Category Not Update' ; 
        header("location:../../emp.subcategory-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Emp. Sub-Category Already Exists' ;
      header("location:../../emp.subcategory-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.subcategory-Ui"); 
  } 
}


// emp.type Add

if(isset($_POST['emptypeAdd'])){
  $emptypeName = ucwords($_POST['emptypeName']);
  if($emptypeName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from empTypeDetails where empType = '$emptypeName'");
    if($checkDataExists<1){
      $emptypeCode = "TY-".time();
      $insertDeptSql= "insert into empTypeDetails (empTypeCode, empType) values('$emptypeCode','$emptypeName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Type Added Successfully' ; 
        header("location:../../emp.type-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Emp. Type Not Added...' ; 
        header("location:../../emp.type-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Emp. Type Already Exists..' ; 
      header("location:../../emp.type-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.type-Ui"); 
  }
}


// edit emp. type

if(isset($_POST['emptypeEdit'])){
  $emptypeName = ucwords($_POST['emptypeName']);
  $emptypeCode = $_POST['emptypeCode'];

  if($emptypeName!="" && $emptypeCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from empTypeDetails where empTypeCode = '$emptypeCode' and empType = '$emptypeName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update empTypeDetails set empType ='$emptypeName' where empTypeCode = '$emptypeCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Emp. Type Updated Successfully..' ; 
        header("location:../../emp.type-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Emp. Type Not Update' ; 
        header("location:../../emp.type-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Emp. Type Already Exists' ;
      header("location:../../emp.type-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../emp.type-Ui"); 
  } 
}

// grade Add

if(isset($_POST['gradeAdd'])){
  $gradeName = ucwords($_POST['gradeName']);
  if($gradeName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from gradeDetails where grade = '$gradeName'");
    if($checkDataExists<1){
      $gradeCode = "GRD-".time();
      $insertDeptSql= "insert into gradeDetails (gradeCode, grade) values('$gradeCode','$gradeName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Grade Added Successfully' ; 
        header("location:../../grade-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Grade Not Added...' ; 
        header("location:../../grade-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Grade Already Exists..' ; 
      header("location:../../grade-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../grade-Ui"); 
  }
}


// edit grade

if(isset($_POST['gradeEdit'])){
  $gradeName = ucwords($_POST['gradeName']);
  $gradeCode = $_POST['gradeCode'];

  if($gradeName!="" && $gradeCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from gradeDetails where gradeCode = '$gradeCode' and grade = '$gradeName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update gradeDetails set grade ='$gradeName' where gradeCode = '$gradeCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Grade Updated Successfully..' ; 
        header("location:../../grade-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Grade Not Update' ; 
        header("location:../../grade-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Grade Already Exists' ;
      header("location:../../grade-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../grade-Ui"); 
  } 
}

// Location Add

if(isset($_POST['locaAdd'])){
  $locaName = ucwords($_POST['locaName']);
  if($locaName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from locationDetails where location = '$locaName'");
    if($checkDataExists<1){
      $locaCode = "LOC-".time();
      $insertDeptSql= "insert into locationDetails (locationCode, location) values('$locaCode','$locaName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Location Added Successfully' ; 
        header("location:../../location-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Location Not Added...' ; 
        header("location:../../location-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Location Already Exists..' ; 
      header("location:../../location-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../location-Ui"); 
  }
}



// edit Location

if(isset($_POST['locaEdit'])){
  $locaName = ucwords($_POST['locaName']);
  $locaCode = $_POST['locaCode'];

  if($locaName!="" && $locaCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from locationDetails where locationCode = '$locaCode' and location = '$locaName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update locationDetails set location ='$locaName' where locationCode = '$locaCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Location Updated Successfully..' ; 
        header("location:../../location-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Location Not Update' ; 
        header("location:../../location-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Location Already Exists' ;
      header("location:../../location-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../location-Ui"); 
  } 
}

// Team Add

if(isset($_POST['teamAdd'])){
  $teamName = ucwords($_POST['teamName']);
  if($teamName !=""){
    $checkDataExists = sql_num_rows($conn,"select * from teamDetails where teamName = '$teamName'");
    if($checkDataExists<1){
      $teamCode = "TM-".time();
      $insertDeptSql= "insert into teamDetails (teamCode, teamName) values('$teamCode','$teamName')";
      $insertQuery = sqlsrv_query($conn, $insertDeptSql);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Team Added Successfully' ; 
        header("location:../../team-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Team Not Added...' ; 
        header("location:../../team-Ui"); 
      }
    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Team Already Exists..' ; 
      header("location:../../team-Ui"); 
    }
  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../team-Ui"); 
  }
}

// edit team 
if(isset($_POST['teamEdit'])){
  $teamName = ucwords($_POST['teamName']);
  $teamCode = $_POST['teamCode'];

  if($teamName!="" && $teamCode!=""){
   
    $checkDataCount = sql_num_rows($conn,"select * from teamDetails where teamCode = '$teamCode' and teamName = '$teamName'");
    if($checkDataCount<1){ 
      $update_brn_sql="update teamDetails set teamName ='$teamName' where teamCode = '$teamCode'"; 
      $inser_stmt=sqlsrv_query($conn, $update_brn_sql); 
      if($inser_stmt){ 
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Team Updated Successfully..' ; 
        header("location:../../team-Ui"); 
      }else{
        $_SESSION['icon_ad']='error' ; 
        $_SESSION['status_ad']='Team Not Update' ; 
        header("location:../../team-Ui"); }
    }else{ 
      $_SESSION['icon_ad']='warning' ; 
      $_SESSION['status_ad']='Team Already Exists' ;
      header("location:../../team-Ui"); 
    } 
  }else{ 
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../team-Ui"); 
  } 
}



// add shift
if(isset($_POST['shiftAdd'])){
  $shiftName = $_POST['shiftName'];
  $shiftChIn = $_POST['shiftChIn'];
  $shiftHChOut = $_POST['shiftHChOut'];
  $shiftFChOut = $_POST['shiftFChOut'];
  $shiftTimingDur = $_POST['shiftDuration'];

  if($shiftName!="" && $shiftChIn!="" && $shiftHChOut!="" && $shiftFChOut!="" && $shiftTimingDur!=""){
    // check in dutration
    $checkinFrom = date("H:i:s",(strtotime($shiftChIn)-($shiftTimingDur * 60)));
    $checkinTo = date("H:i:s",(strtotime($shiftChIn)+($shiftTimingDur * 60)));
    // half day Checkout duration
    $HcheckoutFrom = date("H:i:s",(strtotime($shiftHChOut)));
    $HcheckoutTo = date("H:i:s",(strtotime($shiftHChOut)+((2*$shiftTimingDur) * 60)));
    // Full day Checkout duration
    $FcheckoutFrom = date("H:i:s",(strtotime($shiftFChOut)));
    $FcheckoutTo = date("H:i:s",(strtotime($shiftFChOut)+((2*$shiftTimingDur) * 60)));
    $checkNumRows = sql_num_rows($conn, "select * from shiftDetails where shiftStaus = 'Active'");
    if($checkNumRows<1){
      $activeStatus = "Active";
    }else{
      $activeStatus = "Deactive";

    }

    $checkDublicateValue = sql_num_rows($conn, "select * from shiftDetails where shiftName='$shiftName'");
    if($checkDublicateValue<1){
      $shiftCode = "SFT-".time();
      $shiftInsert = "insert into shiftDetails (shiftCode,shiftName,checkInTime,HcheckOutTime,checkOutTime,duration,checkInFrom,checkInTo, halfCheckOutFrom,halfCheckOutTo,FcheckOutFrom,FcheckOutTo,shiftStaus) values('$shiftCode','$shiftName','$shiftChIn','$shiftHChOut','$shiftFChOut','$shiftTimingDur','$checkinFrom','$checkinTo','$HcheckoutFrom','$HcheckoutTo','$FcheckoutFrom','$FcheckoutTo','$activeStatus')";
      $insertQuery = sqlsrv_query($conn,$shiftInsert);
      if($insertQuery){
        $_SESSION['icon_ad']='success' ;
        $_SESSION['status_ad']='Shift Added Successfully...' ; 
        header("location:../../shift-Details"); 
      
      }else{
        $_SESSION['icon_ad']='error' ;
        $_SESSION['status_ad']='Shift not Added' ; 
        header("location:../../shift-Details"); 
      }

    }else{
      $_SESSION['icon_ad']='warning' ;
      $_SESSION['status_ad']='Shift Already Exists...' ; 
      header("location:../../shift-Details"); 
    }

  }else{
    $_SESSION['icon_ad']='warning' ;
    $_SESSION['status_ad']='Please enter the proper Information' ; 
    header("location:../../shift-Details"); 
  }

}
// Edit shift
if(isset($_POST['shiftEdit'])){
  $shiftEditCode = $_POST['shiftEditCode'];
  $shiftName = $_POST['shiftName'];
  $shiftChIn = $_POST['shiftChIn'];
  $shiftHChOut = $_POST['shiftHChOut'];
  $shiftFChOut = $_POST['shiftFChOut'];
  $shiftTimingDur = $_POST['shiftDuration'];
  $shiftStatus = $_POST['shiftStatus'];
echo $shiftStatus;
  if($shiftName!="" && $shiftChIn!="" && $shiftHChOut!="" && $shiftFChOut!="" && $shiftTimingDur!=""){
    // check in dutration
    $checkinFrom = date("H:i:s",(strtotime($shiftChIn)-($shiftTimingDur * 60)));
    $checkinTo = date("H:i:s",(strtotime($shiftChIn)+($shiftTimingDur * 60)));
    // half day Checkout duration
    $HcheckoutFrom = date("H:i:s",(strtotime($shiftHChOut)));
    $HcheckoutTo = date("H:i:s",(strtotime($shiftHChOut)+((2*$shiftTimingDur) * 60)));
    // Full day Checkout duration
    $FcheckoutFrom = date("H:i:s",(strtotime($shiftFChOut)));
    $FcheckoutTo = date("H:i:s",(strtotime($shiftFChOut)+((2*$shiftTimingDur) * 60)));

    if($shiftStatus == 'Active'){
      $checkNumRows = sql_num_rows($conn, "select * from shiftDetails where shiftStaus = 'Active'");
      if($checkNumRows>=1){
        $checkCode = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from shiftDetails where shiftStaus = 'Active'"), SQLSRV_FETCH_ASSOC);
        if($checkCode['shiftCode'] !=  $shiftEditCode){
          $_SESSION['icon_ad']='warning' ;
          $_SESSION['status_ad']='One Shift Already Active' ; 
          header("location:../../shift-Details"); 
          exit;
        }
      }
    }
    $checkDublicateValue = sql_num_rows($conn, "select * from shiftDetails where shiftName='$shiftName'");
    if($checkDublicateValue>=1){
      $checkCode =sql_num_rows($conn,"select * from shiftDetails where  shiftName= '$shiftName' and shiftCode = '$shiftEditCode'");
      if($checkCode<1){
        $_SESSION['icon_ad']='warning' ;
        $_SESSION['status_ad']='Dublicat Shift Name' ; 
        header("location:../../shift-Details"); 
        exit;
      }
    }
     
    $shiftInsert = "update shiftDetails set shiftName='$shiftName',checkInTime = '$shiftChIn',HcheckOutTime ='$shiftHChOut',checkOutTime = '$shiftFChOut', duration = '$shiftTimingDur', checkInFrom = '$checkinFrom', checkInTo = '$checkinTo', halfCheckOutFrom = '$HcheckoutFrom', halfCheckOutTo = '$HcheckoutTo', FcheckOutFrom = '$FcheckoutFrom', FcheckOutTo = '$FcheckoutTo', shiftStaus = '$shiftStatus' where shiftCode = '$shiftEditCode'";
    $insertQuery = sqlsrv_query($conn,$shiftInsert);
    if($insertQuery){
      $_SESSION['icon_ad']='success' ;
      $_SESSION['status_ad']='Shift Updated Successfully...' ; 
      header("location:../../shift-Details"); 
    
    }else{
      $_SESSION['icon_ad']='error' ;
      $_SESSION['status_ad']='Shift not Updated' ; 
      header("location:../../shift-Details"); 
    }
  }
   

}
?>