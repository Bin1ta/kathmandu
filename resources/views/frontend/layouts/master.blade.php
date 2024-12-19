<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/utils.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        .modal-content {
            min-height: auto;
            border: 0;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
@include('frontend.partials.header_middle')
<div>
    @yield('content')
</div>

{{--@include('frontend.partials.digital_board_footer')--}}

<x-popup-setting-component :ward="request('ward')"/>

<script src="{{ asset('assets/frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/simplyScroll.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 1,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    });
</script>
@stack('scripts')

</body>

</html>
