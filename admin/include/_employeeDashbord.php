<?php 
// include '../../include/_dbConnect.php';
$empCountSql = "SELECT
      (select COUNT(*) from employeeDetails where empCode!='Emp00lst') as totalEmp,
      (select COUNT(*) from employeeDetails where empCode!='Emp00lst' and status = 'Working') as workEmp,
      (select COUNT(*) from employeeDetails where empCode!='Emp00lst' and status = 'Resigned') as resignEmp,
      (select COUNT(*) from employeeDetails where empCode!='Emp00lst' and status = 'Retired') as retiredEmp;";
$empCountQuery = sqlsrv_fetch_array(sqlsrv_query($conn, $empCountSql));





?>
<div style="margin-bottom:1.5rem">
  <div class="card radius-10 border-0 border-start border-success border-3" id="pageHeader">
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3 mb-header">
      <div class="breadcrumb-title pe-3 header-sec">Employee Dashbord</div>
      <div class="ps-3 d-none d-sm-flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item "><a href="dashbord"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item header-subsec"><i class="bi bi-chevron-right" id="pageHeaderSec">Employee
                Info</i>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#ff00f796; --clrs: #f2f700c2">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112"><?php echo $empCountQuery['totalEmp'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Total Employeees</p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-1"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#00C9FF ;--clrs:#92FE9D;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class="mb-112"><?php echo $empCountQuery['workEmp'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Working </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-2"><i class="icofont-fountain-pen"
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
            <h3 class=" mb-112"><?php echo $empCountQuery['resignEmp'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Resigned </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-users-alt-2"><i class="icofont-ban"
                  style="font-size: 2rem; font-style: unset;"></i></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#09e2ff ;--clrs:#f883fb73;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112"><?php echo $empCountQuery['retiredEmp'];?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Retired </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="icofont icofont-wheelchair" style="font-size:4rem;"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>


  </div>
</div>