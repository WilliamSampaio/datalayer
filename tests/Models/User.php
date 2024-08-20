<?php

namespace CoffeeCode\DataLayer\Tests\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct($database = null)
    {
        parent::__construct('users', ['first_name', 'last_name'], 'id', true, $database);
    }
}
