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

        $bookings = App\Models\Booking::where('vehicle_id', $vehicle_id)->get();

        $disabledDates = $bookings->flatMap(function ($booking) {
            // Convert pickUpDate and collectionDate to Carbon instances
            $startDate = Carbon\Carbon::parse($booking->pickUpDate);
            $endDate = Carbon\Carbon::parse($booking->collectionDate);

            // Generate an array of dates between start and end date (inclusive)
            $dates = [];
            while ($startDate <= $endDate) {
                $dates[] = $startDate->toDateString(); // Add the current date
                $startDate->addDay(); // Increment the date by 1 day
            }

            return $dates;
        })->unique()->toArray();

        $disabledDatesJson = json_encode($disabledDates);
        // Debug the result
        // dd($disabledDates);

    @endphp

    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/designesia.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
        let isHome = "{{ $isHome }}";

        let disabledDates = {!! $disabledDatesJson !!};
        console.log(disabledDates);

        // const disabledDates = ["2025-02-16", "2025-02-18", "2025-02-19", "2025-02-26"];

        $("#startDate").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            ...(isHome ?
            {
                onSelect: function(selectedDate) {
                    $("#endDate").datepicker("option", "minDate", selectedDate);
                    if ($("#endDate").val() && new Date(selectedDate) > new Date($("#endDate").val())) {
                        $("#endDate").val("");
                        $("#endTime").val("");
                    }
                getCombinedDateTime();
                    setTimeout(function() {
                        $("#endDate").datepicker("show");
                    }, 0);
                }
            }
            :
            {
                beforeShowDay: function(date) {
                    const formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
                    return [disabledDates.indexOf(formattedDate) === -1];
                },
                onSelect: function(selectedDate) {
                    const startDate = new Date(selectedDate);

                    // Sort disabled dates and find the next one after the selected start date
                    const sortedDisabledDates = disabledDates
                        .map(date => new Date(date))
                        .sort((a, b) => a - b);

                    let nextDisabledDate = null;
                    for (let date of sortedDisabledDates) {
                        if (date > startDate) {
                            nextDisabledDate = date;
                            break;
                        }
                    }

                    // Set the maximum date to the day before next disabled date
                    if (nextDisabledDate) {
                        const maxDate = new Date(nextDisabledDate);
                        maxDate.setDate(maxDate.getDate() - 1);
                        $("#endDate").datepicker("option", "maxDate", maxDate);
                    } else {
                        $("#endDate").datepicker("option", "maxDate", null);
                    }

                    // Set minimum end date to start date
                    $("#endDate").datepicker("option", "minDate", startDate);

                    // Clear end date if it's now invalid
                    const currentEndDate = $("#endDate").datepicker("getDate");
                    if (currentEndDate && nextDisabledDate && currentEndDate >= nextDisabledDate) {
                        $("#endDate").val("");
                        $("#endTime").val("");
                    }

                    getCombinedDateTime();
                    calculateDaysWeeksMonths();
                    calculateTotalPrice();
                }
            }),
        });

        $("#endDate").datepicker({
            dateFormat: "yy-mm-dd",
            minDate: 0,
            ...(isHome ? {
                onSelect: function(selectedDate) {
                    $("#startDate").datepicker("option", "maxDate", selectedDate);
                    if ($("#startDate").val() && new Date(selectedDate) < new Date($("#startDate").val())) {
                        $("#startDate").val("");
                        $("#startTime").val("");
                    }
                    getCombinedDateTime();
                }
            }
            :
            {
                beforeShowDay: function(date) {
                    const formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
                    const startDate = $("#startDate").datepicker("getDate");

                    if (!startDate) return [true];

                    // Find next disabled date after start date
                    const sortedDisabledDates = disabledDates
                        .map(date => new Date(date))
                        .sort((a, b) => a - b);

                    let nextDisabledDate = null;
                    for (let disabledDate of sortedDisabledDates) {
                        if (disabledDate > startDate) {
                            nextDisabledDate = disabledDate;
                            break;
                        }
                    }

                    // Check if current date is disabled or beyond next disabled date
                    const isDisabled = disabledDates.includes(formattedDate);
                    const isAfterNextDisabled = nextDisabledDate && date >= nextDisabledDate;

                    return [!isDisabled && !isAfterNextDisabled];
                },
                onSelect: function(selectedDate) {
                    getCombinedDateTime();
                    calculateDaysWeeksMonths();
                    calculateTotalPrice();
                }
            }),
        });

        $("#startTime, #endTime").timepicker({
            timeFormat: "HH:mm",
            interval: 30, // 30-minute interval
            minTime: "00:00",
            maxTime: "23:30",
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        function initializeDateTimePickers() {
            let sessionStartDate = "{{ session('startDate', '') }}";
            let sessionStartTime = "{{ session('startTime', '') }}";
            let sessionEndDate = "{{ session('endDate', '') }}";
            let sessionEndTime = "{{ session('endTime', '') }}";

            const now = new Date();
            const formattedNow = now.toISOString().split("T")[0];
            let formattedTime = now.getHours().toString().padStart(2, '0') + ":" + now.getMinutes().toString().padStart(2, '0');

            // Set the start date to session start date or current date
            const startDateToSet = sessionStartDate || formattedNow;
            $("#startDate").datepicker("setDate", startDateToSet);

            // Set the start time to session start time or current time
            $("#startTime").val(sessionStartTime || formattedTime);

            // Set the end date to session end date or 2 days after the start date
            let endDate = new Date(now);
            endDate.setDate(now.getDate() + 2);
            let formattedEndDate = endDate.toISOString().split("T")[0]; // Format end date

            // Check if isHome is false and adjust end date if it is in the disabled dates list
            if (!isHome) {
                formattedEndDate = $.datepicker.formatDate("yy-mm-dd", endDate);

                while (disabledDates.indexOf(formattedEndDate) !== -1) {
                    endDate.setDate(endDate.getDate() + 1);
                    formattedEndDate = $.datepicker.formatDate("yy-mm-dd", endDate);
                }
            }

            // Set the end date from session or the calculated one
            const endDateToSet = sessionEndDate || formattedEndDate;
            $("#endDate").datepicker("setDate", endDateToSet);

            // Set the end time to session end time or calculate it based on start time
            let endTime = new Date();
            endTime.setDate(endDate.getDate());
            if (endTime.getDate() === now.getDate()) {
                endTime.setMinutes(startTimeMinutes);
            } else {
                endTime.setHours(now.getHours());
                endTime.setMinutes(now.getMinutes() + 15);
            }

            const formattedEndTime = endTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            $("#endTime").val(sessionEndTime || formattedEndTime);

            // Call additional functions
            getCombinedDateTime();
            calculateDaysWeeksMonths();
            calculateTotalPrice();
        }


        function getCombinedDateTime() {
            const startDate = $("#startDate").val();
            const startTime = $("#startTime").val();
            const endDate = $("#endDate").val();
            const endTime = $("#endTime").val();

            let startDateTime = startDate && startTime? startDate + ' ' + startTime: "";
            let endDateTime = endDate && endTime? endDate + ' ' + endTime: "";

            return {
                start: startDateTime,
                end: endDateTime
            };
        }

        initializeDateTimePickers();

        function calculateDaysWeeksMonths() {
            let startDate = $("#startDate").val();
            let endDate = $("#endDate").val();

            if (!startDate || !endDate) return;

            startDate = new Date(startDate);
            endDate = new Date(endDate);

            // let totalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
            let totalDays = (startDate.getTime() === endDate.getTime()) ? 1 : Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

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
