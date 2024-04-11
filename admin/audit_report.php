<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Report Audit Log-ui page";
$rem="Report Audit Log details page";
$header="Report Audit Log Details";
$headerDes="Audit Log Report";
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
      <div class="card">
        <div class="row">
          <div class="col-xl-16 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;    flex-wrap: wrap;">

                    <h6 class="mb-0 text-uppercase">Audit Log Report</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->

                  </div>
                  <hr />
                  <form action="process-Report-Ui" method="post" class="row g-3">
                    <?php  if($user_role == "User"){?>
                    <div class="row row-2" style="padding-top:1rem;     align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name</label>
                        <label class="form-control"><?php echo $user_name;?></label>
                        <input type="hidden" placeholder="Enter the User name" name="userreportUserCode"
                          value="<?php echo $user_id;?>" />
                      </div>
                      <div class="col-15 col-14">
                        <button type="submit" class="btn btn-outline-primary px-5" name="userreportUserEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userreportUserPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                          name="userReportDate" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="userReportDateEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userReportDatePd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Month</label>
                        <input type="month" class="form-control" placeholder="Enter the User name"
                          name="UserReportMonth" value="<?php echo date('Y-m'); ?>" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="userReportMonthEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userReportMonthPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <?php }else{?>
                    <div class="row row-2" style="padding-top:1rem;     align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" placeholder="Enter the User name" name="reportUser" />
                      </div>
                      <div class="col-15 col-14">
                        <button type="submit" class="btn btn-outline-primary px-5" name="reportUserEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="reportUserPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                          name="reportDate" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="reportDateEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="reportDatePd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Month</label>
                        <input type="month" class="form-control" placeholder="Enter the User name" name="reportMonth"
                          value="<?php echo date('Y-m'); ?>" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="reportMonthEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="reportMonthPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <?php } ?>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-6 mx-auto">

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