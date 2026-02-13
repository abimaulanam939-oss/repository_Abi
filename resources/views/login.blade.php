<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login disini</title>
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">
    <script src="bootsrap/js/bootsrap.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden; /* Prevents scrollbars */
        }
        video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1; /* Sends video behind other elements */
            transform: translate(-50%, -50%);
            object-fit: cover; /* Ensures the video covers the entire area */
            filter: brightness(0.5); /* Menambahkan efek gelap */
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            margin-top: 100px;
            background: rgba(255, 255, 255, 0.3); /* Lebih transparan */
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            /* backdrop-filter: blur(8px); /* Jika ingin menghapus blur, bisa hapus atau komentar ini */
        }
        h2 {
            
            color: #333;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <video autoplay muted loop>
        <source src="video/vidiotaruna.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="{{route('cek_user')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </di>
        </form>

       @if(@session()->has('pesan'))
           {{session()->get('pesan')}}
     
        @endif
            
        <div class="text-center mt-3">
            <a href="#">Lupa Password?</a>
        </div>
     
        

    </div>


</body>
</html>
