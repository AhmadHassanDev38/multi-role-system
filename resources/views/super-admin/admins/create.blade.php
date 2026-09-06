<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Admin</title>
</head>

<body style="font-family:Arial;background:#f5f7fb;padding:40px;">

<div style="max-width:600px;margin:auto;background:white;padding:30px;border-radius:12px;">

    <h1>Create Administrator</h1>

    @if($errors->any())

        <div style="color:red;margin-bottom:20px;">

            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach

        </div>

    @endif

    <form method="POST" action="{{ route('super-admin.admins.store') }}">

        @csrf

        <p>
            <label>Name</label><br>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                style="width:100%;padding:12px;"
            >
        </p>

        <p>
            <label>Email</label><br>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                style="width:100%;padding:12px;"
            >
        </p>

        <p>
            <label>Password</label><br>

            <input
                type="password"
                name="password"
                required
                minlength="8"
                style="width:100%;padding:12px;"
            >
        </p>

        <button
            type="submit"
            style="background:#111827;color:white;padding:12px 20px;border:0;border-radius:7px;"
        >
            Create Admin
        </button>

        <a href="{{ route('super-admin.admins.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>
</html>