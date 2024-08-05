<!-- resources/views/emails/example.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Message for Order</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    
    <p> Dear {{$details['userName']}}, </p>
    <p>{{ $details['body'] }}</p>
    {{-- <p>Order ID: {{ $details['orderId'] }}</p>
    <p>From: {{ $details['senderName'] }} ({{ $details['senderEmail'] }})</p>
    <p>To: {{ $details['userName'] }} ({{ $details['recieverEmail'] }})</p>
    <p>Images:</p> --}}
    <ul>
        @foreach(explode(',', $details['images']) as $image)
            <li><a href="{{ $image }}" target="_blank">{{ $image }}
            <img src="{{$image}}" alt="Image Preview" width="400px"/>    
            </a></li>
        @endforeach
    </ul>
</body>
</html>
