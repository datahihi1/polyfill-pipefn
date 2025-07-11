<?php
if (!function_exists('pipe')){
    /**
     * Pipe function to allow method chaining via method names or closures.
     *
     * @param mixed $value The initial value to be piped through the methods.
     * @param mixed ...$methods (string method name, ['method', [args...]], or closure)
     * @return mixed
     */
    function pipe($value, ...$methods)
    {
        foreach ($methods as $method) {
            if (is_string($method)) {
                if (function_exists($method)) {
                    $value = $method($value);
                } elseif (is_object($value) && method_exists($value, $method)) {
                    $value = $value->$method();
                } else {
                    throw new Exception("Method or function '$method' does not exist.");
                }
            } elseif (is_array($method)) {
                $methodName = $method[0];
                $args = isset($method[1]) ? $method[1] : [];
                if (function_exists($methodName)) {
                    $value = $methodName($value, ...$args);
                } elseif (is_object($value) && method_exists($value, $methodName)) {
                    $value = $value->$methodName(...$args);
                } else {
                    throw new Exception("Method or function '$methodName' does not exist.");
                }
            } elseif (is_callable($method)) {
                $value = $method($value);
            }
        }
        return $value;
    }
}