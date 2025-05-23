<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Challenges</title>
    <style>
        body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f7f9fc;
        color: #333;
        margin: 2rem auto;
        max-width: 600px;
        padding: 0 1rem;
        }

        h1 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 2rem;
        color: #2c3e50;
        user-select: none;
        }

        ul {
        list-style: none;
        padding: 0;
        margin: 0;
        }

        li {
        margin-bottom: 1rem;
        }

        a {
        display: block;
        padding: 1rem 1.5rem;
        text-decoration: none;
        font-weight: 600;
        background: #3498db;
        color: white;
        border-radius: 6px;
        box-shadow: 0 4px 6px rgb(52 152 219 / 0.3);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        a:hover,
        a:focus {
        background: #2980b9;
        box-shadow: 0 6px 12px rgb(41 128 185 / 0.5);
        outline: none;
        }
    </style>
</head>
<body>
    <h1>🧠 Choose a Challenge</h1>

    <ul>
        @foreach ($challenges as $key => $label)
            <li>
                <a href="{{ url('/challenge/' . $key) }}">
                    👉 {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>

</body>
</html>