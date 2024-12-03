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
        margin: 0px auto;
        margin-top: 4%;
        margin-bottom: 4%;
        border-radius: 5px;
    }

    .contact-table {
        width: 100%;
        border-collapse: collapse;
    }

    table.contact-table tr {
        border-top: 1px solid #f5f5f5;
        padding: 10px 0px;
    }

    table.contact-table tr td {
        width: 50%;
        font-size: 16px;
        color: #8C8889;
        padding: 10px;
    }

    table.contact-table tr td:nth-child(2) {
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
            <h3>Your Booking Request has been Processed</h3>
            <p>Dear {{ $booking->first_name }},</p>
            <p>{{ $messageText }}</p>
            <p>Here are your booking details:</p>

            <table class="contact-table">
                <tbody>
                    <!-- New Checkout Details -->
                    <tr>
                        <td><strong>First Name:</strong></td>
                        <td>{{ $checkout->first_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Last Name:</strong></td>
                        <td>{{ $checkout->last_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $checkout->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $checkout->phone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address (First Line):</strong></td>
                        <td>{{ $checkout->address_first }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address (Last Line):</strong></td>
                        <td>{{ $checkout->address_last }}</td>
                    </tr>
                    <tr>
                        <td><strong>Vehicle Name:</strong></td>
                        <td>{{ $booking->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pickup Location:</strong></td>
                        <td>{{ $booking->pickUpLocation }}</td>
                    </tr>
                    <tr>
                        <td><strong>Drop-off Location:</strong></td>
                        <td>{{ $booking->dropOffLocation }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Price:</strong></td>
                        <td>CHF {{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pickup Date:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($booking->pickUpDate)->format('d-M-Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pickup Time:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($booking->pickUpTime)->format('h:i A') }}</td>

                    </tr>
                    <tr>
                        <td><strong>Collection Date:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($booking->collectionDate)->format('d-M-Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Collection Time:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($booking->collectionTime)->format('h:i A') }}</td>

                    </tr>
                    
                </tbody>
            </table>

            <p>We will get back to you soon. Thank you for choosing our service!</p>
        </div>
    </section>
</body>

@endsection
