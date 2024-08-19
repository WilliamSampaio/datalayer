<?php declare(strict_types=1);

namespace CoffeeCode\DataLayer\Tests;

use CoffeeCode\DataLayer\Connect;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Connect::class)]
class ConnectTest extends TestCase
{
    public function test_getinstance_function_with_data_layer_config_const()
    {
        define('DATA_LAYER_CONFIG', [
            'driver' => 'sqlite',
            'host' => 'localhost',
            'port' => '3306',
            'dbname' => 'datalayer_example',
            'username' => 'root',
            'passwd' => '',
        ]);
    }
}
