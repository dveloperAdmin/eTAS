<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load User View-ui page";
$rem="User details View page";
$header="User Details View";
$headerDes="User View";
include '../include/_audiLog.php'; 
include '../include/_licCheck.php'; 

$Tabledata = sqlsrv_fetch_array(sqlsrv_query($conn,"select * from loginUser where userCode ='$userCode'"),
SQLSRV_FETCH_ASSOC);




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

                    <h6 class="mb-0 text-uppercase">User Details View</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <form action="admin/process/userProcess.php" method="post" class="row g-3">
                    <div class="row row-2">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name </label>
                        <label class="form-control"><?php echo $Tabledata['name']; ?></label>
                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">Email Id</label>
                        <label class="form-control"><?php echo $Tabledata['mailId']; ?></label>
                      </div>
                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14">
                        <label class="form-label">Mobile Number </label>
                        <label class="form-control"><?php echo $Tabledata['mobileNO'];?></label>

                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">User Role </label>

                        <label class="form-control"><?php echo $Tabledata['userRole']; ?></label>

                      </div>

                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">User Satus</label>
                        <label for="" class="form-control"><?php echo $Tabledata['userStatus']; ?></label>

                      </div>

                    </div>

                    <!-- <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="userAdd">
                          <i class="bi bi-plus-lg"></i>
                          Add User
                        </button>
                      </div>
                    </div> -->
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
<script>

</script>