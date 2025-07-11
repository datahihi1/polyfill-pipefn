<?php
require_once __DIR__ . '/../pipeFunction.php';

$text = "  hello world  ";

$result = pipe($text,
    'trim',
    'strtoupper',
    function($str) { return str_replace(' ', '_', $str); }
);

echo $result; // Outputs: HELLO_WORLD