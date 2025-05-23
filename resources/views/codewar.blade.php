<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucfirst($challenge)." Challenge"}}</title>
    <style>
        body {
            display: flex;
            gap: 20px;
            justify-content: space-between;
            background-color: #ffffff;  /* white background */
            color: #222222;             /* dark text */
            font-family: 'Courier New', Courier, monospace;
            padding: 2rem;
            line-height: 1.6;
        }

        .cont1, .cont2{
            width: 49%;
        }
       

        h2 {
            color: #e67e22;  /* bright orange */
            margin-bottom: 1rem;
        }

        a {
            color: #2980b9;  /* strong blue */
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
            font-size: 1.3rem;
            font-weight: 600;
        }

        textarea {
            width: 90%;
            background-color: #2d2d3f;  /* dark but softer */
            color: #d4d4dc;
            padding: 1rem;
            border: 1px solid #44475a;
            font-family: 'Fira Mono', 'Consolas', 'Courier New', monospace;
            font-size: 1.2rem;
            line-height: 1.4;
            white-space: pre;
            overflow-wrap: break-word;
            resize: vertical;
            border-radius: 5px;
        }

        button {
            margin-top: 1.5rem;
            padding: 0.5rem 1rem;
            background-color: #27ae60;  /* green */
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }
        button:hover, button:focus {
            background-color: #1e8449;
            outline: none;
        }

        .pre {
            background-color: #282a36;  /* very light grey */
            padding: 1rem 0;
            border: 1px solid #ddd;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            line-height: 1;
            margin: 0;
            font-family: monospace;
            font-size: 0.9rem;
            color: #f8f8f2;
        }

        .pre span {
            display: block;  /* no extra vertical spacing */
            margin: 0 15px;
            padding: 0;
        }

        /* Colored highlights */
        .green {
            color: #27ae60; /* dark green */
            font-weight: 600;
        }

        .red {
            color: #c0392b; /* dark red */
            font-weight: 600;
        }

        .yellow {
            color: yellow; /* dark orange */
            font-weight: 600;
        }

        .description {
            font-size: 1.25rem;
            color: #333;
            background-color: #fff9db;
            border-left: 6px solid #ffc107;
            padding: 1rem;
            max-width: 800px;
            margin-bottom: 2rem;
            font-style: normal;
            font-weight: 500;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }


    </style>

</head>
<body>
    
    <div class="cont1">
        <a href="{{ url('/') }}">← Back to challenges</a>
    
        <h2>🔥 Challenge: {{ ucfirst($challenge) }}</h2>
        <p class="description">
            {{ $description }}
        </p>
        
        <form method="POST" action="{{ url('/challenge/' . $challenge) }}">
            @csrf
            <textarea name="code" rows="10" cols="80" placeholder="Write your function here..." >{{ trim($code ?? $func[$challenge]) }}</textarea>
            <br>
            <button type="submit">✅ Run Tests</button>
        </form>
    </div>

    <div class="cont2">
        @if (isset($output))
            <h3>✅ Test Results</h3>
    
            @php
                $lines = explode("\n", $output);
            @endphp
    
            <div class="pre">
                @foreach ($lines as $line)
                    @php
                        $styledLine = $line;
                        $needles = ['FAIL', '➜', 'failed', '⨯'];
                        $class = "";
    
                        if ((str_contains($line, 'assertEquals') && !str_contains($line, '➜')) || str_contains($line, "✓") || str_contains($line, "PASS") || str_contains($line, "Duration")) {
                            $class = 'green';
                        }
                        foreach ($needles as $n) {
                            if (str_contains($line, $n)) {
                                $class = 'red';
                            }
                        }
                        if (str_contains($line, 'expected')) {
                            $class = 'yellow';
                        }
                        
                        $line = trim($line);
                        if ($line === '{}' || $line === '' || str_contains($line, "Metadata")) continue;

                    @endphp
    
                    <span class="{{ $class }}">{!! trim($styledLine) !!}</span>
                @endforeach
            </div>
        @endif
    </div>

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