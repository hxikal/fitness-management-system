<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
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
      input[type=email], input[type=password], select {
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
      #cancelButton {
        background-color: #e3342f;
        color: white;
        padding: 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
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
<form method="POST" action="{{ route('login') }}">
    @csrf   
    
    @if(session('status'))
      <div style="color: #10a37f; text-align: center; padding: 10px; background: #e6f6f2; margin-bottom: 10px;">
        {{ session('status') }}
      </div>
    @endif

    @if(session('error'))
      <div style="color: #e3342f; text-align: center; padding: 10px; background: #fdeaea; margin-bottom: 10px;">
        {{ session('error') }}
      </div>
    @endif

    <div class="logo-container">
      <img src="{{ asset('image/gym.jpg') }}" alt="Logo" class="logo-img">
    </div>

    <div class="container" style="padding-top: 20px;"> 
      <label for="roleSelector"><b>Login As</b></label>
      <select name="role" id="roleSelector" required>
        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Gym Member</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>System Administrator</option>
        <option value="trainer" {{ old('role') == 'trainer' ? 'selected' : '' }}>Trainer</option>
      </select>

      <label for="email"><b>Email Address</b></label>
      <input type="email" 
             id="email" 
             name="email" 
             placeholder="Enter Email" 
             required 
             maxlength="50" 
             value="{{ old('email') }}">
      
      <label for="password"><b>Password</b></label>
      <input type="password" 
             id="password" 
             name="password" 
             placeholder="Enter Password" 
             required 
             minlength="6" 
             maxlength="20" 
             autocomplete="current-password">
      
      @if($errors->has('login_error'))
        <div style="color: #e3342f; text-align: left; padding: 0 0 20px 0; font-size: 14px; font-weight: 500;">
          ⚠ {{ $errors->first('login_error') }}
        </div>
      @endif
      
      <button type="submit" id="loginButton">Login</button>
    </div>

    <div class="bottom-container">
      <button type="button" id="cancelButton" onclick="window.location.href='/'">Cancel</button>
      <div class="link-group">
        <a href="{{ route('register') }}">Register Member</a>
        <a href="{{ route('trainer.register') }}">Register Trainer</a>  
        <a href="{{ route('password.request') }}"> Forgot password?</a>
      </div>
    </div>
</form>

<script>
document.getElementById('roleSelector').addEventListener('change', function() {
    if (this.value === 'admin') {
        window.location.href = "{{ route('admin.login') }}";
    } else if (this.value === 'trainer') {
        window.location.href = "{{ route('trainer.login') }}";
    } else {
        window.location.href = "{{ route('login') }}";
    }
});
</script>
</body>
</html>