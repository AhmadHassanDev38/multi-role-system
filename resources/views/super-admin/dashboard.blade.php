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
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar {
            height: 70px;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 35px;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .user-area {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-size: 14px;
        }

        .logout {
            border: none;
            background: #ef4444;
            color: white;
            padding: 9px 15px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 25px;
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
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #eef2ff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            font-size: 22px;
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }

            .user-name {
                display: none;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <h2>Super Admin Panel</h2>

    <div class="user-area">

        <span class="user-name">
            {{ auth()->user()->name }}
        </span>

        <form method="POST" action="{{ route('super-admin.logout') }}">
            @csrf

            <button class="logout" type="submit">
                Logout
            </button>
        </form>

    </div>

</nav>

<main class="container">

    <section class="welcome">

        <h1>
            Welcome, {{ auth()->user()->name }}
        </h1>

        <p>
            Manage administrators and users from your control panel.
        </p>

    </section>

    <section class="cards">

        <div class="card">

            <div class="card-icon">
                👨‍💼
            </div>

            <h3>Manage Admins</h3>

            <p>
                Create, edit, activate and deactivate administrators.
            </p>

            <a href="{{ route('super-admin.admins.index') }}" class="button">
                Manage Admins
            </a>

        </div>

        <div class="card">

            <div class="card-icon">
                👥
            </div>

            <h3>All Users</h3>

            <p>
                View all users and see which administrator manages each user.
            </p>

            <a href="{{ route('super-admin.users.index') }}" class="button">
                View Users
            </a>

        </div>

        <div class="card">

            <div class="card-icon">
                🔐
            </div>

            <h3>Account</h3>

            <p>
                You are logged in as the system Super Administrator.
            </p>

            <strong>
                Role: {{ auth()->user()->role }}
            </strong>

        </div>

    </section>

</main>

</body>
</html>