<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Unique Plus</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
<style>
        :root {
            --primary-blue: #0061f2;
            --success-green: #10a37f;
            --header-black: #1a202c;
            --bg-dark: black; 
            --bg-light: #f8fafc;
            --amber: #d97706;
            --secondary-color: #d4af37;
            --text-white: #ffffff;
        }

        body {
            background: #7FFF00;
            font-family: 'Inter', sans-serif;
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

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 50px;
            width: calc(100% - 260px);
            box-sizing: border-box;
            min-height: 100vh;
        }

        .header-container {
            margin-bottom: 40px;
            border-left: 6px solid var(--success-green);
            padding-left: 20px;
        }

        .header-container h1 {
            color: var(--header-black);
            font-size: 38px;
            font-weight: 800;
            margin: 0;
            text-transform: uppercase;
        }

        .payment-container {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 35px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            border: 1px solid #edf2f7;
        }

        .card h3 {
            font-size: 20px;
            color: var(--header-black);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .price-display {
            font-size: 48px;
            font-weight: 800;
            color: var(--success-green);
            margin: 25px 0;
            text-align: center;
            background: #f0fff4;
            padding: 30px;
            border-radius: 15px;
            border: 2px solid #c6f6d5;
        }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 12px;
        }

        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .payment-methods { display: flex; gap: 15px; }
        .method-box {
            flex: 1;
            border: 2px solid #e2e8f0;
            padding: 20px 10px;
            text-align: center;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .method-box.active {
            border-color: var(--primary-blue);
            background: #ebf8ff;
        }

        .btn-pay {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 22px;
            border-radius: 12px;
            width: 100%;
            font-weight: 700;
            font-size: 20px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn-pay:hover { background: #004ebc; transform: translateY(-3px); }

        .summary-total {
            color: var(--success-green);
            font-size: 26px;
            font-weight: 800;
            border-top: 2px solid #eee;
            margin-top: 20px;
            padding-top: 20px;

            
        }


    </style>
</head>
<body>

        <nav>
        <a href="{{ route('user.dashboard') }}" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>Unique Plus Gym</span>
        </a>
        <ul>
            <li><a href="{{ route('user.dashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-qrcode"></i> <span>Membership info</span></a></li> 
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i> <span>Payment</span></a></li> 
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

    <div class="main-content">
        <div class="header-container">
            <h1>Membership Payment</h1>
            <p>Securely complete your gym registration.</p>
        </div>

        <div class="payment-container">
            <div class="card">
                <h3><i class="fa fa-shield-halved icon-shield"></i> Secure Checkout</h3>
                <form id="paymentForm">
                    <div class="form-group">
                        <label><i class="fa fa-dumbbell" style="color:var(--bg-dark)"></i> Membership Plan</label>
                        <select id="membership_type" onchange="updateUI()">
                            <option value="walkin" data-price="12.00">Walk-in Pass : General (RM 12.00), Student(RM 6.00)</option>
                            <option value="monthly" data-price="85.00">Monthly Membership (RM 85.00), Student(RM63.00)</option>
                            <option value="yearly" data-price="699.00">Annual Membership (RM 699.00), Student(RM 500.00)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Payment Method</label>
                        <div class="payment-methods">
                            <div class="method-box active" onclick="selectMethod(this)">
                                <i class="fa fa-university icon-bank"></i><br>Banking
                            </div>
                            <div class="method-box" onclick="selectMethod(this)">
                                <i class="fa fa-wallet icon-wallet"></i><br>E-Wallet
                            </div>
                         
                        </div>
                    </div>

                    <div class="price-display" id="display_price">auto</div>

                    <button type="submit" class="btn-pay">
                        <i class="fa fa-lock"></i> PAY NOW
                    </button>
                </form>
            </div>

            <div class="card">
                <h3><i class="fa fa-receipt icon-receipt"></i> Order Summary</h3>
                <div style="display:flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color:#718096">Member:</span>
                    <strong>{{ auth()->user()->name ?? 'Guest Member' }}</strong>
                </div>
                <div style="display:flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color:#718096">Status:</span>
                    <span style="color:var(--amber); font-weight: 700;">UNPAID</span>
                </div>
                <div style="display:flex; justify-content: space-between; margin-bottom: 15px;">
                    <span style="color:#718096">Plan:</span>
                    <strong id="summary_plan">Walk-in Pass</strong>
                </div>

                <div class="summary-total" style="display:flex; justify-content: space-between;">
                    <span>Total:</span>
                    <span id="summary_total"></span>
                </div>

                <div style="margin-top:30px; font-size: 12px; color: #a0aec0; text-align: center;">
                    <i class="fa fa-circle-check icon-shield"></i> 
                    Pending Transaction
                </div>
            </div>
        </div>
    </div>

    

   <script>
    // 1. Function to handle selection of payment method
    function selectMethod(el) {
        document.querySelectorAll('.method-box').forEach(box => box.classList.remove('active'));
        el.classList.add('active');
    }

    // 2. Function to update UI details
    function updateUI() {
        const select = document.getElementById('membership_type');
        // Get selected option
        const selectedOption = select.options[select.selectedIndex];
        
        // Extract values
        const price = selectedOption.getAttribute('data-price');
        // Extract text before the first parenthesis
        const planName = selectedOption.text.split(' (')[0];
        
        // Apply values to the DOM
        document.getElementById('display_price').innerText = "RM " + price;
        document.getElementById('summary_total').innerText = "RM " + price;
        document.getElementById('summary_plan').innerText = planName;
    }

    // 3. Initialize on page load so it's not "auto"
    window.addEventListener('DOMContentLoaded', (event) => {
        updateUI();
    });

    // 4. Payment Submission logic
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const plan = document.getElementById('membership_type').value;
        // Ensure we handle cases where price might still be empty
        const priceElement = document.getElementById('display_price').innerText;
        const price = priceElement.replace('RM ', '');
        const method = document.querySelector('.method-box.active').innerText.trim();

        fetch('/api/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ plan, amount: price, method })
        })
        .then(res => res.json())
        .then(data => {
            alert("Payment Response: " + JSON.stringify(data));
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>