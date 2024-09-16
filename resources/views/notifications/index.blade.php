<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
</head>
<body>
    <h1>Notifications</h1>
    @foreach ($notifications as $notification)
        <p>Listing ID: {{ $notification->data['listing_id'] }}</p>
        <p>Bid Amount: {{ $notification->data['bid_amount'] }}</p>
        <p>Bidder ID: {{ $notification->data['bidder_id'] }}</p>
    @endforeach
</body>
</html>
