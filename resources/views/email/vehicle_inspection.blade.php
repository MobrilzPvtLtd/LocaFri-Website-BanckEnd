<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Inspection Report</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .email-container {
            width: 100%;
            padding: 20px 0;
            display: flex;
            justify-content: center;
        }

        .email-content {
            width: 70%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header h2 {
            font-weight: 400;
            font-size: 24px;
            color: #333;
        }

        .email-details {
            width: 100%;
            margin-top: 20px;
        }

        .email-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .email-details table tr {
            border-bottom: 1px solid #f1f1f1;
            padding: 10px 0;
        }

        .email-details td {
            padding: 10px;
            font-size: 16px;
            color: #555;
        }

        .email-details td:first-child {
            width: 50%;
        }

        .email-details td:last-child {
            text-align: right;
        }

        .email-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #888;
        }

        @media only screen and (max-width: 600px) {
            .email-content {
                width: 90%;
            }

            .email-details td {
                font-size: 14px;
            }

            .email-header h2 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-content">
            <div class="email-header">
                <h2>Vehicle Inspection Request from {{ ucfirst($data['name']) }}</h2>
            </div>
            <div class="email-details">
                <table>
                    <tr>
                        <td>User Name</td>
                        <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td>User Email</td>
                        <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td>{{ $data['postal_code'] }}</td>
                    </tr>
                    <tr>
                        <td>Kilometers Recorded</td>
                        <td>{{ $data['record_kilometers'] }}</td>
                    </tr>
                    <tr>
                        <td>Fuel Level</td>
                        <td>{{ $data['fuel_level'] }}</td>
                    </tr>
                    <tr>
                        <td>Vehicle Damage Comments</td>
                        <td>{{ $data['vehicle_damage_comments'] ?? 'No comments' }}</td>
                    </tr>
                    <tr>
                        <td>Customer Signature</td>
                        <td><a href="{{ asset('storage/' . $data['customer_signature']) }}" target="_blank">View Signature</a></td>
                    </tr>
                    @if(!empty($data['vehicle_images']))
                    <tr>
                        <td>Vehicle Images</td>
                        <td>
                            @foreach (json_decode($data['vehicle_images']) as $image)
                            <a href="{{ asset('storage/' . $image) }}" target="_blank">View Image</a><br>
                            @endforeach
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="email-footer">
                <p>Thank you for completing the vehicle inspection process.</p>
            </div>
        </div>
    </div>
</body>

</html>
