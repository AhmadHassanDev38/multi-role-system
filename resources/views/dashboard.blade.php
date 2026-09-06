<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        .header h2 {
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .welcome h1 {
            margin-top: 0;
        }

        .welcome p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .button {
            display: inline-block;
            margin-top: 15px;
            background: #111827;
            color: white;
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 8px;
        }

        .logout {
            background: none;
            border: 0;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="header">

        <h2>User Dashboard</h2>

        <form method="POST" action="{{ route('user.logout') }}">
            @csrf

            <button type="submit" class="logout">
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
                You are successfully logged in as a User.
            </p>

        </div>

        <div class="cards">

            <div class="card">

                <h3>My Profile</h3>

                <p>
                    View and update your profile information.
                </p>

                <a
                    href="{{ route('profile.edit') }}"
                    class="button"
                >
                    My Profile
                </a>

            </div>

            <div class="card">

                <h3>Account Information</h3>

                <p>
                    Email:
                    <strong>{{ auth()->user()->email }}</strong>
                </p>

                <p>
                    Role:
                    <strong>{{ auth()->user()->role }}</strong>
                </p>

            </div>

        </div>

    </div>

</body>

</html>