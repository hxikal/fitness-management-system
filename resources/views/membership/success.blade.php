<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Verified - Unique Plus Gym</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #101410;
            color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .page {
            width: 100%;
            max-width: 520px;
        }

        .brand {
            text-align: center;
            margin-bottom: 22px;
        }

        .brand-mark {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #7fff00;
            background: #0b0f0b;
        }

        .brand-name {
            margin: 12px 0 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0;
            text-transform: uppercase;
            color: #7fff00;
        }

        .card {
            background: #ffffff;
            color: #1f2937;
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.35);
            border-top: 6px solid #22c55e;
        }

        .success-icon {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            font-weight: 800;
            margin: 0 auto 18px;
        }

        h1 {
            margin: 0;
            text-align: center;
            font-size: 26px;
            color: #111827;
        }

        .subtitle {
            margin: 10px 0 28px;
            text-align: center;
            color: #64748b;
            font-size: 15px;
        }

        .details {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 26px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 15px 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .row:last-child {
            border-bottom: 0;
        }

        .label {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
        }

        .value {
            color: #111827;
            font-size: 14px;
            font-weight: 700;
            text-align: right;
        }

        .status {
            color: #15803d;
            background: #dcfce7;
            padding: 4px 10px;
            border-radius: 999px;
        }

        .actions {
            display: flex;
            justify-content: center;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border-radius: 6px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
        }

        .button:hover {
            background: #22c55e;
            color: #081108;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
                align-items: flex-start;
            }

            .card {
                padding: 24px 18px;
            }

            h1 {
                font-size: 22px;
            }

            .row {
                flex-direction: column;
                gap: 6px;
            }

            .value {
                text-align: left;
            }

            .button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="brand">
            <img class="brand-mark" src="{{ asset('image/gym.jpg') }}" alt="Unique Plus Gym">
            <p class="brand-name">Unique Plus Gym</p>
        </div>

        <section class="card">
            <div class="success-icon">&#10003;</div>

            <h1>Membership Verified</h1>
            <p class="subtitle">The member account has been activated successfully.</p>

            <div class="details">
                <div class="row">
                    <span class="label">Member Name</span>
                    <span class="value">{{ $user->name }}</span>
                </div>
                <div class="row">
                    <span class="label">Membership Status</span>
                    <span class="value status">Active</span>
                </div>
                <div class="row">
                    <span class="label">Expiry Date</span>
                    <span class="value">
                        {{ $user->membership_expiry ? \Carbon\Carbon::parse($user->membership_expiry)->format('d M Y') : 'Not set' }}
                    </span>
                </div>
            </div>

            <div class="actions">
                <a class="button" href="{{ route('userdashboard') }}">Back to Dashboard</a>
            </div>
        </section>
    </main>
</body>
</html>
