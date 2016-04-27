<!DOCTYPE html>
<html lang="en">
<body>
    <p>Dear, {{ $toName }}</p>
	<p>{{ $emailBody }}.</p>
	<p>If you have not yet paid your fees please pay them asap either <a href="{{ $linkToEventPaymentPage }}">online</a> or handed in to your church.</p>
	<p>Thank you!</p>
</body>
</html>