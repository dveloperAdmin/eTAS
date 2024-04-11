<?php 
// include '../../include/_dbConnect.php';
$attenTableName = "Attendance_".date("m")."_".date("Y");
$attendDate = date("d");
$attenCountSql = "declare @tableexists int;

if exists (select 1 from sys.tables where name = '$attenTableName')
    set @tableexists = 1;
else
    set @tableexists = 0;

if @tableexists = 1
	begin
		select
			(select count(*) from $attenTableName where [$attendDate] like '%P%' and EmployeeCode!= 'Emp00lst') as present,
			(select count(*) from $attenTableName where [$attendDate] like '%HD%'and EmployeeCode!= 'Emp00lst') as halfDay,
			(select count(*) from $attenTableName where ([$attendDate] like '%L%' or [$attendDate] is NULL) and EmployeeCode!= 'Emp00lst') as leave,
			(select count(*) from $attenTableName where [$attendDate] like '%WO%'and EmployeeCode!= 'Emp00lst') as weekOff;
	end
else
    select 0 as 'TableNotFound';";

$empCountQuery = sqlsrv_fetch_array(sqlsrv_query($conn, $attenCountSql), SQLSRV_FETCH_ASSOC);
if($empCountQuery == false){
  $present = 0;
  $halfDay = 0;
  $leave = 0;
  $weekOff = 0;
}else {
  if (isset($empCountQuery['present'])) {
      $present = $empCountQuery['present'];
  } else {
      $present = 0; // Default value if 'present' key is not set
  }

  if (isset($empCountQuery['halfDay'])) {
      $halfDay = $empCountQuery['halfDay'];
  } else {
      $halfDay = 0; // Default value if 'halfDay' key is not set
  }

  if (isset($empCountQuery['leave'])) {
      $leave = $empCountQuery['leave'];
  } else {
      $leave = 0; // Default value if 'leave' key is not set
  }

  if (isset($empCountQuery['weekOff'])) {
      $weekOff = $empCountQuery['weekOff'];
  } else {
      $weekOff = 0; // Default value if 'weekOff' key is not set
  }
}





?>
<div style="margin-bottom:1.5rem">
  <div class="card radius-10 border-0 border-start border-success border-3" id="pageHeader">
    <div class="row">
      <div class="col-xl-6 mx-auto">
        <div class="page-breadcrumb d-sm-flex align-items-center mb-3 mb-header">
          <div class="breadcrumb-title pe-3 header-sec">Attendance Dashbord</div>
          <div class="ps-3 d-none d-sm-flex">
            <nav aria-label="breadcrumb">

              <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item "><a href="dashbord"><i class="bi bi-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item header-subsec"><i class="bi bi-chevron-right" id="pageHeaderSec">Attendance
                    Info <span id="attendanceDate">( <?php echo date("d-M-Y");?> )</span></i>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="col-xl-6 mx-auto" style="display: grid; justify-items: end;">

        <input type="date" class="form-control" name="shiftChIn" value="" id="attendanceFilter"
          style="width:50%;padding: .2275rem .75rem;">

      </div>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#23d5ab; --clrs: #d9ff00">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112" id="attenDshP"><?php echo $present;?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;">Present </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="bi bi-calendar2-check-fill"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#ff00f796 ;--clrs:#f70000b8;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class="mb-112" id="attenDshHd"><?php echo $halfDay;?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;">Half Day </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="bi bi-calendar2-week-fill"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">

      <div class="col-dash card radius-10 " style="--clr:#f234afc9;--clrs:#31ffdf;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112" id="attenDshL"><?php echo $leave;?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Leave </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="bi bi-calendar2-x"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>
    <div class="col ">
      <div class="col-dash card radius-10 " style="--clr:#ff9900a6 ;--clrs:#92FE9D;">
        <div class="card-body text-center addAnimation row">
          <div class="col-15" style="height:5rem;">
            <h3 class=" mb-112" id="attenDshWo"><?php echo $weekOff;?></h3>
            <p class="mt-3 mb-0" style="font-family: 'Lora', serif;font-weight: bolder;"> Week Off </p>
          </div>
          <div class="col-15" style="align-content: space-evenly;">
            <span><i class="bi bi-calendar2-minus-fill"></i></span>
          </div>
        </div>
        <i class="i"></i>
      </div>
    </div>


  </div>
</div>