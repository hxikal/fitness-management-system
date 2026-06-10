<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Report | Push N Pull</title>
    
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
            color: white;
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
    input[type=text], select, textarea {
  width: 100%; /* Full width */
  padding: 12px; /* Some padding */ 
  border: 1px solid #ccc; /* Gray border */
  border-radius: 4px; /* Rounded borders */
  box-sizing: border-box; /* Make sure that padding and width stays in place */
  margin-top: 6px; /* Add a top margin */
  margin-bottom: 16px; /* Bottom margin */
  resize: vertical /* Allow the user to vertically resize the textarea (not horizontally) */
}

/* Style the submit button with a specific background color etc */
input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* When moving the mouse over the submit button, add a darker green color */
input[type=submit]:hover {
  background-color: #45a049;
}

/* Add a background color and some padding around the form */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

label {
    display: block;      /* Moves text to a new line */
    margin-top: 15px;    /* Adds space above the label */
    margin-bottom: 5px;  /* Adds space between label and its input */
    font-weight: bold;
}

input[type="text"], 
input[type="number"], 
textarea {
    display: block;      /* Forces the box to take its own line */
    width: 100%;         /* Makes the box fill the container */
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; 
}
    </style>
</head>
<body>

        <nav>
        <a href="{{ route('userdashboard') }}" class="logo">
            <img src="{{ asset('image/push n pull.jpg') }}" alt="Logo">
            <span>Push N Pull</span>
        </a>
        <ul>
            <li><a href="{{ route('userdashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-qrcode"></i> <span>Membership info</span></a></li> 
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Payment History</span></a></li> 
            <li><a href="{{ route('equipment.report') }}"><i class="fas fa-tools"></i> <span>Equipment Report</span></a></li> 
            <li><a href="{{ route('fitnesstrainer') }}" class="active"><i class="fas fa-calendar-check"></i> <span>Fitness Trainer</span></a></li>
           

            <li style="margin-top: 20px;">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: var(--danger);">
                    <i class="fas fa-sign-out-alt"></i> <span>Log Keluar</span>
                </a>
            </li>
        </ul>
    </nav>



<div class="container">
    <div class="card">
        <div class="header-section">
            <h1><i class="fa fa-chart-line"></i> Feedback Reports</h1>
        </div>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif


        {{-- Create new feedback form --}}
        <section id="feedbackTable">
            <form action="{{ route('feedback.store') }}" method="POST" class="feedback-report-form report-entry" style="background: #f9f9f9; border: 1px solid #ddd; border-radius: 4px; padding: 20px; margin-bottom: 30px;">
                @csrf
                <label>User Name</label>
                <input type="text" name="user_name" placeholder="Your name" required>

                <label>Rating (1-5)</label>
                <input type="number" name="rating" min="1" max="5" required>

                <label>Comments</label>
                <textarea name="comments" required></textarea>

                <button type="submit" style="background-color: #00a65a; color: white; border: none; padding: 12px; border-radius: 4px; font-weight: bold;">Submit</button>
            </form>
        </section>

        
       

{{-- Script to handle edit button --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.btn-edit');
    const editFormContainer = document.getElementById('editFormContainer');
    const editForm = document.getElementById('editForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const entry = this.closest('.report-entry');
            const userName = entry.querySelector('.report-user').value;
            const rating = entry.querySelector('.report-rating').value;
            const comments = entry.querySelector('.report-comments').value;
            const feedbackId = this.dataset.id;

            // Fill the edit form
            document.getElementById('fname').value = userName;
            document.getElementById('lname').value = rating;
            document.getElementById('subject').value = comments;

            // Set the form action
            editForm.action = `/feedback/${feedbackId}`;

            // Show the form
            editFormContainer.style.display = 'block';
            editForm.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
</script>
