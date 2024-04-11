<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
include '../include/_function.php';
$des="load Employee List-ui page";
$rem="Employee List details page";
$header="Employee Details";
$headerDes="Employee List";
include '../include/_audiLog.php'; 
// include '../include/_licCheck.php'; 
$initial=100;
$initial_limit = 500; // Initial number of records to fetch
$initial_offset = 0; // Initial offset

// Fetch initial set of employee details
$empTabledata = sqlsrv_query($conn, "SELECT * FROM (
    SELECT *, ROW_NUMBER() OVER(ORDER BY (SELECT NULL)) AS row_num
    FROM employeeDetails where empCode != 'Emp00lst'
) AS emp
WHERE row_num > $initial_offset AND row_num <= ($initial_offset + $initial)");


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

      <div class="card" id="empLoader">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <h5 class="mb-0">Employee Details</h5>
            <form action="Employee List-Ui" method="" enctype="multipart/form-data" class="ms-auto position-relative"
              style="margin-right: 1rem;">
              <div class="position-absolute top-50 translate-middle-y search-icon px-3">
                <i class="bi bi-search"></i>
              </div>
              <input class="form-control ps-5" type="text" placeholder="search" id="searchInput" />
            </form>
            <div class="d-flex" style="justify-content: flex-end;">
              <a href="admin/exportEmp"><button type="submit" class="btn btn-primary" name="empEdit"
                  style="margin-right:.5rem">
                  <i class="bi bi-save"></i>
                  Export Employee Details
                </button>
              </a>
            </div>
          </div>
          <div class="table-responsive mt-3 " style="height: 26rem; overflow-y: auto;" id="tableContaier">
            <table class="table align-middle comTable" id="dataTable">
              <thead class="table-secondary table-header">
                <tr>
                  <th>Count</th>
                  <th>Emp.Code</th>
                  <th>Emp. Name</th>
                  <th>Comapny</th>
                  <th>Department</th>
                  <th>Category</th>
                  <th>Emp. Type</th>
                  <th>Location</th>
                  <th>Emp. Satus</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 0; while($tableDataFetch = sqlsrv_fetch_array($empTabledata , SQLSRV_FETCH_ASSOC)){ ?>
                <tr>
                  <td><?php echo ++$i;?></td>
                  <td><?php echo $tableDataFetch['empCode'];?></td>
                  <td><?php echo $tableDataFetch['empName'];?></td>
                  <td><?php echo company_find($tableDataFetch['companyCode'],$conn);?></td>
                  <td><?php echo dept_find($tableDataFetch['departmentCode'],$conn);?></td>
                  <td><?php echo empCat_find($tableDataFetch['empCategoryCode'],$conn);?></td>
                  <td><?php echo empType_find($tableDataFetch['empTypeCode'],$conn);?></td>
                  <td><?php echo empLoc_find($tableDataFetch['locationCode'],$conn);?></td>
                  <td><?php echo $tableDataFetch['status'];?></td>
                  <input type="hidden" name="" value="emp">
                  <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                      <a href="javascript:;" class="text-primary empviewBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                      <?php if($user_role != 'User'){?>
                      <a href="javascript:;" class="text-warning empeditBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Edit "><i class="bi bi-pencil-fill"></i></a>
                      <a href="javascript:;" class="text-danger empdeltBtn" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                      <?php }?>
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
$(document).ready(function() {
  var offset = <?php echo $initial; ?>;
  var limit = <?php echo $initial_limit; ?>; // Number of records to fetch at a time
  let i = offset;
  console.log(i);

  // Function to fetch employee details
  function fetchEmployeeDetails() {
    $.ajax({
      url: 'admin/process/ajax.php',
      type: 'GET',
      dataType: 'json',
      data: {
        offset: offset,
        limit: limit
      },
      success: function(response) {
        // Append fetched employee details to the existing list
        $.each(response, function(index, employee) {
          $('#dataTable tbody').append(`
            <tr>
              <td>${i++}</td>
              <td>${employee.empCode}</td>
              <td>${employee.empName}</td>
              <td>${employee.comName}</td>
              <td>${employee.deptName}</td>
              <td>${employee.empCat}</td>
              <td>${employee.empType}</td>
              <td>${employee.location}</td>
              <td>${employee.status}</td>
              <input type="hidden" name="" value="emp">
              <td>
                <div class="table-actions d-flex align-items-center gap-3 fs-6">
                  <a href="javascript:;" class="text-primary empviewBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Views"><i class="bi bi-eye-fill"></i></a>
                  <?php if($user_role != 'User'){?>
                  <a href="javascript:;" class="text-warning empeditBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit "><i class="bi bi-pencil-fill"></i></a>
                  <a href="javascript:;" class="text-danger empdeltBtn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                  <?php }?>
                </div>
              </td>
            </tr>
          `);
        });

        // Update offset for the next request
        offset += limit;
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }

  // Attach scroll event handler to the table container
  $('#tableContaier').on('scroll', function() {
    var tableBody = $(this)[0];
    var tableBottom = tableBody.scrollHeight - tableBody.clientHeight;
    console.log(tableBottom);

    // If the user has scrolled to the bottom of the table body or is very close to it
    if (tableBody.scrollTop >= tableBottom - 1) {
      fetchEmployeeDetails(); // Fetch more employee details
    }
  });

  // Initial fetch when the page loads
  // fetchEmployeeDetails();

  // Rest of your JavaScript code...
});










$(document).ready(function() {


  $(".comTable").on("click", ".empviewBtn", function() {
    // Find the closest row to the clicked edit button
    let row = $(this).closest("tr");

    // Find the values within the row
    let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
    let Code = row.find("input").val() + "View";

    let sendFormData = dataSet(Code, RegNo);
    console.log(sendFormData);
    $.ajax({
      url: "admin/process/ajax.php", // Update the URL to your server-side script
      type: "POST",
      data: sendFormData,
      contentType: false,
      processData: false,
      success: function(response) {
        var jsonResponse = JSON.parse(response);
        $("#empLoader").html(jsonResponse.formConteent);
        $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);
        $(".tooltip").css("display", "none");
        // console.log(response)
        // $('#process_btn').html(jsonResponse.formContent);
      },
      error: function(error) {
        console.log("Error:", error);
        Swal.fire({
          title: "400V",
          text: "Contact to your Developer..",
          icon: "error",
          confirmButtonText: "OK",
        });
      },
    });
  });
});
$(".comTable").on("click", ".empeditBtn", function() {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "Edit";

  let sendFormData = dataSet(Code, RegNo);
  console.log(sendFormData);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: sendFormData,
    contentType: false,
    processData: false,
    success: function(response) {
      var jsonResponse = JSON.parse(response);
      $("#empLoader").html(jsonResponse.formConteent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);
      $(".tooltip").css("display", "none");
      // console.log(response)
      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function(error) {
      console.log("Error:", error);
      Swal.fire({
        title: "400E",
        text: "Contact to your Developer..",
        icon: "error",
        confirmButtonText: "OK",
      });
    },
  });
});

// delete employee
$(".comTable").on("click", ".empdeltBtn", function() {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "Del";

  let sendFormData = dataSet(Code, RegNo);
  Swal.fire({
    title: "Are you sure?",
    text: "You are about to delete this data.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "admin/process/ajax.php", // Update the URL to your server-side script
        type: "POST",
        data: sendFormData,
        contentType: false,
        processData: false,
        success: function(response) {
          var jsonResponse = JSON.parse(response);
          Swal.fire({
            title: jsonResponse.alertTitle,
            icon: jsonResponse.alertIcon,
            confirmButtonText: "OK",
          }).then((result) => {
            window.location.href = jsonResponse.redirectUrl;
          });
        },
        error: function(error) {
          console.log("Error:", error);
          Swal.fire({
            title: "400D",
            text: "Contact to your Developer..",
            icon: "error",
            confirmButtonText: "OK",
          });
        },
      });
    }
  });
});
</script>