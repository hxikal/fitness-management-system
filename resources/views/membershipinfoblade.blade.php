<!DOCTYPE html>
<html lang= en>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Info - Push N Pull</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
        :root {
            --primary-color:  #7FFF00;
            --bg-dark: black;
            --text-white: green;
            --bg-light: green;
            --font-main: 'Poppins', sans-serif;
        }

        body {
            background: #7FFF00;
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

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 50px;
            width: 100%;
            box-sizing: border-box;
        }

        .info-card {
            background: green;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            max-width: 700px;
            margin-top: 30px;
            border-left: 8px solid var(--primary-color);
        }

        .info-header {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #f9f9f9;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
        }

        .info-label i {
            margin-right: 10px;
            color: var(--bg-dark);
            width: 20px;
        }

        .info-value {
            color: #333;
            font-weight: 500;
        }

        .badge {
            background: var(--primary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>UNIQUE PLUS GYM</span>
        </a>
     
        <ul>
            <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
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



 <div class="main-content" style="margin-left: 260px; padding: 40px; background: #7FFF00; min-height: 100vh;">
    <div class="header" style="margin-bottom: 30px;">
        <h1 style="color: black; font-size: 28px;">Membership Info</h1>
        <p style="color: #666;">Verify your membership below.</p>
    </div>

    <div class="qr-container" style="background: black; padding: 40px; text-align: center; border-radius: 15px; color: white;">
        
        <div style="background: white; padding: 15px; border-radius: 10px; display: inline-block;">
    <img 
        src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode(url('/admin/member/scan/' . Auth::user()->id)) }}"
        alt="QR Code"
        style="width:180px;">
</div>

        <h3 style="margin: 0;">ID: PNP-{{ str_pad(Auth::user()->id, 5, '0', STR_PAD_LEFT) }}</h3>

        <div style="margin-top: 20px;">
            {{-- We check strictly for 1. If it's 0 or NULL, it shows NOT ACTIVE --}}
            @if(Auth::user()->is_active == 0)
                <span style="background: #27ae60; padding: 8px 20px; border-radius: 20px; font-weight: bold;">
                    <i class="fas fa-check-circle"></i> STATUS: NOT ACTIVE
                </span>

                <div style="margin-top: 25px;">
                   
<a href="{{ route('payment_history') }}" 
   style="background:#27ae60; color:white; padding:10px 20px; border-radius:5px; text-decoration:none; font-weight:bold;">
   PROCEED TO PAYMENT <i class="fas fa-arrow-right"></i>
</a>
                </div>
            @else
                <span style="background: #e74c3c; padding: 8px 20px; border-radius: 20px; font-weight: bold;">
                    <i class="fas fa-times-circle"></i> STATUS: NOT ACTIVE
                </span>
                
                <div style="margin-top: 20px; background: rgba(0,0,0,0.2); padding: 20px; border-radius: 10px; border: 1px dashed rgba(255,255,255,0.3);">
                    <p style="font-size: 14px; line-height: 1.6; margin-bottom: 10px; color: #ffeb3b;">
                        <strong>Verification Required</strong>
                    </p>
                    <p style="font-size: 13px; margin: 0; opacity: 0.9;">
                    Please show this QR code to the gym owner for record verification. 
                    The payment button will only appear after your account is activated by the management.
                    </p>
                </div>
            @endif
        </div>
    </div>
   <div style="padding: 40px; flex: 1.5; min-width: 300px; background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05); margin-top: 30px;">
    <h2 style="color: #333; margin-bottom: 25px; border-bottom: 2px solid #f1f1f1; padding-bottom: 10px;">update profile</h2>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="margin-top: 20px;">
    @csrf
    @method('PUT')

    <label style="font-weight: 600; display: block; margin-bottom: 6px; color: #333; font-size: 14px;">Nama Penuh</label>
    <input type="text" name="name" value="{{ Auth::user()->name }}" style="width:100%; padding:11px; margin-bottom:18px; border: 1px solid #dcdcdc; border-radius: 6px; box-sizing: border-box;">

    <label style="font-weight: 600; display: block; margin-bottom: 6px; color: #333; font-size: 14px;">Emel Berdaftar</label>
    <input type="email" name="email" value="{{ Auth::user()->email }}" style="width:100%; padding:11px; margin-bottom:18px; border: 1px solid #dcdcdc; border-radius: 6px; box-sizing: border-box;">

    <label style="font-weight: 600; display: block; margin-bottom: 6px; color: #333; font-size: 14px;">No Telefon</label>
    <input type="text" name="phone" value="{{ Auth::user()->phone }}" style="width:100%; padding:11px; margin-bottom:18px; border: 1px solid #dcdcdc; border-radius: 6px; box-sizing: border-box;">

    <label style="font-weight: 600; display: block; margin-bottom: 6px; color: #333; font-size: 14px;">Alamat</label>
    <input type="text" name="address" value="{{ Auth::user()->address }}" style="width:100%; padding:11px; margin-bottom:18px; border: 1px solid #dcdcdc; border-radius: 6px; box-sizing: border-box;">

    <label style="font-weight: 600; display: block; margin-bottom: 6px; color: #333; font-size: 14px;">Upload Background Image</label>
    <div style="margin-bottom: 25px;">
        
        <div id="upload-wrapper-default" style="display: block;">
            <input type="file" id="background-input" name="background" accept="image/*" 
                   style="width:100%; padding:10px; border: 1px solid #dcdcdc; border-radius: 6px; background-color: #fafafa; box-sizing: border-box;">
        </div>

        <div id="upload-wrapper-preview" style="display: none; align-items: center; justify-content: space-between; padding: 10px 15px; border: 1px solid #cbd5e1; background: #f8fafc; border-radius: 6px; box-sizing: border-box;">
            <div style="display: inline-flex; align-items: center; gap: 12px; overflow: hidden; max-width: 85%;">
                <span id="file-type-badge" style="background: #475569; color: white; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; tracking-spacing: 0.5px; flex-shrink: 0;">
                    FILE
                </span>
                <span id="file-name-text" style="font-size: 13px; color: #334155; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 500;">
                    Nama_Fail_Anda.png
                </span>
            </div>
            
            <button type="button" id="btn-remove-file" 
                    style="background: #ef4444; color: white; border: none; width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 12px; transition: all 0.2s; flex-shrink: 0;"
                    title="Remove File"
                    onmouseover="this.style.background='#dc2626'; this.style.transform='scale(1.05)';"
                    onmouseout="this.style.background='#ef4444'; this.style.transform='scale(1)';">
                <i class="fas fa-times"></i>
            </button>
        </div>

    </div>

    <button type="submit" style="background: #008000; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; width: 100%; font-weight: 600; font-size: 15px; transition: background 0.2s;"
            onmouseover="this.style.background='#006400';"
            onmouseout="this.style.background='#008000';">
        Save Changes
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('background-input');
        const defaultWrapper = document.getElementById('upload-wrapper-default');
        const previewWrapper = document.getElementById('upload-wrapper-preview');
        const fileTypeBadge = document.getElementById('file-type-badge');
        const fileNameText = document.getElementById('file-name-text');
        const removeBtn = document.getElementById('btn-remove-file');

        // Mengesan apabila pengguna memilih dokumen
        fileInput.addEventListener('change', function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                
                // 1. Ekstrak nama dan jenis ext fail
                const fileName = file.name;
                const fileExtension = fileName.split('.').pop().toUpperCase();

                // 2. Kemas kini data paparan komponen teks & lencana
                fileNameText.textContent = fileName;
                fileTypeBadge.textContent = fileExtension;

                // 3. Tukar paparan (Sembunyikan kotak asal, paparkan barisan ringkas baru)
                defaultWrapper.style.display = 'none';
                previewWrapper.style.display = 'flex';
            }
        });

        // Pengendali tindakan butang cancel / pangkah merah
        removeBtn.addEventListener('click', function () {
            // Kosongkan fail di input asal
            fileInput.value = '';
            
            // Pulihkan bentuk asal paparan form
            previewWrapper.style.display = 'none';
            defaultWrapper.style.display = 'block';
        });
    });
</script>

</body>
</html>