<!-- Logo container-->
<div class="logo">
    <a href="index-2.html" class="logo"><i class="md md-equalizer"></i> <span>AGCL</span> </a>
</div>
<!-- End Logo container-->

<div class="menu-extras">

    <ul class="nav navbar-nav navbar-right pull-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true">{{ Auth::guard('user')->user()->consumer_number}} <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                <li><a href="{{ route('user.logout') }}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
            </ul>
        </li>
    </ul>

    <div class="menu-item">
        <!-- Mobile menu toggle-->
        <a class="navbar-toggle">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <!-- End mobile menu toggle-->
    </div>
</div>