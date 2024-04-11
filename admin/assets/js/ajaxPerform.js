function dataSet(processName, dataSet) {
  var formData = new FormData();
  switch (processName) {
    case "branchEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "branchView":
      formData.append(processName + "Code", dataSet);
      break;
    case "branchDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "deptEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "deptView":
      formData.append(processName + "Code", dataSet);
      break;
    case "deptDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdeptEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdeptView":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdeptDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "desigEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "desigView":
      formData.append(processName + "Code", dataSet);
      break;
    case "desigDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdesigEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdesigView":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdesigDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "divisionEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "divisionView":
      formData.append(processName + "Code", dataSet);
      break;
    case "divisionDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdivEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdivView":
      formData.append(processName + "Code", dataSet);
      break;
    case "subdivDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "empcatEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "empcatView":
      formData.append(processName + "Code", dataSet);
      break;
    case "empcatDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "empsubcatEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "empsubcatView":
      formData.append(processName + "Code", dataSet);
      break;
    case "empsubcatDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "emptypeEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "emptypeView":
      formData.append(processName + "Code", dataSet);
      break;
    case "emptypeDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "gradeEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "gradeView":
      formData.append(processName + "Code", dataSet);
      break;
    case "gradeDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "locaEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "locaView":
      formData.append(processName + "Code", dataSet);
      break;
    case "locaDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "teamEdit":
      formData.append(processName + "Code", dataSet);
      break;
    case "teamView":
      formData.append(processName + "Code", dataSet);
      break;
    case "teamDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "shiftEdit":
      formData.append(processName + "Code", dataSet);
      // console.log(dataSet);
      break;
    case "shiftView":
      formData.append(processName + "Code", dataSet);
      break;
    case "shiftDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "empEdit":
      formData.append(processName + "Code", dataSet);
      // console.log(dataSet);
      break;
    case "empView":
      formData.append(processName + "Code", dataSet);
      break;
    case "empDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "userEdit":
      formData.append(processName + "Code", dataSet);
      // console.log(dataSet);
      break;
    case "userView":
      formData.append(processName + "Code", dataSet);
      break;
    case "userDel":
      formData.append(processName + "Code", dataSet);
      break;
    case "userReset":
      formData.append(processName + "Code", dataSet);
      break;
  }
  return formData;
}

$("#searchInput").keyup(function () {
  var searchText = $(this).val().toLowerCase();

  $("#dataTable tbody tr").each(function () {
    var rowData = $(this).text().toLowerCase();
    if (rowData.indexOf(searchText) === -1) {
      $(this).hide();
    } else {
      $(this).show();
    }
  });
});

$(".comTable").on("click", ".editBtn", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val();

  var formData = new FormData();
  var fileInput = document.getElementById("fileInput");
  formData.append("regNo", RegNo);
  formData.append("code", Code);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formConteent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);

      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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

//view comapny details
$(".comTable").on("click", ".viewBtn", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val();

  var formData = new FormData();
  var fileInput = document.getElementById("fileInput");
  formData.append("regNo", RegNo);
  formData.append("RegCode", Code);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formConteent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);

      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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

//delete comapny details
$(".comTable").on("click", ".deltBtn", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val();

  var formData = new FormData();
  var fileInput = document.getElementById("fileInput");
  formData.append("regNo", RegNo);
  // formData.append("RegCode", Code);
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
        url: "admin/process/masterSetupProcess.php", // Update the URL to your server-side script
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          window.location.href = response.redirectUrl;
          Swal.fire({
            title: response.alertTitle,
            icon: response.alertIcon,
            confirmButtonText: "OK",
          }).then((result) => {
            window.location.href = response.redirectUrl;
          });
        },

        error: function (error) {
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

// totally dynmic {

// edit section
$(".comTable").on("click", ".btnEdit", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "Edit";

  let sendFormData = dataSet(Code, RegNo);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: sendFormData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formConteent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);
      // console.log(response)
      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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

// view section
$(".comTable").on("click", ".btnView", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "View";

  let sendFormData = dataSet(Code, RegNo);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: sendFormData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formConteent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);
      // console.log(response)
      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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
// delete section
$(".comTable").on("click", ".btnDelt", function () {
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
        success: function (response) {
          var jsonResponse = JSON.parse(response);
          $("#comFrom").html(jsonResponse.formConteent);
          $("#pageHeaderSec").html(jsonResponse.pageHeaderSec);
          $("#reloadTable").html(jsonResponse.tableConteent);
          Swal.fire({
            title: jsonResponse.alertTitle,
            icon: jsonResponse.alertIcon,
            confirmButtonText: "OK",
          }).then((result) => {
            window.location.href = jsonResponse.redirectUrl;
          });
        },
        error: function (error) {
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

// total dynamic end }

// import employee

$("#fileInput25").on("change", function () {
  var formData = new FormData();
  var fileInput = document.getElementById("fileInput25");
  formData.append("excelFile", fileInput.files[0]);

  console.log(formData);
  $.ajax({
    url: "admin/process/employeeProcess.php", // Update the URL to your server-side script
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      Swal.fire({
        title: jsonResponse.alertTitle,
        icon: jsonResponse.alertIcon,
        confirmButtonText: "OK",
      }).then((result) => {
        window.location.href = jsonResponse.redirectUrl;
      });
    },
    error: function (error) {
      console.log("Error:", error);
    },
  });
});

$(".comTable").on("click", ".ubtnEdit", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "Edit";

  let sendFormData = dataSet(Code, RegNo);
  // console.log(RegNo);
  // console.log(Code);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: sendFormData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formContent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSection);
      // console.log(response)
      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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

$(".comTable").on("click", ".ubtnView", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "View";

  let sendFormData = dataSet(Code, RegNo);
  console.log(RegNo);
  console.log(Code);
  $.ajax({
    url: "admin/process/ajax.php", // Update the URL to your server-side script
    type: "POST",
    data: sendFormData,
    contentType: false,
    processData: false,
    success: function (response) {
      var jsonResponse = JSON.parse(response);
      $("#comFrom").html(jsonResponse.formContent);
      $("#pageHeaderSec").html(jsonResponse.pageHeaderSection);
      // console.log(response)
      // $('#process_btn').html(jsonResponse.formContent);
    },
    error: function (error) {
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

// delete section
$(".comTable").on("click", ".ubtnDelt", function () {
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
        success: function (response) {
          var jsonResponse = JSON.parse(response);
          Swal.fire({
            title: jsonResponse.alertTitle,
            icon: jsonResponse.alertIcon,
            confirmButtonText: "OK",
          }).then((result) => {
            window.location.href = jsonResponse.redirectUrl;
          });
        },
        error: function (error) {
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

// reset Password section
$(".comTable").on("click", ".ubtnReset", function () {
  // Find the closest row to the clicked edit button
  let row = $(this).closest("tr");

  // Find the values within the row
  let RegNo = row.find("td:eq(1)").text(); // Second td in the row (index 1)
  let Code = row.find("input").val() + "Reset";

  let sendFormData = dataSet(Code, RegNo);
  Swal.fire({
    title: "Are you sure?",
    text: "You are about reset password.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, Reset it!",
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "admin/process/ajax.php", // Update the URL to your server-side script
        type: "POST",
        data: sendFormData,
        contentType: false,
        processData: false,
        success: function (response) {
          var jsonResponse = JSON.parse(response);
          Swal.fire({
            title: jsonResponse.alertTitle,
            icon: jsonResponse.alertIcon,
            confirmButtonText: "OK",
          }).then((result) => {
            window.location.href = jsonResponse.redirectUrl;
          });
        },
        error: function (error) {
          console.log("Error:", error);
          Swal.fire({
            title: "400R",
            text: "Contact to your Developer..",
            icon: "error",
            confirmButtonText: "OK",
          });
        },
      });
    }
  });
});

// dashbord attendance ajax
$("#attendanceFilter").change(function () {
  let processDate = $(this).val();
  var resetData = new FormData();
  resetData.append("processDate", processDate);
  // console.log(resetData);
  $.ajax({
    url: "admin/process/attendanceCalculation.php", // Update the URL to your server-side script
    type: "POST",
    data: resetData,
    contentType: false,
    processData: false,
    success: function (response) {
      var reponseProcess = JSON.parse(response);
      console.log(reponseProcess.present);
      $("#attendanceDate").text(reponseProcess.processDate);
      $("#attenDshP").text(reponseProcess.present);
      $("#attenDshHd").text(reponseProcess.halfDay);
      $("#attenDshL").text(reponseProcess.leave);
      $("#attenDshWo").text(reponseProcess.weekoff);
    },
  });
});
