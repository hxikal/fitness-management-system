<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Unique Plus</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
            color: rgba(255, 255, 255, 0.7);
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
            background: rgba(255, 255, 255, 0.1);
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
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

        .form-group {
            margin-bottom: 20px;
        }

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

        .payment-methods {
            display: flex;
            gap: 15px;
        }

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

        .btn-pay:hover {
            background: #004ebc;
            transform: translateY(-3px);
        }

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
        <a href="{{ route('userdashboard') }}" class="logo">
            <img src="{{ asset('image/gym.jpg') }}" alt="Logo">
            <span>Unique Plus Gym</span>
        </a>
        <ul>
            <li><a href="{{ route('userdashboard') }}"><i class="fas fa-th-large"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('membership.info') }}"><i class="fas fa-qrcode"></i> <span>Membership info</span></a>
            </li>
            <li><a href="{{ route('payment_history') }}"><i class="fas fa-file-invoice-dollar"></i>
                    <span>Payment</span></a></li>
            <li><a href="{{ route('equipment.report.index') }}"><i class="fas fa-tools"></i> <span>Equipment
                        Report</span></a></li>
            <li><a href="{{ route('fitnesstrainer') }}" class="active"><i class="fas fa-calendar-check"></i>
                    <span>Fitness Trainer</span></a></li>

            <li style="margin-top: 20px;">
                <div style="border-top: 1px solid #333;">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();"
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
            <!-- LEFT: Checkout Form -->
            <div class="card">
                <h3><i class="fa fa-shield-halved"></i> Secure Checkout</h3>

                <!-- STEP 1: Plan & Method Selection -->
                <div id="step1">
                    <div class="form-group">
                        <label><i class="fa fa-dumbbell"></i> Membership Plan</label>
                        <select id="membership_type" name="membership_type" onchange="updateUI()">
                            <option value="walkin" data-price="12.00">Walk-in Pass (RM 12.00), Student (RM6.00)</option>
                            <option value="monthly" data-price="85.00">Monthly Membership (RM 85.00), Student (RM 60.00)
                            </option>
                            <option value="yearly" data-price="699.00">Annual Membership (RM 699.00), Student (RM500.00)
                            </option>
                        </select>
                    </div>

                    <input type="hidden" name="payment_method" id="payment_method_input" value="Maybank DuitNow QR">

                    <div class="form-group">
                        <label>Available Payment Methods</label>
                        <div class="payment-methods">
                            <div class="method-box active" data-method="Maybank DuitNow QR">
                                <i class="fa fa-university"></i><br>Maybank DuitNow QR
                            </div>
                            <div class="method-box" data-method="Touch 'n Go eWallet">
                                <i class="fa fa-wallet"></i><br>Touch 'n Go eWallet
                            </div>
                            <div class="method-box" data-method="Maybank Online Transfer">
                                <i class="fa fa-money-bill-transfer"></i><br>Maybank Online Transfer
                            </div>
                        </div>
                    </div>
                    <div class="price-display" id="display_price">RM 12.00</div>

                    <button type="button" class="btn-pay" onclick="proceedToQR()">
                        <i class="fa fa-lock"></i> PAY NOW
                    </button>
                </div>

                <!-- STEP 2: QR Code + Receipt Upload -->
                <div id="step2" style="display:none;">
                    <div style="text-align:center; margin-bottom:20px;">
                        <h4 style="color:#1a202c; font-size:18px; font-weight:700;">
                            Scan QR to Pay
                        </h4>
                        <p style="color:#718096; font-size:13px;">
                            Transfer to <strong>Unique Plus Gym</strong> and upload your receipt below.
                        </p>

                        <!-- YOUR GYM QR CODE IMAGE HERE -->
                        <div
                            style="background:#f8fafc; border:2px dashed #10a37f; border-radius:15px; padding:20px; display:inline-block; margin:15px 0;">
                            <img src="{{ asset('image/paymentqr.jpeg') }}" alt="Payment QR Code" style="
        width:100%;
        max-width:400px;
        height:auto;
        object-fit:contain;
        display:block;
        margin:auto;
     " onerror="this.style.display='none'; document.getElementById('qr_placeholder').style.display='block'">

                            <div id="qr_placeholder"
                                style="display:none; width:220px; height:220px; background:#e2e8f0; border-radius:10px; align-items:center; justify-content:center; flex-direction:column;">
                                <i class="fa fa-qrcode" style="font-size:60px; color:#a0aec0;"></i>
                                <p style="color:#a0aec0; font-size:12px; margin-top:10px;">QR Code Here</p>
                            </div>

                            <div
                                style="background:#f0fff4; border-radius:10px; padding:15px; margin:10px 0; font-size:13px; color:#2d3748; text-align:left;">
                                <p style="margin:4px 0;"><strong>Bank:</strong> Maybank / TNG / DuitNow</p>
                                <p style="margin:4px 0;"><strong>Account:</strong> 551427167561</p>
                                <p style="margin:4px 0;"><strong>Name:</strong> Unique Plus Gym Sdn Bhd</p>
                                <p style="margin:4px 0; color:var(--success-green); font-weight:700;">
                                    Amount: <span id="qr_amount">RM 12.00</span>
                                </p>
                            </div>
                        </div>

                        <!-- Receipt Upload -->
                        <div class="form-group">
                            <label><i class="fa fa-upload"></i> Upload Payment Receipt</label>
                            <input type="file" id="receipt_file" accept="image/*,.pdf"
                                style="width:100%; padding:10px; border:2px dashed #e2e8f0; border-radius:8px; cursor:pointer;">
                            <p style="font-size:11px; color:#a0aec0; margin-top:5px;">JPG, PNG or PDF. Max 5MB.</p>
                        </div>

                        <button type="button" class="btn-pay" onclick="submitReceipt()" id="uploadBtn">
                            <i class="fa fa-paper-plane"></i> SUBMIT RECEIPT
                        </button>

                        <button type="button" onclick="backToStep1()"
                            style="width:100%; margin-top:10px; padding:12px; background:none; border:1px solid #e2e8f0; border-radius:10px; cursor:pointer; color:#718096;">
                            ← Back
                        </button>
                    </div>

                    <!-- STEP 3: Success -->
                    <div id="step3" style="display:none; text-align:center; padding:20px;">
                        <i class="fa fa-circle-check" style="font-size:60px; color:#10a37f;"></i>
                        <h3 style="color:#1a202c; margin-top:15px;">Receipt Submitted!</h3>
                        <p style="color:#718096;">Your payment is under review. Membership will be activated once
                            approved.</p>
                        <div
                            style="background:#f0fff4; border-radius:10px; padding:15px; margin:15px 0; text-align:left; font-size:13px;">
                            <p style="margin:4px 0;"><strong>Transaction ID:</strong> <span id="success_txn"></span></p>
                            <p style="margin:4px 0;"><strong>Plan:</strong> <span id="success_plan"></span></p>
                            <p style="margin:4px 0;"><strong>Amount:</strong> <span id="success_amount"></span></p>
                        </div>
                        <a href="{{ route('payment_history') }}"
                            style="display:inline-block; margin-top:10px; padding:12px 25px; background:#10a37f; color:white; border-radius:10px; text-decoration:none; font-weight:700;">
                            View History
                        </a>
                    </div>
                </div>
                <!-- RIGHT: Order Summary -->
                <div class="card">
                    <h3><i class="fa fa-receipt"></i> Order Summary</h3>
                    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
                        <span style="color:#718096">Member:</span>
                        <strong>{{ auth()->user()->name ?? 'Guest' }}</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
                        <span style="color:#718096">Status:</span>
                        <span style="color:var(--amber); font-weight:700;" id="order_status">UNPAID</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
                        <span style="color:#718096">Plan:</span>
                        <strong id="summary_plan">Walk-in Pass</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:15px;">
                        <span style="color:#718096">Accepted Payment:</span>
                        <strong id="summary_payment_method" style="text-align:right;">Maybank DuitNow QR, Touch 'n Go
                            eWallet, Maybank Online Transfer</strong>
                    </div>
                    <div class="summary-total" style="display:flex; justify-content:space-between;">
                        <span>Total:</span>
                        <span id="summary_total">RM 12.00</span>
                    </div>
                    <div style="margin-top:30px; font-size:12px; color:#a0aec0; text-align:center;">
                        <i class="fa fa-circle-check"></i> Pending Transaction
                    </div>
                </div>
            </div>
            <script>
                let selectedMethod = document.querySelector('.method-box.active')?.dataset.method || 'Maybank DuitNow QR';
                let currentPaymentId = null;

                document.querySelectorAll('.method-box').forEach(box => {
                    box.addEventListener('click', () => {
                        document.querySelectorAll('.method-box').forEach(method => method.classList.remove('active'));
                        box.classList.add('active');
                        selectedMethod = box.dataset.method;
                        document.getElementById('payment_method_input').value = selectedMethod;
                    });
                });

                function updateUI() {
                    const select = document.getElementById('membership_type');
                    const opt = select.options[select.selectedIndex];
                    const price = opt.getAttribute('data-price');
                    const plan = opt.text.split(' (')[0];

                    document.getElementById('display_price').innerText = 'RM ' + price;
                    document.getElementById('summary_total').innerText = 'RM ' + price;
                    document.getElementById('summary_plan').innerText = plan;
                }

                function proceedToQR() {
                    const select = document.getElementById('membership_type');
                    const opt = select.options[select.selectedIndex];
                    const price = opt.getAttribute('data-price');
                    const plan = select.value;

                    fetch("/payment/pay", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ plan: plan, amount: price, method: selectedMethod })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                currentPaymentId = data.payment_id;
                                document.getElementById('qr_amount').innerText = 'RM ' + data.amount;
                                document.getElementById('order_status').innerText = 'PENDING';
                                document.getElementById('order_status').style.color = '#d97706';
                                document.getElementById('step1').style.display = 'none';
                                document.getElementById('step2').style.display = 'block';
                            } else {
                                alert('Something went wrong. Please try again.');
                            }
                        })
                        .catch(() => alert('Network error. Please try again.'));
                }

                function submitReceipt() {
                    const file = document.getElementById('receipt_file').files[0];
                    if (!file) { alert('Please select a receipt file.'); return; }
                    if (!currentPaymentId) { alert('No payment found. Please try again.'); return; }

                    const form = new FormData();
                    form.append('receipt', file);
                    form.append('payment_id', currentPaymentId);
                    form.append('_token', '{{ csrf_token() }}');

                    document.getElementById('uploadBtn').innerText = 'Uploading...';
                    document.getElementById('uploadBtn').disabled = true;

                    fetch("/payment/upload-receipt", {
                        method: 'POST',
                        body: form
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const select = document.getElementById('membership_type');
                                const opt = select.options[select.selectedIndex];

                                document.getElementById('success_txn').innerText = 'TXN-' + currentPaymentId;
                                document.getElementById('success_plan').innerText = opt.text.split(' (')[0];
                                document.getElementById('success_amount').innerText = document.getElementById('qr_amount').innerText;

                                document.getElementById('step2').style.display = 'none';
                                document.getElementById('step3').style.display = 'block';
                            } else {
                                alert('Upload failed. Please try again.');
                            }
                        })
                        .catch(() => alert('Upload error. Please try again.'))
                        .finally(() => {
                            document.getElementById('uploadBtn').innerText = 'SUBMIT RECEIPT';
                            document.getElementById('uploadBtn').disabled = false;
                        });
                }

                function backToStep1() {
                    document.getElementById('step2').style.display = 'none';
                    document.getElementById('step1').style.display = 'block';
                }

                // Init on load
                updateUI();
            </script>
</body>

</html>