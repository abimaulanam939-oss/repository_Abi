<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Perpustakaan</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family: 'Segoe UI', sans-serif;
}

/* BACKGROUND */

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f') no-repeat center center/cover;
position:relative;
}

/* OVERLAY GELAP */

body::before{
content:'';
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.6);
z-index:0;
}

/* LOGIN CARD */

.login-card{
position:relative;
z-index:1;
width:380px;
background:white;
padding:40px;
border-radius:20px;
box-shadow:0 10px 40px rgba(0,0,0,0.4);
text-align:center;
}

/* ICON */

.icon{
width:90px;
height:90px;
margin:-80px auto 20px;
background:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:40px;
box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

/* TITLE */

h1{
font-size:28px;
margin-bottom:5px;
}

.subtitle{
color:gray;
margin-bottom:25px;
font-size:14px;
}

/* INPUT */

.input-group{
margin-bottom:18px;
text-align:left;
}

label{
font-size:12px;
color:#555;
margin-bottom:5px;
display:block;
}

input{
width:100%;
padding:12px;
border-radius:10px;
border:1px solid #ddd;
font-size:14px;
}

input:focus{
border-color:#2c5364;
outline:none;
}

/* BUTTON */

button{
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:#2c5364;
color:white;
font-size:15px;
cursor:pointer;
}

button:hover{
background:#203a43;
}

/* ERROR */

.error{
background:#ffe5e5;
color:red;
padding:10px;
border-radius:8px;
margin-bottom:15px;
font-size:14px;
}

</style>
</head>

<body>

<div class="login-card">

<div class="icon">
<i class="fa-solid fa-book"></i>
</div>

<h1>Login</h1>
<p class="subtitle">Perpustakaan bpm</p>

@if(session('error'))
<div class="error">
{{ session('error') }}
</div>
@endif

<form action="/login" method="POST">
@csrf

<div class="input-group">
<label>Username</label>
<input type="text" name="username" placeholder="Masukkan username" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" placeholder="Masukkan password" required>
</div>

<button type="submit">
<i class="fa-solid fa-right-to-bracket"></i> Login
</button>

</form>

</div>

</body>
</html>