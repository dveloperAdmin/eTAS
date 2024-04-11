<!--start top header-->
<header class="top-header">
  <nav class="navbar navbar-expand">
    <div class="mobile-toggle-icon d-xl-none">
      <i class="bi bi-list"></i>
    </div>
    <div class="top-navbar d-none d-xl-block">
      <ul class="navbar-nav align-items-center">
        <h3 class="nav-item" id="header-name">
          Easy Track Attendance System
        </h3>
        <!-- <li class="nav-item">
          <a class="nav-link" href="app-emailbox.html">Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="javascript:;">Projects</a>
        </li>
        <li class="nav-item d-none d-xxl-block">
          <a class="nav-link" href="javascript:;">Events</a>
        </li>
        <li class="nav-item d-none d-xxl-block">
          <a class="nav-link" href="app-to-do.html">Todo</a>
        </li> -->
      </ul>
    </div>
    <div class="search-toggle-icon d-xl-none ms-auto" style="background-color: #f7f8fa; box-shadow:none;">
      <!-- <h3 class="nav-item" id="header-name">
        Easy Track Attendance System
      </h3> -->
    </div>
    <div class="searchbar d-none d-xl-flex ms-auto"
      style="width:auto;font-family: 'Protest Guerrilla', sans-serif;font-size: 1rem; font-weight: 400; font-style: normal;">

      <span id="date_span" style="padding:1rem;"></span>
      <span id="clock_span" style="padding:1rem;"></span>
    </div>
    <div class="top-navbar-right ms-3">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="user-setting d-flex align-items-center gap-1">
              <img src="admin/assets/images/admin.png" class="user-img" alt="">
              <div class="user-name d-none d-sm-block"><?php echo $user_name;?></div>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="box shadow">
                    <div class="image-content">

                      <img src="admin/assets/images/admin.png" alt="" class="rounded-circle" width="60" height="60">
                    </div>
                  </div>
                  <div class="ms-3">
                    <h6 class="mb-0 dropdown-user-name"><?php echo $user_name;?></h6>
                    <small class="mb-0 dropdown-user-designation text-secondary"><?php echo $role;?></small>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#" style="padding:0">
                <div class="d-flex align-items-center">
                  <i class="bi bi-box-arrow-in-left" style="font-size: 1.5rem;padding-left:2.7rem"></i>
                  <div class="ms-3">
                    <h6 class="mb-0 dropdown-user-name"><?php echo $last_login_details;?></h6>
                  </div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#" style="padding:0">
                <div class="d-flex align-items-center">
                  <i class="bi bi-box-arrow-in-right" style="font-size: 1.5rem;padding-left:2.7rem"></i>
                  <div class="ms-3">
                    <h6 class="mb-0 dropdown-user-name"><?php echo $last_logout_details;?></h6>
                  </div>
                </div>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="user-View-Ui">
                <div class="d-flex align-items-center">
                  <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                  <div class="setting-text ms-3"><span>Profile</span></div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="changepassword-Ui">
                <div class="d-flex align-items-center">
                  <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                  <div class="setting-text ms-3"><span>Change Password</span></div>
                </div>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="dashbord">
                <div class="d-flex align-items-center">
                  <div class="setting-icon"><i class="bi bi-speedometer"></i></div>
                  <div class="setting-text ms-3"><span>Dashboard</span></div>
                </div>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="include/_logout.php">
                <div class="d-flex align-items-center">
                  <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                  <div class="setting-text ms-3"><span>Logout</span></div>
                </div>
              </a>
            </li>
          </ul>
        </li>
        <!-- <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="projects">
              <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <div class="row row-cols-3 gx-2">
              <div class="col">
                <a href="ecommerce-orders.html">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-primary bg-gradient">
                      <i class="bi bi-cart-plus-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Orders</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="javascript:;">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-danger bg-gradient">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Users</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="ecommerce-products-grid.html">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-success bg-gradient">
                      <i class="bi bi-bank2"></i>
                    </div>
                    <p class="mb-0 apps-name">Products</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="component-media-object.html">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-orange bg-gradient">
                      <i class="bi bi-collection-play-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Media</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="pages-user-profile.html">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-purple bg-gradient">
                      <i class="bi bi-person-circle"></i>
                    </div>
                    <p class="mb-0 apps-name">Account</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="javascript:;">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-dark bg-info bg-gradient">
                      <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Docs</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="ecommerce-orders-detail.html">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-pink bg-gradient">
                      <i class="bi bi-credit-card-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Payment</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="javascript:;">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-white bg-bronze bg-gradient">
                      <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <p class="mb-0 apps-name">Events</p>
                  </div>
                </a>
              </div>
              <div class="col">
                <a href="javascript:;">
                  <div class="apps p-2 radius-10 text-center">
                    <div class="apps-icon-box mb-1 text-dark bg-warning bg-gradient">
                      <i class="bi bi-book-half"></i>
                    </div>
                    <p class="mb-0 apps-name">Story</p>
                  </div>
                </a>
              </div>
            </div>
            <!-- end row
          </div>
        </li> -->
        <!-- <li class="nav-item dropdown dropdown-large">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="messages">
              <span class="notify-badge">5</span>
              <i class="bi bi-messenger"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end p-0">

          </div>
        </li> -->
        <li class="nav-item dropdown dropdown-large d-none d-sm-block">
          <!-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
            <div class="notifications">
              <span class="notify-badge">8</span>
              <i class="bi bi-bell-fill"></i>
            </div>
          </a> -->
          <div class="dropdown-menu dropdown-menu-end p-0">
            <!--<div class="p-2 border-bottom m-2">
              <h5 class="h5 mb-0">Notifications</h5>
            </div>
            <div class="header-notifications-list p-2">
              <div class="dropdown-item bg-light radius-10 mb-1">
                <form class="dropdown-searchbar position-relative">
                  <div class="position-absolute top-50 start-0 translate-middle-y px-3 search-icon"><i
                      class="bi bi-search"></i></div>
                  <input class="form-control" type="search" placeholder="Search Messages">
                </form>
              </div>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-basket2-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">1
                        m</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived
                      new orders</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-people-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">New Customers <span class="msg-time float-end text-secondary">7
                        m</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5 new user
                      registered</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-file-earmark-bar-graph-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">24 PDF File <span class="msg-time float-end text-secondary">2
                        h</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The pdf files
                      generated</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-collection-play-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">Time Response <span class="msg-time float-end text-secondary">3
                        h</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">5.1 min avarage
                      time response</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-cursor-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">New Product Approved <span
                        class="msg-time float-end text-secondary">1 d</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Your new product
                      has approved</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-gift-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">New Comments <span class="msg-time float-end text-secondary">2
                        w</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New customer
                      comments recived</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-droplet-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">New 24 authors<span class="msg-time float-end text-secondary">1
                        m</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">24 new authors
                      joined last week</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-mic-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">Your item is shipped <span
                        class="msg-time float-end text-secondary">7 m</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Successfully
                      shipped your item</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-lightbulb-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">Defense Alerts <span class="msg-time float-end text-secondary">2
                        h</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">45% less alerts
                      last 4 weeks</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-bookmark-heart-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">4 New Sign Up <span class="msg-time float-end text-secondary">2
                        w</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">New 4 user
                      registartions</small>
                  </div>
                </div>
              </a>
              <a class="dropdown-item" href="#">
                <div class="d-flex align-items-center">
                  <div class="notification-box"><i class="bi bi-briefcase-fill"></i></div>
                  <div class="ms-3 flex-grow-1">
                    <h6 class="mb-0 dropdown-msg-user">All Documents Uploaded <span
                        class="msg-time float-end text-secondary">1 mo</span></h6>
                    <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">Sussessfully
                      uploaded all files</small>
                  </div>
                </div>
              </a>
            </div>
            <div class="p-2">
              <div>
                <hr class="dropdown-divider">
              </div>
              <a class="dropdown-item" href="#">
                <div class="text-center">View All Notifications</div>
              </a>
            </div>
          </div> -->
        </li>
      </ul>
    </div>
  </nav>
  <!-- end navbar  -->
</header>
<!-- end header  -->