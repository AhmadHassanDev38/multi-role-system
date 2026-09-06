<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Welcome</title>

</head>

<body>

    <h2>Welcome, {{ $name }}!</h2>

    <p>
        Your account has been created successfully.
    </p>

    <p>
        You can use the following information to log in:
    </p>

    <p>
        <strong>Name:</strong>
        {{ $name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ $email }}
    </p>

    <p>
        <strong>Password:</strong>
        {{ $password }}
    </p>

    <p>
        <strong>Login:</strong>
        <a href="{{ $loginUrl }}">
            {{ $loginUrl }}
        </a>
    </p>

    <p>
        Please change your password after logging in.
    </p>

</body>

</html>