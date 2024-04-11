<!--start sidebar -->
<aside class="sidebar-wrapper">
  <div class="iconmenu">
    <div class="nav-toggle-box">
      <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
    </div>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboards">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-dashboards" type="button"
          onclick="dashLoad()"><i class="bi bi-house-door-fill icon-size"></i></button>
      </li>
      <?php if($user_role != 'User'){?>
      <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Master Setup">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-application" type="button"><i
            class="bi bi-columns-gap icon-size"></i></button>
      </li>
      <?php } ?>
      <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Employee">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-components" type="button"><i
            class="bi bi-people-fill" style="font-size:1.5rem;"></i></button>
      </li>
      <li class="nav-item " id="newusers" data-bs-toggle="tooltip" data-bs-placement="right" title="Users">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-widgets" type="button"><i
            class="bi bi-person-square" style="font-size:1.2rem"></i></button>
      </li>
      <li class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Utility">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-ecommerce" type="button"><i
            class="bi bi-gear" style="font-size:1.4rem;"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Reports">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-forms" type="button"><i
            class="icofont icofont-file-spreadsheet" style="font-size:1.2rem"></i></button>
      </li>
      <?php if($user_role != 'User'){?>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="License">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-tables" type="button"><i
            class=" icofont icofont-license" style="font-size:1.4rem"></i></button>
      </li>
      <?php } ?>
      <!--<li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Authentication">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-authentication" type="button"><i
            class="bi bi-lock-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Icons">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-icons" type="button"><i
            class="bi bi-cloud-arrow-down-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Content">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-content" type="button"><i
            class="bi bi-cone-striped"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i
            class="bi bi-pie-chart-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i
            class="bi bi-pin-map-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i
            class="bi bi-award-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Charts">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-charts" type="button"><i
            class="bi bi-pie-chart-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Maps">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-maps" type="button"><i
            class="bi bi-pin-map-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Pages">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-pages" type="button"><i
            class="bi bi-award-fill"></i></button>
      </li> -->
    </ul>
  </div>
  <div class="textmenu">
    <div class="brand-logo">
      <img src="admin/assets/images/bio-logo.png" width="90" alt="" style="padding-right:1.5rem;" />
      <h3 class="nav-item" id="header-name" style="font-size: 2rem; font-style: italic;flex: 0 50%;text-align: center;">
        eTAS
      </h3>
    </div>
    <div class="tab-content">
      <div class="tab-pane fade" id="pills-dashboards">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Dashboards</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="dashbord" class="list-group-item"><i class="icofont icofont-dashboard-web"></i>Primary Dashbord</a>
          <!-- <a href="index2.html" class="list-group-item"><i class="bi bi-wallet"></i>Sales</a>
          <a href="index3.html" class="list-group-item"><i class="bi bi-bar-chart-line"></i>Analytics</a>
          <a href="index4.html" class="list-group-item"><i class="bi bi-archive"></i>Project Management</a>
          <a href="index5.html" class="list-group-item"><i class="bi bi-cast"></i>CMS Dashboard</a>-->
        </div>
      </div>
      <!-- mastere setup -->
      <div class="tab-pane fade" id="pills-application">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Master Setup</h5>
            </div>
            <small class="mb-0">Some Primary Setup</small>
          </div>
          <a href="company-Ui" class="list-group-item"><i class="bi bi-building"></i>Company</a>
          <a href="branch-Ui" class="list-group-item"><i class="bi bi-file-ruled-fill"></i>Branch</a>
          <a href="department-Ui" class="list-group-item"><i class="bi bi-diagram-3"></i>Department</a>
          <a href="subdepartment-Ui" class=" list-group-item"><i class="bi bi-stack"></i>Sub Department</a>
          <a href="designation-Ui" class="list-group-item"><i class="bi bi-stickies"></i>Designation</a>
          <a href="subdesignation-Ui" class="list-group-item"><i class="bi bi-ui-radios"></i>Sub Designation</a>
          <a href="division-Ui" class="list-group-item"><i class="bi bi-bezier2"></i>Division</a>
          <a href="subdivision-Ui" class="list-group-item"><i class="bi  bi-bezier"></i> Sub Division</a>
          <a href="emp.category-Ui" class="list-group-item"><i class="bi bi-menu-down"></i> Emp. Category</a>
          <a href="emp.subcategory-Ui" class="list-group-item"><i class="bi bi-menu-button-fill"></i> Emp. Sub
            Category</a>
          <a href="emp.type-Ui" class="list-group-item"><i class="bi bi-palette2"></i> Emp. Type</a>
          <a href="grade-Ui" class="list-group-item"><i class="bi bi-paperclip"></i> Grade</a>
          <a href="location-Ui" class="list-group-item"><i class="bi bi-pin-map"></i> Location</a>
          <a href="team-Ui" class="list-group-item"><i class="bi bi-people"></i> Team</a>
          <a href="shift-Details" class="list-group-item"><i class="bi bi-calendar-plus"></i> Shift Details</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-widgets">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">User</h5>
            </div>
            <small class="mb-0">User Content</small>
          </div>
          <?php if($user_role != 'User'){?>
          <a href="user-Ui" class="list-group-item"><i class="bi  bi-person-check-fill"></i>User
            Details</a>
          <?php }?>
          <a href="user-View-Ui" class="list-group-item"><i class="icofont icofont-user-alt-5"></i>User Details
            View</a>
          <a href="changepassword-Ui" class="list-group-item"><i class="icofont icofont-ui-password"></i>Change
            Password</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-ecommerce">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Utility</h5>
            </div>
            <small class="mb-0">Some utility content</small>
          </div>
          <?php if($user_role === 'Developer'){?>
          <a href="import-Employee-Ui" class="list-group-item"><i class="bi bi-box-seam"></i>Import Employee</a>
          <?php }?>
          <a href="download-Attendance-Ui" class="list-group-item"><i class="icofont icofont-file-spreadsheet"
              style="font-size: 18px; margin-right: 7px;"></i>Attendance Formate</a>
          <a href="import-Attendance-Ui" class="list-group-item"><i class="icofont icofont-attachment"
              style="font-size: 18px; margin-right: 7px;"></i> Import Attendance</a>
          <a href="backDb-Ui" class="list-group-item"><i class="icofont icofont-database"></i> Database Backup</a>
          <!-- <a href="ecommerce-products-grid.html" class="list-group-item"><i class="bi bi-box-seam"></i>Products Grid</a>
          <a href="ecommerce-products-categories.html" class="list-group-item"><i class="bi bi-card-text"></i>Products
            Categories</a>
          <a href="ecommerce-orders.html" class="list-group-item"><i class="bi bi-plus-square"></i>Orders</a>
          <a href="ecommerce-orders-detail.html" class="list-group-item"><i class="bi bi-handbag"></i>Orders Detail</a>
          <a href="ecommerce-add-new-product.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New
            Product</a>
          <a href="ecommerce-add-new-product-2.html" class="list-group-item"><i class="bi bi-handbag"></i>Add New
            Product 2</a>
          <a href="ecommerce-transactions.html" class="list-group-item"><i class="bi bi-handbag"></i>Transactions</a> -->
        </div>
      </div>
      <div class="tab-pane fade" id="pills-components">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Employee</h5>
            </div>
            <small class="mb-0">Employee Details</small>
          </div>
          <?php if($user_role != 'User'){?>
          <a href="add-Employee-Ui" class="list-group-item"><i class="icofont icofont-address-book"></i>New
            Employee</a>
          <?php }?>
          <a href="list-Employee-Ui" class="list-group-item"><i class="bi bi-arrows-collapse"></i> Employee List </a>
          <!-- <a href="component-accordions.html" class="list-group-item"><i
              class="bi bi-arrows-collapse"></i>Accordions</a>
          <a href="component-badges.html" class="list-group-item"><i class="bi bi-badge-8k"></i>Badges</a>
          <a href="component-buttons.html" class="list-group-item"><i class="bi bi-menu-button"></i>Buttons</a>
          <a href="component-cards.html" class="list-group-item"><i class="bi bi-card-list"></i>Cards</a>
          <a href="component-carousels.html" class="list-group-item"><i class="bi bi-card-image"></i>Carousels</a>
          <a href="component-list-groups.html" class="list-group-item"><i class="bi bi-list-ol"></i>List Groups</a>
          <a href="component-media-object.html" class="list-group-item"><i class="bi bi-collection"></i>Media
            Objects</a>
          <a href="component-modals.html" class="list-group-item"><i class="bi bi-binoculars"></i>Modals</a>
          <a href="component-navs-tabs.html" class="list-group-item"><i class="bi bi-segmented-nav"></i>Navs & Tabs</a>
          <a href="component-navbar.html" class="list-group-item"><i class="bi bi-list"></i>Navbars</a>
          <a href="component-paginations.html" class="list-group-item"><i class="bi bi-arrow-down-up"></i>Pagination</a>
          <a href="component-popovers-tooltips.html" class="list-group-item"><i class="bi bi-droplet"></i>Popovers &
            Tooltips</a>
          <a href="component-progress-bars.html" class="list-group-item"><i class="bi bi-eject"></i>Progress</a>
          <a href="component-spinners.html" class="list-group-item"><i class="bi bi-gear-wide"></i>Spinners</a>
          <a href="component-notifications.html" class="list-group-item"><i
              class="bi bi-app-indicator"></i>Notifications</a>
          <a href="component-avtars-chips.html" class="list-group-item"><i class="bi bi-person-badge"></i>Avatrs &
            Chips</a>
          <a href="component-typography.html" class="list-group-item"><i class="bi bi-person-badge"></i>Typography</a> -->
        </div>
      </div>
      <div class="tab-pane fade" id="pills-forms">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Reports</h5>
            </div>
            <small class="mb-0">All Reports Here</small>
          </div>
          <a href="report-Attendance-Ui" class="list-group-item"><i class="bi bi-award"></i>Attendance Report</a>

          <?php if($user_role != 'User'){?>
          <a href="report-Audit-Ui" class="list-group-item"><i class="bi bi-back"></i>Audit log Report</a>
          <a href="report-Log-Ui" class="list-group-item"><i class="bi bi-bookmark-check"></i>Login Report</a>
          <?php }?>

          <!---<a href="form-validations.html" class="list-group-item"><i class="bi bi-broadcast-pin"></i>Form
            Validations</a>
          <a href="form-file-upload.html" class="list-group-item"><i class="bi bi-cloud-upload"></i>File Upload</a>
          <a href="form-date-time-pickes.html" class="list-group-item"><i class="bi bi-calendar-date"></i>Date
            Pickers</a>
          <a href="form-select2.html" class="list-group-item"><i class="bi bi-check2-circle"></i>Select2</a> -->
        </div>
      </div>
      <div class="tab-pane fade" id="pills-tables">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">License</h5>
            </div>
            <small class="mb-0">Some Proparties of License </small>
          </div>
          <a href="license-About-Ui" class="list-group-item"><i class="icofont icofont-document-folder"></i>About
            License</a>
          <a href="license-Extend-Ui" class="list-group-item"><i class="icofont icofont-law-document"></i>Extend
            License</a>
          <!-- <a href="table-datatable.html" class="list-group-item"><i class="bi bi-graph-up"></i>Data Tables</a> -->
        </div>
      </div>
      <div class="tab-pane fade" id="pills-authentication">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Authentication</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="authentication-signin.html" class="list-group-item"><i class="bi bi-easel"></i>Sign In</a>
          <a href="authentication-signin-with-header-footer.html" class="list-group-item d-flex align-items-center"><i
              class="bi bi-eject"></i>Sign In with Header & Footer</a>
          <a href="authentication-signup.html" class="list-group-item"><i class="bi bi-emoji-heart-eyes"></i>Sign
            Up</a>
          <a href="authentication-signup-with-header-footer.html" class="list-group-item d-flex align-items-center"><i
              class="bi bi-eye"></i>Sign Up with Header & Footer</a>
          <a href="authentication-forgot-password.html" class="list-group-item"><i
              class="bi bi-file-earmark-code"></i>Forgot Password</a>
          <a href="authentication-reset-password.html" class="list-group-item"><i class="bi bi-gem"></i>Reset
            Password</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-icons">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Icons</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="icons-line-icons.html" class="list-group-item"><i class="bi bi-brightness-low"></i>Line Icons</a>
          <a href="icons-boxicons.html" class="list-group-item"><i class="bi bi-chat"></i>Boxicons</a>
          <a href="icons-feather-icons.html" class="list-group-item"><i class="bi bi-droplet"></i>Feather Icons</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-charts">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Charts</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="charts-chartjs.html" class="list-group-item"><i class="bi bi-bar-chart"></i>Chart JS</a>
          <a href="charts-apex-chart.html" class="list-group-item"><i class="bi bi-pie-chart"></i>Apex Chart</a>
          <a href="charts-highcharts.html" class="list-group-item"><i class="bi bi-graph-up"></i>Highcharts</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-maps">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Maps</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="map-google-maps.html" class="list-group-item"><i class="bi bi-geo-alt"></i>Google Map</a>
          <a href="map-vector-maps.html" class="list-group-item"><i class="bi bi-geo"></i>Vector Map</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-pages">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Pages</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="pages-user-profile.html" class="list-group-item"><i class="bi bi-alarm"></i>User Profile</a>
          <a href="pages-timeline.html" class="list-group-item"><i class="bi bi-archive"></i>Timeline</a>
          <a href="pages-faq.html" class="list-group-item"><i class="bi bi-question-diamond"></i>FAQ</a>
          <a href="pages-pricing-tables.html" class="list-group-item"><i class="bi bi-tags"></i>Pricing</a>
          <a href="pages-errors-404-error.html" class="list-group-item"><i class="bi bi-bug"></i>404 Error</a>
          <a href="pages-errors-500-error.html" class="list-group-item"><i class="bi bi-diagram-2"></i>500 Error</a>
          <a href="pages-errors-coming-soon.html" class="list-group-item"><i class="bi bi-egg-fried"></i>Coming
            Soon</a>
          <a href="pages-blank-page.html" class="list-group-item"><i class="bi bi-flag"></i>Blank Page</a>
        </div>
      </div>
    </div>
  </div>
</aside>
<!--start sidebar -->