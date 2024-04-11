<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Import Employee-ui page";
$rem="Import Employee details page";
$header="Import Employee Details";
$headerDes="Employee Upload";
include '../include/_audiLog.php'; 
include '../include/_licCheck.php'; 

// $Tabledata = sqlsrv_query($conn,"select * from Import EmployeeDetails");





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
      <div class="card">
        <div class="row">
          <div class="col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase">Import Employee</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <form action="admin/process/employeeProcess.php" method="post" class="row g-3">
                    <div class="input-group">
                      <input type="file" class="form-control" id="fileInput25" aria-describedby="inputGroupFileAddon04"
                        aria-label="Upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                      <!-- <button class="btn btn-success" type="button" id="inputGroupFileAddon04"><i
                          class="icofont icofont-upload" style="    font-size: 20px;margin-right: 10px;"></i>Upload
                        Excel
                      </button> -->
                    </div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12"></div>
                    <div class="col-12 imp-emp">
                      <label class=" form-label " style="margin-right: 1rem;font-size: 1.35rem;">Download
                        Employee
                        Upload Formate</label>
                      <button type=" submit" class="btn btn-primary" name="excel_formate">
                        <i class="icofont icofont-download" style="font-size: 20px;margin-right: 10px;"></i>
                        Download Formate
                      </button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase" style="color:red;">Important Notice</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <div>
                    <span style="color:red;">*&nbsp; At fast you have to download the excel formate to import employee
                      Details.</span><br>
                    <span style="color:red;">*&nbsp; You should fill the details in the excel as it is the formate.
                      You
                      Cant'n Change the formate.</span><br>
                    <span style="color:red;">*&nbsp; Some fields are mandatory - <br><span style="padding-left:1rem;">
                        1. Employee Code </span><br><span style="padding-left:1rem;"> 2.
                        Employee Name </span><br><span style="padding-left:1rem;"> 3. Company Name </span><br><span
                        style="padding-left:1rem;"> 4. Department Name </span><br><span style="padding-left:1rem;"> 5.
                        Employee Type </span><br><span style="padding-left:1rem;"> 6. Mobile
                        Number </span><br><span style="padding-left:1rem;"> 7. Employee Status . </span></span><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </main>
  <!-- mode segment  -->

  </div>
</body>

<!-- footer segment  -->
<?php include 'include/_footer_.php';?>

</html>
<script>

</script>