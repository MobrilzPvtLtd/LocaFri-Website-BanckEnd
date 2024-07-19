<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            body {
                margin: 0px;
                padding: 0px;
            }

            .contact-main-div {
                width: 100%;
                display: inline-block;
                background: #f5f5f5;
                height: 100vh;
            }

            .contact-us-content {
                width: 50%;
                padding: 10px 20px;
                background: #ffffff;
                margin: 0px auto;
                margin-top: 5%;
                border-radius: 5px;
            }

            .contact-table {
                width: 100%;
            }

            table.contact-table tr {
                display: flex;
                width: 100%;
                float: left;
                border-top: 1px solid #f5f5f5;
                padding: 10px 0px;
            }

            table.contact-table tr td {
                width: 50%;
                float: left;
                font-size: 16px;
                color: #8C8889;
            }

            table.contact-table tr td:nth-child(2) {
                text-align: right;
            }
            @media only screen and (max-width: 600px) {
               .contact-us-content {
                    width:90%;
                }
            }
        </style>
    </head>

    <body>
        <section class="contact-main-div">
            <div class="contact-us-content">
                <h2 style="text-align: center;font-weight: 400;">A New Request from
                    {{ ucfirst($data['name']) }}
                </h2>
                <table class="contact-table">
                    <tbody>
                        <tr>
                            <td>
                              User Name
                            </td>
                            <td>
                                {{ $data['name'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                User Email
                            </td>
                            <td>
                                {{ $data['email'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address First
                            </td>
                            <td>
                                {{ $data['address_first'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Address Last
                            </td>
                            <td>
                                {{ $data['address_last'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Vehicle Name
                            </td>
                            <td>
                                {{ $data['vehicle_name'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                PickUp Location
                            </td>
                            <td>
                                {{ $data['pickUpLocation'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Drop Off Location
                            </td>
                            <td>
                                {{ $data['dropOffLocation'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                PickUp Date
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data['pickUpDate'])->format('d-M-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                PickUp Time
                            </td>
                            <td>
                                {{ $data['pickUpTime'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Collection Time
                            </td>
                            <td>
                                {{ $data['collectionTime'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Collection Date
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($data['collectionDate'])->format('d-M-Y') }}
                            </td>
                        </tr>
                        @if($data['day_price'])
                            <tr>
                                <td>
                                    Day Price
                                </td>
                                <td>
                                    ${{ $data['day_price'] }}
                                </td>
                            </tr>
                        @elseif($data['week_price'])
                            <tr>
                                <td>
                                    Week Price
                                </td>
                                <td>
                                    ${{ $data['week_price'] }}
                                </td>
                            </tr>
                        @elseif($data['month_price'])
                            <tr>
                                <td>
                                    Month Price
                                </td>
                                <td>
                                    ${{ $data['month_price'] }}
                                </td>
                            </tr>
                        @endif
                        @if($data['additional_driver'])
                            <tr>
                                <td>
                                    Additional Driver
                                </td>
                                <td>
                                    ${{ $data['additional_driver'] }}
                                </td>
                            </tr>
                        @endif
                        @if($data['booster_seat'])
                            <tr>
                                <td>
                                    Booster Seat
                                </td>
                                <td>
                                    ${{ $data['booster_seat'] }}
                                </td>
                            </tr>
                        @endif
                        @if($data['child_seat'])
                            <tr>
                                <td>
                                    Child Seat
                                </td>
                                <td>
                                    ${{ $data['child_seat'] }}
                                </td>
                            </tr>
                        @endif
                        @if($data['exit_permit'])
                            <tr>
                                <td>
                                    Exit Permit
                                </td>
                                <td>
                                    ${{ $data['exit_permit'] }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                Total Price
                            </td>
                            <td>
                                ${{ $data['total_price'] }}
                            </td>
                        </tr>
                        @if($data['payment_status'] == 0)
                        <tr>
                            <td>
                                Remaining Amount
                            </td>
                            <td>
                                ${{ $data['remaining_amount'] }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>
                                Status
                            </td>
                            <td>
                                {{ $data['status'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Order Status
                            </td>
                            <td>
                                {{ $data['order_status'] }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Payment Method
                            </td>
                            <td>
                                {{ $data['payment_method'] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </body>
</html>
