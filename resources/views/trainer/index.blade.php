<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trainer Sessions</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
   
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #10a37f;
            --warning: #f39c12;
            --danger: #e74c3c;
            --bg-dark: black;
            --text-white: #ffffff;
            --bg-light: #f1f5f9; /* Changed to a cleaner light gray background */
            --font-main: 'Poppins', sans-serif;
        }

        body {
            background-color: #7FFF00;
            font-family: var(--font-main);
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body ::selection {
            background: var(--color-green-400);
            color: black;
        }

        /* --- SIDEBAR (STRUCTURAL OVERRIDES APPLIED VIA CSS PROPERTY ALONE) --- */
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

        nav ul li a, nav ul li button {
            display: flex;
            align-items: center;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            padding: 15px 25px;
            transition: 0.3s;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-family: inherit;
            font-size: 16px;
            cursor: pointer;
        }

        nav ul li a i, nav ul li button i {
            width: 30px;
            font-size: 18px;
            text-align: center;
        }

        nav ul li a:hover, nav ul li button:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 35px;
        }

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


        /* --- MAIN CONTENT & CALENDAR CARD (FIXED CONTAINMENT) --- */
        .main-content {
            margin-left: 260px; /* Offset the exact width of fixed sidebar */
            padding: 40px;
            width: calc(100% - 260px);
            min-height: 100vh;
            box-sizing: border-box;
        }

        .header h1 { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 5px; }
        .header p { color: #64748b; margin-bottom: 30px; }

        .calendar-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        /* FullCalendar Custom Overrides */
        .fc .fc-button-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        .fc .fc-button-primary:hover {
            background-color: #0d8a6b !important;
            border-color: #0d8a6b !important;
        }

        /* Force FullCalendar to show events as blocks, not just dots */
    .fc .fc-daygrid-event {
        display: block !important;
        white-space: normal !important;
        padding: 2px 4px !important;
        background-color: #38a169 !important; /* Green for visibility */
        border: none !important;
        color: white !important;
    }
    
    /* Ensure the container isn't forcing a collapse */
    .fc-daygrid-day-frame {
        min-height: 100px !important;
    }
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>Unique Plus Gym</span>
        </a>
        <ul>
        <li><a href="{{ route('trainer.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('trainer.session.index') }}"><i class="fa fa-calendar"></i> My Sessions</a></li>
        <li><a href="{{ route('trainer.profile') }}"><i class="fa fa-user"></i> My Profile</a></li>
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
        </ul>
    </nav>

    <div class="main-content">
        <div class="header">
            <h1>My Sessions</h1>
            <p>Manage and track your upcoming trainee training sessions.</p>
        </div>

<div class="availability-form" style="background:#fff; padding:20px; border-radius:8px; max-width:600px; margin:20px auto;">
    <h3 style="color:#333;">Add Availability</h3>
    <form id="addAvailabilityForm" method="POST" action="/trainer/availability">
        @csrf
        
        <label>Activity:</label>
        <input type="text" name="activity" required 
               style="width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px;">
        
        <label>Date:</label>
        <input type="date" name="session_date" required 
               style="width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px;">
        
        <label>Start Time:</label>
        <input type="time" name="start_time" required 
               style="width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px;">
        
        <label>End Time:</label>
        <input type="time" name="end_time" required 
               style="width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px;">
        
        <button type="submit" 
                style="background:#3182ce; color:#fff; padding:10px 20px; border:none; border-radius:4px; cursor:pointer;">
            Save
        </button>
    </form>
</div>

<div id="userCalendar" style="max-width: 100%; margin: 20px auto; padding: 24px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06);">
    <h3 style="font-family: sans-serif; color: #1a1a1a; margin-top: 0; margin-bottom: 20px; font-size: 1.4rem; font-weight: 700;">My Availability</h3>
    
    <div style="overflow-x: auto;">
        <table style="width:100%; border-collapse:collapse; font-family: sans-serif; text-align: left; background: #ffffff; white-space: nowrap; table-layout: fixed;" cellpadding="14">
            <thead>
                <tr style="background: #111111; color: #ffffff;">
                    <th style="border: 1px solid #111111; padding: 16px 20px; font-weight: 600; font-size: 0.95rem; width: 20%;">Trainer</th>
                    <th style="border: 1px solid #111111; padding: 16px 20px; font-weight: 600; font-size: 0.95rem; width: 25%;">Activity</th>
                    <th style="border: 1px solid #111111; padding: 16px 20px; font-weight: 600; font-size: 0.95rem; width: 15%;">Date</th>
                    <th style="border: 1px solid #111111; padding: 16px 20px; font-weight: 600; font-size: 0.95rem; width: 20%;">Time</th>
                    <th style="border: 1px solid #111111; padding: 16px 20px; font-weight: 600; font-size: 0.95rem; width: 20%;">Status</th>
                </tr>
            </thead>

            <tbody id="userAvailabilityBody" style="background: #ffffff;"></tbody>
        </table>
    </div>
</div>


<script>
const trainerName = "{{ Auth::guard('trainer')->user()->name ?? '' }}";

// Fungsi untuk load events trainer (boleh dipanggil semula)
function loadTrainerEvents() {
    fetch("/trainer/events")
        .then(res => res.json())
        .then(data => {
            let tbody = document.getElementById("trainerBody");
            if (!tbody) return; 
            tbody.innerHTML = "";
         data.forEach(session => {
    let row = `
        <tr style="border-bottom: 1px solid #eef0f2;">
            <td style="padding: 16px 20px; white-space: nowrap; color: #4a5568; width: 20%; box-sizing: border-box;">${session.title}</td>
            <td style="padding: 16px 20px; white-space: nowrap; color: #4a5568; width: 25%; box-sizing: border-box;">${new Date(session.start).toLocaleDateString()}</td>
            <td style="padding: 16px 20px; white-space: nowrap; color: #4a5568; width: 15%; box-sizing: border-box;">${new Date(session.start).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</td>
            <td style="padding: 16px 20px; white-space: nowrap; color: #4a5568; width: 20%; box-sizing: border-box;">Available</td>
            <td style="padding: 16px 20px; white-space: nowrap; width: 20%; box-sizing: border-box;">
                <div style="display: flex; align-items: center; width: 100%;">
                    <button onclick="deleteSession(${session.id})" style="width: 100%; max-width: 120px;">Delete</button>
                </div>
            </td>
        </tr>
    `;
    tbody.innerHTML += row;
});
 });
}

document.addEventListener('DOMContentLoaded', function() {

    // Load availability bila page dibuka
    loadTrainerEvents();

    // Submit Add Availability
    const form = document.getElementById('addAvailabilityForm');

    if (form) {
        form.addEventListener('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if (data.success) {

                    alert(data.message);

                    form.reset();

                    loadTrainerEvents();

                } else {

                    alert('Gagal menyimpan data.');

                }

            })
            .catch(err => {

                console.error(err);
                alert('Ralat semasa menghantar data.');

            });

        });
    }

});


// Load Trainer Availability Table
function loadTrainerEvents()
{
    fetch('/trainer/availability-table')
        .then(res => res.json())
        .then(data => {

            const tbody = document.getElementById('userAvailabilityBody');

            if (!tbody) return;

            tbody.innerHTML = '';

            data.forEach(item => {

                let row = document.createElement('tr');

                row.innerHTML = `
                    <td>${item.trainer_name}</td>
                    <td>${item.activity}</td>
                    <td>${item.date}</td>
                    <td>${item.start_time} - ${item.end_time}</td>
                    <td>
                        ${item.status}
                        <button
                            onclick="deleteSession(${item.id})"
                            style="
                                margin-left:10px;
                                background:#dc3545;
                                color:white;
                                border:none;
                                padding:4px 8px;
                                border-radius:5px;
                                cursor:pointer;
                            ">
                            Delete
                        </button>
                    </td>
                `;

                tbody.appendChild(row);

            });

        })
        .catch(err => {
            console.error(err);
        });
}


// Delete Availability
window.deleteSession = function(id)
{
    if(confirm("Padam availability ini?"))
    {
        fetch('/trainer/availability/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {

            if(data.success)
            {
                alert('Deleted');
                loadTrainerEvents();
            }

        });
    }
}
</script>
