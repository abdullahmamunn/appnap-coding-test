<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Varification</title>
</head>
<body>
    <p>Dear, {{ $user['user_name'] }}</p>
    <p>Congratulations, You have successfully created your account, To varify your account 
        <a href="{{ route('email.verify',$user['email_varified_token']) }}">{{ $user['email_varified_token'] }}</a>
    </p>
    <p>Thanks</p>
    <h4>Appnap</h4>

</body>
</html>