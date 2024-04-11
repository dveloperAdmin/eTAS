<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load password Change-ui page";
$rem="password Change details page";
$header="Password Details";
$headerDes="Password Change";
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
          <div class="col-xl-6 mx-auto">
            <div class="card">
              <div class="card-body" id="comFrom">
                <div class="border p-3 rounded">
                  <div style="display:flex;justify-content: space-between;">
                    <h6 class="mb-0 text-uppercase">Chnage Password</h6>
                    <h8 class="mb-0 text-uppercase" style="font-style:italic;"> <?php echo $user_name;?></h8>
                  </div>
                  <hr />
                  <form action="admin/process/userProcess.php" method="post" class="row g-3">
                    <!-- <div class="row"> -->
                    <div class="col-12 col-14">
                      <label class="form-label">New Password <span style="color:red; font-size:1.1rem;">*</span></label>
                      <div class="input-group">
                        <input type="password" class="form-control" id="password" placeholder="Enter password"
                          name="password" required>
                        <button tabindex="-1" class="btn btn-outline-secondary" type="button" id="showPasswordBtn"><i
                            class="bi bi-eye"></i></button>
                      </div>
                    </div>
                    <input type="hidden" name="userCode" value="<?php echo $user_id;?>">
                    <div class="col-12 col-14">
                      <label class="form-label">Confirm Password <span
                          style="color:red; font-size:1.1rem;">*</span></label>
                      <div class="input-group" style="align-items: flex-end;">
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password"
                          name="confirmPassword" style="height: 2.35rem;" required>
                        <span id="showConfirme"
                          style="color: #09de09;font-size: 1.8rem; padding-left: 1rem;display: none;"><i
                            class="icofont icofont-tick-mark"></i></span>
                      </div>
                    </div>
                    <label class="form-label" id="errorMassage"
                      style="margin: 0;color:red;font-style: italic;display:none">* Password mismach </label>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="chngPass">
                          <i class="icofont icofont-edit"></i>
                          Change Password
                        </button>
                      </div>
                    </div>
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

<?php
if(isset($_SESSION['chamgePAss_status']) && $_SESSION['chamgePAss_status']!=''){ 
        echo "<script>
        Swal.fire({
          icon: '".$_SESSION['chamgePAss_icon']."',
          title: '". $_SESSION['chamgePAss_status']."',
          showCloseButton: true,
          confirmButton: true,
          }).then((result) => {
            window.location.href ='include/_logout.php';
          });
          </script>";

}?>
<!-- footer segment  -->
<?php include 'include/_footer_.php';?>

</html>
<script>
$("#showPasswordBtn").hover(function() {
  var passwordInput = document.getElementById("password");
  var showPasswordBtn = document.getElementById("showPasswordBtn");
  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    showPasswordBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
  } else {
    passwordInput.type = "password";
    showPasswordBtn.innerHTML = '<i class="bi bi-eye"></i>';
  }
})

$("#password").keyup(function() {
  let pass = $("#password").val();
  let confPass = $("#confirmPassword").val();
  if (confPass != "") {
    if (pass.length >= confPass.length) {
      if (pass != confPass) {
        $("#errorMassage").css("display", "block");
        $("#showConfirme").css("display", "none");
      } else {
        $("#errorMassage").css("display", "none");
        $("#showConfirme").css("display", "block");
      }
    }
  }
})
$("#confirmPassword").keyup(function() {
  let pass = $("#password").val();
  let confPass = $("#confirmPassword").val();
  if (confPass != "") {
    $("#errorMassage").css("display", "none");
    $("#showConfirme").css("display", "none");
  }
  if (pass != "") {
    if (confPass.length >= pass.length) {
      if (pass != confPass) {
        $("#errorMassage").css("display", "block");
        $("#showConfirme").css("display", "none");
      } else {
        $("#errorMassage").css("display", "none");
        $("#showConfirme").css("display", "block");
      }
    }

  }
})

// function validatePassword() {
//   var password = document.getElementById("password").value;
//   var confirmPassword = document.getElementById("confirmPassword").value;
//   var confirmPasswordField = document.getElementById("confirmPassword");

//   if (password != confirmPassword) {
//     confirmPasswordField.setCustomValidity("Passwords do not match!");
//   } else {
//     confirmPasswordField.setCustomValidity('');
//   }
// }
</script>