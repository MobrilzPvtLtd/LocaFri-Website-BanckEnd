@extends('backend.layouts.app')

@section('content')
    <style>
        .card {
            margin-bottom: 15px;
        }

        /* Basic styling for the selected options */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff; /* Bootstrap primary color */
            border: 1px solid #0056b3; /* Darker shade for border */
            color: #fff;
            padding: 0 5px;
            margin-top: 3px;
            border-radius: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-right: 2px;
        }

        /* Darker/Brighter background for selected options *within the dropdown* */
        .select2-results__option[aria-selected="true"] {
            background-color: #0056b3 !important; /*Darker background*/
            color: #fff !important; /*White text for contrast*/
        }
    </style>

    {{-- Main Content (Matrix Chart) --}}
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4">Vehicle Bookings</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('backend.analytics', ['date' => $currentDate->copy()->subDays(6)->format('Y-m-d'), 'start_date' => $startDateFilter ?? '', 'end_date' => $endDateFilter ?? '', 'vehicle_id' => $vehicleFilter ?? [], 'special_date_filter' => $specialDateFilter ?? '']) }}"
                   class="btn btn-secondary btn-sm">
                    « Previous 5 Days
                </a>
                <span class="text-center">{{ $currentDate->format('Y-m-d') }}</span>
                <a href="{{ route('backend.analytics', ['date' => $currentDate->copy()->addDays(6)->format('Y-m-d'), 'start_date' => $startDateFilter ?? '', 'end_date' => $endDateFilter ?? '', 'vehicle_id' => $vehicleFilter ?? [], 'special_date_filter' => $specialDateFilter ?? '']) }}"
                   class="btn btn-secondary btn-sm">
                    Next 5 Days »
                </a>
            </div>

            {{-- Chart Container --}}
            <div class="row">
                <div class="col-12">
                    <div id="matrix-chart" class="overflow-auto"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{-- Share Options --}}
            <div class="d-flex justify-content-end">
                <form method="POST" action="{{ route('backend.analytics.export') }}">
                    @csrf
                    <input type="hidden" name="matrix_data" id="matrix_data_export" value="">
                    <button type="submit" class="btn btn-success btn-sm mr-2" id="export_button">Export as CSV</button>
                </form>

                <a href="#" class="btn btn-info btn-sm" id="share_email">Share via Email</a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Filter Sidebar --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Date Range Filter:</h5>
                    <form method="GET" action="{{ route('backend.analytics') }}">
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control form-control-sm" id="start_date" name="start_date"
                                   value="{{ $startDateFilter ?? '' }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control form-control-sm" id="end_date" name="end_date"
                                   value="{{ $endDateFilter ?? '' }}">
                        </div>
                        <br>
                        <input type="hidden" name="vehicle_id[]" value="{{ implode(',',$vehicleFilter) ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filter</button>
                        <a href="{{ route('backend.analytics') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </form>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vehicle Filter:</h5>
                    <br>
                    <form method="GET" action="{{ route('backend.analytics') }}">

                        <div class="form-group">
                            <label for="vehicle_id">Select Vehicles:</label>
                            <select class="form-control form-control-sm select2" id="vehicle_id" name="vehicle_id[]"
                                    multiple>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ in_array($vehicle->id, $vehicleFilter) ? 'selected' : '' }}>
                                        {{ $vehicle->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="start_date" value="{{ $startDateFilter ?? '' }}">
                        <input type="hidden" name="end_date" value="{{ $endDateFilter ?? '' }}">
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm">Apply
                            Vehicle Filter
                        </button>
                        <a href="{{ route('backend.analytics') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </form>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special Date Filter:</h5>
                    <form method="GET" action="{{ route('backend.analytics') }}">

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="special_date_filter"
                                       id="start_date_filter" value="start_date" {{ $specialDateFilter === 'start_date' ? 'checked' : '' }}>
                                <label class="form-check-label" for="start_date_filter">
                                    Bookings Starting Today/Tomorrow
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="special_date_filter"
                                       id="end_date_filter" value="end_date" {{ $specialDateFilter === 'end_date' ? 'checked' : '' }}>
                                <label class="form-check-label" for="end_date_filter">
                                    Bookings Ending Today/Tomorrow
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="special_date_filter" id="no_filter"
                                       value="" {{ empty($specialDateFilter) ? 'checked' : '' }}>
                                <label class="form-check-label" for="no_filter">
                                    No Special Date Filter
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="vehicle_id[]" value="{{ implode(',',$vehicleFilter) ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Apply Special Date Filter</button>
                        <a href="{{ route('backend.analytics') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2({
                    placeholder: "Select Vehicles",
                    allowClear: true
                });
            });

            $(function () {
                const matrixData = @json($matrixData);
                const dateLabels = @json($dateLabels);
                const vehiclesData = @json($vehicles);
                // const vehicles = vehiclesData.map(vehicle => vehicle.name);
                const vehicles = @json($vehicleNames);
                const margin = {top: 80, right: 250, bottom: 50, left: 200},
                    width = 900 - margin.left - margin.right,
                    height = 600 - margin.top - margin.bottom;
                const svg = d3.select("#matrix-chart")
                    .append("svg")
                    .attr("width", width + margin.left + margin.right)
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", `translate(${margin.left},${margin.top})`);
                const x = d3.scaleBand()
                    .range([0, width])
                    .domain(dateLabels)
                    .padding(0.2);
                svg.append("g")
                    .attr("transform", `translate(0,${height})`)
                    .call(d3.axisBottom(x))
                    .selectAll("text")
                    .style("text-anchor", "end")
                    .attr("dx", "-.8em")
                    .attr("dy", ".15em")
                    .attr("transform", "rotate(-65)")
                    .style("font-size", "11px")
                    .style("fill", "#555");
                const y = d3.scaleBand()
                    .range([height, 0])
                    .domain(vehicles)
                    .padding(0.02);

                svg.append("g")
                    .call(d3.axisLeft(y))
                    .selectAll("text")
                    .style("font-size", "11px")
                    .style("fill", "#555");
                const tooltip = d3.select("#matrix-chart")
                    .append("div")
                    .style("opacity", 0)
                    .attr("class", "tooltip")
                    .style("background-color", "white")
                    .style("border", "solid")
                    .style("border-width", "2px")
                    .style("border-radius", "5px")
                    .style("padding", "5px")
                    .style("position", "absolute")
                    .style("font-size", "12px");
                const mouseover = function (event, d) {
                    tooltip
                        .style("opacity", 1)
                    d3.select(this)
                        .style("stroke", "black")
                        .style("opacity", 1)
                }
                const mousemove = function (event, d) {
                    tooltip
                        .html("Vehicle: " + d.vehicle + "<br>Date: " + d.date + "<br>Status: " + (d.booked ?
                            "Booked" : "Available"))
                        .style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 10) + "px");
                }
                const mouseleave = function (event, d) {
                    tooltip
                        .style("opacity", 0)
                    d3.select(this)
                        .style("stroke", "none")
                        .style("opacity", 0.8)
                }
                const checkmark = "✔";
                svg.selectAll()
                    .data(matrixData, function (d) {
                        return d.vehicle + ':' + d.date;
                    })
                    .enter()
                    .append("g")
                    .attr("transform", function (d) {
                        return `translate(${x(d.date)}, ${y(d.vehicle)})`;
                    })
                    .each(function (d) {
                        const bandWidth = x.bandwidth();
                        const bandHeight = y.bandwidth();
                        d3.select(this)
                            .append("circle")
                            .attr("cx", bandWidth / 2)
                            .attr("cy", bandHeight / 2)
                            .attr("r", Math.min(bandWidth, bandHeight) / 2.3)
                            .attr("fill", d.booked ? "#dc3545" : "#28a745");
                        d3.select(this)
                            .append("text")
                            .attr("x", bandWidth / 2)
                            .attr("y", bandHeight / 2)
                            .attr("text-anchor", "middle")
                            .attr("dominant-baseline", "central")
                            .style("font-size", Math.min(bandWidth, bandHeight) * 0.6 + "px")
                            .style("fill", "#fff")
                            .text(d.booked ? checkmark : "");
                    });
                const legendX = width + 50;
                const legendY = height / 2 - 50;

                const legendGroup = svg.append("g")
                    .attr("transform", `translate(${legendX}, ${legendY})`);

                legendGroup.append("circle").attr("cx", 0).attr("cy", -20).attr("r", 6).style("fill",
                    "#dc3545");
                legendGroup.append("text").attr("x", 20).attr("y", -20).text("Booked").style("font-size",
                    "12px").attr("alignment-baseline", "middle").style("fill", "#555");

                legendGroup.append("circle").attr("cx", 0).attr("cy", 10).attr("r", 6).style("fill",
                    "#28a745");
                legendGroup.append("text").attr("x", 20).attr("y", 10).text("Available").style("font-size",
                    "12px").attr("alignment-baseline", "middle").style("fill", "#555");
             $("#export_button").click(function() {
                $("#matrix_data_export").val(JSON.stringify(matrixData));
            });
                $("#share_email").click(function() {
                    const dataString = encodeURIComponent(JSON.stringify(matrixData));
                    const subject = "Vehicle Booking Analytics";
                    const body = "Here is the Vehicle Booking Analytics data:\n\n" +
                        "You can import this into a spreadsheet program.\n\n";

                    const mailtoLink = "mailto:?subject=" + encodeURIComponent(subject) +
                        "&body=" + encodeURIComponent(body);

                    window.location.href = mailtoLink;
                });


            });
            document.addEventListener("DOMContentLoaded", function () {
                const startDateInput = document.getElementById("start_date");
                const endDateInput = document.getElementById("end_date");

                startDateInput.addEventListener("change", function () {
                    endDateInput.min = startDateInput.value;
                });
                endDateInput.min = startDateInput.value || new Date().toISOString().split("T")[0]; // Today's date in YYYY-MM-DD format

            });
        </script>
    @endpush
@endsection
