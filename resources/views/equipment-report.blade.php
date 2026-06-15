<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Equipment Maintenance | Unique Plus Gym</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
 <style>
        :root {
            --primary-color: #10a37f;
            --bg-dark: black; 
            --secondary-color: #d4af37;
            --text-main: #2d3748;
            --text-light: #718096;
            --text-white: #ffffff; /* Fixed: Added missing variable for sidebar text */
            --bg-light: #f7fafc;
            --danger: #e53e3e;
            --blue-btn: #3182ce;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        body {
            background: #7FFF00;
            font-family: 'Inter', sans-serif;
            margin: 0;
            color: var(--text-main);
            display: flex; /* Keeps sidebar and content side-by-side */
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
        /* --- MAIN CONTENT INTERFACE FIX --- */
        .main-content {
            margin-left: 260px; /* Crucial: Prevents overlap with sidebar */
            padding: 40px;
            width: calc(100% - 260px);
            min-height: 100vh;
            box-sizing: border-box;
        }

        .header-section {
            margin-bottom: 30px;
        }

        .header-section h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin: 0;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr; /* Proper proportions for form vs table */
            gap: 25px;
            align-items: start;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            border: 1px solid #edf2f7;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--bg-dark);
        }

        .btn-edit-action {
        background:none; 
        border:none; 
        color:#007bff; 
        cursor:pointer; 
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .btn-edit-action:hover { text-decoration: underline; }

        /* Form Layout Fixes */
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
        
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            box-sizing: border-box; /* Prevents padding from breaking width */
        }

 table { width: 100%; border-collapse: collapse; }
th { text-align: center; padding: 12px; background: #f8fafc; color: var(--text-light); font-size: 12px; text-transform: uppercase; border-bottom: 2px solid #edf2f7; vertical-align: middle; }
td { padding: 15px 12px; border-bottom: 1px solid #edf2f7; font-size: 14px; text-align: center; vertical-align: middle; }

th:nth-child(1), td:nth-child(1) { width: 10%; }
th:nth-child(2), td:nth-child(2) { width: 15%; }
th:nth-child(3), td:nth-child(3) { width: 10%; }
th:nth-child(4), td:nth-child(4) { width: 25%; }
th:nth-child(5), td:nth-child(5) { width: 15%; }
th:nth-child(6), td:nth-child(6) { width: 12%; }
th:nth-child(7), td:nth-child(7) { width: 13%; }

.status-tag {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
}
.status-fixed { background: #c6f6d5; color: #22543d; }
.status-pending { background: #feebc8; color: #744210; }
    </style>
</head>
<body>

     <nav>
        <a href="{{ route('userdashboard') }}" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>Unique Plus Gym</span>
        </a>
        <ul>
            <li><a href="{{ route('userdashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-qrcode"></i> <span>Membership info</span></a></li> 
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Payment History</span></a></li> 
            <li><a href="{{ route('equipment.report.index') }}"><i class="fas fa-tools"></i> <span>Equipment Report</span></a></li> 
            <li><a href="{{ route('fitnesstrainer') }}" class="active"><i class="fas fa-calendar-check"></i> <span>Fitness Trainer</span></a></li>
        
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
    <div class="header-section">
        <h1>Equipment Maintenance</h1>
        <p>Monitor health and report issues for gym facilities.</p>
    </div>
  <b></b>
<section style="margin: 20px 0; background: white; padding: 25px; border-radius: 12px; border: 1px solid #edf2f7; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); font-family: sans-serif;">
    
    <div style="margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">
        <h3 style="margin: 0; color: #2d3748; font-size: 1.25rem;">Equipment Visual Reference Library</h3>
        <p style="margin: 5px 0 0 0; color: #718096; font-size: 0.9rem;">Identify your specific equipment type and note condition classifications below before filing a report.</p>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 30px; background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #3182ce;">
        <span style="color:#3498db; font-weight:600; font-size: 14px;">🔵 Normal – Fully Functional</span>
        <span style="color:#e67e22; font-weight:600; font-size: 14px;">🟠 Rusty – Wear & Tear / Rusting</span>
        <span style="color:#dc3545; font-weight:600; font-size: 14px;">🔴 Critical – Broken / Out of Order</span>
    </div>

    <div style="display: flex; flex-direction: column; gap: 30px;">

        <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff;">
            <div style="padding: 12px 20px; background: #ebf8ff; color: #2b6cb0; font-weight: bold; font-size: 15px; border-bottom: 1px solid #bee3f8; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-person-running"></i> Treadmill Varieties
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Treadmill A (Commercial)</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/treadmill_a.jpeg') }}" alt="Treadmill A" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Treadmill+A'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Treadmill B (Manual Curved)</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/treadmillb.jpg') }}" alt="Treadmill B" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Treadmill+B'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Treadmill C (Foldable/Home)</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/treadmill-c.jpg') }}" alt="Treadmill C" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Treadmill+C'">
                    </div>
                </div>
            </div>
        </div>

        <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff;">
            <div style="padding: 12px 20px; background: #f0fff4; color: #22543d; font-weight: bold; font-size: 15px; border-bottom: 1px solid #c6f6d5; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-dumbbell"></i> Dumbbell Varieties
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Rubber Hex Dumbbell</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/rubberhexdumbell.png') }}" alt="Hex Dumbbell" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Hex+Dumbbell'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Chrome/Iron Dumbbell</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/irondumbell.png') }}" alt="Iron Dumbbell" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Iron+Dumbbell'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Adjustable Smart Dumbbell</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/adjustabledumbell.png') }}" alt="Adjustable Dumbbell" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Adjustable+Dumbbell'">
                    </div>
                </div>
            </div>
        </div>

        <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff;">
            <div style="padding: 12px 20px; background: #fffaf0; color: #dd6b20; font-weight: bold; font-size: 15px; border-bottom: 1px solid #feebc8; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-weight-hanging"></i> Barbells & Weight Plates
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Olympic Straight Barbell</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/two-barbells-gym.jpg') }}" alt="Straight Barbell" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Straight+Barbell'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">EZ-Curl Barbell</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/ezcurlbarbell.jpg') }}" alt="EZ Barbell" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=EZ+Curl+Bar'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Bumper Plates Stack</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/bumberplatestacks.jpg') }}" alt="Weight Plates" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Weight+Plates'">
                    </div>
                </div>
            </div>
        </div>

        <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; background: #fff;">
            <div style="padding: 12px 20px; background: #edf2f7; color: #4a5568; font-weight: bold; font-size: 15px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-screws-turn"></i> Stationary Gym Machines
            </div>
            <div style="padding: 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Cable Pulldown Machine</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/cablemachine.jpg') }}" alt="Cable Machine" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Cable+Machine'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Leg Press Station</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/legpress.jpg') }}" alt="Leg Press" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Leg+Press'">
                    </div>
                </div>
                <div style="text-align: center; border: 1px dashed #cbd5e0; padding: 10px; border-radius: 8px; background: #fafafa;">
                    <span style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Smith Machine Rack</span>
                    <div style="height: 130px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('image/smithmachinerack.png') }}" alt="Smith Machine" style="max-width: 100%; max-height: 120px; object-fit: contain; border-radius: 6px;" onerror="this.src='https://placehold.co/180x120?text=Smith+Machine'">
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-title">
                <i class="fa-solid fa-file-medical"></i> New Fault Report
            </div>

   <form action="{{ route('equipment.report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
<div class="form-group">
    <label for="category">Equipment Category</label>
    <select id="category" class="form-control" onchange="updateEquipmentHints()" required>
        <option value="" disabled selected>-- Select Category --</option>
        <option value="treadmills">Treadmills</option>
        <option value="dumbbells">Dumbbells</option>
        <option value="barbells">Barbells & Plates</option>
        <option value="machines">Gym Machines</option>
    </select>
</div>

<div class="form-group mt-3">
    <label for="equipment_input">Specific Equipment</label>
    <input list="equipment_hints" id="equipment_input" name="equip_name" class="form-control" placeholder="Type or select equipment name..." required>
    <datalist id="equipment_hints">
        </datalist>
</div>
                <div class="form-group">
                    <label style="font-weight: bold; margin-bottom: 8px; display: block;">Urgency Level</label>
                    <div style="display: flex; gap: 20px; align-items: center; justify-content: flex-start;">
<label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color:#3498db; font-weight:600;">
    <input type="radio" name="urgency" value="Normal"> <span>Normal</span>
</label>

<label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color:#e67e22; font-weight:600;">
    <input type="radio" name="urgency" value="Rusty"> <span>Rusty</span>
</label>

<label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color:#dc3545; font-weight:600;">
    <input type="radio" name="urgency" value="Critical"> <span>Critical</span>
</label>

                    </div>
                </div>
                <div class="form-group">
                    <label>Issue Description</label>
                    <textarea name="description" class="form-control" rows="4" required></textarea>
                </div>

<div class="form-group" style="margin-top: 15px;">
    <label for="image_upload">Upload Evidence (Optional)</label>
    <input type="file" name="image" id="image_upload" accept="image/*" 
           style="padding: 8px; background: #f8fafc; border: 1px dashed #cbd5e0;">
    <small style="color: #718096;">Upload a photo of the issue (Max 2MB)</small>

 <button type="button" id="btn-remove-file"
        style="display:none; background:#ef4444; color:white; border:none;
        width:26px; height:26px; border-radius:50%; align-items:center;
        justify-content:center; cursor:pointer; margin-top:5px;">
    <i class="fas fa-times"></i>
</button>
</div>
         

            <button type="submit" class="btn-submit">Submit Report</button>
            </form>
        </div> 
        <div class="card">
    <div class="card-title">
        <i class="fa-solid fa-clock-rotate-left"></i> Maintenance History
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Equipment</th>
                <th>Urgency</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                @if($report)
                    <tr>
                        <td>
                            @if($report->created_at)
                                {{ date('d/m/Y', strtotime($report->created_at)) }}
                            @else
                                -
                            @endif
                        </td>
                        
                        <td style="font-weight: 600;">{{ $report->equip_name ?? 'N/A' }}</td>
                        
                        <td>{{ $report->urgency ?? 'N/A' }}</td>  
<td>
    {{ preg_replace('/\[Image:.*?\]/', '', $report->description) }}
</td>
                        

                 <td>
    @if($report->image)
        <img src="{{ asset('storage/' . $report->image) }}" width="80">
    @else
        No Photo
    @endif
</td>

                        <td style="text-align:center; vertical-align:justify;">
                            @if($report->status == 'pending')
                                <span style="
                                    background:#ffc107;
                                    color:#000;
                                    padding:4px 10px;
                                    font-weight:600;
                                    display:inline-block;
                                    border-radius: 4px; 
                                ">
                                    Pending
                                </span>
                            @elseif($report->status == 'fixed')
                                <span style="
                                    background:#28a745;
                                    color:#fff;
                                    padding:4px 10px;
                                    border-radius:12px;
                                    font-weight:600;
                                    display:inline-block;
                                ">
                                    Fixed
                                </span>
                            @endif
                        </td>
<td style="text-align:center; vertical-align:justify;">
    <span style="display:inline-flex; align-items:center; justify-content:center; gap:12px;">
        <button type="button"
            onclick="openEditSection('{{ $report->id }}', '{{ addslashes($report->equip_name) }}', '{{ addslashes($report->description) }}', '{{ $report->urgency }}')"
            style="background:none; border:none; color:#007bff; cursor:pointer; font-weight:600;">
            <i class="fas fa-edit"></i> Edit
        </button>

        <form action="{{ route('equipment.report.delete', $report->id) }}"
              method="POST"
              onsubmit="return confirm('Confirm delete?');"
              style="margin:0;">
            @csrf
            @method('DELETE')
            <button type="submit"
                style="background:none; border:none; color:#dc3545; cursor:pointer; font-weight:600;">
                <i class="fas fa-trash"></i> Delete
            </button>
        </form>
    </span>
</td>
                    </tr>
                </td>
                @endif
            @endforeach
    </tbody>
    </table>

    <div id="edit-report-section" style="display:none;" class="card p-4">
    <h3>Edit Equipment Report</h3>
<form id="updateReportForm"
      method="POST"
      action="/equipment/report/update"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" id="edit_report_id" value="">
    

     <div class="form-group">
    <label for="category">Equipment Category</label>
    <select id="category" class="form-control" onchange="updateEquipmentHints()" required>
        <option value="" disabled selected>-- Select Category --</option>
        <option value="treadmills">Treadmills</option>
        <option value="dumbbells">Dumbbells</option>
        <option value="barbells">Barbells & Plates</option>
        <option value="machines">Gym Machines</option>
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Specific Equipment</label>
            <input type="text" id="edit_equip_name" name="equip_name" class="form-control">
        </div>

 <div class="mb-3">
    <label class="form-label">Urgency Level</label>
    <div style="display:flex; justify-content:center; align-items:center; gap:20px;">
        <label style="display:flex; align-items:center; gap:6px;">
            <input type="radio" id="edit_urgency_normal" name="urgency" value="Normal"> Normal
        </label>
        <label style="display:flex; align-items:center; gap:6px;">
            <input type="radio" id="edit_urgency_rusty" name="urgency" value="Rusty"> Rusty
        </label>
        <label style="display:flex; align-items:center; gap:6px;">
            <input type="radio" id="edit_urgency_critical" name="urgency" value="Critical"> Critical
        </label>
    </div>
</div>

        <div class="mb-3">
            <label class="form-label">Issue Description</label>
            <textarea id="edit_description" name="description" class="form-control"></textarea>
        </div>

    
        <button type="submit" class="btn btn-success">Update Report</button>
        <button type="button" class="btn btn-secondary" onclick="closeEditSection()">Cancel</button>
    </form>
</div>



<script>

function scrollToForm() {
    // Scroll smoothly to the report form
    document.querySelector('.card').scrollIntoView({ behavior: 'smooth' });
    
    // Optional: Highlight the form or clear it if it was being used for something else
    document.querySelector('form').reset();
}

function showAddForm() {
    // Hide the edit section if it's open
    const editSection = document.getElementById('edit-report-section');
    if (editSection) {
        editSection.style.display = 'none';
    }

    // Show the New Fault Report form
    const addForm = document.getElementById('new-report-form');
    addForm.style.display = 'block';


    // Optional: Scroll to the form smoothly
    addForm.scrollIntoView({ behavior: 'smooth' });
}

document.querySelector('input[name="image"]').addEventListener('change', function () {

    if (this.files && this.files.length > 0) {
        document.getElementById('btn-remove-file').style.display = 'flex';
    }
});

document.getElementById('btn-remove-file').addEventListener('click', function () {

    const fileInput = document.querySelector('input[name="image"]');

    fileInput.value = "";

    this.style.display = 'none';
});

function openEditSection(id, name, desc, urgency) {
    const editSection = document.getElementById('edit-report-section');
    const newSection = document.getElementById('new-report-section');
    const form = document.getElementById('updateReportForm');

    if (!editSection) {
        console.error("Critical Error: div id='edit-report-section' is missing from your HTML!");
        return;
    }

    // Toggle sections
    if (newSection) newSection.style.display = 'none';
    editSection.style.display = 'block';

    // Update Form Action
    if (form) {
        // IMPORTANT: Ensure this path matches the output of 'php artisan route:list'
       form.action = "/equipment-report/update/" + id;
    }

    // Fill fields... (rest of your logic)
    document.getElementById('edit_equip_name').value = name;
    document.getElementById('edit_description').value = desc;
    
    editSection.scrollIntoView({ behavior: 'smooth' });
}

function closeEditSection() {
    document.getElementById('edit-report-section').style.display = 'none';
    const newSection = document.getElementById('new-report-section');
    if (newSection) newSection.style.display = 'block';
}

    // Function to handle report deletion
    function deleteReport(id) {
 if (confirm('Are you sure you want to delete this report?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        
        // Ensure this URL matches your Route::delete exactly
        form.action = '/equipment-report/delete/' + id;

        // Get the token from the meta tag we added in Step 1
        const tokenElement = document.querySelector('meta[name="csrf-token"]');
        
        if (!tokenElement) {
            alert('Error: CSRF token not found. Please add the meta tag to your head section.');
            return;
        }

        const csrfToken = tokenElement.getAttribute('content');

        // Create CSRF Input
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;

        // Create Method Spoofing Input (Crucial for DELETE routes)
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();

    

function updateEquipment() {
    const categorySelect = document.getElementById('category');
    const equipSelect = document.getElementById('equipment');
    const selectedCategory = categorySelect.value;

    // 1. Reset the equipment dropdown
    equipSelect.innerHTML = '<option value="" disabled selected>-- Select Item --</option>';
    
    // 2. If a valid category is picked, populate the items
    if (selectedCategory && equipmentData[selectedCategory]) {
        equipSelect.disabled = false; // Unlock the dropdown
        
        equipmentData[selectedCategory].forEach(item => {
            let option = document.createElement('option');
            option.value = item;
            option.text = item;
            equipSelect.appendChild(option);
        });
    } else {
        // 3. If no category, keep it locked
        equipSelect.disabled = true;
    }
}
    }
 
}
    
</script>
