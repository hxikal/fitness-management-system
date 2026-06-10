<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<div class="calendar-container">
    <div id="calendar"></div>
</div>
<script>
const trainerName = "{{ Auth::user()->name ?? '' }}";
</script>
<script src="{{ asset('js/calendar.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: true,
        selectable: true,
        selectMirror: true,

 select: function(arg) {
    var title = prompt('Enter Session Title:');
    if (title) {
        var dateStr = arg.startStr.split("T")[0];
        var timeStr = arg.startStr.split("T")[1] 
            ? arg.startStr.split("T")[1].substring(0,5) 
            : "00:00";

        fetch("{{ route('trainer.availability.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                trainer_name: trainerName,
                activity: title,
                session_date: dateStr,
                session_time: timeStr,
                status: "available"
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                calendar.refetchEvents(); // ← refresh lepas save
            }
        });
    }
    calendar.unselect();
},

        eventClick: function(arg) {
    if (confirm('Are you sure you want to delete this session?')) {
        fetch('/trainer/availability/' + arg.event.id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                arg.event.remove();
                calendar.refetchEvents();
            }
        });
    }
},

        events: "{{ route('trainer.my.events') }}", // hanya availability jurulatih
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        }
    });
    
    calendar.render();
});
</script>


</body>
</html>