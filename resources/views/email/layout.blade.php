<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    {{-- <style>
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
            width: 50%;
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
    </style> --}}
    @yield('style')
</head>
<body>
    <div class="body">
        @include('email.partials._header')
        @yield('content')
        @include('email.partials._footer')
    </div>
</body>
</html>
