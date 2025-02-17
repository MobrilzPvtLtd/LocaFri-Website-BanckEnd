<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->currentLocale()) }}" dir="{{ language_direction() }}">

<head>
    <meta charset="utf-8" />
    <link href="{{ asset('img/favicon.png') }}" rel="apple-touch-icon" sizes="76x76">
    <link type="image/png" href="{{ asset('img/favicon.png') }}" rel="icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title') | Locafri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Locafri">
    <meta name="keyword" content="Locafri">
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

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <x-google-analytics />

    <style>
        .custom-dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-button {
            background-color: var(--primary-color);
            color: black;
            padding: 4px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 98px;
            z-index: 1;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        .dropdown-item {
            padding: 8px 16px;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
        }

        .dropdown-item img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .dropdown-item:hover {
            background-color: #ddd;
        }

        .custom-dropdown:hover .dropdown-content {
            display: block;
        }

    </style>

    @yield('style')
</head>

<body onload="initialize()">
<div id="wrapper">

<div id="de-preloader"></div>

    @include('frontend.includes.header')


    @yield('content')

    <a href="#" id="back-to-top"></a>

    @include('frontend.includes.footer')

    @php
        $isHome = request()->routeIs('frontend.index');
        // $pickUpDate = session()->get('pickUpDate');
        $startDate = session()->get('startDate');
        $startTime = session()->get('startTime');
        $endDate = session()->get('endDate');
        $endTime = session()->get('endTime');
        $vehicle_id = session()->get('vehicle_id');

        $vehi = App\Models\Booking::where('vehicle_id', $vehicle_id)->first();
        // dd($vehi);
    @endphp

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
  $(function () {
    let dailyRate = parseFloat($("#dailyRate").val()) || 50; // Default 50

    $("#startDate").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        beforeShowDay: function(date) {
            return [date >= new Date(), ""];
        },
        onSelect: function (selectedDate) {
            let minEndDate = new Date(selectedDate);
            minEndDate.setDate(minEndDate.getDate() + 1);

            $("#endDate").datepicker("option", "minDate", minEndDate);

            if (!$("#endDate").val() || new Date($("#endDate").val()) < minEndDate) {
                $("#endDate").datepicker("setDate", minEndDate);
            }

            getCombinedDateTime();
            calculateDaysWeeksMonths();
            calculateTotalPrice();
        }
    });

    $("#startDate").change(function () {
        let selectedDate = new Date($(this).val());
        let today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            alert("Past date selection is not allowed!");
            $(this).datepicker("setDate", today);
        }
    });

    $("#endDate").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 1,
        onSelect: function (selectedDate) {
            let maxStartDate = new Date(selectedDate);
            maxStartDate.setDate(maxStartDate.getDate() - 1);

            $("#startDate").datepicker("option", "maxDate", maxStartDate);

            getCombinedDateTime();
            calculateDaysWeeksMonths();
            calculateTotalPrice();
        }
    });

    function getCombinedDateTime() {
        const startDate = $("#startDate").val();
        const startTime = $("#startTime").val();
        const endDate = $("#endDate").val();
        const endTime = $("#endTime").val();

        let startDateTime = startDate && startTime ? startDate + ' ' + startTime : "Not set";
        let endDateTime = endDate && endTime ? endDate + ' ' + endTime : "Not set";

        $("#dateTimeRange").html("Selected Range: " + startDateTime + " - " + endDateTime);
    }

    function calculateDaysWeeksMonths() {
        let startDate = $("#startDate").val();
        let endDate = $("#endDate").val();

        if (!startDate || !endDate) return;

        startDate = new Date(startDate);
        endDate = new Date(endDate);

        let totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

        let months = Math.floor(totalDays / 30);
        let weeks = Math.floor((totalDays % 30) / 7);
        let days = totalDays - (months * 30) - (weeks * 7);

        $("#counter003").val(months);
        $("#counter002").val(weeks);
        $("#counter001").val(days);
    }

    function calculateTotalPrice() {
        var dayVal = parseFloat($("#Dprice").val()) || 0;
        var weekVal = parseFloat($("#wprice").val()) || 0;
        var monthVal = parseFloat($("#mprice").val()) || 0;

        var additionalDriverVal = parseFloat($("#additionalDriverCheckbox").val()) || 0;
        var boosterSeatVal = parseFloat($("#boosterSeatCheckbox").val()) || 0;
        var childSeatVal = parseFloat($("#childSeatCheckbox").val()) || 0;
        var exitPermitVal = parseFloat($("#exitPermitCheckbox").val()) || 0;

        var dayCount = parseFloat($("#counter001").val()) || 0;
        var weekCount = parseFloat($("#counter002").val()) || 0;
        var monthCount = parseFloat($("#counter003").val()) || 0;

        var totalPriceDay = dayCount * dayVal;
        var totalPriceWeek = weekCount * weekVal;
        var totalPriceMonth = monthCount * monthVal;

        var totalPrice = totalPriceDay + totalPriceWeek + totalPriceMonth;

        if ($("#additionalDriverCheckbox").is(':checked')) {
            totalPrice += additionalDriverVal;
        }

        if ($("#boosterSeatCheckbox").is(':checked')) {
            totalPrice += boosterSeatVal;
        }

        if ($("#childSeatCheckbox").is(':checked')) {
            totalPrice += childSeatVal;
        }

        if ($("#exitPermitCheckbox").is(':checked')) {
            totalPrice += exitPermitVal;
        }

        totalPrice = totalPrice.toFixed(2);

        $("#totalPrice").val(totalPrice);
        $("#totalPriceDisplay").text(totalPrice);
    }

    $("#additionalDriverCheckbox, #boosterSeatCheckbox, #childSeatCheckbox, #exitPermitCheckbox").change(function () {
        calculateTotalPrice();
    });

    function initializeDateTimePickers() {
        let sessionStartDate = "{{ session('startDate', '') }}";
        let sessionStartTime = "{{ session('startTime', '') }}";
        let sessionEndDate = "{{ session('endDate', '') }}";
        let sessionEndTime = "{{ session('endTime', '') }}";

        const now = new Date();
        const formattedNow = now.toISOString().split("T")[0];
        let formattedTime = now.getHours().toString().padStart(2, '0') + ":" + now.getMinutes().toString().padStart(2, '0');

        const endDate = new Date(now);
        endDate.setDate(now.getDate() + 2);
        const formattedEndDate = endDate.toISOString().split("T")[0];

        if (!sessionStartDate || new Date(sessionStartDate) < new Date(formattedNow)) {
            sessionStartDate = formattedNow;
        }

        $("#startDate").datepicker("setDate", sessionStartDate);
        $("#startTime").val(sessionStartTime || formattedTime);

        $("#endDate").datepicker("setDate", sessionEndDate || formattedEndDate);
        $("#endTime").val(sessionEndTime || formattedTime);

        getCombinedDateTime();
        calculateDaysWeeksMonths();
        calculateTotalPrice();
    }

    initializeDateTimePickers();

    // **Fixed Time Picker Initialization**
    $("#startTime, #endTime").timepicker({
        timeFormat: "HH:mm",
        interval: 30, // 30-minute interval
        minTime: "00:00",
        maxTime: "23:30",
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

});


</script>


    @yield('script')

    <script
        src="https://maps.googleapis.com/maps/api/js?key=insert_your_api_key_here&libraries=places&callback=initPlaces"
        async="" defer="">
    </script>
    {{-- <script>
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

    </script> --}}

</div>

</body>

</html>
