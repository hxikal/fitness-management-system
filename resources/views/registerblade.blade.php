<style>
        body { 
            font-family: "Poppins", sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            background-color: #228b22; 
        }

        .register-container { 
            background-color: white !important; 
            border-radius: 8px !important; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important; 
            width: 400px !important; 
            overflow: hidden !important;
        }

        .form-header {
            padding: 25px 30px 10px 30px;
            text-align: center;
        }

        .form-header h1 {
            margin: 0;
            font-size: 22px;
            color: #333;
        }

        /* --- TAB NAVIGATION --- */
        .tab-nav {
            display: flex;
            background: black;
            cursor: pointer;
        }

        .tab-link {
            flex: 1;
            padding: 12px;
            text-align: center;
            font-weight: bold;
            color: #666;
            transition: 0.3s;
            border-bottom: 2px solid transparent;
        }

        .tab-link.active {
            background: black;
            color: #10a37f;
            border-bottom: 2px solid #10a37f;
        }

        /* --- FORM CONTENT --- */
        .content-body {
            padding: 20px 30px !important;
            display: block !important;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        label {
            display: block !important;
            margin-top: 14px !important;
            margin-bottom: 4px !important;
            font-weight: bold !important;
            color: #333 !important;
            font-size: 14px !important;
        }

        /* This forces ALL forms to behave exactly the same way */
        .content-body input {
            width: 100% !important;
            height: 46px !important; 
            padding: 0 14px !important;
            margin: 4px 0 12px 0 !important; 
            display: block !important;
            border: 1px solid #cccccc !important; 
            border-radius: 4px !important;
            background-color: #fdfdfd !important;
            box-sizing: border-box !important;
            font-size: 14px !important;
            color: #333333 !important;
        }

        .error-msg {
            color: #e3342f;
            font-size: 12px;
            margin-top: -8px;
            margin-bottom: 10px;
            display: block;
        }

        .registerbtn {
            background-color: #10a37f;
            color: white;
            padding: 14px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
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
    <div class="form-header">
        <h1>Choose Membership</h1>
    </div>

    @if ($errors->any())
        <div style="padding: 10px 40px; color: #e3342f; background: #fdeaea; font-size: 14px;">
            Sila betulkan ralat di bawah.
        </div>
    @endif

    <div class="tab-nav">
        <div class="tab-link active" onclick="openTab(event, 'walkin-form')">Walk-in</div>
        <div class="tab-link" onclick="openTab(event, 'monthly-form')">Monthly</div>
        <div class="tab-link" onclick="openTab(event, 'annual-form')">Annual</div>
    </div>

    <div class="content-body">
        
        <div id="walkin-form" class="tab-content active">
            <form action="{{ url('/register/walkin') }}" method="POST">
                @csrf
                <label>Full Name</label>
                <input type="text" placeholder="Enter Full Name" name="name" value="{{ old('name') }}" required>
                
                <label>Email Address</label>
                <input type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Phone Number</label>
                <input type="tel" placeholder="e.g. 0123456789" name="no_telefon" value="{{ old('no_telefon') }}" required>
                @error('no_telefon') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Password</label>
                <input type="password" placeholder="Create Password" name="password" minlength="8" title="Password must be at least 8 characters long" required>
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror

                <button type="submit" class="registerbtn">Register Walk-in</button>
            </form>
        </div>

        <div id="monthly-form" class="tab-content">
           <form action="{{ route('register.monthly.submit') }}" method="POST">
                @csrf
                <label>Full Name</label>
                <input type="text" placeholder="Enter Full Name" name="name" value="{{ old('name') }}" required>
                
                <label>Email Address</label>
                <input type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Phone Number</label>
                <input type="tel" placeholder="e.g. 0123456789" name="no_telefon" value="{{ old('no_telefon') }}" required>
                @error('no_telefon') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Password</label>
                <input type="password" placeholder="Create Password" name="password" minlength="8" title="Password must be at least 8 characters long" required>

                <button type="submit" class="registerbtn" style="background-color: #007BFF;">Register Monthly</button>
            </form>
        </div>

        <div id="annual-form" class="tab-content">
            <form action="{{ route('register.annual.submit') }}" method="POST">
                @csrf
                <label>Full Name</label>
                <input type="text" placeholder="Enter Full Name" name="name" value="{{ old('name') }}" required>
                
                <label>Email Address</label>
                <input type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Phone Number</label>
                <input type="tel" placeholder="e.g. 0123456789" name="no_telefon" value="{{ old('no_telefon') }}" required>
                @error('no_telefon') <span class="error-msg">{{ $message }}</span> @enderror

                <label>Password</label>
                <input type="password" placeholder="Create Password" name="password" minlength="8" title="Password must be at least 8 characters long" required>

                <button type="submit" class="registerbtn" style="background-color: #28A745;">Register Annually</button>
            </form>
        </div>

    </div> 
    @if(session('status'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('status') }}
        </div>
    @endif

    <div class="signin">
        <p>Already have an account? <a href="{{ url('/login') }}">Log in</a></p>
    </div>
</div>

<script>
    function openTab(evt, tabId) {
        var contents = document.getElementsByClassName("tab-content");
        for (var i = 0; i < contents.length; i++) {
            contents[i].style.display = "none";
            contents[i].classList.remove("active");
        }

        var links = document.getElementsByClassName("tab-link");
        for (var i = 0; i < links.length; i++) {
            links[i].classList.remove("active");
        }

        var selected = document.getElementById(tabId);
        if (selected) {
            selected.style.display = "block";
            selected.classList.add("active");
        }

        evt.currentTarget.classList.add("active");
    }

    // ✅ VERSI KEMAS: Syarat dimasukkan terus ke dalam "Placeholder" (Inside the fill)
    document.addEventListener("DOMContentLoaded", function() {
        var forms = document.querySelectorAll('.tab-content form');

        forms.forEach(function(form) {
            var nameInput = form.querySelector('input[name="name"]');
            var emailInput = form.querySelector('input[name="email"]');
            var usernameInput = form.querySelector('input[name="username"]');
            var phoneInput = form.querySelector('input[name="no_telefon"]');
            var passwordInput = form.querySelector('input[name="password"]');

            // 1. Full Name - Set had & tukar tulisan dalam kotak
            if (nameInput) {
                nameInput.setAttribute('maxlength', '70');
                nameInput.setAttribute('placeholder', 'Enter Full Name (Max 70 chars)');
            }

            // 2. Email Address - Set had & tukar tulisan dalam kotak
            if (emailInput) {
                emailInput.setAttribute('maxlength', '50');
                emailInput.setAttribute('placeholder', 'Enter Email (Max 50 chars)');
            }

            // 3. Username
            if (usernameInput) {
                usernameInput.setAttribute('maxlength', '30');
                usernameInput.setAttribute('placeholder', 'Enter Username (Max 30 chars)');
            }

            // 4. Phone Number
            if (phoneInput) {
                phoneInput.setAttribute('maxlength', '15');
            }
            
            // 5. Password - Set had & tukar tulisan dalam kotak
            if (passwordInput) {
                passwordInput.setAttribute('minlength', '6');
                passwordInput.setAttribute('maxlength', '20');
                passwordInput.setAttribute('placeholder', 'Create Password (6-20 characters)');
            }
        });
    });
</script>

</body>
</html>