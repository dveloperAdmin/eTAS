<?php
include '../../include/_session.php'; 
include '../../include/_dbConnect.php';
include '../../include/_function.php';
// $des="load ajax page";
// $rem="Ajax page";
// require_once('../../include/_audiLog.php');



function formEdit($formHeading, $firstLabel, $firstData,$valuHolder, $seccondLabel, $seccondData,$valueName,$placeholderName,$btnValueName,$btnName, $pageHeaderName,$backUrl){
$htmlForm = '<div class="border p-3 rounded">
                  <h6 class="mb-0 text-uppercase">'.$formHeading.'</h6>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">
                    
                    <div class="col-12">
                      <label class="form-label">'.$firstLabel.'</label>
                      <label class="form-control" disabled>'.$firstData.'</label>
                      <input type="hidden" value="'.$firstData.'" name="'.$valuHolder.'" />
                    </div>
                    <div class="col-12">
                      <label class="form-label">'.$seccondLabel.'</label>
                      <input type="text" class="form-control" placeholder="Enter the '.$placeholderName.' name" name="'.$valueName.'" value="'.$seccondData.'"
                        required autofocus/>
                    </div>
                    <div class="col-12">
                      <div class="d-flex" style="justify-content: flex-end;">
                        <button type="submit" class="btn btn-primary" name="'.$btnValueName.'" style="margin-right:.5rem">
                          <i class="bi bi-pencil-square"></i>
                          Edit '.$btnName.'
                        </button>
                        <a href="'.$backUrl.'"<button type="click" class="btn btn-secondary" >
                          <i class="bi bi-arrow-clockwise"></i>
                          Back
                        </button></a>
                      </div>
                    </div>
                  </form>
                </div>';
  $responseArray = array(
    'formConteent'=>$htmlForm,
    'pageHeaderSec' => $pageHeaderName
  );
  return $responseArray;
}
function formView($formHeading, $firstLabel, $firstData, $seccondLabel, $seccondData, $pageHeaderName,$backUrl){
$htmlForm = '<div class="border p-3 rounded">
                  <h6 class="mb-0 text-uppercase">'.$formHeading.'</h6>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">
                    
                    <div class="col-12">
                      <label class="form-label">'.$firstLabel.'</label>
                      <label class="form-control" disabled>'.$firstData.'</label>
                      
                    </div>
                    <div class="col-12">
                      <label class="form-label">'.$seccondLabel.'</label>
                      <label class="form-control" disabled>'.$seccondData.'</label>
                        
                    </div>
                    <div class="col-12">
                      <div class="d-flex" style="justify-content: flex-end;">
                        
                        <a href="'.$backUrl.'"<button type="click" class="btn btn-secondary" >
                          <i class="bi bi-arrow-clockwise"></i>
                          Back
                        </button></a>
                      </div>
                    </div>
                  </form>
                </div>';
  $responseArray = array(
    'formConteent'=>$htmlForm,
    'pageHeaderSec' => $pageHeaderName
  );
  return $responseArray;
}



function newForm($formHeading,$inputName, $submitBtnName, $pageHeaderName){
  $htmlForm = '<div class="border p-3 rounded">
                  <h6 class="mb-0 text-uppercase">New '.$formHeading.'</h6>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">
                    <div class="col-12">
                      <label class="form-label">'.$formHeading.' Name</label>
                      <input type="text" class="form-control" placeholder="Enter the '.$formHeading.'" name="'.$inputName.'"
                        required />
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-info" name="'.$submitBtnName.'">
                          <i class="bi bi-plus-lg"></i>
                          Add '.$formHeading.'
                        </button>
                      </div>
                    </div>
                  </form>
                </div>';
                
  $responseArray = array(
    'formConteent'=>$htmlForm,
    'pageHeaderSec' => $pageHeaderName
  );
  return $responseArray;
}
              
function loadTable($tableHeaderArray, $branchTabledata,$code,$name){
    $htmlTable = '<table class="table align-middle comTable" id="dataTable">
                    <thead class="table-secondary table-header">
                      <tr>';
                       for ($i = 0; $i < count($tableHeaderArray); $i++) {
                            $htmlTable .= '<th>' . $tableHeaderArray[$i] . '</th>';
                        }
    $htmlTable .=' </tr>
                    </thead>
                    <tbody>';
                      $i = 0; while($tableDataFetch = sqlsrv_fetch_array($branchTabledata , SQLSRV_FETCH_ASSOC)){
    $htmlTable .='     <tr>
                        <td>'. ++$i.'</td>
                        <td>'.$tableDataFetch[$code].'</td>
                        <td>'.$tableDataFetch[$name].'</td>
                        <input type="hidden" value="branch">
                        <td>
                          <div class="table-actions d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary btnView" data-bs-toggle="tooltip" data-bs-placement="bottom"
                              title="Views"><i class="bi bi-eye-fill"></i></a>
                            <a href="javascript:;" class="text-warning btnEdit" data-bs-toggle="tooltip" data-bs-placement="bottom"
                              title="Edit "><i class="bi bi-pencil-fill"></i></a>
                            <a href="javascript:;" class="text-danger btnDelt" data-bs-toggle="tooltip" data-bs-placement="bottom"
                              title="Delete"><i class="bi bi-trash-fill"></i></a>
                          </div>
                        </td>
                      </tr>';
                      }
   $htmlTable .='                   
              </tbody>
              </table>';
  
   $responseArray = array(
    'tableConteent'=>$htmlTable,
    
  );
  return $responseArray;

}

// company Edit
if(isset($_POST['code'])){
  $des="load ajax page for Company Edit";
  $rem="Company Edit";
  require_once('../../include/_audiLog.php');

  $comCode = $_POST['code'];
  $comRegNo = $_POST['regNo'];

  $serchData = sqlsrv_query($conn,"select * from companyDetails where companyRegNo ='$comRegNo'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $comFname = $searchData['comFName'];
  $comRegno = $searchData['companyRegNo'];

  //funtion call
  $responseArray = formEdit('Edit Company Details', 'Com. Registration No.', $comRegNo,'comRegNo' ,'Company Name',
  $comFname,'comFName','Company','comEdit', 'Company Details','Comapny Edit','company-Ui');

  echo json_encode($responseArray);

}

// company view
if(isset($_POST['RegCode'])){
  $des="load ajax page for Company View";
  $rem="Company View";
  require_once('../../include/_audiLog.php');
  
  $comCode = $_POST['RegCode'];
  $comRegNo = $_POST['regNo'];

  $serchData = sqlsrv_query($conn,"select * from companyDetails where companyRegNo ='$comRegNo'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $comFname = $searchData['comFName'];
  $comRegno = $searchData['companyRegNo'];

  //funtion call
  $responseArray = formView('View Company Details', 'Com. Registation No', $comRegno, 'Company Name', $comFname, 'Company
  View','company-Ui');

  echo json_encode($responseArray);

}

//branch edit

if(isset($_POST['branchEditCode'])){
  $des="load ajax page for Branch Edit";
  $rem="Barnch Edit";
  require_once('../../include/_audiLog.php');
  
  $branchCode = $_POST['branchEditCode'];
  $serchData = sqlsrv_query($conn,"select * from branchDetails where branchCode ='$branchCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $branchCode = $searchData['branchCode'];
  $branchName = $searchData['branch'];

  //funtion call
  $responseArray = formEdit('Edit Branch Details', 'Branch Code', $branchCode, 'branchCode' ,'Branch Name',
  $branchName,'brnName','Branch','brnEdit','Branch Details' ,'Branch Edit','branch-Ui');

  echo json_encode($responseArray);

}

//branch view

if(isset($_POST['branchViewCode'])){
  $des="load ajax page for Branch View";
  $rem="Branch View";
  require_once('../../include/_audiLog.php');
  $branchCode = $_POST['branchViewCode'];
  $serchData = sqlsrv_query($conn,"select * from branchDetails where branchCode ='$branchCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $branchCode = $searchData['branchCode'];
  $branchName = $searchData['branch'];

  //funtion call
  $responseArray = formView('View Branch Details', 'Branch Code', $branchCode, 'Branch Name', $branchName, 'Branch
  View','branch-Ui');

  echo json_encode($responseArray);

}
//branch delete

if(isset($_POST['branchDelCode'])){
  $des="load ajax page for Branch Delete";
  $rem="Branch Delete";
  require_once('../../include/_audiLog.php');
  $branchCode = $_POST['branchDelCode'];
  $delete_brn_sql = "delete from branchDetails where branchCode = '$branchCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'branch-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'branch-Ui'
    );
  }
  $branchTabledata = sqlsrv_query($conn,"select * from branchDetails");
  $code="branchCode";
  $name="branch";
  //funtion call
  $responseform = newForm('Branch','branchName', 'branchAdd', 'Branch Entry');

  $tableHeaderArray = array('Count','Branch Code','Branch Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $branchTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}


  //department edit

if(isset($_POST['deptEditCode'])){
  $des="load ajax page for Department Edit";
  $rem="Department Edit";
  require_once('../../include/_audiLog.php');

  $deptCode = $_POST['deptEditCode'];
  $serchData = sqlsrv_query($conn,"select * from departmentDetails where deptCode ='$deptCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $deptCode = $searchData['deptCode'];
  $deptName = $searchData['department'];

  //funtion call
  $responseArray = formEdit('Edit Department Details', 'Department Code', $deptCode, 'deptCode' ,'Department Name', $deptName,'deptName','Department','deptEdit','Department Details' ,'Department Edit','department-Ui');

  echo json_encode($responseArray);

}


//department view

if(isset($_POST['deptViewCode'])){
  $des="load ajax page for Department View";
  $rem="Department View";
  require_once('../../include/_audiLog.php');

  $deptCode = $_POST['deptViewCode'];
  $serchData = sqlsrv_query($conn,"select * from departmentDetails where deptCode ='$deptCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $deptCode = $searchData['deptCode'];
  $deptName = $searchData['department'];

  //funtion call
  $responseArray = formView('View Department Details', 'Department Code', $deptCode, 'Department Name', $deptName, 'Department View','department-Ui');

  echo json_encode($responseArray);

}

// department delete
if(isset($_POST['deptDelCode'])){
  $des="load ajax page for Department Delete";
  $rem="Department Delete";
  require_once('../../include/_audiLog.php');

  $deptCode = $_POST['deptDelCode'];
  $delete_brn_sql = "delete from departmentDetails where deptCode = '$deptCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'department-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'department-Ui'
    );
  }
  $deptTabledata = sqlsrv_query($conn,"select * from departmentDetails");
  $code="deptCode";
  $name="department";
  //funtion call
  $responseform = newForm('Department','deptName', 'deptAdd', 'Department Entry');

  $tableHeaderArray = array('Count','Department Code','Department Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $deptTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

//Subdepartment edit

if(isset($_POST['subdeptEditCode'])){
  $des="load ajax page for Sub-Department Edit";
  $rem="Sub-Department Edit";
  require_once('../../include/_audiLog.php');

  $subdeptCode = $_POST['subdeptEditCode'];
  $serchData = sqlsrv_query($conn,"select * from subDepartmantDetails where subDeptCode ='$subdeptCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $subdeptCode = $searchData['subDeptCode'];
  $subdeptName = $searchData['subDepartment'];

  //funtion call
  $responseArray = formEdit('Edit Sub-Department Details', 'Sub-Department Code', $subdeptCode, 'subdeptCode' ,'Sub-Department Name', $subdeptName,'subdeptName','Sub-Department','subdeptEdit','Sub-Department Details' ,'Sub-Department Edit','subdepartment-Ui');

  echo json_encode($responseArray);

}

//subdepartment view

if(isset($_POST['subdeptViewCode'])){
  $des="load ajax page for Sub-Department View";
  $rem="Sub-Department View";
  require_once('../../include/_audiLog.php');
  $subdeptCode = $_POST['subdeptViewCode'];
  $serchData = sqlsrv_query($conn,"select * from subDepartmantDetails where subDeptCode ='$subdeptCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $subdeptCode = $searchData['subDeptCode'];
  $subdeptName = $searchData['subDepartment'];

  //funtion call
  $responseArray = formView('View Sub-Department Details', 'Sub-Department Code', $subdeptCode, 'Sub-Department Name', $subdeptName, 'Sub-Department View','subdepartment-Ui');

  echo json_encode($responseArray);

}

// Subdepartment delete
if(isset($_POST['subdeptDelCode'])){
  $des="load ajax page for Sub-Department Delete";
  $rem="Sub-Department Delete";
  require_once('../../include/_audiLog.php');

  $subdeptCode = $_POST['subdeptDelCode'];
  $delete_brn_sql = "delete from subDepartmantDetails where subDeptCode = '$subdeptCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'subdepartment-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'subdepartment-Ui'
    );
  }
  $subdeptTabledata = sqlsrv_query($conn,"select * from subDepartmantDetails");
  $code="subDeptCode";
  $name="subDepartment";
  //funtion call
  $responseform = newForm('Sub-Department','subdeptName', 'subdeptAdd', 'Sub-Department Entry');

  $tableHeaderArray = array('Count','Sub-Department Code','Sub-Department Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $subdeptTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}


//Designation edit

if(isset($_POST['desigEditCode'])){
  $des="load ajax page for Designation Edit";
  $rem="Designation Edit";
  require_once('../../include/_audiLog.php');

  $desigCode = $_POST['desigEditCode'];
  $serchData = sqlsrv_query($conn,"select * from designationDetails where desigCode ='$desigCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $desigCode = $searchData['desigCode'];
  $desigName = $searchData['designation'];

  //funtion call
  $responseArray = formEdit('Edit Desination Details', 'Desination Code', $desigCode, 'desigCode' ,'Desination Name', $desigName,'desigName','Desination','desigEdit','Desination Details' ,'Desination Edit','designation-Ui');

  echo json_encode($responseArray);
}

//Designation view

if(isset($_POST['desigViewCode'])){
  $des="load ajax page for Designation View";
  $rem="Designation View";
  require_once('../../include/_audiLog.php');

  $desigCode = $_POST['desigViewCode'];
  $serchData = sqlsrv_query($conn,"select * from designationDetails where desigCode ='$desigCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $desigCode = $searchData['desigCode'];
    $desigName = $searchData['designation'];

  }else{
    $desigCode = " NotFound";
    $desigName = "Not Found";

  }

  //funtion call
  $responseArray = formView('View Designation Details', 'Designation Code', $desigCode, 'Designation Name', $desigName, 'Designation View','designation-Ui');

  echo json_encode($responseArray);

}

// desination delete
if(isset($_POST['desigDelCode'])){
  $des="load ajax page for Designation Delete";
  $rem="Designation Delete";
  require_once('../../include/_audiLog.php');
  
  $desigCode = $_POST['desigDelCode'];
  $delete_brn_sql = "delete from designationDetails where desigCode = '$desigCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'designation-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'designation-Ui'
    );
  }
  $desigTabledata = sqlsrv_query($conn,"select * from designationDetails");
  $code="desigCode";
  $name="designation";
  //funtion call
  $responseform = newForm('Designation','desigName', 'desigAdd', 'Designation Entry');

  $tableHeaderArray = array('Count','Designation Code','Designation Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $desigTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

//sub Designation edit

if(isset($_POST['subdesigEditCode'])){
  $des="load ajax page for Sub-Designation Edit";
  $rem="Sub-Designation Edit";
  require_once('../../include/_audiLog.php');
  
  $subdesigCode = $_POST['subdesigEditCode'];
  $serchData = sqlsrv_query($conn,"select * from subDesignationDetails where subDesigCode ='$subdesigCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $subdesigCode = $searchData['subDesigCode'];
  $subdesigName = $searchData['subDesignation'];

  //funtion call
  $responseArray = formEdit('Edit Sub-Desination Details', 'Sub-Desination Code', $subdesigCode, 'subdesigCode' ,'Sub-Desination Name', $subdesigName,'subdesigName','Sub-Desination','subdesigEdit','Sub-Desination Details' ,'Sub-Desination Edit','subdesignation-Ui');

  echo json_encode($responseArray);
}

// sub Designation view

if(isset($_POST['subdesigViewCode'])){
  $des="load ajax page for Sub-Designation View";
  $rem="Sub-Designation View";
  require_once('../../include/_audiLog.php');

  $subdesigCode = $_POST['subdesigViewCode'];
  $serchData = sqlsrv_query($conn,"select * from subDesignationDetails where subDesigCode ='$subdesigCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $subdesigCode = $searchData['subDesigCode'];
    $subdesigName = $searchData['subDesignation'];

  }else{
    $subdesigCode = " NotFound";
    $subdesigName = "Not Found";

  }

  //funtion call
  $responseArray = formView('View Sub-Designation Details', 'Sub-Designation Code', $subdesigCode, 'Sub-Designation Name', $subdesigName, 'Sub-Designation View','subdesignation-Ui');

  echo json_encode($responseArray);

}


//sub  desination delete
if(isset($_POST['subdesigDelCode'])){
  $des="load ajax page for Sub-Designation Delete";
  $rem="Sub-Designation Delete";
  require_once('../../include/_audiLog.php');

  $subdesigCode = $_POST['subdesigDelCode'];
  $delete_brn_sql = "delete from subDesignationDetails where subDesigCode = '$subdesigCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'subdesignation-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'subdesignation-Ui'
    );
  }
  $subdesigTabledata = sqlsrv_query($conn,"select * from subDesignationDetails");
  $code="subDesigCode";
  $name="subDesignation";
  //funtion call
  $responseform = newForm('Sub-Designation','subdesigName', 'subdesigAdd', 'Sub-Designation Entry');

  $tableHeaderArray = array('Count','Sub-Designation Code','Sub-Designation Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $subdesigTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

//Division edit

if(isset($_POST['divisionEditCode'])){
  $des="load ajax page for Division Edit";
  $rem="Division Edit";
  require_once('../../include/_audiLog.php');

  $divisionCode = $_POST['divisionEditCode'];
  $serchData = sqlsrv_query($conn,"select * from divisionDetails where divisionCode ='$divisionCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $divisionCode = $searchData['divisionCode'];
  $divisionName = $searchData['division'];

  //funtion call
  $responseArray = formEdit('Edit Division Details', 'Division Code', $divisionCode, 'divisionCode' ,'Division Name', $divisionName,'divisionName','Division','divisionEdit','Division Details' ,'Division Edit','division-Ui');

  echo json_encode($responseArray);
}


// Division view

if(isset($_POST['divisionViewCode'])){
  $des="load ajax page for Division View";
  $rem="Division View";
  require_once('../../include/_audiLog.php');

  $divisionCode = $_POST['divisionViewCode'];
  $serchData = sqlsrv_query($conn,"select * from divisionDetails where divisionCode ='$divisionCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $divisionCode = $searchData['divisionCode'];
    $divisionName = $searchData['division'];

  }else{
    $divisionCode = " NotFound";
    $divisionName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Division Details', 'Division Code', $divisionCode, 'Division Name', $divisionName, 'Division View','division-Ui');

  echo json_encode($responseArray);

}

//Division delete
if(isset($_POST['divisionDelCode'])){
  $des="load ajax page for Division Delete";
  $rem="Division Delete";
  require_once('../../include/_audiLog.php');
  
  $divisionCode = $_POST['divisionDelCode'];
  $delete_brn_sql = "delete from divisionDetails where divisionCode = '$divisionCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'division-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'division-Ui'
    );
  }
  $divisionTabledata = sqlsrv_query($conn,"select * from divisionDetails");
  $code="divisionCode";
  $name="division";
  //funtion call
  $responseform = newForm('Division','divisionName', 'divisionAdd', 'Division Entry');

  $tableHeaderArray = array('Count','Division Code','Division Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $divisionTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}


// SubDivision edit

if(isset($_POST['subdivEditCode'])){
  $des="load ajax page for Sub-Division Edit";
  $rem="Sub-Division Edit";
  require_once('../../include/_audiLog.php');

  $subdivCode = $_POST['subdivEditCode'];
  $serchData = sqlsrv_query($conn,"select * from subDivisionDetails where subDiviCode ='$subdivCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $subdivCode = $searchData['subDiviCode'];
  $subdivName = $searchData['subDivision'];

  //funtion call
  $responseArray = formEdit('Edit Sub-Division Details', 'Sub-Division Code', $subdivCode, 'subdivCode' ,'Sub-Division Name', $subdivName,'subdivName','Sub-Division','subdivEdit','Sub-Division Details' ,'Sub-Division Edit','subdivision-Ui');

  echo json_encode($responseArray);
}

// sub Division view

if(isset($_POST['subdivViewCode'])){
  $des="load ajax page for Sub-Division View";
  $rem="Sub-Division View";
  require_once('../../include/_audiLog.php');

  $subdivCode = $_POST['subdivViewCode'];
  $serchData = sqlsrv_query($conn,"select * from subDivisionDetails where subDiviCode ='$subdivCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $subdivCode = $searchData['subDiviCode'];
    $subdivName = $searchData['subDivision'];

  }else{
    $subdivCode = " NotFound";
    $subdivName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Sub-Division Details', 'Sub-Division Code', $subdivCode, 'Sub-Division Name', $subdivName, 'Sub-Division View','subdivision-Ui');

  echo json_encode($responseArray);

}


//Sub- Division delete
if(isset($_POST['subdivDelCode'])){
  $des="load ajax page for Sub-Division Delete";
  $rem="Sub-Division Delete";
  require_once('../../include/_audiLog.php');
  
  $subdivCode = $_POST['subdivDelCode'];
  $delete_brn_sql = "delete from subDivisionDetails where subDiviCode = '$subdivCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'subdivision-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'subdivision-Ui'
    );
  }
  $subdivTabledata = sqlsrv_query($conn,"select * from subDivisionDetails");
  $code="subDiviCode";
  $name="subDivision";
  //funtion call
  $responseform = newForm('Sub-Division','subdivName', 'subdivAdd', 'Sub-Division Entry');

  $tableHeaderArray = array('Count','Sub-Division Code','Sub-Division Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $subdivTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

// Emp. Category edit

if(isset($_POST['empcatEditCode'])){
  $des="load ajax page for Employe Category Edit";
  $rem="Employe Category Edit";
  require_once('../../include/_audiLog.php');

  $empcatCode = $_POST['empcatEditCode'];
  $serchData = sqlsrv_query($conn,"select * from empCategoryDetails where empCatCode ='$empcatCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $empcatCode = $searchData['empCatCode'];
  $empcatName = $searchData['empCategory'];

  //funtion call
  $responseArray = formEdit('Edit Emp. Category Details', 'Emp. Category Code', $empcatCode, 'empcatCode' ,'Emp. Category Name', $empcatName,'empcatName','Emp. Category','empcatEdit','Emp. Category Details' ,'Emp. Category Edit','emp.category-Ui');

  echo json_encode($responseArray);
}

// Emp. Category view

if(isset($_POST['empcatViewCode'])){
  $des="load ajax page for Employe Category View";
  $rem="Employe Category View";
  require_once('../../include/_audiLog.php');

  $empcatCode = $_POST['empcatViewCode'];
  $serchData = sqlsrv_query($conn,"select * from empCategoryDetails where empCatCode ='$empcatCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $empcatCode = $searchData['empCatCode'];
    $empcatName = $searchData['empCategory'];

  }else{
    $empcatCode = " NotFound";
    $empcatName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Emp. Category Details', 'Emp. Category Code', $empcatCode, 'Emp. Category Name', $empcatName, 'Emp. Category View','emp.category-Ui');

  echo json_encode($responseArray);

}

//Emp. Category delete
if(isset($_POST['empcatDelCode'])){
  $des="load ajax page for Employe Category Delete";
  $rem="Employe Category Delete";
  require_once('../../include/_audiLog.php');

  $empcatCode = $_POST['empcatDelCode'];
  $delete_brn_sql = "delete from empCategoryDetails where empCatCode = '$empcatCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'emp.category-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'emp.category-Ui'
    );
  }
  $empcatTabledata = sqlsrv_query($conn,"select * from empCategoryDetails");
  $code="empCatCode";
  $name="empCategory";
  //funtion call
  $responseform = newForm('Emp. Category','empcatName', 'empcatAdd', 'Emp. Category Entry');

  $tableHeaderArray = array('Count','Emp. Category Code','Emp. Category Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $empcatTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

// Emp. Category edit

if(isset($_POST['empsubcatEditCode'])){
  $des="load ajax page for Employe Sub-Category Edit";
  $rem="Employe Sub-Category Edit";
  require_once('../../include/_audiLog.php');

  $empsubcatCode = $_POST['empsubcatEditCode'];
  $serchData = sqlsrv_query($conn,"select * from empSubCategoryDetails where empSubCatCode ='$empsubcatCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $empsubcatCode = $searchData['empSubCatCode'];
  $empsubcatName = $searchData['empSubCategory'];

  //funtion call
  $responseArray = formEdit('Edit Emp. Sub-Category Details', 'Emp. Sub-Category Code', $empsubcatCode, 'empsubcatCode' ,'Emp. Sub-Category Name', $empsubcatName,'empsubcatName','Emp. Sub-Category','empsubcatEdit','Emp. Sub-Category Details' ,'Emp. Sub-Category Edit','emp.subcategory-Ui');

  echo json_encode($responseArray);
}

// Emp. Category view

if(isset($_POST['empsubcatViewCode'])){
  $des="load ajax page for Employe Sub-Category View";
  $rem="Employe Sub-Category View";
  require_once('../../include/_audiLog.php');

  $empsubcatCode = $_POST['empsubcatViewCode'];
  $serchData = sqlsrv_query($conn,"select * from empSubCategoryDetails where empSubCatCode ='$empsubcatCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $empsubcatCode = $searchData['empSubCatCode'];
    $empsubcatName = $searchData['empSubCategory'];

  }else{
    $empsubcatCode = " NotFound";
    $empsubcatName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Emp. Sub-Category Details', 'Emp. Sub-Category Code', $empsubcatCode, 'Emp. Sub-Category Name', $empsubcatName, 'Emp. Sub-Category View','emp.subcategory-Ui');

  echo json_encode($responseArray);

}

//Emp. Category delete
if(isset($_POST['empsubcatDelCode'])){
  $des="load ajax page for Employe Sub-Category Delete";
  $rem="Employe Sub-Category Delete";
  require_once('../../include/_audiLog.php');

  $empsubcatCode = $_POST['empsubcatDelCode'];
  $delete_brn_sql = "delete from empSubCategoryDetails where empSubCatCode = '$empsubcatCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'emp.subcategory-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'emp.subcategory-Ui'
    );
  }
  $empsubcatTabledata = sqlsrv_query($conn,"select * from empSubCategoryDetails");
  $code="empSubCatCode";
  $name="empSubCategory";
  //funtion call
  $responseform = newForm('Emp. Sub-Category','empsubcatName', 'empsubcatAdd', 'Emp. Sub-Category Entry');

  $tableHeaderArray = array('Count','Emp. Sub-Category Code','Emp. Sub-Category Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $empsubcatTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}


// Emp. Type edit

if(isset($_POST['emptypeEditCode'])){
  $des="load ajax page for Employe Type Edit";
  $rem="Employe Type Edit";
  require_once('../../include/_audiLog.php');

  $emptypeCode = $_POST['emptypeEditCode'];
  $serchData = sqlsrv_query($conn,"select * from empTypeDetails where empTypeCode ='$emptypeCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $emptypeCode = $searchData['empTypeCode'];
  $emptypeName = $searchData['empType'];

  //funtion call
  $responseArray = formEdit('Edit Emp. Type Details', 'Emp. Type Code', $emptypeCode, 'emptypeCode' ,'Emp. Type Name', $emptypeName,'emptypeName','Emp. Type','emptypeEdit','Emp. Type Details' ,'Emp. Type Edit','emp.type-Ui');

  echo json_encode($responseArray);
}

// Emp. Type view

if(isset($_POST['emptypeViewCode'])){
  $des="load ajax page for Employe type View";
  $rem="Employe type View";
  require_once('../../include/_audiLog.php');

  $emptypeCode = $_POST['emptypeViewCode'];
  $serchData = sqlsrv_query($conn,"select * from empTypeDetails where empTypeCode ='$emptypeCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $emptypeCode = $searchData['empTypeCode'];
    $emptypeName = $searchData['empType'];

  }else{
    $emptypeCode = " NotFound";
    $emptypeName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Type Details', 'Emp. Type Code', $emptypeCode, 'Emp. Type Name', $emptypeName, 'Emp. Type View','emp.type-Ui');

  echo json_encode($responseArray);

}

//Emp. type delete
if(isset($_POST['emptypeDelCode'])){
  
  $des="load ajax page for Employe type Delete";
  $rem="Employe type Delete";
  require_once('../../include/_audiLog.php');

  $emptypeCode = $_POST['emptypeDelCode'];
  $delete_brn_sql = "delete from empTypeDetails where empTypeCode = '$emptypeCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'emp.type-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'emp.type-Ui'
    );
  }
  $emptypeTabledata = sqlsrv_query($conn,"select * from empTypeDetails");
  $code="empTypeCode";
  $name="empType";
  //funtion call
  $responseform = newForm('Emp. Type','emptypeName', 'emptypeAdd', 'Emp. Type Entry');

  $tableHeaderArray = array('Count','Emp. Type Code','Emp. Type Name','Actions');
  $reponseTable = loadTable($tableHeaderArray, $emptypeTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

// grade edit

if(isset($_POST['gradeEditCode'])){
  $des="load ajax page for Grade Edit";
  $rem="Grade Edit";
  require_once('../../include/_audiLog.php');

  $gradeCode = $_POST['gradeEditCode'];
  $serchData = sqlsrv_query($conn,"select * from gradeDetails where gradeCode ='$gradeCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $gradeCode = $searchData['gradeCode'];
  $gradeName = $searchData['grade'];

  //funtion call
  $responseArray = formEdit('Edit Grade Details', 'Grade Code', $gradeCode, 'gradeCode' ,'Grade', $gradeName,'gradeName','Grade','gradeEdit','Grade Details' ,'Grade Edit','grade-Ui');

  echo json_encode($responseArray);
}


//grade view

if(isset($_POST['gradeViewCode'])){
  $des="load ajax page for Grade View";
  $rem="Grade View";
  require_once('../../include/_audiLog.php');
  
  $gradeCode = $_POST['gradeViewCode'];
  $serchData = sqlsrv_query($conn,"select * from gradeDetails where gradeCode ='$gradeCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $gradeCode = $searchData['gradeCode'];
    $gradeName = $searchData['grade'];

  }else{
    $gradeCode = " NotFound";
    $gradeName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Grade Details', 'Grade Code', $gradeCode, 'Grade ', $gradeName, 'Grade View','grade-Ui');

  echo json_encode($responseArray);

}

//grade delete
if(isset($_POST['gradeDelCode'])){
  $des="load ajax page for Grade Delete";
  $rem="Grade Delete";
  require_once('../../include/_audiLog.php');

  $gradeCode = $_POST['gradeDelCode'];
  $delete_brn_sql = "delete from gradeDetails where gradeCode = '$gradeCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'grade-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'grade-Ui'
    );
  }
  $gradeTabledata = sqlsrv_query($conn,"select * from gradeDetails");
  $code="gradeCode";
  $name="grade";
  //funtion call
  $responseform = newForm('Grade','gradeName', 'gradeAdd', 'Grade Entry');

  $tableHeaderArray = array('Count','Grade Code','Grade ','Actions');
  $reponseTable = loadTable($tableHeaderArray, $gradeTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}

// Location edit

if(isset($_POST['locaEditCode'])){
  $des="load ajax page for Location Edit";
  $rem="Location Edit";
  require_once('../../include/_audiLog.php');

  $locaCode = $_POST['locaEditCode'];
  $serchData = sqlsrv_query($conn,"select * from locationDetails where locationCode ='$locaCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $locaCode = $searchData['locationCode'];
  $locaName = $searchData['location'];

  //funtion call
  $responseArray = formEdit('Edit Location Details', 'Location Code', $locaCode, 'locaCode' ,'Location', $locaName,'locaName','Location','locaEdit','Location Details' ,'Location Edit','location-Ui');

  echo json_encode($responseArray);
}

//Loaction view

if(isset($_POST['locaViewCode'])){
  $des="load ajax page for Location View";
  $rem="Location View";
  require_once('../../include/_audiLog.php');

  $locaCode = $_POST['locaViewCode'];
  $serchData = sqlsrv_query($conn,"select * from locationDetails where locationCode ='$locaCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $locaCode = $searchData['locationCode'];
    $locaName = $searchData['location'];

  }else{
    $locaCode = " NotFound";
    $locaName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Location Details', 'Location Code', $locaCode, 'Location ', $locaName, 'Location View','location-Ui');

  echo json_encode($responseArray);

}

//Location delete
if(isset($_POST['locaDelCode'])){
  $des="load ajax page for Location Delete";
  $rem="Location Delete";
  require_once('../../include/_audiLog.php');

  $locaCode = $_POST['locaDelCode'];
  $delete_brn_sql = "delete from locationDetails where locationCode = '$locaCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'location-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'location-Ui'
    );
  }
  $locaTabledata = sqlsrv_query($conn,"select * from locationDetails");
  $code="locationCode";
  $name="location";
  //funtion call
  $responseform = newForm('Location','locaName', 'locaAdd', 'Location Entry');

  $tableHeaderArray = array('Count','Location Code','Location ','Actions');
  $reponseTable = loadTable($tableHeaderArray, $locaTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}


// Team edit

if(isset($_POST['teamEditCode'])){
  $des="load ajax page for Team Edit";
  $rem="Team Edit";
  require_once('../../include/_audiLog.php');

  $teamCode = $_POST['teamEditCode'];
  $serchData = sqlsrv_query($conn,"select * from teamDetails where teamCode ='$teamCode'");
  $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
  $teamCode = $searchData['teamCode'];
  $teamName = $searchData['teamName'];

  //funtion call
  $responseArray = formEdit('Edit Team Details', 'Team Code', $teamCode, 'teamCode' ,'Team Name', $teamName,'teamName','Team','teamEdit','Team Details' ,'Team Edit','team-Ui');

  echo json_encode($responseArray);
}

//Loaction view

if(isset($_POST['teamViewCode'])){
  $des="load ajax page for Team View";
  $rem="Team View";
  require_once('../../include/_audiLog.php');

  $teamCode = $_POST['teamViewCode'];
  $serchData = sqlsrv_query($conn,"select * from teamDetails where teamCode ='$teamCode'");
  if($serchData){
    $searchData = sqlsrv_fetch_array($serchData, SQLSRV_FETCH_ASSOC);
    $teamCode = $searchData['teamCode'];
    $teamName = $searchData['teamName'];

  }else{
    $teamCode = " NotFound";
    $teamName = "Not Found";

  }
  //funtion call
  $responseArray = formView('View Team Details', 'Team Code', $teamCode, 'Team Name ', $teamName, 'Team View','team-Ui');

  echo json_encode($responseArray);

}

//Team delete
if(isset($_POST['teamDelCode'])){
  $des="load ajax page for Team Delete";
  $rem="Team Delete";
  require_once('../../include/_audiLog.php');

  $teamCode = $_POST['teamDelCode'];
  $delete_brn_sql = "delete from teamDetails where teamCode = '$teamCode'";
  $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
  if($delete_stmt){
    $rsponseAlert = array(
        'alertTitle' => 'Deleted SuccessFully.',
        'alertIcon' => 'success',
        'redirectUrl'=>'team-Ui'
    );
  }else{
    $rsponseAlert = array(
        'alertTitle' => 'Delete Not done.',
        'alertIcon' => 'error',
        'redirectUrl'=>'team-Ui'
    );
  }
  $teamTabledata = sqlsrv_query($conn,"select * from teamDetails");
  $code="teamCode";
  $name="teamName";
  //funtion call
  $responseform = newForm('Team','teamName', 'teamAdd', 'Team Entry');

  $tableHeaderArray = array('Count','Team Code','Team Name ','Actions');
  $reponseTable = loadTable($tableHeaderArray, $teamTabledata,$code,$name);

  $responseArray = array_merge($responseform, $reponseTable,$rsponseAlert);
  echo json_encode($responseArray);

}



//shift edit

if(isset($_POST['shiftEditCode'])){
  $des="load ajax page for Shift Edit";
  $rem="Shift Edit";
  require_once('../../include/_audiLog.php');

  $shiftEditCode = $_POST['shiftEditCode'];
  $fetchData = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from shiftDetails where shiftCode = '$shiftEditCode'"), SQLSRV_FETCH_ASSOC);
  function timeFormate($rawdata){
    $dateTime = new DateTime($rawdata); // Convert string to DateTime object
    return $dateTime->format("H:i"); 
    }
   
  $formHtml = '<div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase">Edit Shift Details</h6>
                    <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8>
                  </div>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">
                  
                  <div class="col-12 col-14">
                  <label class="form-label">Shift Name</label>
                  <input type="text" class="form-control" placeholder="Enter the Shift Name" name="shiftName"
                  value="'.$fetchData['shiftName'].'" required autofocus />
                  </div>
                  <div class="row row-2">
                  <div class="col-16 col-14">
                  <label class="form-label">Checkin Time</label>
                  <input type="time" id="timePicker" class="form-control" name="shiftChIn" value="'.timeFormate($fetchData["checkInTime"]).'" required
                  autofocus>
                  
                  </div>
                  <div class="col-16 col-14">
                  <label class="form-label">Half-Day Exit Time</label>
                  <input type="time" id="timePicker" class="form-control" name="shiftHChOut" required value="'.timeFormate($fetchData["HcheckOutTime"]).'"
                  autofocus>
                  
                  </div>
                  <input type="hidden" value ="'.$shiftEditCode.'" name="shiftEditCode" />
                  <div class="col-16 col-14">
                        <label class="form-label">Full-Day Exit Time</label>
                        <input type="time" id="timePicker" class="form-control" name="shiftFChOut" value="'.timeFormate($fetchData["checkOutTime"]).'" required
                          autofocus>

                      </div>
                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">Duration Of Time Range</label>
                        <select name="shiftDuration" id="" class="form-control" style="width:90%;display:inline"
                          required>
                          
                          <option value="'.$fetchData["duration"].'" selected disable hidden>'.$fetchData["duration"].'</option>
                          ';
                         for($i=0;$i<60;$i++){
$formHtml.='                    <option value="'.sprintf("%02d", $i).'">'.sprintf("%02d", $i).'</option>';

                          } 
$formHtml.='            </select>
                        <span class="info-icon" id="infoIcon" style="font-size: 1.2rem;   
    -webkit-text-fill-color: #135a9b;">&#9432;</span>
                        <div class="connector"></div>
                        <div class="info-content" id="infoContent" style="top:-14.5rem;width: 588px;     left: calc(-4% + -12px);">
                          The duration will work prefix and sufix of the checkin and checkout time.<br />
                          Let'."'".'s explain suppose that <br />
                          Shift time = 10:00 to 19:00<br />
                          Half Day checkout = 14:00<br />
                          Duration = 20 min (You SET)<br />
                          How it'."'".'s work<br />
                          We start the punch (Check in) from 09:40 to 10:20 ( 20 min before and 20 min after )<br />
                          We start the punch (Check Out) from 18:40 to 19:20 ( 20 min before and 20 min after )<br />
                          We start the punch for half day (Check Out) from 13:40 to 14:20 ( 20 min before
                          and 20 min after )<br />

                        </div>
                        </div>
                        <div class="col-15 col-14 info-box">
                          <label class="form-label">Shift Status</label>
                          <select name="shiftStatus" id="" class="form-control" style="width:90%;display:inline" required>
                            <option value="'.$fetchData["shiftStaus"].'" selected disable hidden>'.$fetchData["shiftStaus"].'</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>



                          </select>
                        </div>
                        </div>

                        <div class="col-12">
                          <div class="d-flex" style="justify-content: flex-end;">
                            <button type="submit" class="btn btn-primary" name="shiftEdit" style="margin-right:.5rem">
                              <i class="bi bi-pencil-square"></i>
                              Edit Shift
                            </button>
                            <a href="shift-Details"<button type="click" class="btn btn-secondary" >
                              <i class="bi bi-arrow-clockwise"></i>
                              Back
                            </button></a>
                          </div>
                        </div>
                        </form>
                        </div>';


$responseArray = array(
    'formConteent'=>$formHtml,
    'pageHeaderSec' => 'Shift Edit'
  );
echo json_encode($responseArray);

// echo $_POST['shiftEditCode'];
}

//shift view

if(isset($_POST['shiftViewCode'])){
  $des="load ajax page for Shift View";
  $rem="Shift View";
  require_once('../../include/_audiLog.php');

  $shiftViewCode = $_POST['shiftViewCode'];
  $fetchData = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from shiftDetails where shiftCode = '$shiftViewCode'"), SQLSRV_FETCH_ASSOC);
  function timeFormate($rawdata){
    $dateTime = new DateTime($rawdata); // Convert string to DateTime object
    return $dateTime->format("H:i"); 
    }
   
  $formHtml = '<div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase">View Shift Details</h6>
                    <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8>
                  </div>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">
                  
                    <div class="col-12 col-14">
                    <label class="form-label">Shift Name</label>
                    <label class="form-control">'.$fetchData['shiftName'].'</label>
                    
                    </div>
                    <div class="row row-2">
                      <div class="col-16 col-14">
                        <label class="form-label">Checkin Time</label>
                        <label class="form-control">'.timeFormate($fetchData["checkInTime"]).'</label>
                      </div>
                      <div class="col-16 col-14">
                        <label class="form-label">Half-Day Exit Time</label>
                        <label class="form-control">'.timeFormate($fetchData["HcheckOutTime"]).'</label>
                      </div>
                      <input type="hidden" value ="'.$shiftViewCode.'" name="shiftViewCode" />
                      <div class="col-16 col-14">
                        <label class="form-label">Full-Day Exit Time</label>
                        <label class="form-control">'.timeFormate($fetchData["checkOutTime"]).'</label>
                      </div>
                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">Duration Of Time Range</label>
                        <div style="display:flex">
                        <label class="form-control"style="width:85%; margin-right: 0.4rem;">'.$fetchData["duration"].'</label>

                        <span class="info-icon"id="infoIcon">&#9432;</span>
                        </div>
                        <div class="connector"></div>
                        <div class="info-content" id="infoContent">
                          The duration will work prefix and sufix of the checkin and checkout time.<br />
                          Let'."'".'s explain suppose that <br />
                          Shift time = 10:00 to 19:00<br />
                          Half Day checkout = 14:00<br />
                          Duration = 20 min (You SET)<br />
                          How it'."'".'s work<br />
                          We start the punch (Check in) from 09:40 to 10:20 ( 20 min before and 20 min after )<br />
                          We start the punch (Check Out) from 18:40 to 19:20 ( 20 min before and 20 min after )<br />
                          We start the punch for half day (Check Out) from 13:40 to 14:20 ( 20 min before
                          and 20 min after )<br />

                        </div>
                      </div>
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">Shift Status</label>
                        <label class="form-control">'.$fetchData["shiftStaus"].'</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-flex" style="justify-content: flex-end;">
                        
                        <a href="shift-Details"<button type="click" class="btn btn-secondary" >
                          <i class="bi bi-arrow-clockwise"></i>
                          Back
                        </button></a>
                      </div>
                    </div>
                  </form>
                </div>';


$responseArray = array(
    'formConteent'=>$formHtml,
    'pageHeaderSec' => 'Shift View'
  );
echo json_encode($responseArray);

// echo $_POST['shiftEditCode'];
}

//shift delete
if(isset($_POST['shiftDelCode'])){
  $des="load ajax page for Shift Delete";
  $rem="Shift Delete";
  require_once('../../include/_audiLog.php');

  $sqlshiftCount = sql_num_rows($conn, "select * from shiftDetails");
  //delete query
  if($sqlshiftCount >1){

    $shiftCode = $_POST['shiftDelCode'];
    $num_rows = sqlsrv_fetch_array(sqlsrv_query($conn,"select count(*) as 'count_row' from shiftDetails where shiftCode = '$shiftCode' and shiftStaus!='Active'"),SQLSRV_FETCH_ASSOC);
    if($num_rows['count_row'] >=1){
      $delete_brn_sql = "delete from shiftDetails where shiftCode = '$shiftCode' and shiftStaus!='Active'";
      $delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
      if($delete_stmt){
        $rsponseAlert = array(
          'alertTitle' => 'Deleted SuccessFully.',
          'alertIcon' => 'success',
          'redirectUrl'=>'shift-Details'
        );
      }else{
        $rsponseAlert = array(
          'alertTitle' => 'Delete Not done.',
          'alertIcon' => 'error',
          'redirectUrl'=>'shift-Details'
        );
      }
      
    }else{
      $rsponseAlert = array(
        'alertTitle' => 'Active Shift can Not Delete.',
        'alertIcon' => 'error',
        'redirectUrl'=>'shift-Details'
      );
    }
  }else{
    $rsponseAlert = array(
            'alertTitle' => "You can't delete because there is only one shift",
            'alertIcon' => 'info',
            'redirectUrl'=>'shift-Details'
        );
  }
$teamTabledata = sqlsrv_query($conn,"select * from shiftDetails");

$responseform='<div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase">New Shift</h6>
                    <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8>
                  </div>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">

                    <div class="col-12 col-14">
                      <label class="form-label">Shift Name</label>
                      <input type="text" class="form-control" placeholder="Enter the Shift Name" name="shiftName"
                        value="" required autofocus />
                    </div>
                    <div class="row row-2">
                      <div class="col-16 col-14">
                        <label class="form-label">Checkin Time</label>
                        <input type="time" id="timePicker" class="form-control" name="shiftChIn" value="" required
                          autofocus>

                      </div>
                      <div class="col-16 col-14">
                        <label class="form-label">Half-Day Exit Time</label>
                        <input type="time" id="timePicker" class="form-control" name="shiftHChOut" required value=""
                          autofocus>

                      </div>
                      <div class="col-16 col-14">
                        <label class="form-label">Full-Day Exit Time</label>
                        <input type="time" id="timePicker" class="form-control" name="shiftFChOut" value="" required
                          autofocus>

                      </div>
                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">Duration Of Time Range</label>
                        <select name="shiftDuration" id="" class="form-control" style="width:90%;display:inline"
                          required>
                          <option value="" selected disable hidden style="color: #ced4da;">Select Duration</option>
                          <?php for($i=0;$i<60;$i++){ ?>
<option value="<?php echo sprintf("%02d", $i);?>"><?php echo sprintf("%02d", $i);?></option>

<?php   } ?>
</select>
<span class="info-icon" style="font-size: 1.2rem;   
    -webkit-text-fill-color: #135a9b;">&#9432;</span>
<div class="connector"></div>
<div class="info-content" id="infoContent">
  The duration will work prefix and sufix of the checkin and checkout time.<br />
  Let'."'".'s explain suppose that <br />
  Shift time = 10:00 to 19:00<br />
  Half Day checkout = 14:00<br />
  Duration = 20 min (You SET)<br />
  How it'."'".'s work<br />
  We start the punch (Check in) from 09:40 to 10:20 ( 20 min before and 20 min after )<br />
  We start the punch (Check Out) from 18:40 to 19:20 ( 20 min before and 20 min after )<br />
  We start the punch for half day (Check Out) from 13:40 to 14:20 ( 20 min before
  and 20 min after )<br />

</div>
</div>

</div>

<div class="col-12">
  <div class="d-grid">
    <button type="submit" class="btn btn-primary" name="shiftAdd">
      <i class="bi bi-plus-lg"></i>
      Add Shift
    </button>
  </div>
</div>
</form>
</div>';

$tableHeaderArray = array('Count','Shift','Checkin','Checkout <br>(Half-Day)','Checkout <br>(Full-Day)','Actions');

$htmlTable = '<table class="table align-middle comTable" id="dataTable">
  <thead class="table-secondary table-header">
    <tr>';
      for ($i = 0; $i < count($tableHeaderArray); $i++) { $htmlTable .='<th>' . $tableHeaderArray[$i] . '</th>' ; }
        $htmlTable .=' </tr>
                    </thead>
                    <tbody>' ; $i=0; while($tableDataFetch=sqlsrv_fetch_array($teamTabledata , SQLSRV_FETCH_ASSOC)){
        $htmlTable .='     <tr>
                        <td>' . ++$i.'</td>
        <td>'.$tableDataFetch["shiftName"].'</td>
        <td>'.$tableDataFetch["checkInFrom"].'<br>'.$tableDataFetch["checkInTo"].'</td>
        <td>'.$tableDataFetch["halfCheckOutFrom"].'<br>'.$tableDataFetch["halfCheckOutTo"].'</td>
        <td>'.$tableDataFetch["FcheckOutFrom"].'<br>'.$tableDataFetch["FcheckOutTo"].'</td>
        <input type="hidden" value="branch">
        <td>
          <div class="table-actions d-flex align-items-center gap-3 fs-6">
            <a href="javascript:;" class="text-primary btnView" data-bs-toggle="tooltip" data-bs-placement="bottom"
              title="Views"><i class="bi bi-eye-fill"></i></a>
            <a href="javascript:;" class="text-warning btnEdit" data-bs-toggle="tooltip" data-bs-placement="bottom"
              title="Edit "><i class="bi bi-pencil-fill"></i></a>
            <a href="javascript:;" class="text-danger btnDelt" data-bs-toggle="tooltip" data-bs-placement="bottom"
              title="Delete"><i class="bi bi-trash-fill"></i></a>
          </div>
        </td>
    </tr>';
    }
    $htmlTable .='
    </tbody>
</table>';
$responseArray = array_merge(array(
'formConteent'=>$responseform,
'pageHeaderSec'=>"Shift Entry",
'tableConteent'=>$htmlTable,
''=>$rsponseAlert
),$rsponseAlert);
echo json_encode($responseArray);

}


//employee list loader


if(isset($_POST['empViewCode'])){
$des="load ajax page for Employee View";
$rem="Employee View";
require_once('../../include/_audiLog.php');

//view query
$empCode = $_POST['empViewCode'];
$empTabledata = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from employeeDetails where empCode =
'$empCode'"),SQLSRV_FETCH_ASSOC);

$htmlForm ='<div class="row">
  <div class="col-xl-6 mx-auto">
    <div class="card" style="margin-bottom:0px">
      <div class="card-body">
        <div class="border p-3 rounded">
          <h6 class="mb-0 text-uppercase">View Employee Details</h6>
          <hr />
          <div class="row g-3">
            <div class="row row-2">
              <div class="col-12 col-17">
                <label class="form-label">Employee Code <span style="color:red; font-size:1.2rem;">*</span></label>
                <label class="form-control">'.$empTabledata['empName'].'</label>
              </div>
              <div class="col-12 col-18">
                <label class="form-label">Employee Name <span style="color:red; font-size:1.2rem;">*</span></label>
                <label class="form-control">'.$empTabledata['empName'].'</label>
              </div>
            </div>
            <div class="col-12 col-14" style="margin-top:0px">
              <label class="form-label">Company Name <span style="color:red; font-size:1.2rem;">*</span></label>
              <label class="form-control">'.company_find($empTabledata['companyCode'],$conn).'</label>
            </div>

            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Department <span style="color:red; font-size:1.2rem;">*</span></label>
                <label class="form-control">'.dept_find($empTabledata['departmentCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Sub - Department <span style="color:red; font-size:1.2rem;"></span></label>
                <label class="form-control">'.sub_dept_find($empTabledata['subDepartmantCode'],$conn).'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Designation </label>
                <label class="form-control">'.desig_find($empTabledata['designationCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Sub-Designation </label>
                <label class="form-control">'.subdesig_find($empTabledata['subDesignationCode'],$conn).'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Division </label>
                <label class="form-control">'.division_find($empTabledata['divisionCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Sub-Division </label>
                <label class="form-control">'.subdivision_find($empTabledata['subDivisionCode'],$conn).'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Emp. Category </label>
                <label class="form-control">'.empCat_find($empTabledata['empCategoryCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Emp. Sub-Category </label>
                <label class="form-control">'. empSCat_find($empTabledata['empSubCategoryCode'],$conn).'</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 mx-auto">
    <div class="card" style="margin-bottom:0px">
      <div class="card-body">
        <div class="border p-3 rounded">
          <div class="row g-3">
            <div class="row row-2" style="padding-top: 0.5rem;">
              <div class="col-15 col-14">
                <label class="form-label">Employee Type </label>
                <label class="form-control">'.empType_find($empTabledata['empTypeCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Grade </label>
                <label class="form-control">'.empGrade_find($empTabledata['grade'], $conn).'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Branch </label>
                <label class="form-control">'.branch_find($empTabledata['branchCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Location </label>
                <label class="form-control">'.empLoc_find($empTabledata['locationCode'],$conn).'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Team <span style="color:red; font-size:1.2rem;"></span></label>
                <label class="form-control">'.empTeam_find($empTabledata['teamCode'],$conn).'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Employee Status<span style="color:red; font-size:1.2rem;">*</span></label>
                <label class="form-control">'.$empTabledata['status'].'</label>
              </div>
            </div>

            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">MObile NO </label>
                <label class="form-control">'.$empTabledata['contactNO'].'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Email Id </label>
                <label class="form-control">'.$empTabledata['emailId'].'</label>
              </div>
            </div>
            <div class="row row-2">
              <div class="col-15 col-14">
                <label class="form-label">Govt.Id Number</label>
                <label class="form-control">'.$empTabledata['govtId'].'</label>
              </div>
              <div class="col-15 col-14">
                <label class="form-label">Address</label>
                <label class="form-control">'.$empTabledata['address'].'</label>
              </div>
            </div>

            <div class="col-12">
              <div class="d-grid">
                <a href="list-Employee-Ui" <button type="click" class="btn btn-secondary">
                  <i class="bi bi-arrow-clockwise"></i>
                  Back
                  </button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

$responseArray = array(

'formConteent'=>$htmlForm ,
'pageHeaderSec'=>"Employee View"
);
echo json_encode($responseArray);
}


// =============================== Edit Employee =====================================

if(isset($_POST['empEditCode'])){
$des="load ajax page for Employee Edit";
$rem="Employee Edit";
require_once('../../include/_audiLog.php');

$comTabledata = sqlsrv_query($conn,"select companyCode,comFName from companyDetails");
$deptTabledata = sqlsrv_query($conn,"select * from departmentDetails");
$sdeptTabledata = sqlsrv_query($conn,"select * from subDepartmantDetails");
$desigTabledata = sqlsrv_query($conn,"select * from designationDetails");
$sdesigTabledata = sqlsrv_query($conn,"select * from subDesignationDetails");
$divTabledata = sqlsrv_query($conn,"select * from divisionDetails");
$sdivTabledata = sqlsrv_query($conn,"select * from subDivisionDetails");
$empcatTabledata = sqlsrv_query($conn,"select * from empCategoryDetails");
$empScatTabledata = sqlsrv_query($conn,"select * from empSubCategoryDetails");
$empTypeTabledata = sqlsrv_query($conn,"select * from empTypeDetails");
$gradeTabledata = sqlsrv_query($conn,"select * from gradeDetails");
$branchTabledata = sqlsrv_query($conn,"select * from branchDetails");
$locTabledata = sqlsrv_query($conn,"select * from locationDetails");
$teamTabledata = sqlsrv_query($conn,"select * from teamDetails");
$empCode = $_POST['empEditCode'];
$empTabledata = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from employeeDetails where empCode =
'$empCode'"),SQLSRV_FETCH_ASSOC);

$htmlForm ='
<form action="admin/process/employeeProcess.php" method="post">
  <div class="row">
    <div class="col-xl-6 mx-auto">
      <div class="card" style="margin-bottom:0px">
        <div class="card-body">
          <div class="border p-3 rounded">
            <h6 class="mb-0 text-uppercase">Edit Employee Details</h6>
            <hr />
            <div class="row g-3">
              <div class="row row-2">
                <div class="col-12 col-17">
                  <label class="form-label">Employee Code <span style="color:red; font-size:1.2rem;">*</span></label>

                  <label class="form-control">'.$empTabledata['empCode'].'</label>
                  <input type="hidden" name="empCode" value="'.$empTabledata['empCode'].'">
                </div>
                <div class="col-12 col-18">
                  <label class="form-label">Employee Name <span style="color:red; font-size:1.2rem;">*</span></label>

                  <input type="text" class="form-control" placeholder="Enter the Employee name" name="empName"
                    value="'.$empTabledata['empName'].'" required />
                </div>
              </div>
              <div class="col-12 col-14" style="margin-top:0px">
                <label class="form-label">Company Name <span style="color:red; font-size:1.2rem;">*</span></label>
                <select class="form-control" name="comName" required />
                <option value="'.$empTabledata['companyCode'].'" hidden selected disbale>
                  '.company_find($empTabledata['companyCode'],$conn).'</option>';
                while ($row = sqlsrv_fetch_array($comTabledata, SQLSRV_FETCH_ASSOC)){
                $htmlForm .= '<option value="'. $row['companyCode'].'">'.$row['comFName'].'</option>';
                }
                $htmlForm .= '</select>
              </div>

              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Department <span style="color:red; font-size:1.2rem;">*</span></label>
                  <select class="form-control" name="dept" required />
                  <option value="'.$empTabledata['departmentCode'].'" hidden selected disbale>
                    '.dept_find($empTabledata['departmentCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($deptTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .= '<option value="'.$row['deptCode'].'">'. $row['department'].'</option>';
                  }
                  $htmlForm .= ' </select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub - Department <span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="subDept" />
                  <option value="'.$empTabledata['subDepartmantCode'].'" hidden selected disbale>
                    '.sub_dept_find($empTabledata['subDepartmantCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdeptTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .= '<option value="'.$row['subDeptCode'].'">'. $row['subDepartment'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Designation </label>
                  <select class="form-control" name="desig" />
                  <option value="'.$empTabledata['designationCode'].'" hidden selected disbale>
                    '.desig_find($empTabledata['designationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($desigTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .=' <option value="'.$row['desigCode'].'">'. $row['designation'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub-Designation </label>

                  <select class="form-control" name="subdesig" />
                  <option value="'.$empTabledata['subDesignationCode'].'" hidden selected disbale>
                    '.subdesig_find($empTabledata['subDesignationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdesigTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['subDesigCode'].'">'.$row['subDesignation'].'</option>';
                  }
                  $htmlForm .=' </select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Division </label>
                  <select class="form-control" name="division" />
                  <option value="'.$empTabledata['divisionCode'].'" hidden selected disbale>
                    '.division_find($empTabledata['divisionCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($divTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['divisionCode'].'">'. $row['division'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Sub-Division </label>

                  <select class="form-control" name="subdivision" />
                  <option value="'.$empTabledata['subDivisionCode'].'" hidden selected disbale>
                    '.subdivision_find($empTabledata['subDivisionCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($sdivTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['subDiviCode'].'">'. $row['subDivision'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Emp. Category </label>

                  <select class="form-control" name="empcat" />
                  <option value="'.$empTabledata['empCategoryCode'].'" hidden selected disbale>
                    '.empCat_find($empTabledata['empCategoryCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empcatTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['empCatCode'].'">'.$row['empCategory'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Emp. Sub-Category </label>

                  <select class="form-control" name="empsubcat" />
                  <option value="'.$empTabledata['empSubCategoryCode'].'" hidden selected disbale>'.
                    empSCat_find($empTabledata['empSubCategoryCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empScatTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['empSubCatCode'].'">'.$row['empSubCategory'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 mx-auto">
      <div class="card" style="margin-bottom:0px">
        <div class="card-body">
          <div class="border p-3 rounded">
            <div class="row g-3">
              <div class="row row-2" style="padding-top: 0.5rem;">
                <div class="col-15 col-14">
                  <label class="form-label">Employee Type </label>

                  <select class="form-control" name="EmpType" />
                  <option value="'.$empTabledata['empTypeCode'].'" hidden selected disbale>
                    '.empType_find($empTabledata['empTypeCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($empTypeTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['empTypeCode'].'">'. $row['empType'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Grade </label>

                  <select class="form-control" name="grade" />
                  <option value="'.$empTabledata['grade'].'" hidden selected disbale>
                    '.empGrade_find($empTabledata['grade'], $conn).'</option>';
                  while ($row = sqlsrv_fetch_array($gradeTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['gradeCode'].'">'. $row['grade'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Branch </label>

                  <select class="form-control" name="branch" />
                  <option value="'.$empTabledata['branchCode'].'" hidden selected disbale>
                    '.branch_find($empTabledata['branchCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($branchTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['branchCode'].'">'. $row['branch'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Location </label>

                  <select class="form-control" name="location" />
                  <option value="'.$empTabledata['locationCode'].'" hidden selected disbale>
                    '.empLoc_find($empTabledata['locationCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($locTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'.$row['locationCode'].'">'. $row['location'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
              </div>
              <div class=" row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Team<span style="color:red; font-size:1.2rem;"></span></label>

                  <select class="form-control" name="team" />
                  <option value="'.$empTabledata['teamCode'].'" hidden selected disbale>
                    '.empTeam_find($empTabledata['teamCode'],$conn).'</option>';
                  while ($row = sqlsrv_fetch_array($teamTabledata, SQLSRV_FETCH_ASSOC)){
                  $htmlForm .='<option value="'. $row['teamCode'].'">'. $row['teamName'].'</option>';
                  }
                  $htmlForm .='</select>
                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Employee Status<span style="color:red; font-size:1.2rem;">*</span></label>

                  <select class="form-control" name="empsts" required />
                  <option value="'.$empTabledata['status'].'" hidden selected disbale>'.$empTabledata['status'].'
                  </option>
                  <option value="Working">Working</option>
                  <option value="Resigned">Resigned</option>
                  <option value="Retired">Retired</option>
                  </select>
                </div>
              </div>

              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">MObile NO </label>

                  <input type="number" class="form-control" name="mobileNo" id="login_mob" autocomplete="off"
                    placeholder="Enter Mobile Number"
                    oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                    pattern="\d{10}" maxlength="10" value="'.$empTabledata['contactNO'].'">

                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Email Id </label>

                  <input type="email" class="form-control" name="email" value="'.$empTabledata['emailId'].'" />
                </div>
              </div>
              <div class="row row-2">
                <div class="col-15 col-14">
                  <label class="form-label">Govt.Id Number</label>
                  <input type="text" value="'.$empTabledata['govtId'].'" class="form-control"
                    placeholder="Enter Govt. ID" name="govtID" />

                </div>
                <div class="col-15 col-14">
                  <label class="form-label">Address</label>
                  <input type="text" value="'.$empTabledata['address'].'" class="form-control"
                    placeholder="Enter Address" name="address" />

                </div>
              </div>

              <div class="col-12">
                <div class="d-flex" style="justify-content: flex-end;">
                  <button type="submit" class="btn btn-primary" name="empEdit" style="margin-right:.5rem">
                    <i class="bi bi-pencil-square"></i>
                    Edit Employee
                  </button>
                  <a href="list-Employee-Ui" <button type="click" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                    Back
                    </button></a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>';

$responseArray = array(

'formConteent'=>$htmlForm ,
'pageHeaderSec'=>"Employee Edit"
);
echo json_encode($responseArray);
}


// emp Delete


if(isset($_POST['empDelCode'])){
$des="load ajax page for Employee Delete";
$rem="Employee Delete";
require_once('../../include/_audiLog.php');

$empCode = $_POST['empDelCode'];
$delete_brn_sql = "delete from employeeDetails where empCode = '$empCode'";
$delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
if($delete_stmt){
$rsponseAlert = array(
'alertTitle' => 'Deleted SuccessFully.',
'alertIcon' => 'success',
'redirectUrl'=>'list-Employee-Ui'
);
}else{
$rsponseAlert = array(
'alertTitle' => 'Delete Not done.',
'alertIcon' => 'error',
'redirectUrl'=>'list-Employee-Ui'
);
}

echo json_encode($rsponseAlert);

}





if(isset($_GET['offset']) && isset($_GET['limit'])) {
$des="load ajax page for Employee List";
$rem="Employee List";
require_once('../../include/_audiLog.php');

$offset = $_GET['offset'];
$limit = $_GET['limit'];

// Fetch employee details from the database using LIMIT and OFFSET
$query = "SELECT * FROM employeeDetails where empCode != 'Emp00lst' ORDER BY (SELECT NULL) OFFSET $offset ROWS FETCH
NEXT $limit ROWS ONLY;";
$result = sqlsrv_query($conn, $query);

$employees = array();
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
$employee = array(
'empCode' => $row['empCode'],
'empName' => $row['empName'],
'comName' => company_find($row['companyCode'],$conn),
'deptName' => dept_find($row['departmentCode'],$conn),
'empCat' => empCat_find($row['empCategoryCode'],$conn),
'empType' => empType_find($row['empTypeCode'],$conn),
'location' => empLoc_find($row['locationCode'],$conn),
'status' => $row['status'],

// Add other fields as needed
);

$employees[] = $employee;
}

// Return employee details as JSON response
// header('Content-Type: application/json');
echo json_encode($employees);
exit();
}


// user edit
if(isset($_POST['userEditCode'])){
$des="load ajax page for User Edit";
$rem="User Edit";
require_once('../../include/_audiLog.php');

$userCode = $_POST['userEditCode'];
$user_role = array("Developer", "Admin","User");
$Tabledata = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from loginUser where userCode ='$userCode'"),
SQLSRV_FETCH_ASSOC);
$htmlForm = ' <div class="border p-3 rounded">
  <div style="display:flex;justify-content: space-between;">

    <h6 class="mb-0 text-uppercase">Edit User Details</h6>

  </div>
  <hr />
  <form action="admin/process/userProcess.php" method="post" class="row g-3">
    <div class="row row-2">
      <div class="col-15 col-14">
        <label class="form-label">User Name <span style="color:red; font-size:1.1rem;">*</span></label>
        <input type="text" class="form-control" placeholder="Enter the User Name" name="UserName"
          value="'.$Tabledata['name'].'" required autofocus />
      </div>
      <div class="col-15 col-14">
        <label class="form-label">Email Id <span style="color:red; font-size:1.1rem;">*</span></label>
        <input type="gmail" class="form-control" placeholder="Enter the Gmail" name="userGmail"
          value="'.$Tabledata['mailId'].'" required />
      </div>
    </div>
    <div class="row row-2">
      <div class="col-15 col-14">
        <label class="form-label">Mobile Number <span style="color:red; font-size:1.1rem;">*</span></label>
        <input type="number" class="form-control" name="userMobile" id="login_mob" autocomplete="off"
          placeholder="Enter mobile nunmber"
          oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
          pattern="\d{10}" value="'.$Tabledata['mobileNO'].'" maxlength="10" required>

        <input type="hidden" value="'.$userCode.'" name="userCode" />
      </div>
      <div class=" col-15 col-14">
        <label class="form-label">User Role <span style="color:red; font-size:1.1rem;">*</span></label>

        <select name="userRole" id="" class="form-control" required>
          <option value="'.$Tabledata['userRole'].'" selected disable hidden style="color: #ced4da;">
            '.$Tabledata['userRole'].'</option>';
          if($user_role ==='Developer'){
          $p = 0;
          }else{
          $p = 1;
          }
          for($i = $p;$i<count($user_role);$i++){ $htmlForm .='<option value="' .$user_role[$i].'">'.$user_role[$i].'
            </option>';

            }
            $htmlForm .='
        </select>

      </div>

    </div>
    <div class="row row-2">
      <div class="col-15 col-14 info-box">
        <label class="form-label">User Satus <span style="color:red; font-size:1.1rem;">*</span></label>
        <select name="userSts" id="" class="form-control" required>
          <option value="'.$Tabledata['userStatus'].'" selected disable hidden style="color: #ced4da;">
            '.$Tabledata['userStatus'].'</option>
          <option value="Active">Active</option>
          <option value="Deactive">Deactive</option>
        </select>
      </div>
    </div>

    <div class="col-12">
      <div class="d-flex" style="justify-content: flex-end;">
        <button type="submit" class="btn btn-primary" name="editUser" style="margin-right:.5rem">
          <i class="bi bi-pencil-square"></i>
          Edit User
        </button>
        <a href="user-Ui" <button type="click" class="btn btn-secondary">
          <i class="bi bi-arrow-clockwise"></i>
          Back
          </button></a>
      </div>
    </div>
  </form>
</div>';

$responseArray = array(
'formContent'=>$htmlForm,
'pageHeaderSection'=> 'Edit user'
);


echo json_encode($responseArray);
}

// user view
if(isset($_POST['userViewCode'])){
$des="load ajax page for User View";
$rem="User View";
require_once('../../include/_audiLog.php');

$userCode = $_POST['userViewCode'];
$user_role = array("Developer", "Admin","User");
$Tabledata = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from loginUser where userCode ='$userCode'"),
SQLSRV_FETCH_ASSOC);
$htmlForm = ' <div class="border p-3 rounded">
  <div style="display:flex;justify-content: space-between;">

    <h6 class="mb-0 text-uppercase">View User Details</h6>

  </div>
  <hr />
  <form action="admin/process/userProcess.php" method="post" class="row g-3">
    <div class="row row-2">
      <div class="col-15 col-14">
        <label class="form-label">User Name <span style="color:red; font-size:1.1rem;">*</span></label>
        <lebal class="form-control">'.$Tabledata['name'].'</label>

      </div>
      <div class="col-15 col-14">
        <label class="form-label">Email Id <span style="color:red; font-size:1.1rem;">*</span></label>
        <lebal class="form-control">'.$Tabledata['mailId'].'</label>

      </div>
    </div>
    <div class="row row-2">
      <div class="col-15 col-14">
        <label class="form-label">Mobile Number <span style="color:red; font-size:1.1rem;">*</span></label>
        <lebal class="form-control">'.$Tabledata['mobileNO'].'</label>

      </div>
      <div class="col-15 col-14">
        <label class="form-label">User Role <span style="color:red; font-size:1.1rem;">*</span></label>
        <lebal class="form-control">'.$Tabledata['userRole'].'</label>

      </div>

    </div>
    <div class="row row-2">
      <div class="col-15 col-14 info-box">
        <label class="form-label">User Satus <span style="color:red; font-size:1.1rem;">*</span></label>
        <lebal class="form-control">'.$Tabledata['userStatus'].'</label>
      </div>
    </div>

    <div class="col-12">
      <div class="d-flex" style="justify-content: flex-end;">

        <a href="user-Ui" <button type="click" class="btn btn-secondary">
          <i class="bi bi-arrow-clockwise"></i>
          Back
          </button></a>
      </div>
    </div>
  </form>
</div>';

$responseArray = array(
'formContent'=>$htmlForm,
'pageHeaderSection'=> 'View User'
);


echo json_encode($responseArray);
}
//user deleted
if(isset($_POST['userDelCode'])){
$des="load ajax page for User Delete";
$rem="User Delete";
require_once('../../include/_audiLog.php');

$userCode = $_POST['userDelCode'];
$delete_brn_sql = "delete from loginUser where userCode = '$userCode'";
$delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
if($delete_stmt){
$rsponseAlert = array(
'alertTitle' => 'Deleted SuccessFully.',
'alertIcon' => 'success',
'redirectUrl'=>'user-Ui'
);
}else{
$rsponseAlert = array(
'alertTitle' => 'Delete Not done.',
'alertIcon' => 'error',
'redirectUrl'=>'user-Ui'
);
}

echo json_encode($rsponseAlert);

}


//user reset password
if(isset($_POST['userResetCode'])){
$des="load ajax page for User Reset Password";
$rem="User Reset Password";
require_once('../../include/_audiLog.php');

$userCode = $_POST['userResetCode'];
$u_pass = "eTAS".date("Y");
$pass = password_hash($u_pass,PASSWORD_DEFAULT);
$delete_brn_sql = "update loginUser set logPass = '$pass' where userCode = '$userCode'";
$delete_stmt = sqlsrv_query($conn, $delete_brn_sql);
if($delete_stmt){
$rsponseAlert = array(
'alertTitle' => 'Passwrod Reset SuccessFully.',
'alertIcon' => 'success',
'redirectUrl'=>'user-Ui'
);
}else{
$rsponseAlert = array(
'alertTitle' => 'Password not reset.',
'alertIcon' => 'error',
'redirectUrl'=>'user-Ui'
);
}

echo json_encode($rsponseAlert);

}