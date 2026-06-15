<!DOCTYPE html>

<html lang = "en">

<head>

   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Member Dashboard</title>
    
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


.main-content {
    margin-left: 260px; 
    padding: 60px 40px;
    width: calc(100% - 260px);
    min-height: 100vh;
    box-sizing: border-box;

    /* Background image setup */
    background-image: url("{{ asset('image/uniquebackground.png') }}");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: contain;
    background-attachment: fixed;

    /* Add a subtle overlay tint so card elements don't entirely smother the logo details */
    background-color: rgba(118, 255, 3, 0.03); 
}




/* --- HEADER TITLE --- */
.header h1 {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
    font-size: 42px; /* ✅ slightly larger for prominence */
    font-weight: 800; /* ✅ bold, strong presence */
    text-transform: uppercase; /* ✅ matches MEMBERSHIP STATUS style */
    -webkit-text-fill-color: black;
    letter-spacing: 1px; /* ✅ clean spacing for caps */
    margin-bottom: 12px;
    line-height: 1.3;
}

/* --- HEADER TITLE --- */
.header h1 {
    font-family: Georgia (serif);
    font-size: 44px;          /* ✅ larger for impact */
    font-weight: 900;         /* ✅ extra bold */
    text-transform: uppercase;/* ✅ matches LOG OUT style */
    color: black;           /* ✅ crisp white for clarity */
    letter-spacing: 1.5px;    /* ✅ spacing for uppercase readability */
    margin-bottom: 14px;
    line-height: 1.3;
}

/* --- SUBTITLE TEXT --- */
.header p {
    font-family: sans-serif;
    font-size: 20px;
    font-weight: 500;
    color: green;                 
    -webkit-text-fill-color: #f1f5f9; 
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6); 
    margin-top: 0;
    line-height: 1.7;
}


.dashboard-grid {
    display: grid;
    /* Menggunakan auto-fill supaya bilangan kad menyesuaikan diri secara automatik ikut lebar skrin */
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); 
    justify-content: center; 
    align-content: center;
    gap: 20px;                
    width: 100%;
    max-width: 1400px;       
    margin: 40px auto 0 auto; 
    box-sizing: border-box;
}

/* --- 2. PEMBETULAN KAD (BUANG LEBAR TEGAP BERPIKSEL) --- */
.dashboard-grid .card {
    width: 100% !important;   
    max-width: 100% !important; /* Tukar dari 280px kepada 100% supaya ia mengikut saiz grid */
    height: auto !important;  
    min-height: 250px;        
    margin: 0 auto;           
}

.card {
    width: 100%;               /* Biarkan kad mengembang mengikut ruang grid yang ada */
    min-height: 250px;        
    height: auto;             
    background: black; 
    padding: 24px;            
    border: 1px solid rgba(191, 255, 0, 0.15);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    box-sizing: border-box;
    transition: transform 0.2s ease, border 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-5px);

    /* Slightly brighter background on hover */
    background: #334155;

    /* Neon green border highlight */
    border: 1px solid rgba(191, 255, 0, 0.45);

    /* Soft neon glow */
    box-shadow:
        0 15px 35px rgba(0, 0, 0, 0.45),
        0 0 20px rgba(191, 255, 0, 0.08);
}

.card h3,
.card .label-text {
    font-size: 12px;
    color: white;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.05em;
    margin: 0 0 20px 0;
    opacity: 0.9;
}

.card .value,
.card h2 {
    font-family: var(--font-display);
    font-size: 32px;
    font-weight: 700;
    color: white;
    margin: 0;
    line-height: 1.1;
}

.card .sub-text {
    font-size: 13px;
    color: #94a3b8; /* Light slate gray */
    margin-top: 10px;
}
   
</style>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gym Member Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav>
        <a href="#" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>Unique Plus Gym</span>
        </a>
        <ul>
           <li>
    <a href="{{ route('userdashboard') }}">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
    </a>
</li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-id-card"></i> <span>Membership info</span></a></li>
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Payment</span></a></li>
            <li><a href="{{ route('equipment.report.index') }}"><i class="fas fa-tools"></i> <span>Equipment Report</span></a></li>
            <li><a href="{{ route('fitnesstrainer') }}"><i class="fas fa-calendar-check"></i> <span>Fitness Trainer</span></a></li>
            <li style="margin-top: 20px;">
 <div style="border-top: 1px solid #333;"> 
    <a href="#" 
       onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();" 
       style="display: flex; align-items: center; gap: 15px; padding: 20px; color: #ff4d4d; text-decoration: none; font-weight: bold; font-size: 16px;">
        
        <span style="font-size: 18px;"></span> 
        
        <span>Log Out</span>
    </a>

    <form id="user-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
            </li>
        </ul>
    </nav>

<div class="main-content">
<div style="font-family: 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif; -webkit-font-smoothing: antialiased; margin-bottom: 20px; padding-left: 5px;">
    <h2 style="margin: 0; font-size: 30px; font-weight: 700; color: #111111; letter-spacing: -0.5px;">
        Welcome, {{ Auth::user()->name }}
    </h2>
    <p style="margin: 6px 0 0 0; font-size: 20px; color: #4a5568; font-weight: 400;">
         Monitor your fitness and membership status below.
    </p>
</div>

<div class="session-box" style="font-family: 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif; -webkit-font-smoothing: antialiased; background: #ffffff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06); max-width: 360px; display: flex; flex-direction: column; gap: 12px; border: 1px solid #edf2f7;">
    
<div style="display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 600; font-size: 14px; color: #4a5568;">Status:</span>
        <span style="font-weight: 700; color: #38a169; background: #f0fff4; padding: 5px 12px; border-radius: 6px; font-size: 12px; display: inline-block; letter-spacing: 0.3px;">
            Online
        </span>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 600; font-size: 14px; color: #4a5568;">User:</span>
        <span style="font-weight: 600; font-size: 14px; color: #2d3748;">
            {{ session('user_name') ?? 'Guest' }}
        </span>
    </div>
    
    <hr style="border: 0; border-top: 1px dashed #e2e8f0; margin: 4px 0 0 0; padding: 0;">

    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px;">
        <span style="font-weight: 500; color: #718096;">System Time:</span>
        <span style="color: #2b6cb0; font-weight: 600; font-variant-numeric: tabular-nums;">
            {{ \Carbon\Carbon::now()->timezone('Asia/Kuala_Lumpur')->format('M d, Y, h:i a') }}
        </span>
    </div>

</div>

    <!-- ✅ Wrap all cards inside dashboard-grid -->
<div class="main-content">
    <div class="dashboard-grid">

    <div class="card">
        <p class="label-text">MEMBERSHIP STATUS</p>
        @if(Auth::user() && Auth::user()->is_active && Auth::user()->membership_expiry)
            <h2 style="color:#27ae60;">ACTIVE</h2>
            <p class="sub-text">Status: Membership Verified</p>
            <p class="sub-text">Expires: {{ \Carbon\Carbon::parse(Auth::user()->membership_expiry)->format('d-m-Y') }}</p>
        @else
            <h2 style="color:#e74c3c;">NOT ACTIVE</h2>
            <p class="sub-text" style="color:#f39c12;">Verification Required</p>
            <p class="sub-text">Please show your QR code to the admin.</p>
        @endif
    </div>

 <!-- Payment Status card -->
<a href="{{ route('payment_history') }}" style="text-decoration:none; color:inherit;">
    <div class="card" style="cursor:pointer;">
        <p class="label-text">Payment Status</p>
        <div class="value" style="color:red;">Not Paid</div>
        <div class="sub-text">Monthly Subscription: Not added</div>
    </div>
</a>

<!-- Workout Sessions card -->
<a href="{{ route('fitnesstrainer') }}" style="text-decoration:none; color:inherit;">
    <div class="card" style="cursor:pointer;">
        <p class="label-text">Workout Sessions</p>
        <div class="value" style="color:blue;">{{ $totalSessions ?? 0 }} Session</div>
        <div class="sub-text">Click to see booking record.</div>
    </div>
</a>

<!-- Unpaid Notifications card -->
<a href="{{ route('payment_history') }}" style="text-decoration:none; color:inherit;">
    <div class="card" style="cursor:pointer;">
        <p class="label-text">Unpaid Notifications</p>
        <div class="value" style="color:blue;">RM 0.00</div>
        <div class="sub-text">No outstanding balances.</div>
    </div>
</a>

<!-- Maintenance Alerts card -->
<a href="{{ route('equipment.report.index') }}" style="text-decoration:none; color:inherit;">
    <div class="card" style="cursor:pointer;">
        <p class="label-text">Maintenance Alerts</p>
        <div class="value" style="color:blue;">{{ $maintenanceAlerts ?? 0 }} Pending</div>
        <div class="sub-text">Check the report.</div>
    </div>
</a>

</div>
<!-- Background image container -->
    <div class="dashboard-bg"></div>
</div>

</body>
</html>
