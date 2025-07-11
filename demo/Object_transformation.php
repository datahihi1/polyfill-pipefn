<?php
require_once __DIR__ . '/../pipeFunction.php';

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
(array)$result = pipe($user,
    ['setName', ['Jane']],
    ['setEmail', ['jane@example.com']],
    'toArray'
);

print_r($result); // Output: Array ( [name] => Jane [email] => jane@example.com )