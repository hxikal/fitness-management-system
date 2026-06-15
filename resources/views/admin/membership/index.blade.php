<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Membership</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
        .main--content {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        .badge-success {
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .btn-delete {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            font-weight: 600;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        /* Badge Style for File Type Badge */
        .file-type-badge {
            background: #f1f5f9;
            color: #475569;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #cbd5e1;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

    <div class="main--content">
        <div class="membership" style="background:#fff;padding:25px;border-radius:12px;box-shadow:0 5px 15px rgba(0,0,0,0.05);">

            <div class="title" style="margin-bottom:25px;">
                <h2 class="section--title" style="color:#800000;text-transform:uppercase;font-weight:700;margin:0;">
                    Membership Management
                </h2>
            </div>

            <div class="table-container" style="overflow-x: auto; margin-top: 15px;">
                <table style="width: 100%; border-collapse: collapse; table-layout: fixed; min-width: 900px;">
<thead>
    <tr style="text-align: center; border-bottom: 2px solid #f1f1f1; background: #fafafa;">
        <th style="padding: 15px 10px; width: 50px; text-align: center;">ID</th>
        <th style="padding: 15px 10px; width: 150px; text-align: left;">Name</th>
        <th style="padding: 15px 10px; width: 160px; text-align: center;">Identity Verification</th>
        <th style="padding: 15px 10px; width: 100px; text-align: center;">Type</th>
        <th style="padding: 15px 10px; width: 100px; text-align: center;">Status</th>
        <th style="padding: 15px 10px; width: 200px; text-align: center;">Actions</th>
    </tr>
</thead>
                    <tbody>
                        @forelse($members as $member)
                        <tr style="border-bottom: 1px solid #eee; text-align: center; vertical-align: middle;">
                            <td style="padding: 15px 10px; text-align: center; color: #666; font-size: 14px;">{{ $member->id }}</td>
                            
                            <td style="padding: 15px 10px; text-align: left; font-weight: 500; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $member->name }}
                            </td>

                            <td style="padding: 15px 10px; text-align: center; vertical-align: middle;">
                                @php
                                    $fileName = $member->background ?? $member->background_image ?? $member->profile_image ?? $member->image;
                                    $imagePath = null;
                                    $extension = 'FILE';

                                    if (!empty($fileName)) {
                                        $imagePath = asset('storage/' . $fileName);
                                        // Mengambil jenis fail (extension) daripada nama fail secara dinamik
                                        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                                    }
                                @endphp

                                @if(!empty($fileName))
                                    <div style="display: inline-flex; align-items: center; justify-content: center; gap: 12px; width: 100%;">
                                        <div class="file-type-badge">
                                            <i class="far fa-file-image" style="color: #475569;"></i>
                                            {{ strtoupper($extension) }}
                                        </div>
                                        
                                        <a href="{{ $imagePath }}" download="Member_{{ $member->id }}_Identity" 
                                           style="color: #10a37f; font-size: 13px; display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #eaf6f2; border-radius: 50%; transition: all 0.2s; flex-shrink: 0; text-decoration: none;" 
                                           title="Download Document"
                                           onmouseover="this.style.background='#10a37f'; this.style.color='#ffffff';"
                                           onmouseout="this.style.background='#eaf6f2'; this.style.color='#10a37f';">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                @else
                                    <span style="color: #94a3b8; font-size: 11px; font-style: italic; background: #f8fafc; padding: 4px 8px; border-radius: 4px; border: 1px dashed #e2e8f0; display: inline-block; white-space: nowrap;">
                                        No document
                                    </span>
                                @endif
                            </td>

                            <td style="padding: 15px 10px; text-align: center; vertical-align: middle;">
                                @php
                                    $rawType = $member->type ?? $member->membership_type ?? $member->plan ?? null;
                                    $cleanType = $rawType ? strtolower(trim($rawType)) : '';
                                @endphp

                                @if($cleanType === 'monthly')
                                    <span style="background:#3498db; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">
                                        Monthly
                                    </span>
                                @elseif($cleanType === 'walk-in' || $cleanType === 'walkin')
                                    <span style="background:#f39c12; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">
                                        Walk-in
                                    </span>
                                @elseif($cleanType === 'annually' || $cleanType === 'annual')
                                    <span style="background:#9b59b6; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">
                                        Annually
                                    </span>
                                @elseif(!empty($rawType))
                                    <span style="background:#7f8c8d; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; text-transform:capitalize; display:inline-block; min-width: 70px;">
                                        {{ $rawType }}
                                    </span>
                                @else
                                    <span style="background:#e74c3c; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">
                                        Walk-in
                                    </span>
                                @endif
                            </td>
                           
                            <td style="padding: 15px 10px; text-align: center; vertical-align: middle;">
                                @if($member->is_active)
                                    <span class="badge-success" style="padding:4px 8px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">Active</span>
                                @else
                                    <span style="background:#e74c3c; color:white; padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; display:inline-block; min-width: 70px;">
                                        Not Active
                                    </span>
                                @endif
                                
                            <td style="padding: 15px 10px; text-align: center; vertical-align: middle;">
                                <div style="display: inline-flex; gap: 6px; align-items: center; justify-content: center;">
                                    <button onclick="alert(`Membership Start: {{ $member->membership_start ?? 'Not yet activated' }}\nMembership Expiry: {{ $member->membership_expiry ?? 'Not yet activated' }}`)"
                                            style="background:#10a37f; color:white; padding:6px 10px; border:none; border-radius:4px; cursor:pointer; font-size:12px; font-weight:500; transition: background 0.2s;"
                                            onmouseover="this.style.background='#0d8566';"
                                            onmouseout="this.style.background='#10a37f';">
                                        <i class="fas fa-info-circle"></i> Info
                                    </button>

                                    
                                    
                                    <form action="{{ route('admin.members.delete', $member->id) }}" method="POST" style="margin: 0; display: inline;" onsubmit="return confirm('Delete this member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" style="background:#e74c3c; color:white; padding:6px 10px; border:none; border-radius:4px; cursor:pointer; font-size:12px; font-weight:500; transition: background 0.2s;"
                                                onmouseover="this.style.background='#c0392b';"
                                                onmouseout="this.style.background='#e74c3c';">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <td style="vertical-align: middle; text-align: center; white-space: nowrap;">
    @if(!$member->is_active)
   <form action="{{ route('admin.members.activate', $member->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-success">
        Activate
    </button>
</form>
    @else
        <span class="badge badge-success">Active</span>
    @endif
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #999; font-size: 14px;">No members found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> 
    </div> 


    
</body>
</html>