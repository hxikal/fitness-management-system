
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Trainer Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #10a37f;
            --bg-dark: black;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }
        body { background:  #7FFF00; font-family: var(--font-main); margin: 0; display: flex; }
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
        
        /* CONTENT AREA */
        main { margin-left: 260px; width: calc(100% - 260px); padding: 40px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #e3e6f0; text-align: left; }
        th { background: #f8f9fc; }
        .badge { padding: 5px 10px; border-radius: 4px; color: white; font-size: 12px; }

        /* Make the entire table background white */
.booking-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #ffffff;
    color: #000000; /* All text black */
    font-family: inherit; /* Keep your existing font */
}

/* Header cells */
.booking-table th {
    background-color: #f8f9fa; /* Light gray header */
    color: #000000 !important; /* Header text black */
    padding: 12px;
    text-align: left;
    border: 1px solid #dddddd;
}

/* Body rows */
.booking-table tbody tr,
.booking-table tbody tr:nth-child(even),
.booking-table tbody tr:nth-child(odd) {
    background-color: #ffffff !important;
}

/* Table data cells */
.booking-table td {
    background-color: #ffffff !important;
    color: #000000 !important; /* Body text black */
    padding: 12px;
    border: 1px solid #dddddd;
}

/* Ensure links/icons inside cells remain black unless overridden */
.booking-table td a,
.booking-table td i {
    color: #000000;
}

/* Keep delete button red with white text */
.booking-table button {
    background-color: #e74c3c !important;
    color: #ffffff !important;
    border: none;
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

    <main>
    <h2>Trainer Bookings Management</h2>



<table class="booking-table">

    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Trainer</th>
            <th>Date & Time</th>
            <th>Activity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
<tbody>
    @forelse($bookings as $booking)
        <tr>
            <td>{{ $booking->id }}</td>
            <td>{{ $booking->user_id }}</td> <!-- shows user ID -->
            <td>{{ $booking->trainer_name }}</td> <!-- trainer name from booking -->
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->booking_time }}</td>
            <td>{{ $booking->activity }}</td>
            <td>{{ ucfirst($booking->status) }}</td>
            <td>
                <form action="{{ route('admin.trainer-bookings.destroy', $booking->id) }}"
                      method="POST"
                      style="display:inline;"
                      onsubmit="return confirm('Delete this booking?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" style="text-align:center;">No bookings found.</td>
        </tr>
    @endforelse
</tbody>


</main>

<script>
    
</script>
    
       

</body>
</html>