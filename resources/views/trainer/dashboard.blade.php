
<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
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

    body ::selection {
        background: var(--color-green-400);
        color: black;
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

        /* 1. Memaksa butang mengekalkan warna teks putih dan latar belakang telus */
.custom-logout-btn {
    background: none !important;
    background-color: transparent !important;
    color: #ffffff !important;
    border: none !important;
}

/* 2. Menghalang ::selection daripada menukarkan warna kawasan butang ini kepada hijau */
.custom-logout-btn::selection,
.custom-logout-btn *::selection {
    background: transparent !important;
    color: #ffffff !important;
}

/* 3. Menghilangkan gangguan warna hijau semasa butang diklik atau dipilih (Focus/Active) */
.custom-logout-btn:focus,
.custom-logout-btn:active {
    background: none !important;
    background-color: transparent !important;
    outline: none !important;
    color: #ffffff !important;
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

        /* Add this inside your existing <style> block to format the table columns cleanly */
   .booking-table-container {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    margin-top: 30px;
    overflow-x: auto;
}

/* Pastikan ini ada dalam <style> anda */
.custom-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* KUNCI UTAMA: Menetapkan lebar kolum agar tetap/selari */
    text-align: left;
}

.custom-table th, 
.custom-table td {
    padding: 15px;
    border-bottom: 1px solid #e2e8f0;
    word-wrap: break-word; /* Memastikan teks panjang tidak melimpah */
}

/* Tetapkan peratusan lebar setiap kolum */
.custom-table th:nth-child(1) { width: 15%; } /* User */
.custom-table th:nth-child(2) { width: 15%; } /* Date */
.custom-table th:nth-child(3) { width: 15%; } /* Time */
.custom-table th:nth-child(4) { width: 20%; } /* Activity */
.custom-table th:nth-child(5) { width: 15%; } /* Status */
.custom-table th:nth-child(6) { width: 20%; text-align: center; } /* Action */

    /* Status Badges */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
        display: inline-block;
    }
    .badge-confirmed { background-color: #dcfce7; color: #15803d; }
    .badge-pending { background-color: #fef9c3; color: #a16207; }
    .badge-cancelled { background-color: #fee2e2; color: #b91c1c; }

    /* Action Buttons Row Configuration */
    .action-group {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        color: white;
    }
    .btn-confirm { background-color: #10a37f; }
    .btn-confirm:hover { background-color: #0d8a6b; }
    .btn-deny { background-color: #e74c3c; }
    .btn-deny:hover { background-color: #c0392b; }

        </style>

<nav>
    <a href="#" class="logo">
      <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
        <span>Unique Plus Gym</span>
    </a>
    <ul>
        <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('trainer.session.index') }}"><i class="fa fa-calendar"></i> My Sessions</a></li>
        <li><a href="{{ route('trainer.profile') }}"><i class="fa fa-user"></i> My Profile</a></li>
                <li>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<div style="background-color: #000000; width: 100%; padding: 12px 20px; box-sizing: border-box;">
    
    <button class="custom-logout-btn" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            style="cursor: pointer; display: flex; align-items: center; gap: 10px; font-size: 16px; font-family: inherit; font-weight: 500; padding: 0; margin: 0;">
        
        <i class="fa fa-sign-out-alt" style="line-height: 1;"></i>
        <span>Logout</span>
        
    </button>
</div>
            </li>   
        </li>
    </ul>
</nav>


<div class="main-content">
    <div style="font-family: 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif; -webkit-font-smoothing: antialiased; margin-bottom: 20px; padding-left: 5px;">
        <h2 style="margin: 0; font-size: 30px; font-weight: 700; color: #111111; letter-spacing: -0.5px;">
            Welcome, {{ auth()->user()->name }}
        </h2>
    </div>

   <div class="dashboard-grid">
    <div class="card">
        <div class="label-text">Total Sessions</div>
        <div class="value">{{ $bookings->count() }}</div>
        <div class="sub-text">All bookings assigned to you</div>
    </div>

    <div class="card">
        <div class="label-text">Confirmed</div>
        <div class="value">{{ $bookings->where('status','Confirmed')->count() }}</div>
        <div class="sub-text">Sessions ready to run</div>
    </div>

    <div class="card">
        <div class="label-text">Cancelled</div>
        <div class="value">{{ $bookings->where('status','Cancelled')->count() }}</div>
        <div class="sub-text">Cancelled by trainer or user</div>
    </div>

    <div class="card">
        <div class="label-text">Pending</div>
        <div class="value">{{ $bookings->where('status','Pending')->count() }}</div>
        <div class="sub-text">Pending by trainer or user</div>
    </div>

    <div class="card">
        <div class="label-text">Today’s Sessions</div>
        <div class="value"> {{ $bookings->filter(function($b) {
            return \Carbon\Carbon::parse($b->booking_date)->isToday();
        })->count() }}</div>
        <div class="sub-text">Scheduled for {{ now()->format('d/m/Y') }}</div>
    </div>
</div>
<!--  Existing Bookings Table -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">My Bookings</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
  <table class="table table-striped table-hover align-middle custom-table">
    <thead class="table-dark">
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Time</th>
            <th>Activity</th>
            <th>Status</th>
            <th class="text-center">Action</th> </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <td>{{ optional($booking->user)->name ?? 'No User' }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</td>
            <td>{{ $booking->activity }}</td>
            <td>
                <span class="badge {{ strtolower($booking->status) == 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                    {{ $booking->status }}
                </span>
            </td>
            <td class="text-center">
                <form action="{{ route('trainer.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="Confirmed" class="btn btn-success btn-sm">Confirm</button>
                    <button type="submit" name="status" value="Pending" class="btn btn-success btn-sm">Pending</button>
                    <button type="submit" name="status" value="Cancelled" class="btn btn-danger btn-sm">Deny</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
        </div>
    </div>
</div>
</body>
</html>


