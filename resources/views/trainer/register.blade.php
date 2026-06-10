<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (session('success'))
    <div class="alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif
    <style>
    body {
        font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
        background:  #228b22; 
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .register-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 420px;
    }

    h2 {
        text-align: center;
        color: #0f172a;
        margin-bottom: 8px;
        font-weight: 800;
        font-size: 26px;
        letter-spacing: -0.5px;
    }

    /* Subtitle description helper */
    .register-container::before {
        content: "Create your credentials to manage your gym sessions";
        display: block;
        text-align: center;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 28px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #0f172a;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    input {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        box-sizing: border-box;
        font-size: 15px;
        font-weight: 500;
        color: #0f172a;
        background-color: #f8fafc;
        transition: all 0.2s ease;
    }

    /* Sleek focus wrapper ring */
    input:focus {
        background-color: #ffffff;
        border-color: #10a37f;
        box-shadow: 0 0 0 4px rgba(16, 163, 127, 0.12);
        outline: none;
    }

    /* Change placeholder style */
    input::placeholder {
        color: #94a3b8;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background-color: #10a37f;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(16, 163, 127, 0.2);
        transition: all 0.2s ease;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #0d8a6b;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(16, 163, 127, 0.3);
    }

    .btn-submit:active {
        transform: translateY(1px);
    }

    .alert {
        background-color: #fef2f2;
        border-left: 4px solid #ef4444;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .alert p {
        margin: 0;
        color: #991b1b;
        font-size: 13px;
        font-weight: 500;
    }

            .signin {
            background-color: #f1f1f1;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }

        .signin p {
            margin: 0;
        }

        .signin a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
</style>
</head>
<body>

<div class="register-container">
   <title>Trainer Registration</title>
    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

<form action="{{ route('trainer.register.submit') }}" method="POST">
    @csrf 

    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required value="{{ old('name') }}">
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required value="{{ old('email') }}">
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required value="{{ old('phone') }}" placeholder="e.g. 0123456789">
    </div>

    

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn-submit">Register Account</button>
</form>

<div class="signin">
    <p>Already have an account? <a href="{{ url('/trainer/login') }}">Log in</a></p>
</div>
</div>

</body>
</html>