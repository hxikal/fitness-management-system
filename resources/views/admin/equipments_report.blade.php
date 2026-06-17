
<head>

   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Equipment Reports</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
 

<style>
        :root {
            --primary-color: #10a37f;
            --warning: #f39c12;
            --danger: #e74c3c;
            --bg-dark: black;
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

        .main-content {
    margin-left: 260px;   /* space for sidebar */
    padding: 40px;
    flex: 1;
}

/* For smaller screens (phones/tablets) */
@media (max-width: 768px) {
    .main-content {
        margin-left: 0;       /* remove sidebar offset */
        padding: 20px;        /* smaller padding */
        font-size: 18px;      /* bigger text for clarity */
    }

    .header-section h1 {
        font-size: 28px;      /* larger title */
    }

}


        .status-tag {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    display: inline-block;
    text-align: center;
}

.status-pending {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

.status-fixed {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Hover effect for table rows */
tbody tr:hover {
    background-color: #f9f9f9;
    transition: 0.2s;
}
</style>


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
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<div class="main-content" style="margin-left: 260px; padding: 40px;">
    <div class="header-section">
        <b><h1 style="color: maroon;">Global Equipment Reports</h1></b>
        <p>All data submitted by users for gym maintenance.</p>
    </div>

    

    <div class="card" style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: maroon; color: white; text-align: left;">
                    <th style="padding: 15px;">Date</th>
                    <th style="padding: 15px;">User</th>
                    <th style="padding: 15px;">Equipment</th>
                    <th style="padding: 15px;">Issue</th>
                    <th style="padding: 15px;">Image</th> 
                    <th style="padding: 15px;">Status</th>
                    <th style="padding: 15px;">Action</th>
                </tr>
            </thead>
<tbody>
    @foreach($reports as $report)
    <tr style="border-bottom: 1px solid #edf2f7;">
        <td style="padding: 15px;">{{ $report->created_at->format('d/m/Y') }}</td>
        <td style="padding: 15px; font-weight: 600;">{{ $report->user->name }}</td>
        <td style="padding: 15px;">{{ $report->equip_name }}</td>
        <td style="padding: 15px;">{{ preg_replace('/\[Image:.*?\]/', '', $report->description ) }}</td>
        
 <td style="padding: 15px;">
    @php
        // 1. Extract only the image path using regex
        preg_match('/\[Image: (.*?)\]/', $report->description, $matches);
        $imagePath = $matches[1] ?? null;
    @endphp

    {{-- Show the image thumbnail ONLY --}}
    @if($imagePath)
        <div style="margin-top: 8px;">
            <a href="{{ asset('storage/' . $imagePath) }}" target="_blank">
                <img src="{{ asset('storage/' . $imagePath) }}" 
                     style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
            </a>
        </div>
    @else
        <span style="color: #999;">No image</span>
    @endif
</td>
        <td style="padding: 15px;">
            <span class="status-tag {{ $report->status == 'fixed' ? 'status-fixed' : 'status-pending' }}">
                {{ strtoupper($report->status) }}
            </span>
        </td>
  <td style="padding: 15px; display: flex; gap: 5px;">
  <form action="{{ route('admin.equipment.update', $report->id) }}" method="POST">
    @csrf
    @method('PUT')
     
        <select name="status" onchange="this.form.submit()" style="padding:5px;">
        <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>
            Pending
        </option>
        <option value="fixed" {{ $report->status == 'fixed' ? 'selected' : '' }}>
            Fixed
        </option>
    </select>
  </form>

   <form action="{{ route('admin.equipment.destroy', $report->id) }}" method="POST"
      onsubmit="return confirm('Are you sure you want to delete this report?');">
    @csrf
    @method('DELETE')
        <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
            Delete
        </button>
    </form>
</td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
</body>
</html>
