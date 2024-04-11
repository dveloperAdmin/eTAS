<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Import Attendance-ui page";
$rem="Import Attendance details page";
$header="Import Attendance Details";
$headerDes="Attendance Upload";
include '../include/_audiLog.php'; 
include '../include/_licCheck.php'; 

// $Tabledata = sqlsrv_query($conn,"select * from Import AttendanceDetails");





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
        <div class="row">
          <div class="col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">

                    <h6 class="mb-0 text-uppercase">Import Attendance</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <form action="admin/process/attendanceProcess.php" method="post" class="row g-3">
                    <div class="row row-2" style="padding-top:1rem;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Month </label>

                        <input class="form-control month-excel" id="bday-month" type="month" name="bday-month" required
                          style="margin-right:1rem;" />
                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">Upload Excel Sheet </label>
                        <input type="file" class="form-control" id="attendsFileInput"
                          aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                          accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <!-- <button class="btn btn-success" type="button" id="inputGroupFileAddon04"><i
                          class="icofont icofont-gears" style="font-size: 20px;margin-right: 10px;"></i>Process
                        Attendance
                      </button> -->
                      </div>
                    </div>
                    <div class="container" style="justify-content: center;" id="process_btn">
                      <div id="progress" style="display:none"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mx-auto">

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
<script src="admin/assets/js/attendAjax59.js"></script>

</html>

<script>
let htmlChnage = ""

$(document).on("click", ".backDefroze", function() {
  resetProcessStatus();
  defrostSidebar(); // Corrected function call with parentheses
  window.location.href = "import-Attendance-Ui"; // Check if this URL is correct
});
$(document).on("click", "#processInFrozen", function() {
  processStart()
});

//aftere process it show

$(document).on("click", "#refreshProgres", function() {
  progressDisplay()
});
</script>