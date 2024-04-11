<?php 
include '../../include/_dbConnect.php';
include '../../include/_session.php';
// $des="load Import Employee-process page";
// $rem="Import Employee process  page";
// include '../../include/_audiLog.php';
require '../../vendor/autoload.php';
// include '../include/_head.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Fill, Font, Border};
use PhpOffice\PhpSpreadsheet\IOFactory;
  if(isset($_POST['excel_formate'])){
$des="load Employee-process page for Import Employee Formate download";
    $rem="Import Employee Excell";
    require_once('../../include/_audiLog.php');
   

    $excel_column = array("SL NO", "Employee Code", "Employee Name", "Company Name", "Department", "Sub-Department ", "Designation", "Sub-Designation", "Division", "Sub-Division", "Employee Category", "Employee Sub-Category", "Employee Type", "Grade","Branch", "Location", "Team Name", "Mobile No", "Gmail Id", "Address","Govt.Id Number","Employee Status");

    
    $spreadsheet = new Spreadsheet();

    // Set some properties for the Excel file
    $spreadsheet->getProperties()
        ->setCreator('Your Name')
        ->setLastModifiedBy('Your Name')
        ->setTitle('Example Spreadsheet')
        ->setSubject('Test');
    
    // Add data to the Excel sheet
    $sheet = $spreadsheet->getActiveSheet();
    
    // Set headers based on the array data and apply styles
    $columnIndex = 1;
    foreach ($excel_column as $header) {
        $sheet->setCellValueByColumnAndRow($columnIndex, 1, $header);
    
        // Apply styles to the header cell
        $headerCell = $sheet->getCellByColumnAndRow($columnIndex, 1);
        $headerCell->getStyle()
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor();
        // ->setARGB('FFFF00'); // Yellow background
    
        $headerCell->getStyle()
            ->getFont()
            ->setBold(true)
            ->getColor()
            ->setARGB('000000'); // Black font color
    
        $sheet->getColumnDimensionByColumn($columnIndex)->setAutoSize(true);
    
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
    
        $headerCell->getStyle()->applyFromArray($styleArray);
    
        $columnIndex++;
    }
     $sheet->freezePane('A2');
    $sheet->freezePane('D2');
    // / Create the response
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Employee Upload.xlsx"');
    header('Cache-Control: max-age=0');
    header('Pragma: public');
    
    // Save the Excel file to the output
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;


}






function insertUpdate($row, $conn){
    $empCode = $row[1];
    $checkEmpExists = sql_num_rows($conn,"select * from employeeDetails  where empCode = '$empCode'");
    $empName = $row[2];
    $comCode = $row[3];
    $deptCode = $row[4];
    $subdeptCode = $row[5];
    $desigCode = $row[6];
    $subdesigCode = $row[7];
    $divisionCode = $row[8];
    $subdivisionCode = $row[9];
    $empcatCode = $row[10];
    $empsubcatCode = $row[11];
    $empTypeCpde = $row[12];
    $grade = $row[13];
    $branch = $row[14];
    $location = $row[15];
    $teamCode =$row[16];
    $conNumber = $row[17];
    $gmailId = $row[18];
    $address = $row[19];
    $gvtId = $row[20];
    $empStatus = $row[21];

   if($checkEmpExists>=1){
    $updateSql = "update employeeDetails set empName='$empName',companyCode = '$comCode',departmentCode = '$deptCode',subDepartmantCode = '$subdeptCode',designationCode = '$desigCode',subDesignationCode = '$subdesigCode',divisionCode = '$divisionCode',subDivisionCode = '$subdivisionCode',empCategoryCode = '$empcatCode',empSubCategoryCode = '$empsubcatCode',empTypeCode = '$empTypeCpde',locationCode = '$location',branchCode = '$branch',grade = '$grade',teamCode = '$teamCode',contactNO = '$conNumber',emailId = '$gmailId',address = '$address',govtId = '$gvtId',status = '$empStatus' where empCode='$empCode'";
    $result =  sqlsrv_query($conn,$updateSql); 
   }else{
    $insertSql = "insert into employeeDetails (empCode,empName,companyCode,departmentCode,subDepartmantCode,designationCode,subDesignationCode,divisionCode,subDivisionCode,empCategoryCode,empSubCategoryCode,empTypeCode,locationCode,branchCode,grade,teamCode,contactNO,emailId,address,govtId,status)values('$empCode','$empName','$comCode','$deptCode','$subdeptCode','$desigCode','$subdesigCode','$divisionCode','$subdivisionCode','$empcatCode','$empsubcatCode','$empTypeCpde','$location','$branch','$grade','$teamCode','$conNumber','$gmailId','$address','$gvtId','$empStatus')";
    $result =  sqlsrv_query($conn,$insertSql);
   }
    if($result){
        return true;
    }else{
        return false;
    }
}



function insertTemp($file,$conn){
    include '../../include/_function.php';
     $excel_column = array("SL NO", "Employee Code", "Employee Name", "Company Name", "Department", "Sub-Department ", "Designation", "Sub-Designation", "Division", "Sub-Division", "Employee Category", "Employee Sub-Category", "Employee Type", "Grade","Branch", "Location", "Team Name", "Mobile No", "Gmail Id", "Address","Govt.Id Number","Employee Status");
     
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $excelData = $sheet->toArray();
    $headerArray = array_shift($excelData);
    $difference = array_diff($excel_column,$headerArray);
    if(empty($difference)){

        $arr_data =[];
        $i=0;
            foreach ($excelData as $row) {
            // $emp_code = $row[1]; // Assuming employee code is in the first column
            // $emp_name = $row[2]; // Assuming employee name is in the second column
    
            $comCode = $row[3] = com_insert($row[3],$conn);
            $deptCode = $row[4] = dept_insert($row[4],$conn);
            $subdeptCode = $row[5] = sub_dept_insert($row[5],$conn);
            $desigCode = $row[6] = desig_insert($row[6],$conn);
            $subdesigCode = $row[7] = subdesig_insert($row[7],$conn);
            $divisionCode = $row[8] = division_insert($row[8],$conn);
            $subdivisionCode = $row[9] = subdivision_insert($row[9],$conn);
            $empcatCode = $row[10] = empCat_insert($row[10],$conn);
            $empsubcatCode = $row[11] = empSCat_insert($row[11],$conn);
            $empTypeCpde = $row[12] = empType_insert($row[12],$conn); 
            $grade = $row[13] = empGrade_insert($row[13],$conn);
            $branch = $row[14] = branch_insert($row[14],$conn);
            $location = $row[15] = empLoc_insert($row[15],$conn);
            $teamCode =$row[16] = empTeam_insert($row[16],$conn);
    
            // Create an associative array with employee code and name
                $result = insertUpdate($row, $conn);
                if($result == true){
                    $i++;
    
                }
                
            
    
            // Add the employee data to the array
            
            
    
        }
        
        if(count($excelData) == $i){
    
            return "Success";
        }else{
            return False;
    
        }
    }else{
        return "formateMismatch";
    }

   

}
if (isset($_FILES['excelFile'])) {
    $des="load Employee-process page for Import Employee Details";
    $rem="Import Employee Details";
    require_once('../../include/_audiLog.php');

    $file = $_FILES['excelFile']['tmp_name'];
    // $month = $_POST['month'];
    // echo $file;
    // Excel sheet processing and HTML table generation
    $htmlTable = insertTemp($file,$conn);
   
    if ($htmlTable == "Success") {
        $rsponseAlert = array(
        'alertTitle' => 'Employee Import Successfully',
        'alertIcon' => 'success',
        'redirectUrl'=>'import-Employee-Ui'
        );
    
    } else if($htmlTable == "formateMismatch") {
        $rsponseAlert = array(
            'alertTitle' => 'File Formate is mismatch..',
            'alertIcon' => 'error',
            'redirectUrl'=>'import-Employee-Ui'
        );
        
    
    } else {
        $rsponseAlert = array(
            'alertTitle' => 'Employee Not Imported......',
            'alertIcon' => 'error',
            'redirectUrl'=>'import-Employee-Ui'
        );
        
    }
    echo json_encode($rsponseAlert);
    
} 

// end of import employee


//add employee

function countDigits($mobileNumber) {
    // Remove non-digit characters from the mobile number
    $digitsOnly = preg_replace('/\D/', '', $mobileNumber);
    // Count the number of remaining digits
    $digitCount = strlen($digitsOnly);
    return $digitCount;
}

//add employee
if(isset($_POST['empAdd'])){
    $des="load Employee-process page for Add Employee Details";
    $rem="Add Employee Details";
    require_once('../../include/_audiLog.php');
    
    $empCode = $_POST['empCode'];
    $empName = $_POST['empName'];
    $comCode = $_POST['comName'];
    $deptCode = $_POST['dept'];
    $desigCode = $_POST['desig'];
    $empcatCode = $_POST['empcat'];
    $branch = $_POST['branch'];
    $conNumber = $_POST['mobileNo'];
    $gmailId = $_POST['email'];
    $empStatus = $_POST['empsts'];
    $subdeptCode = $_POST['subDept'];
    $subdesigCode = $_POST['subdesig'];
    $divisionCode = $_POST['division'];
    $subdivisionCode = $_POST['subdivision'];
    $empsubcatCode = $_POST['empsubcat'];
    $empTypeCpde = $_POST['EmpType'];
    $grade = $_POST['grade'];
    $location = $_POST['location'];
    $teamCode =$_POST['team'];
    $gvtId = $_POST['govtID'];
    $address = $_POST['address'];



    if($empCode !="" && $empName !="" && $comCode != "" && $deptCode !="" && $empStatus !=""){  
            $checkEmpExists = sql_num_rows($conn,"select * from employeeDetails  where empCode = '$empCode'");
            if($checkEmpExists<1){
    
            $insertSql = "insert into employeeDetails (empCode,empName,companyCode,departmentCode,subDepartmantCode,designationCode,subDesignationCode,divisionCode,subDivisionCode,empCategoryCode,empSubCategoryCode,empTypeCode,locationCode,branchCode,grade,teamCode,contactNO,emailId,address,govtId,status)values('$empCode','$empName','$comCode','$deptCode','$subdeptCode','$desigCode','$subdesigCode','$divisionCode','$subdivisionCode','$empcatCode','$empsubcatCode','$empTypeCpde','$location','$branch','$grade','$teamCode','$conNumber','$gmailId','$address','$gvtId','$empStatus')";
            $result =  sqlsrv_query($conn,$insertSql);

            if($result !=""){
                $_SESSION['icon_ad']='success' ; 
                $_SESSION['status_ad']='Employee Entry Successfull' ;
                header("location:../../add-Employee-Ui");

            }else{
                $_SESSION['icon_ad']='error' ; 
                $_SESSION['status_ad']='Employee Details not submit properly' ;
                header("location:../../add-Employee-Ui");
            }
            
        }else{
            $_SESSION['icon_ad']='error' ; 
            $_SESSION['status_ad']='Employee Already Exists' ;
            header("location:../../add-Employee-Ui"); 
        }
    }else{
        $_SESSION['icon_ad']='warning' ; 
        $_SESSION['status_ad']='Please fill the input field mandatory' ;
        header("location:../../add-Employee-Ui"); 
    }

}
//Edit employee
if(isset($_POST['empEdit'])){
    $des="load Employee-process page for Edit Employee Details";
    $rem="Edit Employee Details";
    require_once('../../include/_audiLog.php');

    
    $empCode = $_POST['empCode'];
    $empName = $_POST['empName'];
    $comCode = $_POST['comName'];
    $deptCode = $_POST['dept'];
    $desigCode = $_POST['desig'];
    $empcatCode = $_POST['empcat'];
    $branch = $_POST['branch'];
    $conNumber = $_POST['mobileNo'];
    $gmailId = $_POST['email'];
    $empStatus = $_POST['empsts'];
    $subdeptCode = $_POST['subDept'];
    $subdesigCode = $_POST['subdesig'];
    $divisionCode = $_POST['division'];
    $subdivisionCode = $_POST['subdivision'];
    $empsubcatCode = $_POST['empsubcat'];
    $empTypeCpde = $_POST['EmpType'];
    $grade = $_POST['grade'];
    $location = $_POST['location'];
    $teamCode =$_POST['team'];
    $gvtId = $_POST['govtID'];
    $address = $_POST['address'];



    if($empCode !="" && $empName !="" && $comCode != "" && $deptCode !="" &&  $empStatus !=""){
       
            $checkEmpExists = sql_num_rows($conn,"select * from employeeDetails  where empCode = '$empCode'");
            if($checkEmpExists == 1){
                $updateSql = "update employeeDetails set empName='$empName',companyCode = '$comCode',departmentCode = '$deptCode',subDepartmantCode = '$subdeptCode',designationCode = '$desigCode',subDesignationCode = '$subdesigCode',divisionCode = '$divisionCode',subDivisionCode = '$subdivisionCode',empCategoryCode = '$empcatCode',empSubCategoryCode = '$empsubcatCode',empTypeCode = '$empTypeCpde',locationCode = '$location',branchCode = '$branch',grade = '$grade',teamCode = '$teamCode',contactNO = '$conNumber',emailId = '$gmailId',address = '$address',govtId = '$gvtId',status = '$empStatus' where empCode='$empCode'";
                $result =  sqlsrv_query($conn,$updateSql);
                if($result !=""){
                    $_SESSION['icon_ad']='success' ; 
                    $_SESSION['status_ad']='Employee details Updated Successfull' ;
                    header("location:../../list-Employee-Ui");

                }else{
                    
                    $_SESSION['icon_ad']='error' ; 
                    $_SESSION['status_ad']='Employee Details not Updated' ;
                    header("location:../../list-Employee-Ui");
                }
                
            }else{
                $_SESSION['icon_ad']='warning' ; 
                $_SESSION['status_ad']='Employee Not Found' ;
                header("location:../../list-Employee-Ui"); 
            }
       
    }else{
        
        $_SESSION['icon_ad']='warning' ; 
        $_SESSION['status_ad']='Please fill the input field mandatory' ;
        header("location:../../list-Employee-Ui"); 
    }

}