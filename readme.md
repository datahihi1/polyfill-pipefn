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

You can see a real-world example in the files in the `demo` folder to better understand how to use the `pipe` function.

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
