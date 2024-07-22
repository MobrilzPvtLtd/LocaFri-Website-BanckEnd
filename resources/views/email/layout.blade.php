<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        table.contact-table {
            width: 50%;
        }
    </style>
</head>
<body>
    <div class="body">
        @include('email.partials._header')
        @yield('content')
        @include('email.partials._footer')
    </div>
</body>
</html>
