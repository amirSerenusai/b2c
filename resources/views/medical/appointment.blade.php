

<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="api-base-url" content="<?php echo e(url('/')); ?>" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    @component('medical.css')@endcomponent
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title> Order | Online Medical procedures </title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
{{--@component('medical.header')@endcomponent--}}
@component('medical.new-header')@endcomponent
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
    <section id="content" style="margin-bottom: 0px;">

        <div class="content-wrap">

            <div class="container clearfix">
                <ul class="process-steps process-5 clearfix d-none d-sm-block">
                    <li>
                        <a href="#" class="  i-circled divcenter  icon-shopping-cart"></a>
{{--                        <h5>Review Cart</h5>--}}
                        <h5>Get Access Link </h5>
                    </li>
                    <li class="active">
                        <a href="#" class="i-bordered i-circled divcenter bgcolor   icon-money"></a>
{{--                        <h5>Pa Shipping Info</h5>--}}
                        <h5>Complete Payment</h5>
                    </li>
                    <li>
                        <a href="#" class="i-bordered i-circled divcenter  icon-pencil2"></a>
                        <h5>Fill Your Case details</h5>
                    </li>
                    <li >
                        <a href="#" class=" i-bordered  i-circled   divcenter  icon-like"></a>
{{--                        bgcolor--}}
{{--                        <h5>Complete Payment</h5>--}}
                            <h5>Get immediate results</h5>
                    </li>
                    <li>
                        <a href="#" class="i-bordered i-circled divcenter icon-ok"></a>
                        <h5>Order Complete</h5>
                    </li>
                </ul>

                 <div class="fancy-title title-dotted-border title-center">
                    <h3>Claim my ******** medical report!</h3>
                </div>

                <div class="pricing-box pricing-extended bottommargin clearfix">

                    <div class="pricing-desc">
                        <div class="pricing-title">
                            <h3>What do you get ?</h3>
                        </div>
                        <div class="pricing-features">
                            <ul class="clearfix">
                                <li><i class="icon-desktop"></i> A professional personalized report.</li>
                                <li><i class="icon-eye-open"></i> A list of all the critical factors that you should consider before a risky procedure.</li>
                                <li><i class="icon-beaker"></i> A list of all the critical factors that you should consider before a risky procedure.</li>
                                <li><i class="icon-magic"></i> Tons of Customization Options</li>
                                <li><i class="icon-font"></i> Most updated evidence based medical practices.</li>
                                <li><i class="icon-stack3"></i> Information of alternative conservative measures.</li>
                                <li><i class="icon-file2"></i> An analysis of AI-based awarded technology.</li>
                                <li><i class="icon-support"></i> 24x7 Priority Email Support</li>
                            </ul>
                        </div>
                    </div>

                    <div class="pricing-action-area">
                        <div class="pricing-meta">
                            As Low as
                        </div>
                        <div class="pricing-price">
                            <span class="price-unit">€</span>39<span class="price-tenure">monthly</span>
                        </div>
                        <div class="pricing-action">
{{--                            <a href="#" class="button button-3d button-xlarge btn-block nomargin">Get Started</a>--}}
                            @component('components.paypal')@endcomponent
                        </div>
                    </div>

                </div>




            </div>

        </div>

    </section>
    <!-- Footer
    ============================================= -->
    @component('medical.footer')@endcomponent

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="js/functions.js"></script>
<script
    src="https://www.paypal.com/sdk/js?client-id=AWWvO4Q-DF5tlKHNHyYbswCtg-XupvenY2I-bzixwH3ICH_j_K29bsQWAFryXlt5Iifmn6-kol_dGam8"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>

<script src="js/paypal.js"></script>
{{--<script>--}}

{{--    // $('body').addClass('body-order');--}}
{{--    paypal.Buttons({--}}
{{--        createOrder: function(data, actions) {--}}
{{--            return actions.order.create({--}}
{{--                purchase_units: [{--}}
{{--                    amount: {--}}
{{--                        value: '0.01'--}}
{{--                    }--}}
{{--                }]--}}
{{--            });--}}
{{--        },--}}
{{--        onApprove: function(data, actions) {--}}
{{--            return actions.order.capture().then(function(details) {--}}
{{--                console.log({data , details})--}}
{{--                alert('Transaction completed by ' + details.payer.name.given_name);--}}
{{--                // Call your server to save the transaction--}}
{{--                return fetch('{{url("/api/paypal-transaction-complete")}}', {--}}
{{--                    method: 'post',--}}
{{--                    headers: {--}}
{{--                        'content-type': 'application/json' ,--}}
{{--                     //'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').getAttribute('content')--}}
{{--                    },--}}
{{--                    body: JSON.stringify({--}}
{{--                        orderID: data.orderID,--}}
{{--                        --}}{{--token :  '{!! csrf_token() !!}'--}}
{{--                    })--}}
{{--                });--}}
{{--            });--}}
{{--        }--}}
{{--    }).render('#paypal-button-container');--}}


{{--</script>--}}

</body>
</html>
