<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Dear, {{ $data->toName }}</h1>
	<p>{{ $data->emailBody }}.</p>
	<p>If you have not yet paid your fees please pay them asap either <a href="{{ $data->linkToEvent }}">online</a> or handed in to your church.</p>
	<p>Thank you!</p>
</body>
</html>