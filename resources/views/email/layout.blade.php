<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
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
