<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Admin</title>
</head>

<body style="font-family:Arial;background:#f5f7fb;padding:40px;">

<div style="max-width:600px;margin:auto;background:white;padding:30px;border-radius:12px;">

    <h1>Edit Administrator</h1>

    @if($errors->any())

        <div style="color:red;margin-bottom:20px;">

            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach

        </div>

    @endif

    <form method="POST" action="{{ route('super-admin.admins.update', $admin) }}">

        @csrf
        @method('PUT')

        <p>
            <label>Name</label><br>

            <input
                type="text"
                name="name"
                value="{{ old('name', $admin->name) }}"
                required
                style="width:100%;padding:12px;"
            >
        </p>

        <p>
            <label>Email</label><br>

            <input
                type="email"
                name="email"
                value="{{ old('email', $admin->email) }}"
                required
                style="width:100%;padding:12px;"
            >
        </p>

        <button
            type="submit"
            style="background:#111827;color:white;padding:12px 20px;border:0;border-radius:7px;"
        >
            Update Admin
        </button>

        <a href="{{ route('super-admin.admins.index') }}">
            Cancel
        </a>

    </form>

</div>

</body>
</html>