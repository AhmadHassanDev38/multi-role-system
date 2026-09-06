<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

    <h1>User Dashboard</h1>

    <p>Welcome, {{ auth()->user()->name }}</p>

    <p>
        <a href="{{ route('profile.edit') }}">
            My Profile
        </a>
    </p>

    <form method="POST" action="{{ route('user.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>