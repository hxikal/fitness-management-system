<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Profile</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
 <style>
    :root {
            --primary-color: #10a37f;
            --warning: #f39c12;
            --danger: #e74c3c;
            --bg-dark:  black;
            --text-white: #ffffff;
            --bg-light: #dfe9f5;
            --font-main: 'Poppins', sans-serif;
        }

        body {
            background: #7FFF00;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
        }

    body ::selection {
        background: var(--color-green-400);
        color: black;
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

      /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }
</style>

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
</nav>
<div class="main-content">

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; font-family: sans-serif; font-size: 14px; max-width: 600px; box-sizing: border-box; font-weight: 600;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; font-family: sans-serif; font-size: 14px; max-width: 600px; box-sizing: border-box;">
            <strong style="display: block; margin-bottom: 5px;">Sila betulkan ralat berikut:</strong>
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 <form action="{{ route('trainer.profile.update', $trainer->id) }}"
      method="POST" 
      enctype="multipart/form-data"
      style="display: flex; flex-direction: column; gap: 15px; width: 100%; max-width: 600px; padding: 20px; box-sizing: border-box;">

    @csrf
    @method('PUT')

    <div style="display: flex; flex-direction: column; gap: 6px;">
        <label style="font-weight: 700; font-size: 15px; color: #000000; font-family: sans-serif;">Nama Trainer</label>
        <input type="text" 
               name="name" 
               value="{{ optional(Auth::guard('trainer')->user())->name }}"
               style="width: 100%; padding: 12px; border: 1px solid rgba(0,0,0,0.2); border-radius: 6px; font-size: 15px; box-sizing: border-box; background-color: #ffffff; color: #000000; outline: none;">
    </div>

    

    <div style="display: flex; flex-direction: column; gap: 6px;">
        <label style="font-weight: 700; font-size: 15px; color: #000000; font-family: sans-serif;">No Telefon</label>
        <input type="text" 
               name="phone" 
               value="{{ optional(Auth::guard('trainer')->user())->phone }}"
               placeholder="e.g. 0123456789"
               style="width: 100%; padding: 12px; border: 1px solid rgba(0,0,0,0.2); border-radius: 6px; font-size: 15px; box-sizing: border-box; background-color: #ffffff; color: #000000; outline: none;">
    </div>

    <div style="display: flex; flex-direction: column; gap: 6px;">
        <label style="font-weight: 700; font-size: 15px; color: #000000; font-family: sans-serif;">Muat Naik Gambar Profil</label>
        
        <div id="upload-wrapper-default" style="background-color: #ffffff; width: 100%; padding: 10px 12px; border: 1px solid rgba(0,0,0,0.2); border-radius: 6px; box-sizing: border-box; display: flex; align-items: center;">
            <input type="file" 
                   id="profile-input"
                   name="image"
                   accept="image/*"
                   style="font-size: 14px; color: #000000; background: transparent; border: none; width: 100%; outline: none; cursor: pointer;">
        </div>

        <div id="upload-wrapper-preview" style="display: none; align-items: center; justify-content: space-between; padding: 10px 12px; border: 1px solid rgba(0,0,0,0.2); background: #f8fafc; border-radius: 6px; box-sizing: border-box; width: 100%;">
            <div style="display: inline-flex; align-items: center; gap: 10px; overflow: hidden; max-width: 85%;">
                <span id="file-type-badge" style="background: #475569; color: white; padding: 3px 6px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; font-family: sans-serif;">
                    FILE
                </span>
                <span id="file-name-text" style="font-size: 14px; color: #334155; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: sans-serif;">
                    Nama_Fail.png
                </span>
            </div>
            <button type="button" id="btn-remove-file" 
                    style="background: #ef4444; color: white; border: none; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; font-weight: bold; padding: 0; line-height: 1;">
                ×
            </button>
        </div>

        
    </div>

    <button type="submit" 
            style="width: 100%; padding: 12px; border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; background-color: #007bff; color: #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 10px;">
        Update Profile
    </button>
    
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('profile-input');
        const defaultWrapper = document.getElementById('upload-wrapper-default');
        const previewWrapper = document.getElementById('upload-wrapper-preview');
        const fileTypeBadge = document.getElementById('file-type-badge');
        const fileNameText = document.getElementById('file-name-text');
        const removeBtn = document.getElementById('btn-remove-file');

        fileInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                
                // Ekstrak nama & format jenis fail
                fileNameText.textContent = file.name;
                fileTypeBadge.textContent = file.name.split('.').pop().toUpperCase();

                // Tukar UI paparan kotak muat naik
                defaultWrapper.style.display = 'none';
                previewWrapper.style.display = 'flex';
            }
        });

        removeBtn.addEventListener('click', function () {
            // Set semula input ke kosong
            fileInput.value = '';
            
            // Kembalikan ke UI asal
            previewWrapper.style.display = 'none';
            defaultWrapper.style.display = 'flex';
        });
    });
</script>
</div>
</body>
</html>