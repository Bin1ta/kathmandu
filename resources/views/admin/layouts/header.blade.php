<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                   data-bs-toggle="dropdown"
                   href="#"
                   role="button"
                   aria-haspopup="false"
                   aria-expanded="false" id="profile-tour">
                    <img src="{{auth()->user()->profile_photo_url ?? asset('images/np.png')}}" alt="user-image" class="rounded-circle"/>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown">

                    <a href="{{route('admin.profile')}}" class="dropdown-item notify-item">
                        <i class="fa fa-user"></i>
                        <span>मेरो प्रोफाइल</span>
                    </a>

                    <a href="{{route('admin.systemSetting.officeSetting.index')}}" class="dropdown-item notify-item">
                        <i class="fa fa-spin fa-cog"></i>
                        <span>सेटिङ</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>बाहिर निस्कनु</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <!-- LOGO -->
        <div class="logo-box dropdown">
            <a href="{{route('admin.dashboard')}}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{asset('assets/backend/images/logo_sm.png')}}" alt="" height="40"/>
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/backend/images/logo.png')}}" alt="" height="35"/>
              </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fa fa-bars"></i>
                </button>
            </li>
            <li class="d-none d-xl-block">
                <h3 class="top-heading text-light fw-bold">
                </h3>
            </li>

            <li class="d-none d-xl-block ms-1">
                <p class="top-heading text-danger">
                </p>
            </li>
        </ul>
    </div>
</div>
