<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>My Profile</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
        }

        .container {
            max-width: 650px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
        }

        h1 {
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        button {
            padding: 12px 20px;
            background: #111827;
            color: white;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        a {
            margin-left: 15px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>My Profile</h1>

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="errors">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('profile.update') }}"
    >

        @csrf

        @method('PUT')


        <label for="name">
            Name
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
        >


        <label for="email">
            Email
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
        >


        <h3>Change Password</h3>


        <label for="password">
            New Password
        </label>

        <input
            id="password"
            type="password"
            name="password"
        >


        <label for="password_confirmation">
            Confirm New Password
        </label>

        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
        >


        <button type="submit">
            Update Profile
        </button>


        <a href="{{ route('dashboard') }}">
            Back to Dashboard
        </a>

    </form>

</div>

</body>

</html>