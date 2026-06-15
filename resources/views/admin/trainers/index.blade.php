<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Trainers</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        :root {
            --primary-color: #10a37f;
            --bg-dark: black;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }
        body { background:#7FFF00; font-family: var(--font-main); margin: 0; display: flex; }
        
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

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 20px;
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
            <a href="{{ route('admin.trainer_bookings.index') }}" class="{{ request()->routeIs('admin.trainer_bookings.index') ? 'active' : '' }}">
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
 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>
        </li>
    </ul>
</nav>      

<div class="main-content">
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
         <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-dark">Registered Trainer List</h5>
</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Profile image</th>
                                <th>Trainer name</th>
                                <th>No Tel</th>
                                <th>Date created</th>
                                <th>Date updated</th>
                                <th style="text-align: center;">Action</th> </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trainers as $trainer)
                                <tr>
                                    <td>{{ $trainer->id }}</td>
                                    <td>
                                        @if($trainer->profile_image)
                                            <img src="{{ asset('storage/' . $trainer->profile_image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;">
                                        @else
                                            <span class="badge badge-secondary">Tiada Gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $trainer->name }}</td>
                                    
                                    <td class="font-weight-bold" style="color: #4a5568;">
                                        {{ $trainer->phone ?? '-' }}
                                    </td>

                                    <td>{{ $trainer->created_at ? $trainer->created_at->format('d-m-Y H:i A') : '-' }}</td>
                                    <td>{{ $trainer->updated_at ? $trainer->updated_at->format('d-m-Y H:i A') : '-' }}</td>
                               <td style="vertical-align: middle; text-align: center; white-space: nowrap;">


<form action="{{ route('admin.trainers.destroy', $trainer->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti?');">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        Delete
    </button>
</form>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tiada data jurulatih dijumpai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> 
            </div> 
        </div> 
    </div> 
</div> 

</body>
</html>