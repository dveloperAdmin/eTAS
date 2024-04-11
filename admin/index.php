<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load index page";
$rem="on dashbord page";

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
        include 'include/_sideBar.php'
    ?>
    <main class="page-content">
      <?php 
      // <!-- employee Dash Bord -->
      include 'include/_employeeDashbord.php';
      // <!-- Attendance Dash Bord -->
      include 'include/_attendanceDashbord.php';
      // <!-- User Dash Bord -->
      if($user_role != 'User'){
      include 'include/_userDashbord.php';
      }
      
      ?>

    </main>




    <!-- mode segment  -->

  </div>

</body>

<!-- footer segment  -->
<?php include 'include/_footer_.php';?>

<!-- <script>
$(document).ready(function() {

  var htmlCode = `
              <div class="profile-greeting">
                <div class="confetti">
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>
                  <div class="confetti-piece"></div>

                </div>
              </div>
                `;
  $('.addAnimation').append(htmlCode);

  // Add event listener for mouseenter on each .confetti-container
  $('.col-dash').mouseenter(function() {
    $(this).find('.confetti-piece').addClass('hiddenAnimation'); // Stop the animation on hover
  });

  // Add event listener for mouseleave on each .confetti-container
  $('.col-dash').mouseleave(function() {
    $(this).find('.confetti-piece').removeClass('hiddenAnimation'); // Resume the animation on mouse leave
  });
});
</script> -->

</html>