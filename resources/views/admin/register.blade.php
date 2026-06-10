<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration | Push N Pull</title>
    <style>
        body { font-family: 'Poppins', sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; background-color: #f4f4f4; }
        .reg-card { background: white; border-radius: 8px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); width: 450px; overflow: hidden; }
        .header { padding: 30px; text-align: center; background: #1a202c; color: white; }
        .body { padding: 30px 40px; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 14px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: #2563eb; color: white; padding: 16px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; font-size: 16px; }
        .signin-link { text-align: center; padding: 20px; background: #f1f1f1; border-top: 1px solid #ddd; font-size: 14px; }
        .signin-link a { color: #2563eb; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="reg-card">
    <div class="header">
        <h1 style="margin:0; font-size: 22px;">Admin Registration</h1>
    </div>
    
    <div class="body">
      @if(session('success_register'))
    <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center; border: 1px solid #a7f3d0;">
        {{ session('success_register') }} 
        <a href="{{ route('admin.login') }}" style="font-weight: bold; text-decoration: underline; color: #065f46;">
            Log In Now
        </a>
    </div>
@endif

        @if(session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.register.submit') }}" method="POST">
            @csrf <label>Full Name</label>
            <input type="text" name="name" placeholder="Management Name" required>

            <label>Admin Email</label>
            <input type="email" name="email" placeholder="admin@pushpull.com" required>

            <label>Security Password</label>
            <input type="password" name="password" required>

            <label>Admin Access Code</label>
            <input type="text" name="admin_code" placeholder="Enter Secret Code" required>

            <button type="submit" class="btn">Register Admin</button>
            <a href="{{ route('admin.login') }}">← Back to Login</a>
        </form>
    </div>
</div>
</body>
</html>