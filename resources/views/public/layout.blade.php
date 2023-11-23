<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="{{ asset('assets/admin/logo/errandia-logo.png') }}" type="image/x-icon">
    <title>{{ env('APP_NAME') ?? 'Errandia' }}</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('assets/public/assets/css/animate.min.css') }}" />

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/font-awesome.css') }}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/feather-icon.css') }}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/slick/slick-theme.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/public/assets/css/style.css') }}">

    
    <!-- Plugin CSS file with desired skin css -->
    <link rel="stylesheet" href="{{ asset('assets/public/assets/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">

    <style>
    .no-scrollbar::-webkit-scrollbar{
        display: none;
    }
    .line-clamp-3{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
    }
    </style>
</head>


<body class="bg-effect">

@include('components.header')
    
    <!-- Main Content start -->
    @yield('section')
    <!-- Main Content end -->

   @include('components.footer')

    <script>
        let showErrandModal = function(event){
            $('#errandModal').modal().show();
        }
    </script>

    <!-- latest jquery-->
    <script src="{{ asset('assets/public/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('assets/public/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/public/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/public/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('assets/public/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('assets/public/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('assets/public/assets/js/auto-height.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/public/assets/js/timer1.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('assets/public/assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('assets/public/assets/js/quantity-2.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('assets/public/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('assets/public/assets/js/script.js') }}"></script>





    {{-- ADDITIONAL --}}
    <!-- Slick js-->
    <script src="{{ asset('assets/public/assets/js/custom-slick-animated.js') }}"></script>

    <!-- Range slider js -->
    <script src="{{ asset('assets/public/assets/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('assets/public/assets/js/timer2.js') }}"></script>

    <!-- Copy clipboard Js -->
    <script src="{{ asset('assets/public/assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/copy-clipboard.js') }}"></script>


    <!-- sidebar open js -->
    <script src="{{ asset('assets/public/assets/js/filter-sidebar.js') }}"></script>

    <!-- Zoom Js -->
    <script src="{{ asset('assets/public/assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/public/assets/js/zoom-filter.js') }}"></script>

    <!-- Sticky-bar js -->
    <script src="{{ asset('assets/public/assets/js/sticky-cart-bottom.js') }}"></script>
    <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>

    @yield('script')
</body>

</html>