<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    background: linear-gradient(135deg, #1d2b64, #f8cdda);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

/* Background floating blur effect */
body::before {
    content: "";
    position: absolute;
    width: 600px;
    height: 600px;
    background: rgba(255,255,255,0.15);
    filter: blur(150px);
    border-radius: 50%;
    top: -150px;
    left: -150px;
}

body::after {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(0,0,0,0.2);
    filter: blur(120px);
    border-radius: 50%;
    bottom: -100px;
    right: -100px;
}

.login-card {
    position: relative;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 50px 40px;
    width: 360px;
    box-shadow: 0 25px 45px rgba(0,0,0,0.2);
    text-align: center;
    color: white;
    animation: fadeIn 1s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.logo-box {
    width: 100px;
    height: 100px;
    background: rgba(255,255,255,0.25);
    border-radius: 20px;
    margin: 0 auto 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo-box img {
    width: 60px;
}

h1 {
    font-weight: 600;
    margin-bottom: 5px;
}

.subtitle {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 30px;
}

.input-group {
    text-align: left;
    margin-bottom: 20px;
}

label {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 1px;
    margin-bottom: 5px;
    display: block;
}

input {
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    border: none;
    outline: none;
    font-size: 14px;
    background: rgba(255,255,255,0.8);
    transition: 0.3s;
}

input:focus {
    background: white;
    box-shadow: 0 0 0 2px #ffffff88;
}

button {
    width: 100%;
    padding: 14px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.error {
    margin-top: 15px;
    font-size: 13px;
    color: #ffcccc;
}

.footer-text {
    margin-top: 20px;
    font-size: 12px;
    opacity: 0.7;
}
</style>
</head>

<body>

<div class="login-card">

    <div class="logo-box">
        <img src="{{ asset('logo.png') }}" alt="Logo">
    </div>

    <h1>Welcome Back</h1>
    <p class="subtitle">Sign in to your account</p>

    <form method="POST" action="{{ route('login.proses') }}">
        @csrf

        <div class="input-group">
            <label>USERNAME</label>
            <input type="text" name="username" placeholder="Enter username" required>
        </div>

        <div class="input-group">
            <label>PASSWORD</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <button type="submit">Login</button>

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
    </form>

    <div class="footer-text">
        © 2026 Your Company
    </div>

</div>

</body>
</html>