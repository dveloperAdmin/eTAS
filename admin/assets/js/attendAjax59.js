var isSidebarFrozen = false; // Flag to track sidebar freeze state
var intervalId;
// Function to freeze the sidebar
function freezeSidebar() {
  var sidebar = $(".sidebar-wrapper");
  if (!isSidebarFrozen) {
    sidebar.css("pointer-events", "none"); // Disable pointer events on sidebar
    isSidebarFrozen = true; // Set sidebar freeze state
  }
}

// Function to defrost the sidebar
function defrostSidebar() {
  var sidebar = $(".sidebar-wrapper");
  sidebar.css("pointer-events", "auto"); // Enable pointer events on sidebar
  isSidebarFrozen = false; // Reset sidebar freeze state
}

window.addEventListener("beforeunload", function (event) {
  if (isSidebarFrozen) {
    event.returnValue = "Are you sure you want to leave?"; // Custom confirmation message for older browsers
  }
});
window.addEventListener("beforeunload", function (event) {
  if (isSidebarFrozen) {
    confirm("Are you sure you want to leave?"); // Custom confirmation message for older browsers
  }
});

window.addEventListener("unload", function () {
  // Call your function here
  resetProcessStatus();
});

function resetProcessStatus() {
  let processMonth = $("#process-month").val();
  var resetData = new FormData();
  resetData.append("processMonth", processMonth);
  console.log(resetData);
  $.ajax({
    url: "admin/process/attendanceProcess.php", // Update the URL to your server-side script
    type: "POST",
    data: resetData,
    contentType: false,
    processData: false,
    success: function (response) {},
  });
}

function timingAttend() {
  let processMonth = $("#process-month").val();
  var resetData = new FormData();
  resetData.append("processMonth", processMonth);
  console.log(resetData);
  $.ajax({
    url: "admin/process/attendanceCalculation.php", // Update the URL to your server-side script
    type: "POST",
    data: resetData,
    contentType: false,
    processData: false,
    success: function (response) {
      var reponseProcess = response;
      console.log(response);
      switch (reponseProcess) {
        case "sucessCalculation":
          console.log("yes");
          defrostSidebar();
          Swal.fire({
            icon: "success",
            title: "Successfully Processed Attendent ",
            showCloseButton: true,
            confirmButton: true,
          }).then((result) => {
            clearInterval(intervalId); // Stop the interval
            window.location.href = "import-Attendance-Ui";
          });

          break;
        case "processCorupt":
          console.log("no");
          defrostSidebar();
          Swal.fire({
            icon: "error",
            title: "Set the Shift and Import proper file format ",
            showCloseButton: true,
            confirmButton: true,
          }).then((result) => {
            clearInterval(intervalId); // Stop the interval
            window.location.href = "import-Attendance-Ui";
          });
          break;
        case "shiftProblem":
          defrostSidebar();
          Swal.fire({
            icon: "error",
            title: "Please set a active Shift",
            showCloseButton: true,
            confirmButton: true,
          }).then((result) => {
            clearInterval(intervalId); // Stop the interval
            window.location.href = "import-Attendance-Ui";
          });
          break;
      }
    },
  });
  // window.location.href = "rendom.php";
}
//progress reportg generate in parsentage
function progressDisplay() {
  let processMonth = $("#processTiming").val();
  var resetData = new FormData();
  resetData.append("progreeMonth", processMonth);
  // console.log(resetData);
  $.ajax({
    url: "admin/process/attendanceProcess.php", // Update the URL to your server-side script
    type: "POST",
    data: resetData,
    contentType: false,
    processData: false,
    success: function (response) {
      // console.log(response);
      $("#displayProgress").css("width", response);
      $("#displayProgress").text(response);
    },
  });
}

//this html show progress bar
function progressBar(processMonth) {
  let htmlCode =
    `
      <div class="row">
        <div class="col-xl-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <div class="border p-3 rounded">
                <div style="display:flex;justify-content: space-between;">
                  <h6 class="mb-0 text-uppercase">Process Progress</h6>
                  

                </div>
                <hr />
                <div class="row g-3">
                  <div class="row row-2" style="padding-top:1rem; justify-content: space-between;">
                    <div class="col-15 col-14" style=" max-width: 67%;">
                      <div class="progress">
                      <div class="form-control" id ="displayProgress" style="text-align:center"></div>
                      </div>
                      <input type="hidden" value="` +
    processMonth +
    `" id="processTiming"/>
                    </div>
                    <div class="col-15 col-14" style=" max-width: 20%;">
                     
                      <a href="import-Attendance-Ui"<button type="submit" class="btn btn-primary" name="processAttend"
                        style="margin-right:.5rem" id = "processInFrozen">
                        <i class="icofont icofont-exit"></i>
                      Exit
                      </button></a>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 mx-auto"></div>
      </div>
    `;

  return htmlCode;
}

function processStart() {
  defrostSidebar();
  let processMonth = $("#process-month").val();
  var resetData = new FormData();
  resetData.append("checkTimeTable", processMonth);
  console.log(resetData);
  $.ajax({
    url: "admin/process/attendanceProcess.php", // Update the URL to your server-side script
    type: "POST",
    data: resetData,
    contentType: false,
    processData: false,
    success: function (response) {
      var ajaxReponse = response;
      if (ajaxReponse == "success") {
        timingAttend();
        $("#tableContainer").html(progressBar(processMonth));
        freezeSidebar();
        intervalId = setInterval(progressDisplay, 3000);
      } else {
        resetProcessStatus();
        Swal.fire({
          icon: "warning",
          title: "Please Check System Shift Details..",
          showCloseButton: true,
          confirmButton: true,
        }).then((result) => {
          // window.location.href = "import-Attendance-Ui";
        });
      }
    },
  });
}

$("#attendsFileInput").on("change", function () {
  freezeSidebar();
  var month = $("#bday-month").val();
  if (month != "") {
    console.log(month);
    $("#textInput").attr("for", "fileInput");

    var formData = new FormData();
    var fileInput = document.getElementById("attendsFileInput");
    formData.append("excelFile", fileInput.files[0]);
    formData.append("month", month);

    $.ajax({
      url: "admin/process/attendanceProcess.php", // Update the URL to your server-side script
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        var jsonResponse = JSON.parse(response);
        if (jsonResponse.checkMsg == "yes") {
          $("#tableContainer").html(jsonResponse.tableContent);
          Swal.fire({
            icon: jsonResponse.icon,
            title: jsonResponse.status,
            showCloseButton: true,
            confirmButton: true,
          });
        } else {
          defrostSidebar();
          Swal.fire({
            icon: jsonResponse.icon,
            title: jsonResponse.status,
            showCloseButton: true,
            confirmButton: true,
          }).then((result) => {
            window.location.href = "import-Attendance-Ui";
          });
        }
      },
      error: function (error) {
        console.log("Error:", error);
      },
    });
  }
});
