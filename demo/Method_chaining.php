<?php
require_once __DIR__ . '/../pipeFunction.php';

class Calculator {
    private $value;
    
    public function __construct($value) {
        $this->value = $value;
    }
    
    public function add($num) {
        $this->value += $num;
        return $this;
    }
    
    public function multiply($num) {
        $this->value *= $num;
        return $this;
    }
    
    public function getValue() {
        return $this->value;
    }
}

$calculator = new Calculator(5);

// Traditional chaining
// $result1 = $calculator->add(3)->multiply(2)->getValue(); // 16

// Using pipe function
// $result = pipe($calculator, 'add', 'multiply', 'getValue');
// This won't work as expected because add() and multiply() need arguments

// Better approach with arguments
$result2 = pipe($calculator, 
    ['add', [3]], 
    ['multiply', [2]], 
    'getValue'
);

echo "Result: $result2\n"; // Output: Result: 16