<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load User-ui page";
$rem="User details page";
$header="User Details";
$headerDes="User Entry";
include '../include/_audiLog.php'; 
include '../include/_licCheck.php'; 

$Tabledata = sqlsrv_query($conn,"select * from loginUser where userRole !='Developer'");
$userRole = array("Developer", "Admin","User");




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

                    <h6 class="mb-0 text-uppercase">New User</h6>
                    <!-- <h8 class="mb-0 text-uppercase" style="font-style:italic;">Time Formate In 24 hours</h8> -->
                  </div>
                  <hr />
                  <form action="admin/process/userProcess.php" method="post" class="row g-3">
                    <div class="row row-2">
                      <div class="col-15 col-14">
                        <label class="form-label">User Name <span style="color:red; font-size:1.1rem;">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter the User Name" name="UserName"
                          value="" required autofocus />
                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">Email Id <span style="color:red; font-size:1.1rem;">*</span></label>
                        <input type="gmail" class="form-control" placeholder="Enter the Email" name="userGmail" value=""
                          required />
                      </div>
                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14">
                        <label class="form-label">Mobile Number <span
                            style="color:red; font-size:1.1rem;">*</span></label>
                        <input type="number" class="form-control" name="userMobile" id="login_mob" autocomplete="off"
                          placeholder="Enter mobile nunmber"
                          oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                          pattern="\d{10}" maxlength="10" required>


                      </div>
                      <div class="col-15 col-14">
                        <label class="form-label">User Role <span style="color:red; font-size:1.1rem;">*</span></label>

                        <select name="userRole" id="" class="form-control" required>
                          <option style="color: #ced4da;" selected disabled hidden>User Role</option>
                          <?php if($user_role ==='Developer'){
                                    $p = 0;
                                    }else{
                                    $p = 1;
                                    }
                          for($i = $p;$i<count($userRole);$i++){ ?>
                          <option value="<?php echo $userRole[$i];?>"><?php echo $userRole[$i];?></option>

                          <?php   } ?>
                        </select>

                      </div>

                    </div>
                    <div class="row row-2">
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">Password (By Default)</label>
                        <label for="" class="form-control"><?php echo "eTAS".date("Y");?></label>

                      </div>
                      <div class="col-15 col-14 info-box">
                        <label class="form-label">User Satus (By Default)</label>
                        <label for="" class="form-control">Active</label>

                      </div>

                    </div>

                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="userAdd">
                          <i class="bi bi-plus-lg"></i>
                          Add User
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
                  <h5 class="mb-0">User Details</h5>
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
                      <tr>
                        <th>Count</th>
                        <th>Name</th>
                        <th>User Role</th>
                        <th>Status</th>
                        <th style="text-align:center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 0; while($tableDataFetch = sqlsrv_fetch_array($Tabledata , SQLSRV_FETCH_ASSOC)){ 
                       
                        ?>
                      <tr>
                        <td><?php echo ++$i;?></td>
                        <td style="display:none;"><?php echo $tableDataFetch['userCode'];?></td>
                        <td><?php echo $tableDataFetch['name'];?></td>
                        <td><?php echo $tableDataFetch['userRole'];?></td>
                        <td><?php echo $tableDataFetch['userStatus'];?></td>
                        <input type="hidden" value="user">
                        <td style="text-align:center">
                          <div class="table-actions d-flex align-items-center gap-3 fs-6"
                            style="    justify-content: center;">
                            <a href="javascript:;" class="text-primary ubtnView" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>

                            <?php if($user_id!= $tableDataFetch['userCode']){?>

                            <a href="javascript:;" class="text-warning ubtnEdit" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                            <?php if($user_role!=$tableDataFetch['userRole']){?>
                            <a href="javascript:;" class="text-danger ubtnDelt" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>

                            <?php } ?>
                            <a href="javascript:;" class="text-success ubtnReset" data-bs-toggle="tooltip"
                              data-bs-placement="bottom" title="Reset-Password"><i
                                class="icofont icofont-finger-print"></i></a>
                            <?php } ?>
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