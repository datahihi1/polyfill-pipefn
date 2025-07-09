# PHP Pipe Function Polyfill

A lightweight polyfill that provides a `pipe()` function for method chaining in PHP 5.6+ applications. This function allows you to chain method calls on objects or apply closures in a clean, readable way.

## Installation

### Via Composer

```bash
composer require datahihi1/polyfill-pipefn
```

### Manual Installation

1. Download the `pipeFunction.php` file
2. Include it in your project:
   ```php
   require_once 'pipeFunction.php';
   ```

## Usage

The `pipe()` function takes an initial value and chains it through multiple methods or closures.

### Basic Syntax

```php
$result = pipe($value, ...$methods);
```

### Parameters

- `$value` - The initial value to be piped through the methods
- `...$methods` - Variable number of methods, which can be:
  - String method names (for object methods)
  - Arrays in format `['methodName', [arguments]]`
  - Closures/functions

## Examples

### Method Chaining

```php
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
$result = $calculator->add(3)->multiply(2)->getValue(); // 16

// Using pipe function
$result = pipe($calculator, 'add', 'multiply', 'getValue');
// This won't work as expected because add() and multiply() need arguments

// Better approach with arguments
$result = pipe($calculator, 
    ['add', [3]], 
    ['multiply', [2]], 
    'getValue'
); // 16
```

### Array Processing

```php
$numbers = [1, 2, 3, 4, 5];

// Using closures
$result = pipe($numbers,
    function($arr) { return array_filter($arr, function($n) { return $n > 2; }); },
    function($arr) { return array_map(function($n) { return $n * 2; }, $arr); },
    function($arr) { return array_sum($arr); }
); // 24 (sum of [6, 8, 10])

// Using array functions
$result = pipe($numbers,
    function($arr) { return array_filter($arr, 'is_numeric'); },
    function($arr) { return array_reverse($arr); },
    function($arr) { return array_slice($arr, 0, 3); }
); // [5, 4, 3]
```

### String Processing

```php
$text = "  hello world  ";

$result = pipe($text,
    'trim',
    'strtoupper',
    function($str) { return str_replace(' ', '_', $str); }
); // "HELLO_WORLD"
```

### Object Transformation

```php
class User {
    public $name;
    public $email;
    
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
    
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
    
    public function toArray() {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}

$user = new User('John', 'john@example.com');

$result = pipe($user,
    ['setName', ['Jane']],
    ['setEmail', ['jane@example.com']],
    'toArray'
); // ['name' => 'Jane', 'email' => 'jane@example.com']
```

## Method Types

### 1. String Method Names
```php
pipe($object, 'methodName');
```

### 2. Methods with Arguments
```php
pipe($object, ['methodName', [arg1, arg2, ...]]);
```

### 3. Closures/Functions
```php
pipe($value, function($value) {
    // Process $value
    return $processedValue;
});
```

## Requirements

- PHP >= 5.6
- No additional dependencies

## Features

- ✅ PHP 5.6+ compatibility
- ✅ Method chaining with arguments
- ✅ Closure/function support
- ✅ Lightweight (single file)
- ✅ No external dependencies
- ✅ Automatic function existence check

## License

This project is open source and available under the [MIT License](LICENSE).

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
