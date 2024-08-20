<?php

namespace CoffeeCode\DataLayer\Tests\Models;

use CoffeeCode\DataLayer\DataLayer;

class Company extends DataLayer
{
    public function __construct($database = null)
    {
        parent::__construct('companies', [], 'id', true, $database);
    }

    // public function get_full_name()
    // {
    //     return $this->first_name . ' ' . $this->last_name;
    // }

    // public function teste_method()
    // {
    //     return 'teste_method';
    // }

    // public function testeMethodCamelCase()
    // {
    //     return 'testeMethodCamelCase';
    // }
}
