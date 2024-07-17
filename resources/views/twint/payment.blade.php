<!DOCTYPE html>
<html>
<head>
    <title>TWINT Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>TWINT Payment</h2>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('twint.process') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="amount">Amount (CHF):</label>
            <input type="number" class="form-control" name="amount" id="amount" required>
        </div>
        <button type="submit" class="btn btn-primary">Pay with TWINT</button>
    </form>
</div>
</body>
</html>
