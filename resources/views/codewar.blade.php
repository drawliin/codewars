<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucfirst($challenge)." Challenge"}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    <style>
        body {
            background-color: #ffffff;  /* white background */
            color: #222222;             /* dark text */
            font-family: 'Courier New', Courier, monospace;
            padding: 2rem;
            line-height: 1.6;
        }
        .challenge{
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .cont1{
            width: 48%;
        }
        .cont2{
            width: 50%;
        }
       

        h2 {
            color: #e67e22;  /* bright orange */
            margin-bottom: 1rem;
        }
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: #f1c40f;  /* nice yellow */
            color: #222;
            font-weight: 600;
            font-size: 1.2rem;
            padding: 0.6rem 1rem;
            margin-bottom: 15px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(241, 196, 15, 0.4);
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .back-button i {
            font-size: 1.1rem;
        }

        .back-button:hover, 
        .back-button:focus {
            background-color: #d4ac0d;  /* darker yellow */
            box-shadow: 0 4px 8px rgba(212, 172, 13, 0.6);
            outline: none;
        }

        textarea {
            width: 95%;
            background-color: #2d2d3f;  /* dark but softer */
            color: #d4d4dc;
            padding: 1rem;
            border: 1px solid #44475a;
            font-family: 'Fira Mono', 'Consolas', 'Courier New', monospace;
            font-size: 1.4rem;
            line-height: 1.4;
            white-space: pre;
            overflow-wrap: break-word;
            resize: vertical;
            border-radius: 5px;
            max-height: 600px;
        }

        button {
            margin-top: 1.5rem;
            padding: 0.65rem 1.5rem;
            background: linear-gradient(135deg, #2ecc71, #27ae60); 
            color: white;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(58, 134, 255, 0.4);
            transition: background 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }
        button:hover, button:focus {
            background: linear-gradient(135deg, #27ae60, #219150);
            outline: none;
        }

        .pre {
            background-color: #1e1e2f; 
            color: #f0f0f5;
            font-family: 'Fira Mono', 'Consolas', 'Courier New', monospace;
            font-size: 1.1rem;
            padding: .6rem 0;
            border-radius: 8px;
            box-shadow: 0 0 15px rgb(30 30 47 / 0.6);
            overflow-y: auto;
            line-height: .6;
            white-space: pre-wrap;
            word-wrap: break-word;
            margin: 0;
            border: 1px solid #3b3b5a;
        }

        .pre span {
            display: block; 
            margin: 0 15px;
            padding: 0;
        }

        
        .green {
            color: #27ae60; 
            font-weight: 600;
        }

        .red {
            color: #c0392b; 
            font-weight: 600;
        }

        .yellow {
            color: yellow; 
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
            font-weight: 900;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }


    </style>

</head>
<body>
    
    <a href="{{ url('/') }}" class="back-button" ><i class="fas fa-arrow-left"></i> Back to challenges</a>
    
    <div class="challenge">
        <div class="cont1">
            <h2>🔥 Challenge: {{ ucfirst($challenge) }}</h2>
            <p class="description">
                {{ $description }}
            </p>
            
            <form method="POST" action="{{ url('/challenge/' . $challenge) }}">
                @csrf
                <textarea name="code" rows="14" cols="80" placeholder="Write your function here..." >{{ trim($code ?? $func[$challenge]) }}</textarea>
                <br>
                <button type="submit"><i class="fa-solid fa-bolt"></i> Run Tests</button>
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