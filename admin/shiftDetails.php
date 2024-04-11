<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Shift-ui page";
$rem="Shift details page";
$header="Shift Details";
$headerDes="Shift Entry";
include '../include/_audiLog.php';
include '../include/_licCheck.php';  

$Tabledata = sqlsrv_query($conn,"select * from shiftDetails");





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
                          Let's explain suppose that <br />
                          Shift time = 10:00 to 19:00<br />
                          Half Day checkout = 14:00<br />
                          Duration = 20 min (You SET)<br />
                          How it's work<br />
                          We start the punch (Check in) from 09:40 to 10:20 ( 20 min before and 20 min after )<br />
                          We start the punch (Check Out) from 18:40 to 19:20 ( 20 min before and 20 min after )<br />
                          We start the punch for half day (Check Out) from 13:40 to 14:20 ( 20 min before
                          and 20 min after )<br />

                        </div>
                      </div>

                    </div>

                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-success" name="shiftAdd">
                          <i class="bi bi-plus-lg"></i>
                          Add Shift
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
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <h5 class="mb-0">Shift Details</h5>
                  <form action="Department-Ui" method="" enctype="multipart/form-data"
                    class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                      <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="search" id="searchInput" />
                  </form>
                </div>
                <div class="table-responsive mt-3 mst-3" id="reloadTable">
                  <table class="table align-middle comTable" id="dataTable">
                    <thead class="table-secondary table-header">
                      <tr style="text-align:center;">
                        <th>Count</th>
                        <th>Shift</th>
                        <th>Checkin</th>
                        <th>Checkout <br>(Half-Day)</th>
                        <th>Checkout <br>(Full-Day)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 0; while($tableDataFetch = sqlsrv_fetch_array($Tabledata , SQLSRV_FETCH_ASSOC)){ 
                        $backgroundColor = $tableDataFetch['shiftStaus'] == 'Active' ? '#70ff70' : 'inherit';
                        ?>
                      <tr style="text-align:center;background-color: <?php echo $backgroundColor; ?>">
                        <td><?php echo ++$i;?></td>
                        <td style="display:none;"><?php echo $tableDataFetch['shiftCode'];?></td>
                        <td><?php echo $tableDataFetch['shiftName'];?></td>
                        <td><?php echo $tableDataFetch['checkInFrom'];?><br><?php echo $tableDataFetch['checkInTo'];?>
                        </td>
                        <td>
                          <?php echo $tableDataFetch['halfCheckOutFrom'];?><br><?php echo $tableDataFetch['halfCheckOutTo'];?>
                        </td>
                        <td>
                          <?php echo $tableDataFetch['FcheckOutFrom'];?><br><?php echo $tableDataFetch['FcheckOutTo'];?>
                        </td>


                        <input type="hidden" value="shift">
                        <td>
                          <div class="table-actions d-flex align-items-center gap-3 fs-6">
                            <a href="javascript:;" class="text-primary btnView" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                            <a href="javascript:;" class="text-warning btnEdit" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                            <a href="javascript:;" class="text-danger btnDelt" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                          </div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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