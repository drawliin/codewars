<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process;
use Illuminate\Http\Request;

class CodewarController extends Controller
{
    public function home()
    {
        $challenges = [
            'add' => 'Add Two Numbers',
            'reverse' => 'Reverse a String',
            'factorial' => 'Factorial',
        ];

        return view('home', compact('challenges'));
    }

    public function run($name)
    {
        $func = [
            'add' => 'function add($a, $b) {}',
            'reverse' => 'function reverse($str) {}',
            'factorial' => 'function factorial($n) {}',
        ];
        return view('codewar', ['challenge' => $name, 'func' => $func]);
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
            'challenge' => ucfirst($name),
            'output' => $output,
            'code' => $code
        ]);
    }
}

