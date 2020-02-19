<div id="top-bar">

    <div class="container clearfix">

        <div class="col_half d-none d-md-block nobottommargin">

            <!-- Top Links
            ============================================= -->
            <div class="top-links">
                <ul>
{{--                    <li><a href="#"><i class="icon-time"></i> Timings</a></li>--}}
                    <li><a href="#"><i class="icon-phone3"></i> +972-77-5523404</a></li>
                    <li><a href="#" class="nott"><i class="icon-envelope2"></i> office@serenusai.com</a></li>
                </ul>
            </div><!-- .top-links end -->

        </div>

        <div class="col_half col_last fright nobottommargin">

            <!-- Top Links
            ============================================= -->
            <div class="top-links">
                <ul>
                    <li><a href="#">EN</a>
                        {{--								<ul>--}}
                        {{--									<li><a href="#"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>--}}
                        {{--									<li><a href="#"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>--}}
                        {{--									<li><a href="#"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>--}}
                        {{--								</ul>--}}
                    </li>
                    <li><a href="{{url('contact')}}"  data-scrollto="#booking-appointment-form" data-offset="100" data-easing="easeInOutExpo" data-speed="1200" class="bgcolor" style="color:#fff;">Book an Appointment</a></li>
                </ul>
            </div><!-- .top-links end -->

        </div>

    </div>

</div><!-- #top-bar end -->

<header id="header">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder" style="font-size: 50px;margin-top: -3px;"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo" style="max-width: 300px">
                {{--						<a href="index.html" class="standard-logo"><img src="demos/medical/images/logo-medical.png" alt="Canvas Logo"></a>--}}
                <a href="index.html" style="text-align: left;height: 90px" class="standard-logo" data-dark-logo="assets/images/serenus logo _left.svg"><img src="{{asset('assets/images/logo/MySerenusLOGO3.jpg')}}"    alt="Canvas Logo"></a>
                {{--						<a href="index.html" class="retina-logo"><img src="demos/medical/images/logo-medical@2x.png" alt="Canvas Logo"></a>--}}
                <a href="index.html" style="text-align: left" class="retina-logo" data-dark-logo="assets/images/serenus logo _left.svg"><img src="{{asset('assets/images/logo/MySerenusLOGO3.jpg')}}"    alt="Canvas Logo"></a>
            </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu" class="style-3">

                <ul>
                    <li><a href="{{url(('/medical'))}}"><div>Home</div></a></li>
                    <li><a href="{{url('/about')}}"><div>About Us</div></a></li>
{{--                    <li><a href="demos/medical/about-us.html"><div>About Us</div></a></li>--}}
{{--                    <li><a href="{{url('departments')}}"><div>Procedures</div></a></li>--}}
{{--                            demos/medical/departments.html--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Procedures
                        </a>
                        <ul class="dropdown-menu" role="menu" x-placement="bottom-start" style="padding:5px;width:80px;position: absolute; transform: translate3d(0px, 70px, 0px); top: 0px; left: -5px; will-change: transform;">
                            <a class="dropdown-item"  href="{{url('departments')}}">Ventilation tubes</a>
                            <a class="dropdown-item" href="#">Knee replacement</a>
                            <a class="dropdown-item" href="#">Tonsillectomy</a>
{{--                            <div class="dropdown-divider"></div>--}}
{{--                            <a class="dropdown-item" href="#">Separated link</a>--}}
                        </ul>
                    </li>
                    @auth
{{--                        // The user is authenticated...--}}
                        <li><a href="{{url('appointment')}}"><div>Order</div></a></li>
                    @endauth
                    <li><a href="{{url('doctors')}}"><div>Doctors</div></a>
{{--                    <li><a href="demos/medical/doctors.html"><div>Doctors</div></a>--}}
{{--                        <ul>--}}
{{--                            <li><a href="demos/medical/doctors-lists.html"><div>2 columns - List style</div></a></li>--}}
{{--                            <li><a href="demos/medical/doctors-3.html"><div>3 columns</div></a></li>--}}
{{--                            <li><a href="demos/medical/doctors.html"><div>4 columns</div></a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li><a href="demos/medical/blog.html"><div>Blog</div></a></li>--}}
{{--                    <li><a href="demos/medical/contact.html"><div>Contact</div></a></li>--}}
                                        <li><a href="{{url('contact')}}"><div>Contact</div></a></li>
                </ul>

            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header>
