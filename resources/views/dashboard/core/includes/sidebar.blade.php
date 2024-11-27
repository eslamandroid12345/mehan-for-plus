<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('/') }}" class="brand-link">
        <img src="{{asset("img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('website.MehanPlus')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item  {{ in_array(request()->route()->getName(), ['/']) ? 'menu-open' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            @lang('dashboard.Home')
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admins.index', 'admins.create', 'admins.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('admins.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            @lang('dashboard.Admins')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['resident-seekers.index', 'resident-seekers.create', 'resident-seekers.show', 'resident-seekers.edit', 'non-resident-seekers.index', 'non-resident-seekers.create', 'non-resident-seekers.show', 'non-resident-seekers.edit']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            @lang('dashboard.Seekers')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('resident-seekers.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['resident-seekers.index', 'resident-seekers.create', 'resident-seekers.show', 'resident-seekers.edit']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Resident Seekers')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('non-resident-seekers.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['non-resident-seekers.index', 'non-resident-seekers.create', 'non-resident-seekers.show', 'non-resident-seekers.edit']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Non-Resident Seekers')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['companies.index', 'companies.create', 'companies.show', 'companies.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('companies.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            @lang('dashboard.Companies')
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['ads.index', 'ads.show', 'ads.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('ads.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ad"></i>
                        <p>
                            @lang('dashboard.Ads')
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            @lang('dashboard.Transactions')
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['chats.index', 'chats.search', 'chats.get', ]) ? 'menu-open' : '' }}">
                    <a href="{{ route('chats.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            @lang('dashboard.Chats')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['jobs.index', 'jobs.create', 'jobs.edit', 'skills.index', 'skills.create', 'skills.edit']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>
                            @lang('dashboard.Jobs and Skills')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['jobs.index', 'jobs.create', 'jobs.edit']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Jobs')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('skills.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['skills.index', 'skills.create', 'skills.edit']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Skills')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['fields.index', 'fields.create', 'fields.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('fields.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            @lang('dashboard.Fields')
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['qualifications.index', 'qualifications.create', 'qualifications.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('qualifications.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-certificate"></i>
                        <p>
                            @lang('dashboard.Qualifications')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['countries.index', 'countries.create', 'countries.edit', 'cities.index', 'cities.create', 'cities.edit']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            @lang('dashboard.Countries and Cities')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('countries.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['countries.index', 'countries.create', 'countries.edit']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Countries')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cities.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['cities.index', 'cities.create', 'cities.edit', ]) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Cities')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['nationalities.index', 'nationalities.create', 'nationalities.edit']) ? 'menu-open' : '' }}">
                    <a href="{{ route('nationalities.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-location-arrow"></i>
                        <p>
                            @lang('dashboard.Nationalities')
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['notifications.index']) ? 'menu-open' : '' }}">
                    <a href="{{ route('notifications.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            @lang('dashboard.Notifications')
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ in_array(request()->route()->getName(), ['home.index', 'credits.index', 'contact-us.index', 'about-us.index', 'terms-and-conditions.index', 'privacy-policy.index']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            @lang('dashboard.Subpages Content')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('home.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['home.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Home')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('credits.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['credits.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Credits')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact-us.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['contact-us.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Contact Us')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about-us.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['about-us.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.About Us')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('terms-and-conditions.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['terms-and-conditions.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Terms and Conditions')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('privacy-policy.index') }}" class="nav-link {{ in_array(request()->route()->getName(), ['privacy-policy.index']) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('dashboard.Privacy Policy')</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['settings.index',]) ? 'menu-open' : '' }}">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            @lang('dashboard.Settings')
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
