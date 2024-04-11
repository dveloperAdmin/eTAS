<?php
function func_sql_num_rows($conn, $sql){
    
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    if($stmt != false){
        return sqlsrv_num_rows( $stmt );
        
    }else{
        return 0;
    }
    

}
// some sql for employee

$comTableNumRows = func_sql_num_rows($conn,"select * from companyDetails");
$deptTableNumRows = func_sql_num_rows($conn,"select * from departmentDetails");
$sdeptTableNumRows = func_sql_num_rows($conn,"select * from subDepartmantDetails");
$desigTableNumRows = func_sql_num_rows($conn,"select * from designationDetails");
$sdesigTableNumRows = func_sql_num_rows($conn,"select * from subDesignationDetails");
$divTableNumRows = func_sql_num_rows($conn,"select * from divisionDetails");
$sdivTableNumRows = func_sql_num_rows($conn,"select * from subDivisionDetails");
$empcatTableNumRows = func_sql_num_rows($conn,"select * from empCategoryDetails");
$empScatTableNumRows = func_sql_num_rows($conn,"select * from empSubCategoryDetails");
$empTypeTableNumRows = func_sql_num_rows($conn,"select * from empTypeDetails");
$gradeTableNumRows = func_sql_num_rows($conn,"select * from gradeDetails");
$branchTableNumRows = func_sql_num_rows($conn,"select * from branchDetails");
$locTableNumRows = func_sql_num_rows($conn,"select * from locationDetails");
$teamTableNumRows = func_sql_num_rows($conn,"select * from teamDetails");



// find segment
function company_find($comCode, $conn){
    if($comCode!="" && $comCode != "Default"){
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', comFName from companyDetails group by comFName ,companyCode having companyCode = '$comCode'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&& $sql_data['row_count'] == 1){
            $cname= $sql_data['comFName'];
        }else{
            $cname = "Not Found";
        }
        return($cname);
    }else{
        return "Default";
    }
}
function dept_find($deptCode, $conn){
    if($deptCode!=""){

       
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', department from departmentDetails group by deptCode, department having deptCode = '$deptCode'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['department'];
        }else{
           $code = "Not Found";
        }
        return $code;
    }else{
        return "";
    }
}

function sub_dept_find($subdept,$conn){
    if($subdept!="" && $subdept !="Default"){

       
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count',subDepartment from subDepartmantDetails group by subDeptCode, subDepartment having  subDeptCode= '$subdept'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['subDepartment'];
        }else{
            $code = "Not Found";
        }
        return $code;
    }else{
        return "Default";
    }
}
function desig_find($designation ,$conn){
    if($designation!="" && $designation !="Default"){

      
      $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', designation from designationDetails group by desigCode, designation having desigCode = '$designation'"), SQLSRV_FETCH_ASSOC);
      if($sql_data!=""&&$sql_data['row_count'] == 1){
          $code = $sql_data['designation'];
      }else{
          $code = "Not Found";
          
      }
      return $code;
    }else{
        return "Default";
    }
}
function subdesig_find($subdesignation ,$conn){
    if($subdesignation!="" && $subdesignation !="Default"){
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', subDesignation  from subDesignationDetails  group by subDesigCode, subDesignation having subDesigCode = '$subdesignation'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
          $code = $sql_data['subDesignation'];
        }else{
          $code = "Not Found";
           
        }
        return $code;
    }else{
        return "Default";
    }
}

function division_find($division ,$conn){
  if($division!="" && $division !="Default"){
    $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', divisionCode from divisionDetails group by divisionCode, division having division = '$division'"), SQLSRV_FETCH_ASSOC);
    if($sql_data!=""&&$sql_data['row_count'] == 1){
        $code = $sql_data['division'];
    }else{
        $code = "Not Found";          
    }
    return $code;
  }else{
      return "Default";
  }
}
function subdivision_find($sdivision ,$conn){
    if($sdivision!="" && $sdivision !="Default"){

        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', subDivision from subDivisionDetails group by subDiviCode, subDivision having subDiviCode = '$sdivision'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['subDivision'];
        }else{
            $code = "Not Found";
        }
        return $code;
    }else{
        return "Default";
    }
}
function empCat_find($empCat ,$conn){
    if($empCat!="" && $empCat !="Default"){

        $empCat=ucwords($empCat);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', empCategory from empCategoryDetails group by empCatCode, empCategory having  empCatCode = '$empCat'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['empCategory'];
        }else{
           $code="Not Found";
        }
        return $code;
    }else{
        return "Default";
    }
}
function empSCat_find($empSCat ,$conn){
    if($empSCat!="" && $empSCat !="Default"){

        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count',empSubCategory from empSubCategoryDetails group by empSubCatCode, empSubCategory having empSubCatCode = '$empSCat'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['empSubCategory'];
        }else{
            $code = "Not Found";
          
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empType_find($empType ,$conn){
    if($empType!="" && $empType !="Default"){

        $empType=ucwords($empType);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count',empType  from empTypeDetails group by empTypeCode, empType having empTypeCode = '$empType'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['empType'];
        }else{
            $code = "Not Found";
        }
        return $code;
    }else{
        return "Default";
    }
}
function empGrade_find($empGrade ,$conn){
    if($empGrade!="" && $empGrade !="Default"){

        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', grade from gradeDetails group by gradeCode, grade having gradeCode = '$empGrade'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
          $code = $sql_data['grade'];
        }else{
          $code = "Not Found";
            
        }
        return $code;
    }else{
        return "Default";
    }
}

function empLoc_find($empLoc ,$conn){
    if($empLoc!="" && $empLoc !="Default"){
  
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', location from locationDetails group by locationCode, location having locationCode = '$empLoc'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['location'];
        }else{
          $code = "Not Found";
            
        }
        return $code;
        
    }else{
        return "Default";
    }
}

function branch_find($branch_name, $conn){
  if($branch_name!="" && $branch_name !="Default"){

    $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', branch from branchDetails group by branchCode, branch having branchCode = '$branch_name'"), SQLSRV_FETCH_ASSOC);
    if($sql_data!=""&& $sql_data['row_count'] == 1){
        $code = $sql_data['branch'];
    }else{
        $code = "Not Found";
    }
    return $code;
  }else{
    return "";
  }
}

function empTeam_find($empTeam ,$conn){
    if($empTeam!="" && $empTeam !="Default"){
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', teamName from teamDetails group by teamCode, teamName having teamCode = '$empTeam'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['teamName'];
        }else{
            $code="Not Found";
        }
        return $code;
    }else{
        return "Default";
    }
}



//import Employee Process start
function com_insert($cf_name, $conn){
    if($cf_name!=""){

        $cf_name=ucwords($cf_name);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', companyCode from companyDetails group by companyCode, comFName having comFName = '$cf_name'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&& $sql_data['row_count'] == 1){
            $c_id = $sql_data['companyCode'];
        }else{
            $c_id = "COM-".(time()+ func_sql_num_rows($conn,"select * from companyDetails"));
            sqlsrv_query($conn,"insert into companyDetails(companyCode, comFName, comSName) values ('$c_id','$cf_name','$cf_name')");
            
        }
        return($c_id);
    }else{
        return "Default";
    }
}
function branch_insert($branch_name, $conn){
    if($branch_name!=""){

        $branch_name=ucwords($branch_name);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', branchCode from branchDetails group by branchCode, branch having branch = '$branch_name'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&& $sql_data['row_count'] == 1){
            $code = $sql_data['branchCode'];
        }else{
            $code = "BRN-".(time() + func_sql_num_rows($conn,"select * from branchDetails"));
            sqlsrv_query($conn,"insert into branchDetails(branchCode, branch) values ('$code','$branch_name')");
            
        }
        return $code;
    }else{
        return "";
    }
}
function dept_insert($dept,$conn){
    if($dept!=""){

        $dept=ucwords($dept);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', deptCode from departmentDetails group by deptCode, department having department = '$dept'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['deptCode'];
        }else{
            $code = "DEPT-".(time() +func_sql_num_rows($conn,"select * from departmentDetails"));
            sqlsrv_query($conn,"insert into departmentDetails (deptCode, department) values ('$code','$dept')");
            
        }
        return $code;
    }else{
        return "";
    }
}
function sub_dept_insert($subdept,$conn){
    if($subdept!=""){

        $subdept=ucwords($subdept);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', subDeptCode from subDepartmantDetails group by subDeptCode, subDepartment having subDepartment = '$subdept'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['subDeptCode'];
        }else{
            $code = "SDEPT-".(time() + func_sql_num_rows($conn,"select * from subDepartmantDetails"));
            sqlsrv_query($conn,"insert into subDepartmantDetails (subDeptCode, subDepartment) values ('$code','$subdept')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function desig_insert($designation ,$conn){
    if($designation!=""){

        $designation=ucwords($designation);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', desigCode from designationDetails group by desigCode, designation having designation = '$designation'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['desigCode'];
        }else{
            $code = "DESIG-".(time() + func_sql_num_rows($conn,"select * from designationDetails"));
            sqlsrv_query($conn,"insert into designationDetails (desigCode, designation) values ('$code','$designation')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function subdesig_insert($subdesignation ,$conn){
    if($subdesignation!=""){

        $subdesignation=ucwords($subdesignation);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', subDesigCode from subDesignationDetails  group by subDesigCode, subDesignation having subDesignation = '$subdesignation'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['subDesigCode'];
        }else{
            $code = "SDESIG-".(time() + func_sql_num_rows($conn,"select * from subDesignationDetails"));
            sqlsrv_query($conn,"insert into subDesignationDetails (subDesigCode, subDesignation) values ('$code','$subdesignation')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function division_insert($division ,$conn){
    if($division!=""){

        $division=ucwords($division);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', divisionCode from divisionDetails group by divisionCode, division having division = '$division'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['divisionCode'];
        }else{
            $code = "DIV-".(time() +func_sql_num_rows($conn,"select * from divisionDetails"));
            sqlsrv_query($conn,"insert into divisionDetails (divisionCode, division) values ('$code','$division')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function subdivision_insert($sdivision ,$conn){
    if($sdivision!=""){

        $sdivision=ucwords($sdivision);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', subDiviCode from subDivisionDetails group by subDiviCode, subDivision having subDivision = '$sdivision'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['subDiviCode'];
        }else{
            $code = "SDIV-". (time() + func_sql_num_rows($conn,"select * from subDivisionDetails"));
            sqlsrv_query($conn,"insert into subDivisionDetails (subDiviCode, subDivision) values ('$code','$sdivision')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empCat_insert($empCat ,$conn){
    if($empCat!=""){

        $empCat=ucwords($empCat);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', empCatCode from empCategoryDetails group by empCatCode, empCategory having empCategory = '$empCat'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&& $sql_data['row_count'] == 1){
            $code = $sql_data['empCatCode'];
        }else{
            
            $code = "CATE-".(time()+ func_sql_num_rows($conn,"select * from empCategoryDetails"));
            sqlsrv_query($conn,"insert into empCategoryDetails (empCatCode, empCategory) values ('$code','$empCat')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empSCat_insert($empSCat ,$conn){
    if($empSCat!=""){

        $empSCat=ucwords($empSCat);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', empSubCatCode from empSubCategoryDetails group by empSubCatCode, empSubCategory having empSubCategory = '$empSCat'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['empSubCatCode'];
        }else{
            $code = "SCATE-".(time() + func_sql_num_rows($conn,"select * from empSubCategoryDetails"));
            sqlsrv_query($conn,"insert into empSubCategoryDetails (empSubCatCode, empSubCategory) values ('$code','$empSCat')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empType_insert($empType ,$conn){
    if($empType!=""){

        $empType=ucwords($empType);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', empTypeCode from empTypeDetails group by empTypeCode, empType having empType = '$empType'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['empTypeCode'];
        }else{
            $code = "TY-".(time() +func_sql_num_rows($conn,"select * from empTypeDetails"));
            sqlsrv_query($conn,"insert into empTypeDetails (empTypeCode, empType) values ('$code','$empType')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empGrade_insert($empGrade ,$conn){
    if($empGrade!=""){

        $empGrade=ucwords($empGrade);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', gradeCode from gradeDetails group by gradeCode, grade having grade = '$empGrade'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['gradeCode'];
        }else{
            $code = "GRD-".(time() + func_sql_num_rows($conn,"select * from gradeDetails"));
            sqlsrv_query($conn,"insert into gradeDetails (gradeCode, grade) values ('$code','$empGrade')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}
function empLoc_insert($empLoc ,$conn){
    if($empLoc!=""){
        $empLoc=ucwords($empLoc);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', locationCode from locationDetails group by locationCode, location having location = '$empLoc'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['locationCode'];
        }else{
            $code = "LOC-".(time()+ func_sql_num_rows($conn,"select * from locationDetails"));
            sqlsrv_query($conn,"insert into locationDetails (locationCode, location) values ('$code','$empLoc')");
            
        }
        return $code;
        
    }else{
        return "Default";
    }
}
function empTeam_insert($empTeam ,$conn){
    if($empTeam!=""){

        $empTeam=ucwords($empTeam);
        $sql_data = sqlsrv_fetch_array(sqlsrv_query($conn, "select count(*) as 'row_count', teamCode from teamDetails group by teamCode, teamName having teamName = '$empTeam'"), SQLSRV_FETCH_ASSOC);
        if($sql_data!=""&&$sql_data['row_count'] == 1){
            $code = $sql_data['teamCode'];
        }else{
            $code = "TM-".(time() + func_sql_num_rows($conn,"select * from teamDetails"));
            sqlsrv_query($conn,"insert into teamDetails (teamCode, teamName) values ('$code','$empTeam')");
            
        }
        return $code;
    }else{
        return "Default";
    }
}