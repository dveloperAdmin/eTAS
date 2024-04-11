<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load download-Attendance-Ui page";
$rem="Attendance Format details page";
$header="Attendance Format";
$headerDes="Attendance Format";
include '../include/_audiLog.php';
include '../include/_licCheck.php';  






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

                    <h6 class="mb-0 text-uppercase"> Attendance Format</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <form action="admin/process/attendanceProcess.php" method="post" class="row g-3">
                    <div class="row row-2" style="padding-top:10px;">
                      <div class="col-15 col-14">
                        <label class="form-label">Month </label>
                        <select name="monthFormat" id="" class="form-control" required>
                          <option style="color: #ced4da;" selected disabled hidden>Select Month</option>
                          <?php for($i=1; $i<=12; $i++){?>
                          <option value="<?php echo date("m", mktime(0, 0, 0, $i, 1, 2000));?>">
                            <?php echo date("F", mktime(0, 0, 0, $i, 1, 2000));?></option>

                          <?php }   ?>
                        </select>


                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">Year</label>

                        <select name="yearFormat" id="" class="form-control" required>
                          <option style="color: #ced4da;" selected disabled hidden>Select Year</option>
                          <?php for($i=date("Y");$i>2020;$i--){ ?>
                          <option value="<?php echo $i;?>"><?php echo $i;?></option>

                          <?php   } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type=" submit" class="btn btn-primary" name="attendanceExcelformate">
                          <i class="icofont icofont-download" style="font-size: 20px;margin-right: 10px;"></i>
                          Download Formate
                        </button>
                      </div>
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
                    <span style="color:red;">*&nbsp; At fast you have to download the excel formate to import Attendance
                      Details.</span><br>
                    <span style="color:red;">*&nbsp; You should fill the details in the excel as it is the formate.
                      You
                      Cant'n Change the formate.</span><br>
                    <span style="color:red;">*&nbsp; Some Roles To fillup Attendance sheet - <br><span
                        style="padding-left:1rem;">
                        1. Employee Code mendetory</span><br><span style="padding-left:1rem;"> 2.
                        "P" for Present</span><br><span style="padding-left:1rem;"> 3. "HD" for Halfday</span><br><span
                        style="padding-left:1rem;"> 4. "L" for Leave</span><br><span style="padding-left:1rem;"> 5."WO"
                        for Week Off</span><br><span style="padding-left:1rem;"> 6. Mobile
                        Number </span><br><span style="padding-left:1rem;"> 7. Employee Status . </span></span><br>
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