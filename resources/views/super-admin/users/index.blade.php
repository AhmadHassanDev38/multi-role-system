<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>All Users</title>

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

        .header a {
            color: white;
            text-decoration: none;
        }

        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
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
    </style>
</head>

<body>

<div class="header">
    <h2>Super Admin - All Users</h2>

    <a href="{{ route('super-admin.dashboard') }}">
        ← Dashboard
    </a>
</div>

<div class="container">

    <h1>All Users</h1>

    <div class="card">

        <table>

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Status</th>
                    <th>Created</th>
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
                        {{ $user->admin ? $user->admin->name : 'No Admin' }}
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

</div>

</body>
</html>