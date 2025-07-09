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
                $value = $value->$method();
            } elseif (is_array($method)) {
                $methodName = $method[0];
                $args = isset($method[1]) ? $method[1] : [];
                $value = $value->$methodName(...$args);
            } elseif (is_callable($method)) {
                $value = $method($value);
            }
        }
        return $value;
    }
}