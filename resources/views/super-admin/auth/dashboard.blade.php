<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Super Admin Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .logout-button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 9px 16px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: 600;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin-bottom: 10px;
        }

        .card p {
            color: #6b7280;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 7px;
        }

        @media (max-width: 700px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 15px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">

        <h2>Super Admin Panel</h2>

        <form method="POST" action="{{ route('super-admin.logout') }}">
            @csrf
            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>

    </div>

    <div class="container">

        <div class="welcome">

            <h1>
                Welcome, {{ auth()->user()->name }}
            </h1>

            <p>
                Manage your administration system from here.
            </p>

        </div>

        <div class="cards">

            <div class="card">
                <h3>Manage Admins</h3>

                <p>
                    Create, edit, activate and deactivate administrators.
                </p>

                <a href="#" class="button">
                    Manage Admins
                </a>
            </div>

            <div class="card">
                <h3>View Users</h3>

                <p>
                    View all users and their assigned administrators.
                </p>

                <a href="#" class="button">
                    View Users
                </a>
            </div>

            <div class="card">
                <h3>System</h3>

                <p>
                    You are logged in as Super Administrator.
                </p>

                <span>
                    Role: <strong>{{ auth()->user()->role }}</strong>
                </span>
            </div>

        </div>

    </div>

</body>
</html>