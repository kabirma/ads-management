      <!-- Sidebar -->
      <nav class="col-md-2  sidebar" id="sidebarToggle">
          <div class="text-center mb-4 d-flex align-items-center">
              <img src=" {{ asset('assets/admin/img/icons/logo.png') }}" class="mb-2" alt="logo" />
              <h5 class="fw-bold ms-2">Sahallah</h5>
          </div>
          <ul class="nav flex-column">
              <li class="nav-item">
                  <a class="nav-link " href="#">
                      <img src="../assets/img/icons/B.png" alt=""> My Business</a>
              </li>
              <li class=" nav-item ">

                  <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }} "
                      href="{{ route('dashboard') }}">
                      <img src="{{ asset('assets/admin/img/icons/dashboard.png') }}" alt=""> &nbsp;
                      Dashboard</a>
              </li>

              <li class=" nav-item ">

                  <a class="nav-link {{ Route::currentRouteName() == 'view.customer' ? 'active' : '' }} "
                      href="{{ route('view.customer') }}">
                      <i class="fa fa-users"></i><span class="menu-title text-truncate" data-i18n="Invoice">&nbsp;
                          {{ __('messages.USERS') }}
                      </span>
                  </a>
              </li>

              <li class=" nav-item ">

                  <a class="nav-link {{ Route::currentRouteName() == 'view.ads' ? 'active' : '' }} "
                      href="{{ route('view.ads') }}">
                      <img src=" {{ asset('assets/admin/img/icons/sidebar-wallet.png') }}" alt="">&nbsp;
                      <span class="menu-title text-truncate me-3" data-i18n="Invoice">
                          {{ __('messages.ADS') }}
                      </span>
                  </a>
              </li>
              <li class=" nav-item ">

                  <a class="nav-link {{ Route::currentRouteName() == 'view.media' ? 'active' : '' }} "
                      href="{{ route('view.media') }}">
                      {{-- <img src=" {{ asset('assets/admin/img/icons/sidebar-wallet.png') }}" alt="">&nbsp; --}}

                      <img src=" {{ asset('assets/admin/img/icons/media-icon.png') }}" alt=""><span
                          class="menu-item text-truncate" data-i18n="List">
                          <span class="menu-title text-truncate me-3" data-i18n="Invoice">
                              {{ __('messages.Media') }}Library
                          </span>
                  </a>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">
                      <img src=" {{ asset('assets/admin/img/icons/sidebar-wallet.png') }}" alt="">&nbsp;
                      Wallet</a></li>
              <li class="nav-item"><a class="nav-link" href="#">
                      <img src=" {{ asset('assets/admin/img/icons/add-tools.png') }}" alt="">&nbsp; Add
                      Tools</a></li>
              <li class=" nav-item ">
                  <a class="nav-link {{ Route::currentRouteName() == 'view.page' ? 'active' : '' }}"
                      href="{{ route('view.page') }}">
                      <i class="fa fa-pencil me-3"></i><span class="menu-title text-truncate"
                          data-i18n="Invoice">{{ __('messages.PAGE') }}
                      </span>
                  </a>

              </li>
              {{-- <li class="nav-item">
                  <a class="nav-link" href="#">
                      <img src=" {{ asset('assets/admin/img/icons/add-tools.png') }}" alt="">
                      &nbsp; Add Tools
                  </a>
              </li> --}}

              {{-- <li class="nav-item">
                  <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#adsSubmenu"
                      role="button" aria-expanded="false" aria-controls="adsSubmenu">
                      <i class="fa fa-ad me-2"></i>Ads
                  </a>
                  <div class="collapse" id="adsSubmenu">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          <li>
                              <a class="nav-link text-white ps-3" href="#">
                                  <i class="fa fa-plus me-2"></i>Add New Ad</a>
                          </li>
                          <li>
                              <a class="nav-link text-white ps-3" href="#}">
                                  <i class="fa fa-list me-2"></i>View All Ads</a>
                          </li>
                      </ul>
                  </div>
              </li> --}}

              {{-- create a dropdown --}}
              {{-- <li class="nav-item">
                  <a class="nav-link text-white dropdown-toggle" data-bs-toggle="collapse" href="#userManagement"
                      role="button" aria-expanded="false" aria-controls="userManagement">
                      <i class="fa fa-chart-bar me-2"></i>Reports
                  </a>
                  <div class="collapse" id="userManagement">
                      <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                          <li>
                              <a class="nav-link text-white ps-3" href="#">
                                  <i class="fa fa-file-alt me-2"></i>Ad Performance</a>
                          </li>
                          <li>
                              <a class="nav-link text-white ps-3" href="#">
                                  <i class="fa fa-users me-2"></i>User Engagement</a>
                          </li>
                          <li>
                              <a class="nav-link text-white ps-3" href="#">
                                  <i class="fa fa-dollar-sign me-2"></i>Revenue Reports</a>
                          </li>
                      </ul>
                  </div>
              </li> --}}


              <li class=" nav-item  mt-5">
                  <a class="nav-link {{ Route::currentRouteName() == 'company' ? 'active' : '' }}"
                      href="{{ route('company') }}">
                      <img src=" {{ asset('assets/admin/img/icons/setting.png') }}" alt="">&nbsp;
                      {{ __('messages.SETTINGS') }}</a>

                  </a>
              </li>


              <li class="nav-item"><a class="nav-link" href="#">
                      <img src="{{ asset('assets/admin/img/icons/logout.png') }}" alt="">&nbsp; Logout</a>
              </li>
          </ul>
      </nav>
      <!-- sidebar arrow -->
      <div class="sidebar-toggle-btn" id="sidebarToggler">
          <img src=" {{ asset('assets/admin/img/icons/sidebar-arrow.png') }}" alt="">
      </div>
