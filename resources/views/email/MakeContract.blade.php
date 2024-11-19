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
    <section class="contact-main-div">
        <div class="contact-us-content">
            <h2 style="text-align: center; font-weight: 400;">Your contract has been successfully created, {{ ucfirst($data->name) }}</h2>
            <table class="contact-table">
                <tbody>
                    <h1> You have been successfully created contract</h1>
                    <tr>
                        <td>User Name</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td>Address (First)</td>
                        <td>{{ $data->address_first }}</td>
                    </tr>
                    <tr>
                        <td>PickUp Location</td>
                        <td>{{ $data->pickUpLocation }}</td>
                    </tr>
                    <tr>
                        <td>Drop Off Location</td>
                        <td>{{ $data->dropOffLocation }}</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>${{ $data->total_price }}</td>
                    </tr>
                    <tr>
                        <td>Amount Paid</td>
                        <td>${{ $data->amount_paid }}</td>
                    </tr>
                    @if($data->payment_type == "payment_partial")
                        <tr>
                            <td>Remaining Amount</td>
                            <td>${{ $data->remaining_amount }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Status</td>
                        <td>{{ $data->status }}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>{{ $data->payment_method }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>
@endsection
