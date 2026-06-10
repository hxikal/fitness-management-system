<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body { background: #e0e0e0; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: sans-serif; }
        .card { background: white; padding: 40px; border-radius: 15px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 350px; }
        h1 { color: #800000; margin-bottom: 10px; }
        .btn-login { display: block; margin-top: 20px; padding: 15px; background: #800000; color: #ffd700; text-decoration: none; border-radius: 8px; font-weight: bold; text-transform: uppercase; }
        .btn-login:hover { background: #ffd700; color: #800000; }
    </style>
</head>
<body>
    <div class="card">
        <h1 style="font-size: 50px;">✔</h1>
        <h1>Updated!</h1>
        <p>Your password has been reset successfully.</p>
        <a href="{{ route('login') }}" class="btn-login">Back to Login</a>
    </div>
</body>
</html>
