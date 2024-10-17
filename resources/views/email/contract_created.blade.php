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
        /* margin-top: 40px; */
    }

    .contact-main-div {
        width: 100%;
        display: inline-block;
        background: #f5f5f5;
        /* height: 100vh; */
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
@endsection
@section('content')
 {{-- <body> --}}
@section('content')
    <div class="container">
        <h1>You have Checked-In Successfully</h1>
        <table class="details">
            <tr>
                <td>Name:</td>
                <td>{{ $contract->name }}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{ $contract->address }}</td>
            </tr>
            <tr>
                <td>Postal Code:</td>
                <td>{{ $contract->postal_code }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $contract->email }}</td>
            </tr>
        </table>
        <p>Thank you for your business!</p>
    </div>
@endsection
