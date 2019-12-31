<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Electronics - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

	@include('layouts.frontend_layouts.frontend_css')

</head>

<body>
    <div class="notification-section notification-section-padding  notification-img ptb-10">
        <div class="container-fluid">
            <div class="notification-wrapper">
                <div class="notification-pera-graph">
                    <p>Get A big Discount for Gadgets. 10% to 70% Discount for all products. Save money</p>
                </div>
                <div class="notification-btn-close">
                    <div class="notification-btn">
                        <a href="#">Shop Now</a>
                    </div>
                    <div class="notification-close notification-icon">
                        <button><i class="pe-7s-close"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@include('layouts.frontend_layouts.frontend_header')
	<!--main-container-part-->
	@yield('content')
	<!--end-main-container-part-->

	<!--Footer-part-->

	@include('layouts.frontend_layouts.frontend_footer')

	<!--end-Footer-part-->
	@include('layouts.frontend_layouts.frontend_js')

	<!-- Custoom Scripts on Pages -->
	@yield('scripts')
	<!-- Custoom Scripts on Pages End -->
</body>

</html>