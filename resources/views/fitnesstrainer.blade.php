<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fitness Trainer</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #10a37f;
            --bg-dark: black;
            --secondary-color: #d4af37;
            --text-white: #ffffff;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
            --danger: #ff4d4d;
        }

        body {
            background:  #7FFF00;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
            min-height: 100vh;
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

        /* --- CONTENT WRAPPER --- */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
            min-height: 100vh;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .header h1 { 
            font-size: 34px; 
            font-weight: 800; 
            margin: 0 0 5px 0;
            color: #333; 
        }
        .header p { color: #666; margin: 0; }

        .trainer-grid-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin-top: 10px;
        }

        .trainer-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            width: 310px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            text-align: center;
            border-bottom: 5px solid var(--secondary-color);
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }

        .trainer-card:hover { transform: translateY(-5px); }
        .trainer-img { width: 100%; height: 240px; object-fit: cover; background-color: #f0f0f0; }
        .trainer-info { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .trainer-info h3 { margin: 10px 0 5px 0; color: var(--bg-dark); font-size: 20px; }
        .specialty { font-size: 14px; color: #636e72; margin: 0 0 15px 0; }

        .availability-display {
            width: 100%;
            margin-top: 15px;
            padding: 15px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            box-sizing: border-box;
            display: none; 
        }

        .trainer-status {
            background-color: #00a65a;
            color: white;
            cursor: pointer;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 10px;
            font-weight: 600;
            transition: 0.2s;
        }
        .trainer-status:hover { background-color: #008d4c; }
            
        .btn-book {
            background: #007bff; 
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer; 
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }
        .btn-book:hover { background: var(--primary-color); }

        .training-schedule-section {
            background: #ffffff;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            box-sizing: border-box;
        }

        .table-responsive { width: 100%; overflow-x: auto; }
        .schedule-table { width: 100%; border-collapse: collapse; }
        .schedule-table th, .schedule-table td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        .status-confirmed { color: var(--primary-color); font-weight: bold; }
        .btn-warning { background-color: #ffc107; border: none; padding: 6px 14px; border-radius: 6px; color: white; font-weight: bold; cursor: pointer; }

        /* Modal popup layout styling for smooth workflows */
        .booking-modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 2000;
            display: none; align-items: center; justify-content: center;
        }
        .booking-modal-card {
            background: white; padding: 30px; border-radius: 15px;
            width: 100%; max-width: 500px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
   #userCalendar {
    background: white;
    padding: 15px;
    border-radius: 10px;
}

.fc {
    background-color: white;
    color: black;
}

.fc-theme-standard td,
.fc-theme-standard th {
    border-color: #ddd;
}

.fc-scrollgrid {
    background-color: white;
}

.fc-daygrid-day {
    background-color: white;
}

.fc-col-header-cell {
    background-color: #f8f9fa;
}
        
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('user.dashboard') }}" class="logo">
           <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
           <span>Unique Plus Gym</span>
        </a>
        <ul>
            <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-qrcode"></i> <span>Membership info</span></a></li> 
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Payment</span></a></li> 
            <li><a href="{{ route('equipment.report.index') }}"><i class="fas fa-tools"></i> <span>Equipment Report</span></a></li> 
            <li><a href="{{ route('fitnesstrainer') }}" class="active"><i class="fas fa-calendar-check"></i> <span>Fitness Trainer</span></a></li>
            <li style="margin-top: 20px;">
                <div style="border-top: 1px solid #333;"> 
                    <a href="#" onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();" style="display: flex; align-items: center; gap: 15px; padding: 20px; color: #ff4d4d; text-decoration: none; font-weight: bold; font-size: 16px;">
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

        <div class="header">
            <h1>Booking Fitness Trainer</h1>
            <p>Plan your exercise and we can guide you.</p>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; width: 100%; box-sizing: border-box;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; width: 100%; box-sizing: border-box;">
                {{ session('error') }}
            </div>
        @endif

        <div class="trainer-grid-container">
            @foreach($trainers as $trainer)
                @php
                    $jsKey = in_array($trainer->name, ['Trainer Ahmad', 'Trainer Sarah']) 
                        ? strtolower(str_replace('Trainer ', '', $trainer->name)) 
                        : $trainer->id;
                    $image = $trainer->profile_image ? 'storage/' . $trainer->profile_image : 'image/default.jpg';
                @endphp

                <div class="trainer-card">
                    <img src="{{ asset($image) }}" alt="{{ $trainer->name }}" class="trainer-img">
                    
                    <div class="trainer-info">
                        <div>
                            <h3>Coach {{ str_replace('Trainer ', '', $trainer->name) }}</h3>
                            <p class="specialty">Expert: {{ $trainer->expertise ?? 'General Fitness' }}</p>
                        </div>

                        <div>
                            <button class="trainer-status" onclick="toggleAvailability('availability-{{ $jsKey }}', '{{ $jsKey }}')">
                                Check Availability
                            </button>

                            <div id="availability-{{ $jsKey }}" class="availability-display">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                    <span id="month-year-{{ $jsKey }}" style="font-weight: bold; font-size: 13px; color: #1a202c;"></span>
                                    <span style="font-size: 10px; padding: 2px 6px; background: #e6fffa; color: #234e52; border-radius: 12px; font-weight: 600;">Schedule</span>
                                </div>
                                <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px; text-align: center;">
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Su</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Mo</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Tu</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">We</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Th</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Fr</div>
                                    <div style="font-size: 10px; font-weight: 700; color: #718096;">Sa</div>
                                    <div id="calendar-days-{{ $jsKey }}" style="display: contents;"></div>
                                </div>
                            </div>

                            <button type="button" class="btn-book" onclick="openBooking('{{ $trainer->name }}')">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="training-schedule-section">
            <h3>Group Exercise Schedule</h3>
            <div class="table-responsive">
                <table class="schedule-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Fitness Trainer</th>
                            <th>Activity</th>
                            <th>Status</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr id="booking-row-{{ $booking->id }}">
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px;">
                                        <div>
                                            {{ $booking->start_time ? \Carbon\Carbon::parse($booking->start_time)->format('h:i A') : '00:00' }} - 
                                            {{ $booking->end_time ? \Carbon\Carbon::parse($booking->end_time)->format('h:i A') : '00:00' }}
                                            
                                            @php
                                                $hour = $booking->start_time ? date('H', strtotime($booking->start_time)) : '00';
                                                $slotKey = $booking->booking_date . '-' . $hour . '-' . $booking->trainer_name;
                                                $count = $slotCounts[$slotKey] ?? 0;
                                            @endphp
                                            
                                            @if($count >= 5)
                                                <small style="color: #d9534f; display: block; margin-top: 2px; font-weight: bold;">(This slot is full!)</small>
                                            @else
                                                <small style="color: gray; display: block; margin-top: 2px;">({{ $count }}/5 booked)</small>
                                            @endif
                                        </div>
                                        @if(strtolower($booking->status) === 'confirmed')
                                            <a href="{{ route('payment_history') }}" style="background: #28a745; color: white; text-decoration: none; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 13px; display: inline-flex; align-items: center; gap: 5px;">
                                                <i class="fas fa-credit-card"></i> Pay
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $booking->trainer_name }}</td>
                                <td>{{ $booking->activity }}</td>
                                <td><span class="status-confirmed">{{ $booking->status }}</span></td>
                                <td style="text-align: right; width: 80px;">
                                    <button type="button" class="btn-warning" onclick="openEditSection('{{ $booking->id }}', '{{ $booking->booking_date }}', '{{ addslashes($booking->activity) }}', '{{ $booking->start_time }}', '{{ $booking->end_time }}')">
                                        Edit
                                    </button>
                                </td>
                                <td style="text-align: left; width: 80px;">
                                    <form action="{{ route('fitnesstrainer.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #C41E3A; border: none; color: white; padding: 6px 14px; border-radius: 6px; font-weight: bold; cursor: pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" style="text-align: center; padding: 20px;">No bookings found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="edit-card-wrapper" id="edit-booking-section" style="display: none; width: 100%;">
            <div style="background: white; border: 1px solid #ddd; border-radius: 15px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div style="padding: 12px; background: #fff3cd; border-radius: 10px; margin-bottom: 20px; border: 1px solid #ffeeba;">
                    <h3 style="margin: 0; font-size: 18px; color: #856404; font-weight: 700;">Update Booking</h3>
                </div>
                <form action="{{ route('fitnesstrainer.update', ['id' => 0]) }}" method="POST" id="editFormElement">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Training Date</label>
                        <input type="date" id="edit_booking_date" name="booking_date" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Start Time</label>
                        <input type="time" id="edit_start_time" name="start_time" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">End Time</label>
                        <input type="time" id="edit_end_time" name="end_time" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;" required>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Activity Type</label>
                        <textarea id="edit_activity" name="activity" rows="3" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box; font-family: inherit;" required></textarea>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" style="background: #007bff; color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:600;">Update Booking</button>
                        <button type="button" onclick="closeEditSection()" style="background: #6c757d; color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:600;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="booking-modal-overlay" id="bookingModal">
        <div class="booking-modal-card">
            <h3 style="margin-top:0; margin-bottom: 20px;" id="modalTrainerTitle">Book Trainer</h3>
            <form action="{{ route('fitnesstrainer.store') }}" method="POST">
                @csrf
                <input type="hidden" name="trainer_name" id="inputTrainerName">
                
                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:5px; font-weight:600;">Date:</label>
                    <input type="date" name="booking_date" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:5px; font-weight:600;">Start Time:</label>
                    <input type="time" name="start_time" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;">
                </div>
                <div style="margin-bottom:15px;">
                    <label style="display:block; margin-bottom:5px; font-weight:600;">End Time:</label>
                    <input type="time" name="end_time" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box;">
                </div>
                <div style="margin-bottom:20px;">
                    <label style="display:block; margin-bottom:5px; font-weight:600;">Activity Type:</label>
                    <select name="activity" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; box-sizing: border-box; background-color: white;">
                        <option value="" disabled selected>Choose Exercise</option>
                        <option value="Leg Day">Leg Day</option>
                        <option value="Glute Day">Glute Day</option>
                        <option value="Arm Day">Arm Day</option>
                        <option value="Back Day">Back Day</option>
                        <option value="Chest Day">Chest Day</option>
                        <option value="Shoulder Day">Shoulder Day</option>
                        <option value="Cardio">Cardio</option>
                        <option value="Abs Day">Abs Day</option>
                    </select>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="submit" style="background: #007bff; color:white; border:none; padding:12px; border-radius:8px; cursor:pointer; flex:1; font-weight:600;">Verify Booking</button>
                    <button type="button" onclick="closeBooking()" style="background: var(--danger); color:white; border:none; padding:12px; border-radius:8px; cursor:pointer; flex:1; font-weight:600;">Cancel</button>
                </div>
            </form>
        </div>
    </div>

<div id="userCalendar"></div>
<div id="calendar" style="max-width: 900px; margin: 0 auto; padding: 20px 0;"></div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<script>
// --- SECTION 1: GLOBAL LAYOUT TOGGLES ---
function toggleAvailability() {
    const calendarContainer = document.getElementById('userCalendar');

    if (calendarContainer.style.display === 'none' || calendarContainer.style.display === '') {
        calendarContainer.style.display = 'block';
    } else {
        calendarContainer.style.display = 'none';
        return;
    }

    if (calendarInitialized && window._fcInstance) {
        // ✅ KEY FIX: refetch events every time calendar is shown
        window._fcInstance.refetchEvents();
        return;
    }

    calendarInitialized = true;

 document.addEventListener('DOMContentLoaded', function() {
    var calendarContainer = document.getElementById('userCalendar');

    var calendar = new FullCalendar.Calendar(calendarContainer, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: "{{ route('trainers.availability') }}", // hanya availability jurulatih
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        },
        eventClick: function(info) {
            let props = info.event.extendedProps;

            alert(
                'Trainer: ' + props.trainer_name +
                '\nActivity: ' + info.event.title +
                '\nStatus: ' + props.status +
                '\nDate: ' + props.session_date +
                '\nTime: ' + props.session_time
            );
        }
    });

    calendar.render();
});
    window._fcInstance = calendar;  // ✅ Store reference globally
}
function showTrainerAvailability(trainerId) {
    var section = document.getElementById("availability-section");
    if (section) {
        section.style.display = "block";
        section.scrollIntoView({ behavior: 'smooth' });
    }
    console.log("Fetching availability for: " + trainerId);
}

function showOtherTrainers() {
    let trainersDiv = document.getElementById('other-trainers');
    if (trainersDiv) {
        trainersDiv.style.display = (trainersDiv.style.display === 'none') ? 'block' : 'none';
    }
}

let calendarInitialized = false;

function toggleAvailability() {

    const calendarContainer = document.getElementById('userCalendar');

    // Show/Hide calendar
    if (calendarContainer.style.display === 'none') {
        calendarContainer.style.display = 'block';
    } else {
        calendarContainer.style.display = 'none';
        return;
    }

    // Prevent creating multiple calendars
    if (calendarInitialized) {
        return;
    }

    calendarInitialized = true;

    var calendar = new FullCalendar.Calendar(calendarContainer, {
        initialView: 'dayGridMonth',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

       events: "{{ route('trainers.availability') }}",

        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            meridiem: false
        },

        eventClick: function(info) {

            alert(
                'Trainer: ' + info.event.extendedProps.trainer_name +
                '\nActivity: ' + info.event.title +
                '\nStatus: ' + info.event.extendedProps.status +
                '\nDate: ' + info.event.start.toLocaleString()
            );

        }
    });

    calendar.render();
}



// --- SECTION 4: MODALS & CRUD FORMS ---
function openBooking(name) {
    const modal = document.getElementById('bookingModal');
    const nameText = document.getElementById('modalTrainerName');
    const nameInput = document.getElementById('inputTrainerName');
    
    if(modal) modal.style.display = 'block';
    if(nameText) nameText.innerText = 'Tempah ' + name;
    if(nameInput) nameInput.value = name;
}

function closeBooking() {
    const modal = document.getElementById('bookingModal');
    if(modal) modal.style.display = 'none';
}

function openEditSection(id, date, activity) {
    const editSection = document.getElementById('edit-booking-section');
    const editId = document.getElementById('edit_booking_id');
    const editDate = document.getElementById('edit_booking_date');
    const editActivity = document.getElementById('edit_activity');

    if(editSection) editSection.style.display = 'block';
    if(editId) editId.value = id;
    if(editDate) editDate.value = date;
    if(editActivity) editActivity.value = activity;

    const editForm = document.querySelector('#edit-booking-section form');
    if (editForm) {
        editForm.action = "{{ url('/fitnesstrainer/update') }}/" + id;
    }
}

function closeEditSection() {
    const editSection = document.getElementById('edit-booking-section');
    if(editSection) editSection.style.display = 'none';
}

function deleteRowUI(id) {
    if (confirm('Adakah anda pasti mahu memadam tempahan ini?')) {
        const element = document.getElementById("booking-row-" + id);
        if (element) element.remove();

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/fitnesstrainer/delete/' + id;

        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden'; 
        csrfInput.name = '_token'; 
        csrfInput.value = csrfToken;

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden'; 
        methodInput.name = '_method'; 
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput); 
        form.appendChild(methodInput);
        document.body.appendChild(form); 
        form.submit();
    }
}
</script>
</body>
</html>