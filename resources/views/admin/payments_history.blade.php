<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment history | Push N Pull</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
        :root {
            --primary-color: #10a37f;
            --warning: #f39c12;
            --danger: #e74c3c;
            --bg-dark:  black;
            --text-white: #ffffff;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }

        body {
            background:#7FFF00;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
        }
        /* --- SIDEBAR (UNTOUCHED) --- */
        nav {
            width: 260px;
            height: 100vh;
            background: var(--bg-dark);
            color: var(--text-white);
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 35px 20px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            border: 3px solid #d4af37;
            object-fit: cover;
            background-color: #1a1a1a;
        }

        .logo span {
            font-weight: 800;
            padding-left: 15px;
            font-size: 20px;
            color: green;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            flex-grow: 1;
        }

        nav ul li a {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 15px 25px;
            transition: 0.3s;
        }

        nav ul li a i {
            width: 30px;
            font-size: 18px;
            text-align: center;
        }

        nav ul li a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 35px;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .header h1 { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 5px; }
        .header p { color: #64748b; margin-bottom: 30px; }

        /* --- DASHBOARD GRID (5 Parallel Cards) --- */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            border-left: 5px solid #cbd5e1;
            transition: transform 0.3s;
        }
        .card:hover { transform: translateY(-5px); }

        .label-text { font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 10px; }
        .value { font-size: 24px; font-weight: 800; color: #1e293b; }
        .sub-text { font-size: 12px; color: #94a3b8; margin-top: 5px; }

        /* --- ADMIN DATA SECTION --- */
        .data-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        }

        .data-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; }
        table th { text-align: left; padding: 15px; color: #64748b; font-size: 13px; border-bottom: 2px solid #f1f5f9; }
        table td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #fff7ed;
            color: #9a3412;
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('admin.dashboard') }}" class="logo">
    <img src="{{ asset('image/gym.jpg') }}" alt="Logo">

        <span>UNIQUE PLUS GYM</span>
    </a>

    <ul>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.index') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i> <span>Manage Members</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('admin.trainers.index') }}" class="{{ request()->routeIs('admin.trainers.index') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> <span>Manage Trainers</span>
            </a>
        </li>

    <li>
    <a href="{{ route('admin.trainer_bookings.index') }}" class="{{ request()->routeIs('admin.trainer_bookings.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> <span>Trainer Bookings</span>
    </a>
   </li>
        <li>
            <a href="{{ route('admin.equipment.index') }}" class="{{ request()->routeIs('admin.equipment.index') ? 'active' : '' }}">
                <i class="fas fa-tools"></i> <span>Equipment Reports</span>
            </a>
        </li>
        
        <li>
            <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">
                <i class="fas fa-tools"></i> <span>Payment History</span>
            </a>
        </li>

      
 

        <li style="margin-top: auto;">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #ff4d4d;">
                <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<div class="main-content" style="margin-left: 260px; padding: 50px; font-family: 'Poppins', sans-serif;">
  <div class="header-section" style="margin-bottom: 45px; border-bottom: 3px solid maroon; padding-bottom: 20px;">
        <h1 style="color: green; font-weight: 800; font-size: 3rem; margin-bottom: 10px; letter-spacing: -1px;">
            <i class="fa fa-credit-card"></i> Payment Management
        </h1>
        <p style="color: #4a5568; font-size: 1.1rem; font-weight: 300;">
            Overview of member subscription transactions and gym revenue.
        </p>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div class="stat-box" style="background: white; padding: 25px; border-radius: 15px; border-left: 5px solid maroon; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: #718096; font-size: 14px; text-transform: uppercase;">Total Revenue</h3>
            <p style="font-size: 28px; font-weight: 800; color: #2d3748; margin: 10px 0;">RM {{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="stat-box" style="background: white; padding: 25px; border-radius: 15px; border-left: 5px solid #d4af37; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="color: #718096; font-size: 14px; text-transform: uppercase;">Pending Transactions</h3>
            <p style="font-size: 28px; font-weight: 800; color: #d4af37; margin: 10px 0;">{{ $pendingCount }}</p>
        </div>
    </div>

    <div class="card" style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
        <h2 style="font-size: 20px; margin-bottom: 20px;">Transaction Records</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #edf2f7;">
                    <th style="padding: 15px; color: #718096; font-size: 13px;">TRANSACTION ID</th>
                    <th style="padding: 15px; color: #718096; font-size: 13px;">MEMBER NAME</th>
                    <th style="padding: 15px; color: #718096; font-size: 13px;">MEMBERSHIP PLAN</th>
                    <th style="padding: 15px; color: #718096; font-size: 13px;">PAYMENT METHOD</th>
                    <th style="padding: 15px; color: #718096; font-size: 13px;">AMOUNT (RM)</th>
                    <th style="padding: 15px; color: #718096; font-size: 13px;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 15px;">{{ $payment->id ?: '-' }}</td>
                    <td style="padding: 15px; font-weight: 600;">{{ $payment->user ?: '' }}</td>
                    <td style="padding: 15px;">{{ $payment->plan ?: '' }}</td>
                    <td style="padding: 15px;">{{ $payment->method ?: '' }}</td>
                    <td style="padding: 15px; font-weight: 700;">{{ $payment->amount ?: '0.00' }}</td>
                    <td style="padding: 15px;">
                        @if($payment->status)
<span style="
    padding: 5px 12px; 
    border-radius: 20px; 
    font-size: 11px; 
    font-weight: 800;
    text-transform: uppercase;
    background: '{{ $payment->status == 'paid' ? '#d4edda' : '#fff3cd' }}';
    color: '{{ $payment->status == 'paid' ? '#155724' : '#856404' }}';
">
    {{ $payment->status }}
</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0;">
                        No payment records currently available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>