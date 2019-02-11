<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the Magazin.uz</h2>
<br/>
<p>This is an email for enter to our platform</p>
<p>Login details provided below:</p>
<p>Login: <b>{{ $user->username }}</b></p>
<p>Password: <b>{{ $user->password }}</b></p>
</body>

</html>