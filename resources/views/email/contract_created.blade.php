<!DOCTYPE html>
<html>
<head>
    <title>Contract Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333333;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #4CAF50;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .details {
            border-collapse: collapse;
            width: 100%;
        }
        .details td {
            padding: 8px 0;
        }
        .details td:first-child {
            font-weight: bold;
            color: #555555;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 14px;
            color: #888888;
            border-top: 1px solid #eeeeee;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
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

        <div class="footer">
            <p>Need help? <a href="mailto:support@example.com">Contact our support team</a></p>
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
