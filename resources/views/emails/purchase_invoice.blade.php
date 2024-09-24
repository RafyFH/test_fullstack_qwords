<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Domain Purchase Invoice</title>
</head>
<body>
<h1>Invoice for Domain Purchase</h1>
<p>Dear {{ $user->name }},</p>

<p>Thank you for your purchase! Here are your order details:</p>

<h2>Order Summary</h2>
<p>Domain: {{ $domain }}</p>
<p>Duration: {{ $transaction->duration }} Year(s)</p>
<p>Total Price: Rp{{ number_format($transaction->total_price, 0, ',', '.') }},-</p>

<p>Thank you for choosing us!</p>
<p>Best regards,<br>Your Company</p>
</body>
</html>
