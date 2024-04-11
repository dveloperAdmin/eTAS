<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Employee Add-ui page";
$rem="Employee Add details page";
$header="Employee Add Details";
$headerDes="Employee Add Entry";
include '../include/_audiLog.php';
include '../include/_licCheck.php';  

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






?>
<!DOCTYPE html>
<html lang="en">

<!-- head segment  -->
<?php include 'include/_head.php';?>

<body>
  <!--start wrapper-->
  <div class="wrapper">
    <?php 
        // header & navbar 
        include 'include/_headerSection.php';

        // sidebar segment 
        include 'include/_sideBar.php';
    ?>
    <!--start content-->
    <main class="page-content" style="padding-bottom:.2rem; padding-top:.4rem">
      <?php include 'include/_pageHeader.php' ; ?>
      <div class="card" style="margin-bottom:0px">
        <form action="admin/process/employeeProcess.php" method="post">
          <div class="row">
            <div class="col-xl-6 mx-auto">
              <div class="card" style="margin-bottom:0px">
                <div class="card-body">
                  <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">New Employee</h6>
                    <hr style="margin-top:.45rem;" />
                    <div class="row g-3">
                      <div class="row row-2">
                        <div class="col-12 col-17" style="margin-top:0px;">
                          <label class="form-label">Employee Code <span
                              style="color:red; font-size:1.2rem;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter Employee Code" name="empCode"
                            autofocus required />
                        </div>
                        <div class="col-12 col-18" style="margin-top:0px;">
                          <label class="form-label">Employee Name <span
                              style="color:red; font-size:1.2rem;">*</span></label>
                          <input type="text" class="form-control" placeholder="Enter the Employee name" name="empName"
                            required />
                        </div>
                      </div>
                      <div class="col-12 col-14" style="margin-top:0px;">
                        <label class="form-label">Company Name <span
                            style="color:red; font-size:1.2rem;">*</span></label>
                        <select class="form-control" name="comName" required />
                        <option value="" hidden selected disbale>Select Company Name</option>
                        <?php while ($row = sqlsrv_fetch_array($comTabledata, SQLSRV_FETCH_ASSOC)){?>
                        <option value="<?php echo $row['companyCode'];?>"><?php echo $row['comFName'];?></option>
                        <?php }?>
                        </select>
                      </div>

                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Department <span
                              style="color:red; font-size:1.2rem;">*</span></label>
                          <select class="form-control" name="dept" required />
                          <option value="" hidden selected disbale>Select Department</option>
                          <?php while ($row = sqlsrv_fetch_array($deptTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['deptCode'];?>"><?php echo $row['department'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Sub - Department <span
                              style="color:red; font-size:1.2rem;"></span></label>
                          <select class="form-control" name="subDept" />
                          <option value="" hidden selected disbale>Select Sub-Department</option>
                          <?php while ($row = sqlsrv_fetch_array($sdeptTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['subDeptCode'];?>"><?php echo $row['subDepartment'];?></option>
                          <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Designation </label>
                          <select class="form-control" name="desig" />
                          <option value="" hidden selected disbale>Select Designation</option>
                          <?php while ($row = sqlsrv_fetch_array($desigTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['desigCode'];?>"><?php echo $row['designation'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Sub-Designation </label>
                          <select class="form-control" name="subdesig" />
                          <option value="" hidden selected disbale>Select Sub-Designation</option>
                          <?php while ($row = sqlsrv_fetch_array($sdesigTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['subDesigCode'];?>"><?php echo $row['subDesignation'];?>
                          </option>
                          <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Division </label>
                          <select class="form-control" name="division" />
                          <option value="" hidden selected disbale>Select Division</option>
                          <?php while ($row = sqlsrv_fetch_array($divTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['divisionCode'];?>"><?php echo $row['division'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Sub-Division </label>
                          <select class="form-control" name="subdivision" />
                          <option value="" hidden selected disbale>Select Sub-Division</option>
                          <?php while ($row = sqlsrv_fetch_array($sdivTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['subDiviCode'];?>"><?php echo $row['subDivision'];?></option>
                          <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Emp. Category </label>
                          <select class="form-control" name="empcat" />
                          <option value="" hidden selected disbale>Select Emp. Category</option>
                          <?php while ($row = sqlsrv_fetch_array($empcatTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['empCatCode'];?>"><?php echo $row['empCategory'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Emp. Sub-Category </label>
                          <select class="form-control" name="empsubcat" />
                          <option value="" hidden selected disbale>Select Emp. Category</option>
                          <?php while ($row = sqlsrv_fetch_array($empScatTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['empSubCatCode'];?>"><?php echo $row['empSubCategory'];?>
                          </option>
                          <?php }?>
                          </select>
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
                          <option value="" hidden selected disbale>Select Emp. Type</option>
                          <?php while ($row = sqlsrv_fetch_array($empTypeTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['empTypeCode'];?>"><?php echo $row['empType'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Grade</label>
                          <select class="form-control" name="grade" />
                          <option value="" hidden selected disbale>Select Grade</option>
                          <?php while ($row = sqlsrv_fetch_array($gradeTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['gradeCode'];?>"><?php echo $row['grade'];?></option>
                          <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Branch </label>
                          <select class="form-control" name="branch" />
                          <option value="" hidden selected disbale>Select Branch</option>
                          <?php while ($row = sqlsrv_fetch_array($branchTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['branchCode'];?>"><?php echo $row['branch'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Location </label>
                          <select class="form-control" name="location" />
                          <option value="" hidden selected disbale>Select Location</option>
                          <?php while ($row = sqlsrv_fetch_array($locTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['locationCode'];?>"><?php echo $row['location'];?></option>
                          <?php }?>
                          </select>
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Team <span style="color:red; font-size:1.2rem;"></span></label>
                          <select class="form-control" name="team" />
                          <option value="" hidden selected disbale>Select Team</option>
                          <?php while ($row = sqlsrv_fetch_array($teamTabledata, SQLSRV_FETCH_ASSOC)){?>
                          <option value="<?php echo $row['teamCode'];?>"><?php echo $row['teamName'];?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Employee Status<span
                              style="color:red; font-size:1.2rem;">*</span></label>
                          <select class="form-control" name="empsts" required />
                          <option value="" hidden selected disbale>Select Emp. Status</option>
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
                            pattern="\d{10}" maxlength="10">

                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Email Id </label>

                          <input type="email" class="form-control" id="email" name="email" />
                        </div>
                      </div>
                      <div class="row row-2">
                        <div class="col-15 col-14">
                          <label class="form-label">Govt.Id Number </label>
                          <input type="text" class="form-control" placeholder="Enter Email ID" name="govtID" />
                        </div>
                        <div class="col-15 col-14">
                          <label class="form-label">Address </label>
                          <input type="text" class="form-control" placeholder="Enter Email ID" name="address" />
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary" name="empAdd">
                            <i class="bi bi-plus-lg"></i>
                            Add Employee
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

    </main>



    <!-- mode segment  -->

  </div>

</body>

<!-- footer segment  -->
<?php include 'include/_footer_.php';?>

</html>