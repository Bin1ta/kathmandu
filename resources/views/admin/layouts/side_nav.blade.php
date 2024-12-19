<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="{{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="fa fa-home"></i>
                        <span> ड्यासबोर्ड</span>
                    </a>
                </li>
                @can('employee_access')
                    <li class="{{request()->routeIs('admin.employee.*') ? 'active' : ''}}">
                        <a href="{{route('admin.employee.index')}}">
                            <i class="fa fa-scroll"></i>
                            <span> जनाप्रतिनिधि/कर्मचारी</span>
                        </a>
                    </li>
                @endcan
             {{--   @can('notice_access')
                    <li class="{{request()->routeIs('admin.notice.*') ? 'active' : ''}}">
                        <a href="{{route('admin.notice.index','Notice')}}">
                            <i class="fa fa-info-circle"></i>
                            <span> सूचनाहरु </span>
                        </a>
                    </li>
                @endcan--}}
                @can('news_access')
                    <li class="{{request()->routeIs('admin.notice.*') ? 'active' : ''}}">
                        <a href="{{route('admin.notice.index','News')}}">
                            <i class="fa fa-newspaper"></i>
                            <span> सूचनाहरु</span>
                        </a>
                    </li>
                @endcan
                @can('video_access')
                    <li class="{{request()->routeIs('admin.video.*') ? 'active' : ''}}">
                        <a href="{{route('admin.video.index')}}">
                            <i class="fa fa-video"></i>
                            <span> भिडियोहरु</span>
                        </a>
                    </li>
                @endcan
                <li class="{{request()->is('admin/setting/userManagement/*') ? 'active' : ''}}">
                    <a href="#userManagement"
                       {{request()->is('admin/setting/userManagement/*') ? 'aria-expanded=true  ' : ''}}
                       data-bs-toggle="collapse">
                        <i class="fa fa-users-cog"></i>
                        <span>प्रयोगकर्ता व्यवस्थापन</span>
                        <span class="menu-arrow">
            <i class="fas fa-angle-right"></i>
        </span>
                    </a>
                    <div class="collapse {{request()->is('admin/setting/userManagement/*') ? 'show' : ''}}"
                         id="userManagement">
                        <ul class="nav-second-level">
                            @can('user_access')
                                <li class="{{request()->is('admin/setting/userManagement/user*') ? 'active' : ''}}">
                                    <a href="{{route('admin.systemSetting.userManagement.user.index')}}">प्रयोगकर्ता</a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="{{request()->is('admin/setting/userManagement/role*') ? 'active' : ''}}">
                                    <a href="{{route('admin.systemSetting.userManagement.role.index')}}">भूमिका</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li class="{{request()->routeIs('admin.branch.*') ? 'active' : ''}}">
                    <a href="{{route('admin.branch.index')}}">
                        <i class="fas fa-code-branch"></i>
                        <span> शाखाहरु</span>
                    </a>
                </li>
                <li class="{{request()->routeIs('admin.citizenCharter.*') ? 'active' : ''}}">
                    <a href="{{route('admin.citizenCharter.index')}}">
                        <i class="fas fa-file"></i>
                        <span> नागरिक वडापत्र</span>
                    </a>
                </li>
                <li class="{{request()->routeIs('admin.header.*') ? 'active' : ''}}">
                    <a href="{{route('admin.header.index')}}">
                        <i class="fas fa-file"></i>
                        <span>हेडर</span>
                    </a>
                </li>
                {{--<li class="{{request()->routeIs('admin.revenue.*') ? 'active' : ''}}">
                    <a href="{{route('admin.revenue.index')}}">
                        <i class="fas fa-file"></i>
                        <span>राजस्व</span>
                    </a>
                </li>--}}
                <li class="{{request()->routeIs('admin.popUp.*') ? 'active' : ''}}">
                    <a href="{{route('admin.popUpSetting.index')}}">
                        <i class="fas fa-file"></i>
                        <span>पपअप</span>
                    </a>
                </li>
                <li class="{{request()->routeIs('admin.program.*') ? 'active' : ''}}">
                    <a href="{{route('admin.program.index')}}">
                        <i class="fas fa-file"></i>
                        <span>कार्यक्रम</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
