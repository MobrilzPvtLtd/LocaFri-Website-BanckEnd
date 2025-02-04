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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
            min-width: 160px;
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
        $pickUpDate = session()->get('pickUpDate');
    @endphp

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            var totalVal = parseFloat($("#totalPrice").val()) || 0;
            var dayVal = parseFloat($("#Dprice").val()) || 0;
            var weekVal = parseFloat($("#wprice").val()) || 0;
            var monthVal = parseFloat($("#mprice").val()) || 0;
            var additionalDriverVal = parseFloat($("#additionalDriverCheckbox").val()) || 0;
            var boosterSeatVal = parseFloat($("#boosterSeatCheckbox").val()) || 0;
            var childSeatVal = parseFloat($("#childSeatCheckbox").val()) || 0;
            var exitPermitVal = parseFloat($("#exitPermitCheckbox").val()) || 0;

            function calculateTotalPrice() {
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

                console.log("Total Price: $" + totalPrice);
            }

            calculateTotalPrice();

            $("#additionalDriverCheckbox, #boosterSeatCheckbox, #childSeatCheckbox, #exitPermitCheckbox").change(function() {
                calculateTotalPrice();
            });

            $("#counter001, #counter002, #counter003").on('input', function() {
                calculateTotalPrice();
            });

            var pickUpDate = "{{ $pickUpDate }}";

            if (pickUpDate) {
                var dates = pickUpDate.split(' - ');
                var startDate = moment(dates[0], 'DD/M/YY h:mm A');
                var endDate = moment(dates[1], 'DD/M/YY h:mm A');

                $('input[name="pickUpDate"]').daterangepicker({
                    timePicker: true,
                    startDate: startDate,
                    endDate: endDate,
                    minDate: moment(),
                    locale: {
                        format: 'DD/M/YY h:mm A'
                    }
                }, function(start, end) {
                    calculateDateRangeStats(start, end);
                });

                calculateDateRangeStats(startDate, endDate);

            }else{
                $('input[name="pickUpDate"]').daterangepicker({
                    timePicker: true,
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    minDate: moment(),
                    locale: {
                        format: 'DD/M/YY h:mm A'
                    }
                });
            }
            function calculateDateRangeStats(startDate, endDate) {
                const startMoment = moment(startDate);
                const endMoment = moment(endDate);

                const totalDays = endMoment.diff(startMoment, "days") + 1; // Total days including start and end

                // Approximate months (assuming 30 days per month)
                const totalMonths = Math.floor(totalDays / 30);
                const remainingDaysAfterMonths = totalDays - totalMonths * 30;

                // Calculate weeks from remaining days after months
                const percentileWeeks = Math.floor(remainingDaysAfterMonths / 7);

                // Calculate remaining days
                const remainingDays = remainingDaysAfterMonths - percentileWeeks * 7;

                $("#counter003").val(totalMonths);
                $("#counter002").val(percentileWeeks);
                $("#counter001").val(remainingDays);

                calculateTotalPrice();
            }
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
