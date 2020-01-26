<header id="header">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

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
                    <li><a href="demos/medical/about-us.html"><div>About Us</div></a></li>
                    <li><a href="{{url('departments')}}"><div>Procedures</div></a></li>
                    {{--                            demos/medical/departments.html--}}
                    <li><a href="{{url('appointment')}}"><div>Order</div></a></li>
                    <li><a href="demos/medical/doctors.html"><div>Doctors</div></a>
                        <ul>
                            <li><a href="demos/medical/doctors-lists.html"><div>2 columns - List style</div></a></li>
                            <li><a href="demos/medical/doctors-3.html"><div>3 columns</div></a></li>
                            <li><a href="demos/medical/doctors.html"><div>4 columns</div></a></li>
                        </ul>
                    </li>
                    <li><a href="demos/medical/blog.html"><div>Blog</div></a></li>
                    <li><a href="demos/medical/contact.html"><div>Contact</div></a></li>
                </ul>

            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header>
