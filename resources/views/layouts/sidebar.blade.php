<div class="navbar-header">
    <ul class="nav navbar-nav ">
        <li class="nav-item text-center">
            <a class="navbar-brand" style=" justify-content: center" href="{{route('dashboard')}}"><img style="height:90px" src="{{ asset($setting->logo) }}">
            </a>
        </li>
     
    </ul>
</div>
<div class="shadow-bottom"></div>
<div class="main-menu-content" style="margin-top:20%!important">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                <i class="fa fa-home"></i>
                <span class="menu-title text-truncate" data-i18n="Email">{{ __('messages.DASHBOARD') }}</span>
            </a>
        </li>
    
        @if(Auth::user()->role_id === 1)
        
        
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-users"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.USERS')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.customer' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.customer') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.customer' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.customer') }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-dollar"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.ADS')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.ads' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.ads') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'view.draft' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.draft') }}">
                        <i class="fa fa-save"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}} {{__('messages.DRAFT')}}</span>
                    </a>
                </li>
             
              
            </ul>
        </li>



        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-camera"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.Media')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.media' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.media') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.media' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.media',0) }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
              
            </ul>
        </li>


        <li class=" nav-item {{ Route::currentRouteName() == 'company' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('company') }}">
                <i class="fa fa-gear"></i>
                <span class="menu-title text-truncate" data-i18n="Settings">{{__('messages.SETTINGS')}}</span>
            </a>
        </li>

        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-dollar"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.P_PAC')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.package' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.package') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.package' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.package') }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-pencil"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.PAGE')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.page' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.page') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.page' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.page') }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
            </ul>
        </li>



        @else
        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-dollar"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.ADS')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.ads' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.ads') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'view.draft' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.draft') }}">
                        <i class="fa fa-save"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}} {{__('messages.DRAFT')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.ads' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.ads',0) }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
              
            </ul>
        </li>

        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.BusinessProfile')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.business' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.business') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.business' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.business',0) }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
              
            </ul>
        </li>



        <li class=" nav-item">
            <a class="d-flex align-items-center" href="#">
                <i class="fa fa-camera"></i><span class="menu-title text-truncate" data-i18n="Invoice">{{__('messages.Media')}}
                </span>
            </a>
            <ul class="menu-content">
                <li class="{{ Route::currentRouteName() == 'view.media' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('view.media') }}">
                        <i class="fa fa-list"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.VIEW')}}</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'add.media' ? 'active' : '' }}">
                    <a class="d-flex align-items-center" href="{{ route('add.media',0) }}">
                        <i class="fa fa-plus"></i><span class="menu-item text-truncate" data-i18n="List">{{__('messages.ADD')}}</span>
                    </a>
                </li>
              
            </ul>
        </li>


        <li class=" nav-item {{ Route::currentRouteName() == 'edit.customer' ? 'active' : '' }}">
            <a class="d-flex align-items-center" href="{{ route('edit.customer',Auth::user()->id) }}">
                <i class="fa fa-user"></i>
                <span class="menu-title text-truncate" data-i18n="Profile">{{__('messages.PROFILE')}}</span>
            </a>
        </li>

     

        <li class=" nav-item">
            <a class="d-flex align-items-center" href="{{ route('logout.admin') }}">
                <i class="fa fa-arrow-left"></i>
                <span class="menu-title text-truncate" data-i18n="Logot">{{__('messages.Logout')}}</span>
            </a>
        </li>


        @endif

    </ul>
</div>
