<?php 
// include '../../include/_dbConnect.php';
$empCountSql = "SELECT
(select COUNT(*) from loginUser where userRole!= 'Developer' ) as totalUser,
(select COUNT(*) from loginUser where userRole!= 'Developer' and userStatus = 'Active') as activeUser,
(select COUNT(*) from loginUser where userRole!= 'Developer' and userStatus = 'Deactive') as deactiveUser,
(select COUNT(*) from loginUser where userRole = 'Admin') as adminUSer,
(select COUNT(*) from loginUser where userRole = 'User') as onlyUser;";
$empCountQuery = sqlsrv_fetch_array(sqlsrv_query($conn, $empCountSql));





?>
<div style="margin-bottom:1.5rem">


  <div class="card radius-10 border-0 border-start border-success border-3" id="pageHeader">
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3 mb-header">
      <div class="breadcrumb-title pe-3 header-sec">Users Dashbord</div>
      <div class="ps-3 d-none d-sm-flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item "><a href="dashbord"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item header-subsec"><i class="bi bi-chevron-right" id="pageHeaderSec">User
                Info</i>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#ff00f796; --clrs: #29faad">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112"><?php echo $empCountQuery['totalUser'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Total Users</p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-5"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#413afa ;--clrs:#f1bff8;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class="mb-112"><?php echo $empCountQuery['activeUser'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Active </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-2"><i class="icofont-tick-mark"
                  style="font-size: 2rem; font-style: unset;"></i></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#f70000b8 ;--clrs:#ffad008f;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112"><?php echo $empCountQuery['deactiveUser'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Deactive </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-2"><i class="icofont-ban"
                  style="font-size: 2rem; font-style: unset;"></i></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>

  </div>
  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#23d5ab; --clrs: #d9ff00">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112"><?php echo $empCountQuery['adminUSer'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Admin</p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-business-man-alt-1"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#00C9FF ;--clrs:#92FE9D;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class="mb-112"><?php echo $empCountQuery['onlyUser'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Users </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-user-alt-7"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <!-- <div class="col ">

    <div class="col-dash card radius-10 " style="--clr:#92FE9D ;--clrs:#f1bff8;">
      <div class="card-body text-center addAnimation row">
        <div class="col-15" style="height:5rem;">
          <h3 class=" mb-112"><?php echo $empCountQuery['resignEmp'];?></h3>
          <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> </p>
        </div>
        <div class="col-15" style="align-content: space-evenly;">
          <span><i class="icofont icofont-users-alt-2"><i class="icofont-ban"
                style="font-size: 2rem; font-style: unset;"></i></i></span>
        </div>
      </div>
      <i class="i"></i>
    </div>
  </div> -->

  </div>
</div>