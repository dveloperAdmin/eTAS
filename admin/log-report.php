<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Report LogIn-ui page";
$rem="Report LogIn details page";
$header="Report LogIn Details";
$headerDes="LogIn Report";
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
          <div class="col-xl-16 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;    flex-wrap: wrap;">

                    <h6 class="mb-0 text-uppercase">Log In Report</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->

                  </div>
                  <hr />
                  <form action="process-Report-Ui" method="post" class="row g-3">
                    <?php if($user_role == "User"){?>
                    <div class="row row-2" style="padding-top:1rem;align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name</label>
                        <label class="form-control"><?php echo $user_name;?></label>
                        <input type="hidden" placeholder="Enter the User name" name="userLogReportUserCode"
                          value="<?php echo $user_id;?>" />
                      </div>
                      <div class="col-15 col-14">
                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportUserEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportUserPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                          name="userLogReportDate" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportDateEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportDatePd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Month</label>
                        <input type="month" class="form-control" placeholder="Enter the User name"
                          name="UserLogReportMonth" value="<?php echo date('Y-m'); ?>" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportMonthEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="userLogReportMonthPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <?php }else{?>
                    <div class="row row-2" style="padding-top:1rem;     align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" placeholder="Enter the User name"
                          name="logreportUser" />
                      </div>
                      <div class="col-15 col-14">
                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportUserEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportUserPd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Date</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                          name="logReportDate" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportDateEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportDatePd">
                          <i class="icofont icofont-file-pdf" style="font-weight: 700;"> Pdf</i>

                        </button>
                      </div>
                    </div>
                    <div class="row row-2" style="align-items: end;">
                      <div class="col-15 col-14">
                        <label class="form-label">Select Month</label>
                        <input type="month" class="form-control" placeholder="Enter the User name" name="logReportMonth"
                          value="<?php echo date('Y-m'); ?>" />
                      </div>
                      <div class="col-15 col-14">

                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportMonthEx">
                          <i class="icofont icofont-file-excel" style="font-weight: 700;"> Excel</i>

                        </button>
                        <button type="submit" class="btn btn-outline-primary px-5" name="logReportMonthPd">
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