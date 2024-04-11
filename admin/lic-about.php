<?php
include '../include/_session.php'; 
include '../include/_dbConnect.php';
$des="load branch-ui page";
$rem="About License page";
$header="License Details ";
$headerDes="About License";
include '../include/_audiLog.php'; 


  $myFile = fopen("../src/license.lic",'r');
  $id="";
  for($i=1; $i<=29;$i++){
      $id.=fgetc($myFile);
  }
  fclose($myFile);

  $theData = file("../src/license.lic");
  $id_key =$theData[1];
  //lic expired date
  $ac_date= substr($id,4,2 ).substr($id, 8,2). substr($id, 12,2).substr($id,26,3); ;
  $m_date = ($ac_date/7);
  $date = substr($m_date,0,4)."-".substr($m_date,4,2)."-".substr($m_date,6,2);

  // User Limitation
  $ac_user = substr($id,16,2 ).substr($id,20,2 ).substr($id,24,2 ) ;
  $users = (($ac_user/12)-57);





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
                  <h6 class="mb-0 text-uppercase">License</h6>


                  <hr />
                  <div class="card" style="padding:.5rem;    margin-bottom: 0.8rem;">

                    <h5 id="bio_sync" style="margin: 0;">License Expire :- <span
                        style="color:red; font-family: 'Aboreto', cursive;">&nbsp;
                        <?php echo date("d-M-Y", strtotime($date))?></span></h5>

                  </div>
                  <div class="row" id="timegap">
                    <!-- dashbord start -->

                    <!-- <!-- dashbord end -->
                  </div>
                  <div class="card" style="padding:.5rem;    margin-bottom: 0.8rem;">

                    <h5 id="bio_sync" style="margin: 0;">Employee Limitation :- <span
                        style="font-family: 'Aboreto', cursive;color:red;">&nbsp;
                        <?php echo $users;?></span> </h5>

                  </div>

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