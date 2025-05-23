<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucfirst($challenge)." Challenge"}}</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #eee;
            font-family: 'Courier New', Courier, monospace;
            padding: 2rem;
            line-height: 1.6;
        }

        h2 {
            color: #ffa500;
            margin-bottom: 1rem;
        }

        a {
            color: #00ffff;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        textarea {
            width: 100%;
            max-width: 800px;
            background-color: #121212;
            color: #ffffff;
            padding: 1rem;
            border: 1px solid #444;
            font-family: monospace;
            font-size: 1.5rem;
            white-space: pre;
            overflow-wrap: break-word;
        }

        button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #00cc66;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }

        .pre {
            background-color: #111;
            padding: 1rem;
            border: 1px solid #333;
            overflow-x: auto;
            max-width: 800px;
            white-space: pre-wrap;
            word-wrap: break-word;
            line-height: 1;
            margin: 0;
            font-family: monospace;
            font-size: 0.9rem;
        }

        .pre span {
            display: block; /* forces line-by-line display */
            margin: 0;
            padding: 0;
        }

        .green {
            color: #00ff00;
        }

        .red {
            color: #ff4c4c;
        }

        .orange {
            color: orange;
        }
    </style>
</head>
<body>
    <h2>🔥 Challenge: {{ ucfirst($challenge) }}</h2>

    <a href="{{ url('/') }}">← Back to challenges</a>

    <form method="POST" action="{{ url('/challenge/' . $challenge) }}">
        @csrf
        <textarea name="code" rows="10" cols="80" placeholder="Write your function here..." >{{ trim($code ?? $func[$challenge]) }}</textarea>
        <br>
        <button type="submit">✅ Run Tests</button>
    </form>

    @if (isset($output))
        <h3>✅ Test Results</h3>

        @php
            $lines = explode("\n", $output);
        @endphp

        <div class="pre">
            @foreach ($lines as $line)
                @php
                    $styledLine = $line;
                    $needles = ['FAIL', '➜', 'failed'];
                    $class = "";

                    if ((str_contains($line, 'assertEquals') && !str_contains($line, '➜')) || str_contains($line, "✓") || str_contains($line, "PASS")) {
                        $class = 'green';
                    }
                    foreach ($needles as $n) {
                        if (str_contains($line, $n)) {
                            $class = 'red';
                        }
                    }
                    if (str_contains($line, 'ERROR')) {
                        $class = 'orange';
                    }
                @endphp

                <span class="{{ $class }}">{{!! $styledLine !!}}</span>
            @endforeach
        </div>
    @endif

    <script>
       document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.querySelector('textarea[name="code"]');

            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    e.preventDefault();

                    const start = this.selectionStart;
                    const end = this.selectionEnd;

                    
                    this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);

                    this.selectionStart = this.selectionEnd = start + 1;
                }
            });
        }); 
    </script>
</body>
</html>