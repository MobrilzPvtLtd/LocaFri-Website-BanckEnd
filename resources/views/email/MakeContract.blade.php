@extends('email.layout')

@section('style')
    <style>
        .body {
            margin: 0px;
            padding: 0px;
        }

        .header {
            text-align: center;
        }

        .footer {
            text-align: center;
        }

        .contact-main-div {
            width: 100%;
            display: inline-block;
            background: #f5f5f5;
        }

        .contact-us-content {
            width: 70%;
            padding: 10px 20px;
            background: #ffffff;
            margin: 4% auto;
            border-radius: 5px;
        }

        .contact-table {
            width: 100%;
        }

        .contact-table tr {
            display: flex;
            width: 100%;
            border-top: 1px solid #f5f5f5;
            padding: 10px 0;
        }

        .contact-table tr td {
            width: 50%;
            font-size: 16px;
            color: #8C8889;
        }

        .contact-table tr td:nth-child(2) {
            text-align: right;
        }

        @media only screen and (max-width: 600px) {
            .contact-us-content {
                width: 90%;
            }
        }
    </style>
@endsection

@section('content')

    <body>
        {{-- <section class="contact-main-div">
        <div class="contact-us-content">
            <h2 style="text-align: center; font-weight: 400;"> Check-in reminder</h2>
            <h1>Your Booking Has accepted now fill check-in form</h1> --}}
        <section class="contact-main-div">
            <div class="contact-us-content">
                <h2 style="text-align: center; font-weight: 400;">Check-in Reminder</h2>
                <p style="text-align: center; font-size: 16px; color: #555;">
                    Your booking has been successfully accepted! To complete the process, please fill out the check-in form.
                </p>

                <table class="contact-table">
                    <tbody>
                        <tr>
                            <td>Vehicle Name</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        {{-- <tr>
                        <td>Address (First)</td>
                        <td>{{ $data->address_first }}</td>
                    </tr> --}}
                        <tr>
                            <td>PickUp Location</td>
                            <td>{{ $data->pickUpLocation }}</td>
                        </tr>
                        <tr>
                            <td>Drop Off Location</td>
                            <td>{{ $data->dropOffLocation }}</td>
                        </tr>
                        {{-- <tr>
                            <td>Collection Time</td>
                            <td>{{ $data->collectionTime }}</td>
                        </tr>
                        <tr>
                            <td>Collection Date</td>
                            <td>{{ \Carbon\Carbon::parse($data->collectionDate)->format('d-M-Y') }}</td>
                        </tr>
                        @if ($data->day_price)
                            <tr>
                                <td>Day Price</td>
                                <td>${{ $data->day_price }}</td>
                            </tr>
                        @elseif($data->week_price)
                            <tr>
                                <td>Week Price</td>
                                <td>${{ $data->week_price }}</td>
                            </tr>
                        @elseif($data->month_price)
                            <tr>
                                <td>Month Price</td>
                                <td>${{ $data->month_price }}</td>
                            </tr>
                        @endif
                        @if ($data->additional_driver)
                            <tr>
                                <td>Additional Driver</td>
                                <td>${{ $data->additional_driver }}</td>
                            </tr>
                        @endif
                        @if ($data->booster_seat)
                            <tr>
                                <td>Booster Seat</td>
                                <td>${{ $data->booster_seat }}</td>
                            </tr>
                        @endif
                        @if ($data->child_seat)
                            <tr>
                                <td>Child Seat</td>
                                <td>${{ $data->child_seat }}</td>
                            </tr>
                        @endif
                        @if ($data->exit_permit)
                            <tr>
                                <td>Exit Permit</td>
                                <td>${{ $data->exit_permit }}</td>
                            </tr>
                        @endif --}}
                        <tr>
                            <td>Total Amount</td>
                            <td> CHF {{ $data->total_price }}</td>
                        </tr>
                        @if ($data->payment_type == 'payment_partial')
                            <tr>
                                <td>Remaining Amount</td>
                                <td> CHF {{ $data->remaining_amount }}</td>
                            </tr>
                        @endif
                        {{-- <tr>
                            <td>Status</td>
                            <td>{{ $data->status }}</td>
                        </tr> --}}
                        <tr>
                            <td>Payment Method</td>
                            <td>{{ $data->payment_method }}</td>
                        </tr>
                    </tbody>
                </table>
                <p style="text-align: center; font-size: 16px; color: #555;">
                    This step is important to ensure a smooth experience for your upcoming reservation.
                </p>
            </div>
        </section>
    </body>
@endsection
