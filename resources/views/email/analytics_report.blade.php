@extends('backend.layouts.app')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>



            Vehicle Booking Analytics Report


            Here's the Vehicle Booking Analytics data:




                    Vehicle
                    Date
                    Status



               @foreach($matrixData as $data)


                      {{ $data['vehicle'] }}
                       {{ $data['date'] }}
                        {{ $data['booked'] ? 'Booked' : 'Available' }}


                @endforeach


           @endsection
