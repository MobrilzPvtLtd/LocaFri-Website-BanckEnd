@extends('email.layout')

@section('style')
<style>
    .body {
        margin: 0;
        padding: 0;
    }

    .header {
        text-align: center;
        background-color: #f8f8f8;
        padding: 20px;
    }

    .footer {
        text-align: center;
        margin-top: 40px;
        font-size: 12px;
        color: #888;
    }

    .contact-main-div {
        width: 100%;
        display: inline-block;
        background: #f5f5f5;
    }

    .contact-us-content {
        width: 70%;
        padding: 20px;
        background: #ffffff;
        margin: 0 auto;
        margin-top: 4%;
        margin-bottom: 4%;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .contact-table {
        width: 100%;
        border-collapse: collapse;
    }

    table.contact-table tr {
        border-top: 1px solid #f5f5f5;
        padding: 10px 0;
    }

    table.contact-table tr td {
        width: 50%;
        padding: 10px;
        font-size: 16px;
        color: #333;
    }

    table.contact-table tr td:nth-child(2) {
        text-align: right;
    }

    h1 {
        font-weight: 600;
        color: #333;
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
            <h1>CheckOut Details</h1>
            <table class="contact-table">
                <tbody>
                    <tr>
                        <td><strong>Contract ID:</strong></td>
                        <td>{{ $contract->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Record Kilometers:</strong></td>
                        <td>{{ $contractsOut->record_kilometers }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fuel Level:</strong></td>
                        <td>{{ $contractsOut->fuel_level }}%</td>
                    </tr>
                    @if($contractsOut->vehicle_damage_comments)
                        <tr>
                            <td><strong>Vehicle Damage Comments:</strong></td>
                            <td>{{ $contractsOut->vehicle_damage_comments }}</td>
                        </tr>
                    @endif
                    {{-- <tr>
                        <td><strong>Customer Signature:</strong></td>
                        <td>
                            <img src="{{ asset('storage/' . $contractsOut->customer_signature) }}" alt="Customer Signature" style="max-width: 200px;"/>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
            <p>Please find attached any vehicle images and more details in the contract document.</p>
        </div>
    </section>
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </footer>
</body>
@endsection
