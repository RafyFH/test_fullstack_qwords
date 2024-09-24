<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        h2, h3 {
            text-align: center;
        }
        .summary, .details {
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Invoice</h2>

    <div class="summary">
        <h3>Order Summary</h3>
        <p>Domain: {{ $domain->domain_name }}</p>
        <p>Duration: {{ $transaction->duration }} Year(s)</p>
    </div>

    <div class="details">
        <h3>Customer Details</h3>
        <p>Name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
    </div>

    <div class="total">
        <h3>Total Price</h3>
        <p>Rp{{ number_format($transaction->total_price, 0, ',', '.') }},-</p>
    </div>

    <p>Thank you for your purchase!</p>
    <p>Your domain has been successfully booked.</p>
</div>

</body>
</html>
