<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer Login</title>
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color:#32CD32;
    }
    form {
      border: 1px solid #ddd;
      background-color: white;
      width: 450px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      border-radius: 8px;
      overflow: hidden;
    }
    .logo-container {
      width: 100%;
      background-color: black;
      padding: 50px 0;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .logo-img {
      max-height: 80px;
      object-fit: contain;
    }
    .container {
      padding: 40px;
    }
    label {
      font-weight: bold;
      color: #333;
      font-size: 15px;
    }
    input[type=email], input[type=password] {
      width: 100%;
      padding: 14px;
      margin: 10px 0 20px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 15px;
    }
    #loginButton {
      background-color: #10a37f;
      color: white;
      padding: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      font-weight: bold;
    }
    #loginButton:hover { background-color: #0d8a6b; }
    .bottom-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      background-color: #f8f9fa;
      padding: 30px 40px;
      border-top: 1px solid #eee;
    }
    .link-group {
      display: flex;
      flex-direction: column;
      gap: 10px;
      font-size: 14px;
    }
    .link-group a { color: #007BFF; text-decoration: none; }
    .link-group a:hover { text-decoration: underline; }
  </style>
</head>

<body>
<form action="{{ route('trainer.login.submit') }}" method="POST">
  @csrf
  <div class="logo-container">
    <img src="{{ asset('image/gym.jpg') }}" alt="Logo" class="logo-img">
  </div>

  <div class="container">
    <h2 style="text-align:center; margin-bottom:20px;">TRAINER LOGIN</h2>
  <!-- This section displays the error if login fails -->
    @if ($errors->has('login_error'))
        <div style="color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center; font-size: 14px;">
            {{ $errors->first('login_error') }}
        </div>
    @endif

  <label for="email"><b>Email Address</b></label>
    <input type="email" name="email" placeholder="Trainer Email" required>

    <label for="password"><b>Password</b></label>
    <!-- Added id="password" here -->
    <input type="password" name="password" id="password" placeholder="Password" required>
    
   <!-- This span will only show up when there is an error -->
<span id="passwordError" style="color: #d93025; font-size: 13px; display: none; margin-top: -15px; margin-bottom: 15px; font-weight: 500;">
  Password must be at least 6 characters.
</span>

    <button type="submit" id="loginButton">Login as Trainer</button>
</div>

  <div class="bottom-container">
    <div class="link-group">
      <a href="{{ route('login') }}">Back to Member Login</a>
    </div>
  </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    const roleSelector = document.getElementById('roleSelector');

    // --- Part A: Role Redirect ---
    if (roleSelector) {
        roleSelector.addEventListener('change', function() {
            if (this.value === 'admin') {
                window.location.href = "{{ route('admin.login') }}";
            } else if (this.value === 'trainer') {
                window.location.href = "{{ route('trainer.login') }}";
            } else {
                window.location.href = "{{ route('login') }}";
            }
        });
    }

    // --- Part B: Password Validation ---
    if (loginForm && passwordInput) {
        loginForm.addEventListener('submit', function(e) {
            if (passwordInput.value.length < 6) {
                passwordError.style.display = 'block';
                passwordInput.style.border = '2px solid #d93025';
            } else {
                passwordError.style.display = 'none';
                passwordInput.style.border = '1px solid #ccc';
            }
        });
    }
});
</script>