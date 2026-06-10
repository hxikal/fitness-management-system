<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Feedback | Push N Pull</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

 <style>
        :root {
            --primary-color: #10a37f;
            --bg-dark: maroon;
            --text-white: #ffffff;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg-light);
            font-family: var(--font-main);
            margin: 0;
            display: flex;
        }


        :root {
            --primary-color: #10a37f;
            --warning: #f39c12;
            --danger: #e74c3c;
            --bg-dark: #800000; /* Maroon */
            --text-white: #ffffff;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: var(--bg-light); font-family: var(--font-main); display: flex; }

        /* --- SIDEBAR --- */
        nav {
            width: 260px;
            height: 100vh;
            background: var(--bg-dark);
            color: var(--text-white);
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 30px 20px;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo img {
            width: 50px; height: 50px;
            border-radius: 50%;
            border: 2px solid #ffd700;
            object-fit: cover;
        }

        .logo span {
            font-weight: 800;
            padding-left: 12px;
            font-size: 18px;
            color: #ffd700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        nav ul { list-style: none; padding: 20px 0; flex-grow: 1; }
        nav ul li a {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            padding: 15px 25px;
            transition: 0.3s;
        }

        nav ul li a i { width: 30px; font-size: 18px; }
        nav ul li a:hover, nav ul li a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid #ffd700;
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
  
        body { 
            font-family: 'Inter', sans-serif; 
            padding: 40px; 
            background: var(--bg-light); 
            color: var(--header-black);
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card { 
            background: white; 
            padding: 35px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
            border: 1px solid #edf2f7;
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 { font-size: 28px; font-weight: 800; margin: 0; display: flex; align-items: center; gap: 12px; }
        h1 i { color: var(--primary-blue); }

        /* Search Bar */
        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            outline: none;
            transition: 0.3s;
        }

        .search-box input:focus { border-color: var(--primary-blue); }
        .search-box i { position: absolute; left: 15px; top: 12px; color: var(--text-gray); }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        
        thead th { 
            text-align: left; 
            padding: 15px; 
            background: #f8fafc;
            color: var(--text-gray);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #edf2f7;
        }

        tbody td { 
            padding: 18px 15px; 
            border-bottom: 1px solid #edf2f7;
            transition: background 0.2s;
        }

        tbody tr:hover td { background: #fdfdfd; }

        .star-rating { color: var(--star-gold); font-size: 14px; }
        .star-off { color: #cbd5e0; }

        .no-data { text-align: center; color: var(--text-gray); padding: 60px; font-style: italic; }
        
        /* Action Buttons */
        .btn-edit {
            background: #ebf8ff;
            color: var(--primary-blue);
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-edit:hover { background: var(--primary-blue); color: white; }

        /* --- LAYOUT FIX --- */
.container {
    margin-left: 280px; /* Offset for the 260px sidebar + 20px breathing room */
    max-width: calc(100% - 320px);
    padding: 40px;
    animation: fadeIn 0.5s ease-in-out;
}

/* --- SUMMARY BOXES STYLING --- */
.feedback-summary {
    margin-bottom: 30px;
}

#feedbackStats {
    display: flex;
    gap: 20px;
    margin-top: 15px;
}

.stat-box {
    background: white;
    padding: 25px;
    border-radius: 15px;
    flex: 1;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    text-align: center;
    border: 1px solid #edf2f7;
}

.stat-box h3 {
    font-size: 14px;
    color: #718096;
    margin: 0 0 10px 0;
    text-transform: uppercase;
}

.stat-box p {
    font-size: 32px;
    font-weight: 800;
    margin: 0;
    color: #2d3748;
}

#avgRating { color: #f6ad55; } /* Gold color for rating */
#totalSubmissions { color: #4299e1; } /* Blue color for total */

</style>
</head>
<body>

 <nav>
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('image/push n pull.jpg') }}" alt="Logo">
        <span>Push N Pull</span>
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
    <a href="{{ route('admin.trainer_bookings.index') }}" class="{{ request()->routeIs('admin.trainer_bookings.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check"></i> <span>Manage Trainer Bookings</span>
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
        <li>
           <a href="{{ route('admin.feedback.index') }}" class="{{ request()->routeIs('admin.feedback.index') ? 'active' : '' }}">
                <i class="fas fa-star"></i> <span>System Feedback</span>
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
   <div class="container">
    <div class="card">
        <div class="header-section">
            <h1><i class="fa fa-chart-line"></i> Feedback Reports</h1>
        </div>

      


    <div class="feedback-summary">
    <h2>Recent Feedback Summary</h2>
    <div id="feedbackStats" style="display: flex; gap: 20px;"> <div class="stat-box" style="background: white; padding: 20px; border-radius: 10px; flex: 1; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="font-size: 14px; color: #666;">Average Rating</h3>
            <p style="font-size: 24px; font-weight: bold; color: #f39c12; margin: 0;">
                {{ number_format($avgRating, 1) }} ★
            </p>
        </div>

        <div class="stat-box" style="background: white; padding: 20px; border-radius: 10px; flex: 1; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <h3 style="font-size: 14px; color: #666;">Total Submissions</h3>
            <p style="font-size: 24px; font-weight: bold; color: #007bff; margin: 0;">
                {{ $totalSubmissions }}
            </p>
        </div>

    </div>
</div>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="feedbackTable">
                @foreach($feedbacks as $feedback)
                <tr>
                    <td><strong>{{ $feedback->user_name }}</strong></td>
                    <td>
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star {{ $i <= $feedback->rating ? '' : 'star-off' }}" style="color: {{ $i <= $feedback->rating ? '#ffcc00' : '#ccc' }}"></i>
                        @endfor
                    </td>
                    <td class="comment-text">{{ $feedback->comments }}</td>
                    <td><a href="#" class="btn-delete">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

 
</div>
</body>
</html>
