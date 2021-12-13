<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{url('admin/dashboard')}}">
            <div class="logo-img">
                <img src="{{asset('admin/img/logo-transparent.png')}}" class="header-brand-img w-100" alt="Jersey Swap">
            </div>
            <span class="text">Jersey Swap</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Navigation</div>
                {{--
                <div class="nav-item active">
                    <a href="index.html"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                </div>
                --}}
                <div class="nav-item">
                    <a href="{{url('/admin/users')}}"><i class="ik ik-users"></i><span>Users</span> </a>
                </div>
                <div class="nav-item">
                    <a href="{{url('/admin/contacts')}}"><i class="ik ik-users"></i><span>Contacts</span> </a>
                </div>
                {{--<div class="nav-item">
                    <a href="{{url('/admin/listing')}}"><i class="ik ik-menu"></i><span>Listing</span> </a>
                </div>--}}
                <div class="nav-item">
                    <a href="{{url('/admin/deals')}}"><i class="ik ik-menu"></i><span>Deals</span> </a>
                </div>
                <div class="nav-item">
                    <a href="{{url('/admin/credit-requests')}}"><i class="ik ik-menu"></i><span>Credit Requests</span> </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{url('/admin/testimonials')}}"><i class="ik ik-thumbs-up"></i><span>Testimonials</span> </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{url('/admin/settings')}}"><i class="ik ik-settings"></i><span>Settings</span> </a>
                </div>

                <div class="nav-lavel">Support</div>
                <div class="nav-item">
                    <a href="https://facebook.com/cawoyservices/"><i class="ik ik-monitor"></i><span>Live Support</span></a>
                </div>
                <div class="nav-item">
                    <a href="mailto:info@cawoy.com"><i class="ik ik-help-circle"></i><span>Submit Issue</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>
