<!doctype html>
<html lang="en">
    <head>
        <title>Payment Reminder</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
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
                <h2 style="text-align: center;font-weight: 400;">Payment Reminder for {{ ucfirst($data['name']) }}</h2>
                <table class="contact-table">
                    <tbody>
                        {{-- <tr>
                            <td>User Name</td>
                            <td>{{ $data['name'] }}</td>
                        </tr>
                        <tr>
                            <td>User Email</td>
                            <td>{{ $data['email'] }}</td>
                        </tr> --}}
                        <tr>
                            <td>Total Amount</td>
                            <td> CHF {{ number_format($data['total_price'], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Amount Paid</td>
                            <td> CHF {{ number_format($data['amount_paid'], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Remaining Amount</td>
                            <td> CHF {{ number_format($data['remaining_amount'], 2) }}</td>
                        </tr>
                        <tr>
                            <td>Payment Link</td>
                            <td><a href="{{ $data['payment_url'] }}">Complete Payment</a></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $data['status'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </body>
</html>
