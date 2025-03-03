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

        /* Darker/Brighter background for selected options */
        .select2-results__option[aria-selected="true"] {
            background-color: #0056b3 !important; /*Darker background*/
            color: #fff !important; /*White text for contrast*/
        }

        .filter-card {
            width: 100%;
            max-width: 400px; /* Set a maximum width */
            margin-left: auto;   /* Horizontally center the cards */
            margin-right: auto;
        }
        /* Ensure the sidebar cards have the same height */
        .filter-sidebar .card {
            height: 100%; /* Make the cards use all available vertical space in the column */
        }

         /* Style for the Tooltip */
        .tooltip {
            font-size: 14px;
        }

        #matrix-chart .grid-line {
            stroke: #ddd; /* Light gray grid lines */
            stroke-width: 0.5px; /* Thinner grid lines */
            pointer-events: none; /* Make sure grid lines don't interfere with mouse events */
        }


    </style>

    {{-- Main Content (Matrix Chart) --}}
    <div class="card">
    <div class="card-header">
            {{-- Share Options --}}
            <div class="d-flex justify-content-end">
                 <a href="#" class="btn btn-info btn-sm mr-2" id="share_email">Share via Email</a>
                <form method="POST" action="{{ route('backend.analytics.export') }}">
                    @csrf
                    <input type="hidden" name="matrix_data" id="matrix_data_export" value="">
                    <button type="submit" class="btn btn-success btn-sm mr-2" id="export_button">Export as CSV</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <h2 class="mb-4">Vehicle Bookings</h2>

            <div class="d-flex justify-content-center align-items-center">
                <span class="text-center" style="font-size: 1.2em; margin-top: -10px;">
                    @php
                        $monthYearLabel = '';
                        if (count($dateLabels) > 0) {
                            $firstDate = \Carbon\Carbon::parse($dateLabels[0]);
                            $lastDate = \Carbon\Carbon::parse(end($dateLabels));

                            if ($firstDate->format('Ym') !== $lastDate->format('Ym')) {
                                $monthYearLabel = $firstDate->format('F Y') . ' - ' . $lastDate->format('F Y');
                            } else {
                                $monthYearLabel = $firstDate->format('F Y');
                            }
                        } else {
                            $monthYearLabel = $currentDate->format('F Y');
                        }
                    @endphp
                    {{ $monthYearLabel }}
                </span>
            </div>

            {{-- Chart Container --}}
            <div class="row">
                <div class="col-12">
                    <div id="matrix-chart" class="overflow-auto"></div>
                </div>
            </div>
        </div>

   <div class="d-flex justify-content-between align-items-center m-3">
    <a href="{{ route('backend.analytics', ['date' => $currentDate->copy()->subMonth()->format('Y-m-d'), 'start_date' => $startDateFilter ?? '', 'end_date' => $endDateFilter ?? '', 'vehicle_id' => $vehicleFilter ?? [], 'special_date_filter' => $specialDateFilter ?? '']) }}"
       class="btn btn-primary btn-sm">
        « Previous Month
    </a>
    <a href="{{ route('backend.analytics', ['date' => $currentDate->copy()->addMonth()->format('Y-m-d'), 'start_date' => $startDateFilter ?? '', 'end_date' => $endDateFilter ?? '', 'vehicle_id' => $vehicleFilter ?? [], 'special_date_filter' => $specialDateFilter ?? '']) }}"
       class="btn btn-primary btn-sm">
        Next Month »
    </a>
</div>
    </div>

    <div class="row filter-sidebar">
        {{-- Filter Sidebar --}}
        <div class="col-md-4">
            <div class="card filter-card">
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
                        <input type="hidden" name="vehicle_id[]" value="{{ implode(',', $vehicleFilter) ?? '' }}">
                        <button type="submit" class="btn btn-primary btn-sm">Apply Filter</button>
                        <a href="{{ route('backend.analytics') }}" class="btn btn-secondary btn-sm">Reset</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card filter-card">
                <div class="card-body">
                    <h5 class="card-title">Vehicle Filter:</h5>
                    <br>
                    <form method="GET" action="{{ route('backend.analytics') }}">

                        <div class="form-group">
                            <label for="vehicle_id">Select Vehicles:</label>
                            <select class="form-control form-control-sm select2" id="vehicle_id" name="vehicle_id[]"
                                multiple>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ in_array($vehicle->id, $vehicleFilter) ? 'selected' : '' }}>
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
            <div class="card filter-card">
                <div class="card-body">
                    <h5 class="card-title">Special Date Filter:</h5>
                    <br>
                    <form method="GET" action="{{ route('backend.analytics') }}">

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="special_date_filter"
                                    id="start_date_filter" value="start_date"
                                    {{ $specialDateFilter === 'start_date' ? 'checked' : '' }}>
                                <label class="form-check-label" for="start_date_filter">
                                    Bookings Starting Today/Tomorrow
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="special_date_filter"
                                    id="end_date_filter" value="end-date"
                                    {{ $specialDateFilter === 'end_date' ? 'checked' : '' }}>
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
                        <input type="hidden" name="vehicle_id[]" value="{{ implode(',', $vehicleFilter) ?? '' }}">
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
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
            const vehicles = @json($vehicleNames);

            // Chart dimensions and margins
            const margin = {top: 80, right: 250, bottom: 120, left: 200},
                width = 1400 - margin.left - margin.right,
                height = 800 - margin.top - margin.bottom;

            // Append the SVG object to the div
            const svg = d3.select("#matrix-chart")
                .append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", `translate(${margin.left},${margin.top})`);

            // Build and map the X scale
            const x = d3.scaleBand()
                .range([0, width])
                .domain(dateLabels)
                .padding(0.2);

            //Format only Dates not Month and Years
             const xAxis = d3.axisBottom(x)
                .tickFormat(function (d) {
                    return d3.timeFormat("%d")(new Date(d)); // Format as just the day
                });

            svg.append("g")
                .attr("transform", `translate(0,${height})`)
                .call(xAxis)
                .selectAll("text")
                .style("text-anchor", "start")
                .attr("dx", "0.5em")
                .attr("dy", ".8em")
                .attr("transform", "rotate(0)")
                .style("font-size", "14px") // Increased font size
                .style("fill", "#555");

            // Build and map the Y scale
            const y = d3.scaleBand()
                .range([height, 0])
                .domain(vehicles)
                .padding(0.02);

            svg.append("g")
                .call(d3.axisLeft(y))
                .selectAll("text")
                .style("font-size", "14px") //Increased font size
                .style("fill", "#555");

            // Create a tooltip
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
                .style("font-size", "12px")
                .style("pointer-events", "none");

            // functions that change the tooltip when user hover / move / leave a cell
               const mouseover = function(event, d) {
                   tooltip
                   .style("opacity", 1);
                    //Remove or comment out these lines
                    //d3.select(this)
                    //.style("stroke", "black")
                    //.style("stroke-width", 3);
                  }

                 const mousemove = function (event, d) {
                  // Use `this` to refer to the hovered `rect` element:
                  const cellGroup = d3.select(this);
                    const data = cellGroup.datum();

                  tooltip
                      .html("Vehicle: " + data.vehicle + "<br>Date: " + data.date + "<br>Status: " + (data.booked ?
                          "Booked" : "Available"))
                      .style("left", (event.pageX + 10) + "px")
                      .style("top", (event.pageY - 10) + "px");
                };

            const mouseleave = function () {
               tooltip
                 .style("opacity", 0)
                 .style("left", "0px")  // reset position
                  .style("top", "0px");
              d3.select(this).select("rect").style("stroke", "none");
            }

            svg.selectAll(".cell")
                .data(matrixData, function (d) {
                    return d.vehicle + ':' + d.date;
                })
               .enter()
                .append("g") // Grouping for rectangle + circle
               .attr("class", "cell")
                .attr("transform", d => `translate(${x(d.date)}, ${y(d.vehicle)})`)
                .each(function(d) {
                    const cell = d3.select(this);
                    const bandWidth = x.bandwidth();
                     const bandHeight = y.bandwidth();

                     //Create grid cells:
                          cell.append("rect")
                              .attr("width", bandWidth)
                              .attr("height", bandHeight)
                              .attr("fill", 'none')  // Transparent, so you see the grid lines
                              .style("stroke", "#ddd")
                              .style("stroke-width", "1px");

                // Create circles:
                       cell.append("circle")
                          .attr("cx", bandWidth / 2)
                          .attr("cy", bandHeight / 2)
                          .attr("r", Math.min(bandWidth, bandHeight) / 3)  // radius = 1/3 of cell size
                          .attr("fill", d.booked ? "#dc3545" : "#28a745")

                        .on("mouseover", mouseover)
                     .on("mousemove", mousemove)
                     .on("mouseleave", mouseleave);
                 });
//Select all rect elements within g.cell elements and attach the event listeners

             svg.selectAll(".cell rect")
               .on("mouseover", mouseover)
                 .on("mousemove", mousemove)
              .on("mouseleave", mouseleave);
       $("#export_button").click(function() {
            $("#matrix_data_export").val(JSON.stringify(matrixData));
       });
       $("#share_email").click(function() {

       const dataString = encodeURIComponent(JSON.stringify(matrixData));

        axios({
            method: 'post',
           url: '{{ route("backend.analytics.sendEmail") }}', // Double check the route
            data: {
              matrix_data: dataString
           },
            headers: {
                    "Content-Type": "application/json",
                      "Accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             })
               .then(response => {
                console.log('Email sent',response);
                 if (response && response.data && response.data.message) {
                   alert(response.data.message);
                } else {
                  alert('Email sent successfully!');
                 }
         })
          .catch(error => {
                console.error('There was an error sending the email! Full error data below: ', error);
               console.error('Detailed error:', error.response);
                   let errorMessage = 'Error sending email.';
                 if (error.response && error.response.data && error.response.data.message) {
                       errorMessage = error.response.data.message;
                      }
                    alert(errorMessage);
             });

        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        const startDateInput = document.getElementById("start_date");
        const endDateInput = document.getElementById("end_date");

        startDateInput.addEventListener("change", function () {
            endDateInput.min = startDateInput.value;
        });
        endDateInput.min = startDateInput.value || new Date().toISOString().split("T")[0];

    });
</script>
@endpush
@endsection
