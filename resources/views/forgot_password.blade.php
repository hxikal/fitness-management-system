<!DOCTYPE html>
<html>
<body>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Push N Pull</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<style>
        body {
            background-color: #32CD32;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .reset-card {
            background-color: #ffffff; /* White */
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: black;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: green;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            background: #f9f9f9;
        }

        .update-btn {
            width: 100%;
            padding: 16px;
            background-color: black;
            color: white; 
            border: none;
            border-radius: 8px;
            font-weight: 800;
            cursor: pointer;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .update-btn:hover {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>

    <div class="reset-card">
        <h1>Set New Password</h1>
        
      <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token ?? '' }}">

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Confirm your email" required>
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" placeholder="Min. 8 characters" required>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Repeat password" required>
            </div>

            <button type="submit" class="update-btn">Update Password</button>
           <a href="{{ route('login') }}">← Back to Login</a>
        </form>
    </div>

    <script>
    const resetForm = document.querySelector('form'); // Selects your reset form
    const resetBtn = document.querySelector('button[type="submit"]');

    if(resetForm) {
        resetForm.addEventListener('submit', function() {
            resetBtn.textContent = 'Updating Password...';
            resetBtn.disabled = true;
            // The browser will now submit the form and load the Success Page
        });
    }
</script>
</body>
</html>