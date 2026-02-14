<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat Datang di Dashboard 🚀</h1>

    <h2>Skills</h2>
    <ul>
        @foreach($skills as $skill)
            <li>{{ $skill['name'] }} - {{ $skill['level'] }}%</li>
        @endforeach
    </ul>

    <h2>Projects</h2>
    <ul>
        @foreach($projects as $project)
            <li>
                <strong>{{ $project['title'] }}</strong> ({{ $project['year'] }})
                <br>
                {{ $project['desc'] }}
            </li>
        @endforeach
    </ul>
</body>
</html>
