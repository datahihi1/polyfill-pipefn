<?php
require_once __DIR__ . '/../pipeFunction.php';

$numbers = [1, 2, 3, 4, 5];

// Using closures
$result1 = pipe($numbers,
    function($arr) { return array_filter($arr, function($n) { return $n > 2; }); },
    function($arr) { return array_map(function($n) { return $n * 2; }, $arr); },
    function($arr) { return array_sum($arr); }
); // 24 (sum of [6, 8, 10])

print_r($result1) . "\n";

// Using array functions
$result2 = pipe($numbers,
    function($arr) { return array_filter($arr, 'is_numeric'); },
    function($arr) { return array_reverse($arr); },
    function($arr) { return array_slice($arr, 0, 3); }
); // [5, 4, 3]

print_r($result2);