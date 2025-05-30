<div class="navbar-container d-flex content">

    <ul class="nav navbar-nav align-items-center ms-auto">
        <!-- <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle" data-bs-toggle="collapse"><i class="fa fa-bars"></i></a></li> -->
        <li class="nav-item d-lg-block"><a class="nav-link nav-link-style"><i class="ficon"
                    data-feather="moon"></i></a></li>

        

        <li class="nav-item dropdown dropdown-user">
            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex ">
                    <span class="user-name fw-bolder">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->role_id !== 1)
                    <span class="user-status">{{Auth::user()->wallet}} SAR <i class="fa fa-wallet"></i></span>
                    @else
                    <span class="user-status">{{Auth::user()->email}}</span>
                    @endif
                </div>
                <span class="avatar"><img class="round" src="{{ asset('user.png') }}" alt="avatar" height="40"
                        width="40">
                    <span class="avatar-status-online"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                @if(Auth::user()->role_id !== 1)
                    <a class="dropdown-item" href="{{ route('edit.customer',Auth::user()->id) }}"><i class="me-50" data-feather="user"></i>
                {{__('messages.Profile')}}</a>
                @endif
                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout.admin') }}"><i class="me-50" data-feather="power"></i>
                {{__('messages.Logout')}}</a>
            </div>
        </li>

        <li class="nav-item dropdown dropdown-language">
            <a class="nav-link dropdown-toggle dropdown-language-link" id="dropdown-language" href="#"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-nav d-sm-flex ">
                    <span class="user-name fw-bolder"><i class="fa fa-globe"></i> {{ App::getLocale() == 'en' ? "English" : "العربية" }}</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('change.language', 'en') }}">
                    English
                </a>
                <a class="dropdown-item" href="{{ route('change.language', 'ar') }}">
                    العربية
                </a>
            </div>
        </li>
    </ul>
</div>
