<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Users</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .header {
            background: #111827;
            color: white;
            padding: 20px 35px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .button {
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 8px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .edit {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 6px;
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
        }

        .status {
            border: 0;
            padding: 7px 10px;
            border-radius: 6px;
            background: #f59e0b;
            color: white;
            cursor: pointer;
        }

    </style>

</head>

<body>

<div class="header">

    <h2>My Users</h2>

    <a href="{{ route('admin.dashboard') }}">
        ← Dashboard
    </a>

</div>

<div class="container">

    <div class="top">

        <h1>Users Assigned To Me</h1>

        <a
            href="{{ route('admin.users.create') }}"
            class="button"
        >
            + Create User
        </a>

    </div>

    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <table>

        <thead>

        <tr>

            <th>Name</th>

            <th>Email</th>

            <th>Status</th>

            <th>Created</th>

            <th>Actions</th>

        </tr>

        </thead>

        <tbody>

        @forelse($users as $user)

            <tr>

                <td>
                    {{ $user->name }}
                </td>

                <td>
                    {{ $user->email }}
                </td>

                <td>

                    @if($user->is_active)

                        <span class="badge active">
                            Active
                        </span>

                    @else

                        <span class="badge inactive">
                            Inactive
                        </span>

                    @endif

                </td>

                <td>
                    {{ $user->created_at->format('d M Y') }}
                </td>

                <td>

                    <a
                        href="{{ route('admin.users.edit', $user) }}"
                        class="edit"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('admin.users.toggle-status', $user) }}"
                        style="display:inline;"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="status"
                        >
                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5">
                    No users found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>

</html>