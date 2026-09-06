<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Admins</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
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
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
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

        .action {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 5px;
            text-decoration: none;
            background: #e5e7eb;
            color: #111827;
            margin-right: 5px;
        }

        .status-button {
            border: none;
            padding: 7px 10px;
            border-radius: 5px;
            cursor: pointer;
            background: #f59e0b;
            color: white;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Manage Admins</h2>

    <a href="{{ route('super-admin.dashboard') }}" style="color:white;">
        Dashboard
    </a>
</div>

<div class="container">

    <div class="top">
        <h1>Administrators</h1>

        <a href="{{ route('super-admin.admins.create') }}" class="button">
            + Create Admin
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

        @forelse($admins as $admin)

            <tr>

                <td>{{ $admin->name }}</td>

                <td>{{ $admin->email }}</td>

                <td>

                    @if($admin->is_active)

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
                    {{ $admin->created_at->format('d M Y') }}
                </td>

                <td>

                    <a
                        href="{{ route('super-admin.admins.edit', $admin) }}"
                        class="action"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('super-admin.admins.toggle-status', $admin) }}"
                        style="display:inline;"
                    >
                        @csrf

                        <button type="submit" class="status-button">
                            {{ $admin->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5">
                    No administrators found.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>