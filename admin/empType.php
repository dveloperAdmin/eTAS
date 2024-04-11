<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load Emp. Type-ui page";
$rem="Emp. Type details page";
$header="Emp. Type Details";
$headerDes="Emp. Type Entry";
include '../include/_audiLog.php';
include '../include/_licCheck.php';  

$Tabledata = sqlsrv_query($conn,"select * from empTypeDetails");





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
                  <h6 class="mb-0 text-uppercase">New Emp. Type</h6>
                  <hr />
                  <form action="admin/process/masterSetupProcess.php" method="post" class="row g-3">

                    <div class="col-12">
                      <label class="form-label">Emp. Type Name</label>
                      <input type="text" class="form-control" placeholder="Enter the Emp. Type name" name="emptypeName"
                        required autofocus />
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-success" name="emptypeAdd">
                          <i class="bi bi-plus-lg"></i>
                          Add Emp. Type
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
                  <h5 class="mb-0">Emp. Type Details</h5>
                  <form action="Department-Ui" method="" enctype="multipart/form-data"
                    class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                      <i class="bi bi-search"></i>
                    </div>
                    <input class="form-control ps-5" type="text" placeholder="search" id="searchInput" />
                  </form>
                </div>
                <div class="table-responsive mt-3 mst-2" id="reloadTable">
                  <table class="table align-middle comTable" id="dataTable">
                    <thead class="table-secondary table-header">
                      <tr>
                        <th>Count</th>
                        <th>Emp. Type Code</th>
                        <th>Emp. Type Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 0; while($tableDataFetch = sqlsrv_fetch_array($Tabledata , SQLSRV_FETCH_ASSOC)){ ?>
                      <tr>
                        <td><?php echo ++$i;?></td>
                        <td><?php echo $tableDataFetch['empTypeCode'];?></td>
                        <td><?php echo $tableDataFetch['empType'];?></td>
                        <input type="hidden" value="emptype">
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