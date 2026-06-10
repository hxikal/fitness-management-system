<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | UNIQUE PLUS GYM</title>
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
            background: #7FFF00;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
        }
        /* --- SIDEBAR --- */
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

    <div class="main-content">
        <div class="header">
           <h1>Welcome back, admin</h1>
                <span style="font-size: 12px; background: #800000; color: white; padding: 4px 10px; border-radius: 20px; vertical-align: middle; margin-left: 10px;">ADMIN ACCESS</span>
            </h1>
            <p>System Overview and Management Portal</p>
        </div>

<div class="dashboard-grid">
    <!-- Total Members -->
    <a href="{{ route('admin.members.index') }}" style="text-decoration:none; color:inherit;">
        <div class="card" style="border-left-color: var(--primary-color);">
            <p class="label-text">Total Members</p>
            <div class="value">{{ $totalMembers ?? '0' }}</div>
            <div class="sub-text">Active registrations</div>
        </div>
    </a>

        <!-- Trainer Bookings -->
<a href="{{ route('admin.trainer_bookings.index') }}" style="text-decoration:none; color:inherit;">
    <div class="card" style="border-left-color: #f59e0b;">
        <p class="label-text">Trainer Bookings</p>
        <div class="value">{{ $totalTrainerBookings ?? '0' }}</div>
        <div class="sub-text">User training sessions</div>
    </div>
</a>

        <!-- Equipment Reports -->
    <a href="{{ route('admin.equipment.index') }}" style="text-decoration:none; color:inherit;">
        <div class="card" style="border-left-color: var(--danger);">
            <p class="label-text">Equip. Reports</p>
            <div class="value" style="color: var(--danger);">{{ $pendingEquipmentReports ?? '0' }}</div>
            <div class="sub-text">Repairs needed</div>
        </div>
    </a>

    <!-- Payments -->
    <a href="{{ route('admin.payments.index') }}" style="text-decoration:none; color:inherit;">
        <div class="card" style="border-left-color: #3b82f6;">
            <p class="label-text">Payments</p>
            <div class="value">Not Verified</div>
            <div class="sub-text">System billing status</div>
        </div>
    </a>

</div>

<div class="data-section">
    <div class="data-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="color: #1e293b; margin: 0;">
            <i class="fas fa-tools" style="color: #800000; margin-right: 10px;"></i> 
            Recent Equipment Reports
        </h3>
        <a href="{{ route('admin.equipment.index') }}" 
           style="background: #800000; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer; font-size: 13px; text-decoration: none; font-weight: bold;">
            View All
        </a>
    </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipment Name</th>
                        <th>Issue Reported</th>
                        <th>Report Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
<tbody>
    @forelse($reports as $report)
    <tr>
        <td>#EQ-{{ $report->id ?? '-' }}</td>
        <td style="font-weight: 600; color: #1e293b;">{{ $report->equip_name ?? 'N/A' }}</td>
        <td>{{ $report->description ?? 'No issue description' }}</td>
        <td>{{ $report->created_at ? $report->created_at->format('d/m/Y') : '-' }}</td>
        <td>
            @if(isset($report->status))
                @if(strtolower($report->status) == 'fixed' || strtolower($report->status) == 'paid')
                    <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; background: #d4edda; color: #155724;">
                        {{ $report->status }}
                    </span>
                @elseif(strtolower($report->status) == 'pending')
                    <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; background: #fff3cd; color: #856404;">
                        {{ $report->status }}
                    </span>
                @else
                    <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase; background: #e2e8f0; color: #4a5568;">
                        {{ $report->status }}
                    </span>
                @endif
            @else
                <span style="padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; background: #e2e8f0; color: #4a5568;">
                    UNKNOWN
                </span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" style="text-align: center; padding: 40px; color: #a0aec0;">
            No equipment reports currently available.
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>

   

    <script>
        function confirmLogout() {
            if(confirm('Are you sure you want to log out?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>
</html>