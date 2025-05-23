<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;

class CodewarController extends Controller
{
    public $challenges = [
        'add' => [
            'label' => 'Add Two Numbers',
            'description' => 'Write a function that returns the sum of two numbers.'
        ],
        'reverse' => [
            'label' => 'Reverse a String',
            'description' => 'Write a function that reverses a string.'
        ],
        'factorial' => [
            'label' => 'Factorial',
            'description' => 'Write a function that calculates the factorial of a number.'
        ],
    ];

    public function home()
    {

        return view('home', ['challenges' => $this->challenges]);
    }

    public function run($name)
    {
        $func = [
            'add' => 'function add($a, $b) {}',
            'reverse' => 'function reverse($str) {}',
            'factorial' => 'function factorial($n) {}',
        ];
        return view('codewar', [
            'challenge' => $name, 
            'func' => $func,
            'description' => $this->challenges[$name]['description']
        ]);
    }

    public function submit(Request $request, $name)
    {
        $code = $request->input('code');

        // Save to storage/code/UserCode.php
        $codePath = storage_path('code/UserCode.php');
        if (!is_dir(dirname($codePath))) {
            mkdir(dirname($codePath), 0777, true);
        }

        file_put_contents($codePath, "<?php\n\n" . $code);

        // Run the Laravel test
        $testPath = base_path("tests/Feature/" . ucfirst($name) . "Test.php");

        $env = [
            'TMP' => storage_path('temp'),
            'TEMP' => storage_path('temp'),
        ];

        $process = new \Symfony\Component\Process\Process(['php', 'artisan', 'test', $testPath], base_path(), $env);
        $process->run();

        $output = e($process->getOutput());

        return view('codewar', [
            'challenge' => $name,
            'output' => $output,
            'code' => $code,
            'description' => $this->challenges[$name]['description']
        ]);
    }
}

