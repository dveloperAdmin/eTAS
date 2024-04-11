  <!-- Bootstrap bundle JS -->
  <script src="admin/assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="admin/assets/js/jquery.min.js"></script>
  <script src="admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="admin/assets/js/pace.min.js"></script>
  <!-- <script src="admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script> -->
  <script src="admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
  <!--app-->
  <script src="admin/assets/js/app.js"></script>
  <script src="admin/assets/js/index.js"></script>
  <!-- <script src="assets/js/clock.js"></script> -->
  <script src="admin/assets/js/clock_ad.js"></script>
  <!-- <script src="admin/assets/js/ajaxPerforms.js"></script> -->

  <script>
new PerfectScrollbar(".best-product")
new PerfectScrollbar(".top-sellers-list")

function dashLoad() {
  window.location.href = "dashbord";
}
  </script>


  <?php
   
    if(isset($_SESSION['status_ad']) && $_SESSION['status_ad']!=''){ ?>
  <script>
Swal.fire({
  icon: '<?php echo $_SESSION['icon_ad'] ?>',
  title: '<?php echo $_SESSION['status_ad'] ?>',
  showCloseButton: true,
  confirmButton: true,

})
  </script>
  <?php
unset($_SESSION['status_ad']);
unset($_SESSION['icon_ad']);
// session_destroy();
}?>
  <script>
document.addEventListener("DOMContentLoaded", function() {
  // Attach the click event listener to a parent element
  document.addEventListener('click', function(event) {
    // Check if the clicked element has the class 'info-icon'
    if (event.target.classList.contains('info-icon')) {
      var infoBox = event.target.closest('.info-box'); // Find the closest '.info-box' parent
      var infoContent = infoBox.querySelector('.info-content');

      // Toggle info content visibility
      infoContent.style.display = infoContent.style.display === 'block' ? 'none' : 'block';
    } else {
      // Hide info content when user clicks outside the box
      var infoBoxes = document.querySelectorAll('.info-box');
      infoBoxes.forEach(function(infoBox) {
        var infoContent = infoBox.querySelector('.info-content');
        if (infoContent !== null) {
          infoContent.style.display = 'none';
        }
      });
    }
  });
});
  </script>

  <script src="admin/assets/js/ajaxPerform.js"></script>

  <script>
  </script>