<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load branch-ui page";
$rem="About License page";
$header="License Details ";
$headerDes="About License";
include '../include/_audiLog.php'; 







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
        <div class="card-body" id="comFrom">
          <div class="border p-3 rounded">
            <h6 class="mb-0 text-uppercase">License</h6>
            <hr />
            <form action="admin/process/extend-lic-process.php" method="post" class="digit_group">
              <label>Emp. Sub-Category Name</label>
              <div
                style="display:flex; flex-wrap: wrap; justify-content: space-between; align-items: end; align-content: center; padding:.5rem; padding-left:0;">

                <div>
                  <input class="style-key-input" type="text" id="digit-1" name="digit-1" data-next="digit-2" required />
                  <input class="style-key-input" type="text" id="digit-2" name="digit-2" data-next="digit-3"
                    data-previous="digit-1" required />
                  <input class="style-key-input" type="text" id="digit-3" name="digit-3" data-next="digit-4"
                    data-previous="digit-2" required />
                  <input class="style-key-input" type="text" id="digit-4" name="digit-4" data-next="digit-5"
                    data-previous="digit-3" required />
                  <span class="splitter">&ndash;</span>

                  <input class="style-key-input" type="text" id="digit-5" name="digit-5" data-next="digit-6"
                    data-previous="digit-4" required />
                  <input class="style-key-input" type="text" id="digit-6" name="digit-6" data-next="digit-7"
                    data-previous="digit-5" required />
                  <input class="style-key-input" type="text" id="digit-7" name="digit-7" data-next="digit-8"
                    data-previous="digit-6" required />
                  <input class="style-key-input" type="text" id="digit-8" name="digit-8" data-next="digit-9"
                    data-previous="digit-7" required />
                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-9" name="digit-9" data-next="digit-10"
                    data-previous="digit-8" required />
                  <input class="style-key-input" type="text" id="digit-10" name="digit-10" data-next="digit-11"
                    data-previous="digit-9" required />
                  <input class="style-key-input" type="text" id="digit-11" name="digit-11" data-next="digit-12"
                    data-previous="digit-10" required />
                  <input class="style-key-input" type="text" id="digit-12" name="digit-12" data-next="digit-13"
                    data-previous="digit-11" required />

                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-13" name="digit-13" data-next="digit-14"
                    data-previous="digit-12" required />
                  <input class="style-key-input" type="text" id="digit-14" name="digit-14" data-next="digit-15"
                    data-previous="digit-13" required />
                  <input class="style-key-input" type="text" id="digit-15" name="digit-15" data-next="digit-16"
                    data-previous="digit-14" required />
                  <input class="style-key-input" type="text" id="digit-16" name="digit-16" data-next="digit-17"
                    data-previous="digit-15" required />

                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-17" name="digit-17" data-next="digit-18"
                    data-previous="digit-16" required />
                  <input class="style-key-input" type="text" id="digit-18" name="digit-18" data-next="digit-19"
                    data-previous="digit-17" required />
                  <input class="style-key-input" type="text" id="digit-19" name="digit-19" data-next="digit-20"
                    data-previous="digit-18" required />
                  <input class="style-key-input" type="text" id="digit-20" name="digit-20" data-next="digit-21"
                    data-previous="digit-19" required />

                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-21" name="digit-21" data-next="digit-22"
                    data-previous="digit-20" required />
                  <input class="style-key-input" type="text" id="digit-22" name="digit-22" data-next="digit-23"
                    data-previous="digit-21" required />
                  <input class="style-key-input" type="text" id="digit-23" name="digit-23" data-next="digit-24"
                    data-previous="digit-22" required />
                  <input class="style-key-input" type="text" id="digit-24" name="digit-24" data-next="digit-25"
                    data-previous="digit-23" required />

                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-25" name="digit-25" data-next="digit-26"
                    data-previous="digit-24" required />
                  <input class="style-key-input" type="text" id="digit-26" name="digit-26" data-next="digit-27"
                    data-previous="digit-25" required />
                  <input class="style-key-input" type="text" id="digit-27" name="digit-27" data-next="digit-28"
                    data-previous="digit-26" required />
                  <input class="style-key-input" type="text" id="digit-28" name="digit-28" data-next="digit-29"
                    data-previous="digit-27" required />

                  <span class="splitter">&ndash;</span>
                  <input class="style-key-input" type="text" id="digit-29" name="digit-29" data-previous="digit-28"
                    required />
                </div>
                <div class="prompt">
                  <button type="submit" class="btn btn-primary" name="extendLicense">
                    <i class="bi bi-plus-lg"></i>
                    Extend License
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </main>



    <!-- mode segment  -->

  </div>

</body>

<!-- footer segment  -->
<?php include 'include/_footer_.php';?>
<script src="src/scq1.js"></script>

</html>
<script>

</script>