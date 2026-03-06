<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family: Arial, Helvetica, sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#0f1c1c;
}

/* CARD LOGIN */

.login-card{
background:#f2f2f2;
width:350px;
padding:40px;
border-radius:30px;
text-align:center;
}

/* ICON */

.icon{
width:100px;
height:100px;
background:white;
border-radius:20px;
margin:-80px auto 20px;
display:flex;
align-items:center;
justify-content:center;
font-size:40px;
}

/* TITLE */

h1{
font-size:36px;
margin-bottom:5px;
}

.subtitle{
color:gray;
margin-bottom:30px;
}

/* INPUT */

label{
font-size:12px;
letter-spacing:2px;
color:gray;
display:block;
text-align:left;
margin-bottom:5px;
}

input{
width:100%;
padding:12px;
border:none;
border-radius:15px;
background:#ddd;
margin-bottom:20px;
font-size:14px;
}

/* BUTTON */

button{
width:100%;
padding:14px;
border:none;
border-radius:10px;
background:#1c2b2b;
color:white;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#000;
}

.error{
color:gray;
margin-top:20px;
font-size:14px;
}

</style>
</head>

<body>

<div class="login-card">

<div class="icon">
📚
</div>

<h1>Login</h1>
<p class="subtitle">Sign in to continue.</p>

@if(session('error'))
<div class="error">
{{ session('error') }}
</div>
@endif

<form action="/login" method="POST">

@csrf

<label>NAME</label>
<input type="text" name="username" placeholder="Username">

<label>PASSWORD</label>
<input type="password" name="password" placeholder="Password">

<button type="submit">Log in</button>

</form>

@if(session('error'))
<p class="error">Password atau Username salah</p>
@endif

</div>

</body>
</html>