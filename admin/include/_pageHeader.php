<div class="card radius-10 border-0 border-start border-success border-3" id="pageHeader">
  <div
    style="    display: flex;    align-content: baseline;    justify-content: space-between;    flex-wrap: wrap;    align-items: center;">
    <div class="page-breadcrumb d-sm-flex align-items-center mb-3 mb-header">
      <div class="breadcrumb-title pe-3 header-sec"><?php echo $header;?> </div>
      <div class="ps-3 d-none d-sm-flex">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item "><a href="dashbord"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item header-subsec"><i class="bi bi-chevron-right"
                id="pageHeaderSec"><?php echo $headerDes;?></i>
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <?php if ($url  == "/eTAS/report-Attendance-Ui"){?>
    <div>

    </div>

    <?php } ?>
  </div>
</div>