
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    @component('medical.css')@endcomponent
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Job Openings | Canvas</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
@component('medical.header')@endcomponent

    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="page-title-parallax page-title-dark" style="background-image: url('images/about/parallax.jpg'); padding: 80px 0;" data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">

        <div class="container clearfix">
            <h1>Special offer</h1>
            <span>Join our Fabulous Team of Intelligent Individuals</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_three_fifth nobottommargin">

                    <div class="fancy-title title-bottom-border">
                        <h3>CLAIM MY SPECIAL OFFER AND GET MY REPORT</h3>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo, natus voluptatibus adipisci porro magni dolore eos eius ducimus corporis quos perspiciatis quis iste, vitae autem libero ullam omnis cupiditate quam.</p>

                    <div class="d-flex t600 ml-2 mb-0 p-2 h5 text-dark center justify-content-center align-items-center" style="background: url('demos/medical/images/brush.png')no-repeat center center / cover; width: 180px; height: 50px; margin-bottom: 20px !important;"><span class="align-self-center">
                       <div class="product-price"><del >$599.99</del>&nbsp;   <ins>$59.99</ins></div>
                        </span></div>

                    <div class="accordion accordion-bg clearfix">

                        <div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>What do you get?</div>
                        <div class="acc_content clearfix">
                            <ul class="iconlist iconlist-color nobottommargin">
                                <li><i class="icon-ok"></i>A professional personalized report.</li>
                                <li><i class="icon-ok"></i>A list of all the critical factors that you should consider before a risky procedure.</li>
                                <li><i class="icon-ok"></i>A list of all the critical factors that you should consider before a risky procedure.</li>
                                <li><i class="icon-ok"></i>Most updated evidence based medical practices.</li>
                                <li><i class="icon-ok"></i>Information of alternative conservative measures.</li>
                                <li><i class="icon-ok"></i>An analysis of AI-based awarded technology.</li>

                            </ul>
                        </div>

                        <div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>What we Expect from you?</div>
                        <div class="acc_content clearfix">
                            <ul class="iconlist iconlist-color nobottommargin">
                                <li><i class="icon-plus-sign"></i>Design and build applications/ components using open source technology.</li>
                                <li><i class="icon-plus-sign"></i>Taking complete ownership of the deliveries assigned.</li>
                                <li><i class="icon-plus-sign"></i>Collaborate with cross-functional teams to define, design, and ship new features.</li>
                                <li><i class="icon-plus-sign"></i>Work with outside data sources and API's.</li>
                                <li><i class="icon-plus-sign"></i>Unit-test code for robustness, including edge cases, usability, and general reliability.</li>
                                <li><i class="icon-plus-sign"></i>Work on bug fixing and improving application performance.</li>
                            </ul>
                        </div>

                        <div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>What you've got?</div>
                        <div class="acc_content clearfix">You'll be familiar with agile practices and have a highly technical background, comfortable discussing detailed technical aspects of system design and implementation, whilst remaining business driven. With 5+ years of systems analysis, technical analysis or business analysis experience, you'll have an expansive toolkit of communication techniques to enable shared, deep understanding of financial and technical concepts by diverse stakeholders with varying backgrounds and needs. In addition, you will have exposure to financial systems or accounting knowledge.</div>

                    </div>

                    <p>Repudiandae quasi perspiciatis ea placeat nobis asperiores quod fuga ipsa facere enim ipsum expedita debitis, sit quia adipisci deserunt vitae hic obcaecati voluptates rerum nihil.</p>



{{--                    <a href="#" data-scrollto="#job-apply" data-highlight="yellow" class="button button-3d button-black nomargin">Apply Now</a>--}}

                </div>

                <div class="col_two_fifth nobottommargin col_last">

                   @component('components.paypal')@endcomponent

                </div>

            </div>

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    @component('medical.footer')@endcomponent

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="js/functions.js"></script>
<script
    src="https://www.paypal.com/sdk/js?client-id=AWWvO4Q-DF5tlKHNHyYbswCtg-XupvenY2I-bzixwH3ICH_j_K29bsQWAFryXlt5Iifmn6-kol_dGam8"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
<script>

    // $('body').addClass('body-order');
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.01'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name);
                // Call your server to save the transaction
                return fetch('{{url("/api/paypal-transaction-complete")}}', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });
            });
        }
    }).render('#paypal-button-container');


</script>

</body>
</html>
