<footer  style="background-color: #F5F5F5;border-top: 2px solid rgba(0,0,0,0.06) ;padding-top: 10px">
{{--    id="footer"--}}

    <div class="container" style="border-bottom: 1px solid rgba(0,0,0,0.06);">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap clearfix">

            <div class="col_two_third">

                <div class="widget clearfix">

                    <div class="widget-subscribe-form-result"></div>
                    <form id="widget-subscribe-form" action="include/subscribe" role="form" method="post" class="nobottommargin row clearfix">
                        {{ csrf_field() }}
                        <div class="col-lg-9">
                            <input type="email"    id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="sm-form-control required email" placeholder="Enter your Email to Subscribe to our Newsletter">
                            @if($errors->any())
                                <br>
                                <h5 id="subscribe-error" style="color: darkred">{{$errors->first()}}</h5>
                            @endif
                            @if(old('subscribe-success'))
                                <br>
                               <h5 id="subscribe-success" class="text-success">  {{old('subscribe-success') }}</h5>
                            @endif
                        </div>

                        <div class="col-lg-3">
                            <button class=" button button-rounded nomargin center btn-block   template-btn " type="submit" style="padding: 0px !important;">Subscribe</button>
                        </div>
                    </form>

                    <div class="line line-sm"></div>

                    <div class="clear-bottommargin-sm clearfix">
                        <div class="row">
                            <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                <ul>
                                    <li><a href="{{url(('/medical'))}}"><div>Home</div></a></li>
{{--                                    <li><a href="#">About</a></li>--}}
{{--                                    <li><a href="#">FAQs</a></li>--}}
{{--                                    <li><a href="#">Support</a></li>--}}
{{--                                    <li><a href="#">Contact</a></li>--}}
                                </ul>
                            </div>
                            <ul>


                                {{--                    <li><a href="demos/medical/about-us.html"><div>About Us</div></a></li>--}}

                                {{--                            demos/medical/departments.html--}}


                                {{--                    <li><a href="demos/medical/doctors.html"><div>Doctors</div></a>--}}
                                {{--                        <ul>--}}
                                {{--                            <li><a href="demos/medical/doctors-lists.html"><div>2 columns - List style</div></a></li>--}}
                                {{--                            <li><a href="demos/medical/doctors-3.html"><div>3 columns</div></a></li>--}}
                                {{--                            <li><a href="demos/medical/doctors.html"><div>4 columns</div></a></li>--}}
                                {{--                        </ul>--}}
                                {{--                    </li>--}}
                                {{--                    <li><a href="demos/medical/blog.html"><div>Blog</div></a></li>--}}
                                {{--                    <li><a href="demos/medical/contact.html"><div>Contact</div></a></li>--}}
                            </ul>

                            <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                <ul>
                                    <li><a href="{{url('/about')}}"><div>About Us</div></a></li>
                                    <li><a href="{{url('/contact')}}"><div>Contact</div></a></li>
                                    @auth   <li><a href="{{url('appointment')}}"><div>Order</div></a></li> @endauth
{{--                                    <li><a href="#">Portfolio</a></li>--}}
{{--                                    <li><a href="#">Blog</a></li>--}}
{{--                                    <li><a href="#">Events</a></li>--}}
{{--                                    <li><a href="#">Forums</a></li>--}}
                                </ul>
                            </div>

                            <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                <ul>
                                    <li style="margin-left:-3px" ><i class="fa fa-caret-down" aria-hidden="true"></i>
                                        <a href="{{url('departments')}} " class="no-bg"><div style="margin-left:-9px">Procedures</div></a></li>
                                    <li><a href="{{url('departments')}}">Ventilation-tubes</a></li>
                                    <li><a href="#">Knee replacment</a></li>
                                    <li><a href="#">Tonsillectomy</a></li>
{{--                                    <li><a href="#">One Page</a></li>--}}
                                </ul>
                            </div>

                            <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                <ul>
                                    <li><a href="{{url('doctors')}}"><div>Doctors</div></a>
{{--                                    <li><a href="#">Wedding</a></li>--}}
{{--                                    <li><a href="#">App Showcase</a></li>--}}
{{--                                    <li><a href="#">Magazine</a></li>--}}
{{--                                    <li><a href="#">Landing Page</a></li>--}}
                                </ul>
                            </div>




                        </div>
                    </div>

                </div>

            </div>

            <div class="col_one_third col_last">

                <div class="widget clear-bottommargin-sm clearfix">

                    <div class="row">

                        <div class="col-lg-12 bottommargin-sm">
                            <div class="footer-big-contacts">
                                <span>Call Us:</span>
                                +972-77-5523404
                            </div>
                        </div>

                        <div class="col-lg-12 bottommargin-sm">
                            <div class="footer-big-contacts">
                                <span>Send an Email:</span>
                                office@serenusai.com
                            </div>
                        </div>

                    </div>

                </div>

                <div class="widget subscribe-widget clearfix">
                    <div class="row">

                        <div class="col-lg-6 clearfix bottom margin-sm">
                            <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                <i class="icon-facebook"></i>
                                <i class="icon-facebook"></i>
                            </a>
                            <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                        </div>
                        <div class="col-lg-6 clearfix">
                            <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                                <i class="icon-rss"></i>
                                <i class="icon-rss"></i>
                            </a>
                            <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                        </div>

                    </div>
                </div>

            </div>

        </div><!-- .footer-widgets-wrap end -->

    </div>

    <!-- Copyrights
    ============================================= -->
    <div id="copyrights" class="nobg">

        <div class="container clearfix">

            <div class="col_half">
                Copyrights &copy; 2014 All Rights Reserved by Canvas Inc.<br>
                <div class="copyright-links"><a href="{{url(('/about'))}}">Terms of Use</a> / <a href="{{url(('/about'))}}">Privacy Policy</a></div>
            </div>

            <div class="col_half col_last tright">
                <div class="copyrights-menu copyright-links clearfix">
                    <a href="{{url(('/medical'))}}"><div>Home</div></a>
                    /
                    <a href="{{url(('/about'))}}">About Us</a>
                    /
              @auth <a href="{{url('appointment')}}"><div>Order</div></a>
                    / @endauth
                    <a href="{{url('doctors')}}"><div>Doctors</div></a>
                    /
                    <a href="{{url('contact')}}"><div>Contact</div></a>
{{--                    /<a href="#">Clients</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>--}}
                </div>
            </div>

        </div>

    </div><!-- #copyrights end -->

</footer><!-- #footer end -->
