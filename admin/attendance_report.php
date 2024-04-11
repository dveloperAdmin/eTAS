<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Report Attendance-ui page";
$rem="Report Attendance details page";
$header="Report Attendance Details";
$headerDes="Attendance Report";
include '../include/_audiLog.php'; 
include '../include/_licCheck.php'; 

// $Tabledata = sqlsrv_query($conn,"select * from Import AttendanceDetails");

$companyQuery = sqlsrv_query($conn,"select * from companyDetails");
$departmentQuery = sqlsrv_query($conn,"select * from departmentDetails");
$designationQuery = sqlsrv_query($conn,"select * from designationDetails");
$empTypeQuery = sqlsrv_query($conn,"select * from empTypeDetails");
$empCategoryQuery = sqlsrv_query($conn,"select * from empCategoryDetails");
$empGradeQuery = sqlsrv_query($conn,"select * from gradeDetails");
$empLocationQuery = sqlsrv_query($conn,"select * from locationDetails");



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
    <main class="page-content">
      <?php include 'include/_pageHeader.php' ; ?>
      <div class="card" id="tableContainer">
        <div class="card-body" id="comFrom">
          <div class="border p-3 rounded">
            <div style="display:flex;justify-content: space-between;    flex-wrap: wrap;">

              <h6 class="mb-0 text-uppercase">Attendance Report</h6>
              <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
              <div class="checkBtn">
                <div for="click" class="checkBtnToggle">
                  <input type="checkbox" id="click">
                </div>
                <div class="text"></div>
              </div>
            </div>
            <hr />
            <div id="primaryFilter">
              <form action="process-Att-Ui" method="post" class="row g-3">
                <div class="row row-2" style="padding-top:1rem;">
                  <div class="col-20 col-14">
                    <label class="form-label">Select Month </label>

                    <input class="form-control month-excel" id="bday-month" type="month" name="filteredReportMonth"
                      required style="margin-right:1rem;" />
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Company </label>
                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;" required>
                      <option value="" selected hidden>Select Company</option>
                      <?php while($comData= sqlsrv_fetch_array($companyQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $comData['companyCode'];?>"><?php echo $comData['comFName'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Department </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($deptData= sqlsrv_fetch_array($departmentQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $deptData['deptCode'];?>"><?php echo $deptData['department'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Designation </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($desigData= sqlsrv_fetch_array($designationQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $desigData['desigCode'];?>"><?php echo $desigData['designation'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row row-2" style="padding-top:1rem;">
                  <div class="col-20 col-14">
                    <label class="form-label">Select Emp. Type </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($empTypeData= sqlsrv_fetch_array($empTypeQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $empTypeData['empTypeCode'];?>"><?php echo $empTypeData['empType'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Emp. Category </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($empCatData= sqlsrv_fetch_array($empCategoryQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $empCatData['empCatCode'];?>"><?php echo $empCatData['empCategory'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Grade </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($gradeData= sqlsrv_fetch_array($empGradeQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $gradeData['gradeCode'];?>"><?php echo $gradeData['grade'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-20 col-14">
                    <label class="form-label">Select Location </label>

                    <select name="filtered[]" id="" class="form-control" style="margin-right:1rem;">
                      <option value="All" selected>-- All --</option>
                      <?php while($locationData= sqlsrv_fetch_array($empLocationQuery, SQLSRV_FETCH_ASSOC)){?>
                      <option value="<?php echo $locationData['locationCode'];?>">
                        <?php echo $locationData['location'];?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-12" style="padding-top:1rem;">
                  <div class="d-flex" style="justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary" name="filteredReportEx" style="margin-right:.5rem">
                      <i class="icofont icofont-file-excel"> Report In Excel</i>

                    </button>

                    <button type="submit" class="btn btn-primary" name="filteredReportPd" style="margin-right:.5rem">
                      <i class="icofont icofont-file-pdf"> Report In PDF</i>


                    </button>
                  </div>
                </div>
              </form>
            </div>


            <div id="secondaryFilter" style="display:none;">

              <div class="card-body" id="comFrom">
                <form action="process-Att-Ui" method="post" class="row g-3">
                  <div class="border p-3 rounded">

                    <div class="row row-2" style="padding-top:1rem; align-items:end">
                      <div class="col-20 col-14">
                        <label class="form-label">Select Month </label>

                        <input class="form-control month-excel" id="bday-month" type="month"
                          name="attendSecondReportMonth" required style="margin-right:1rem;" />
                      </div>
                      <div class="col-20 col-14">
                        <label class="form-label">Enter Employee Name</label>
                        <input type="text" name="reportEmpName" class="form-control" placeholder="Enter Employee Name "
                          required>
                      </div>
                      <div class="col-20 col-14" style="display: grid;justify-content: end;">
                        <button type="submit" class="btn btn-primary" name="attendSecondReportEx"
                          style="margin-right:.5rem">
                          <i class="icofont icofont-file-excel"> Report In Excel</i>

                        </button>
                      </div>
                      <div class="col-20 col-14">
                        <button type="submit" class="btn btn-primary" name="attendSecondReportPd"
                          style="margin-right:.5rem">
                          <i class="icofont icofont-file-pdf"> Report In PDF</i>


                        </button>
                      </div>
                    </div>
                  </div>

              </div>

            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-6 mx-auto">

      </div>
  </div>
  </div>

  </div>

  <!-- <div class="table-responsive mt-3 " style="height: 26rem; overflow-y: auto;" id="tableContainer">

        </div> -->
  </div>
  </main>
  <!-- mode segment  -->

  </div>
</body>

<!-- footer segment  -->
<?php include 'include/_footer_.php';?>


<script>
$(document).ready(function() {
  $('.checkBtnToggle').on('click', function() {
    // Check if the checkbox is checked
    if ($('#click').prop('checked')) {
      $("#secondaryFilter").css("display", "block");
      $("#primaryFilter").css("display", "none");
    } else {
      $("#secondaryFilter").css("display", "none");
      $("#primaryFilter").css("display", "block");
    }

    // Toggle the 'check' class on '.CheckText' element
    $('.CheckText').toggleClass('check');
  });
});
</script>

</html>