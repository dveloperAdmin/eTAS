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

            </div>
          </div>
          <div class="col-xl-6 mx-auto"></div>
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
<script src="admin/assets/js/attendAjax34.js"></script>

</html>

<script>
$(document).on("click", ".backDefroze", function() {
  resetProcessStatus();
  defrostSidebar(); // Corrected function call with parentheses
  window.location.href = "import-Attendance-Ui"; // Check if this URL is correct
});
$(document).on("click", "#processInFrozen", function() {
  defrostSidebar()
});
</script>