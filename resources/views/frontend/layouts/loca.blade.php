<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->currentLocale()) }}" dir="{{ language_direction() }}">

<head>
    <meta charset="utf-8" />
    <link href="{{ asset('img/favicon.png') }}" rel="apple-touch-icon" sizes="76x76">
    <link type="image/png" href="{{ asset('img/favicon.png') }}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    @include('frontend.includes.meta')

    <!-- Shortcut Icon -->
    <link href="{{ asset('img/favicon.png') }}" rel="shortcut icon">
    <link type="image/ico" href="{{ asset('img/favicon.png') }}" rel="icon" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap" />
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" type="text/css" id="mdb" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/coloring.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/newStyle.css') }}" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <link id="colors" href="{{ asset('css/colors/scheme-01.css') }}" rel="stylesheet" type="text/css" />

    <x-google-analytics />

    @yield('style')
</head>

<body onload="initialize()">
<div id="wrapper">

<div id="de-preloader"></div>

    @include('frontend.includes.header')


    @yield('content')

    <a href="#" id="back-to-top"></a>

    @include('frontend.includes.footer')

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>

    @yield('script')

    <script
        src="https://maps.googleapis.com/maps/api/js?key=insert_your_api_key_here&libraries=places&callback=initPlaces"
        async="" defer="">
    </script>
    <script>
        const value2 = document.querySelector("#counter001")
        const minus = document.querySelector("#minus")
        const plus = document.querySelector("#plus")
        plus.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value2.value= parseInt(value2.value) + 1;
        }))
        minus.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value2.value= parseInt(value2.value) - 1;

        }))
        const value3 = document.querySelector("#counter002")
        const minus1 = document.querySelector("#minus1")
        const plus1 = document.querySelector("#plus1")
        plus1.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value3.value= parseInt(value3.value) + 1;
        }))
        minus1.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value3.value= parseInt(value3.value) - 1;

        }))
        const value4 = document.querySelector("#counter003")
        const minus2 = document.querySelector("#minus2")
        const plus2 = document.querySelector("#plus2")
        plus2.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value4.value= parseInt(value4.value) + 1;
        }))
        minus2.addEventListener("click" , ((e)=>{
            e.preventDefault()
            value4.value= parseInt(value4.value) - 1;

        }))

    </script>
</div>

</body>

</html>
