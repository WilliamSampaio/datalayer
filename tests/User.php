<?php

namespace CoffeeCode\DataLayer\Tests;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct($database = null)
    {
        parent::__construct('users', [], 'id', true, $database);
    }

    public function teste_method()
    {
        return 'teste_method';
    }

    public function testeMethodCamelCase()
    {
        return 'testeMethodCamelCase';
    }
}
