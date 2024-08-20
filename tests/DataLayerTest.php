<?php declare(strict_types=1);

namespace CoffeeCode\DataLayer\Tests;

use CoffeeCode\DataLayer\Tests\User;
use CoffeeCode\DataLayer\DataLayer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use PDOException;

#[CoversClass(DataLayer::class)]
class DataLayerTest extends TestCase
{
    private $database_config = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->database_config = [
            'driver' => 'sqlsrv',
            'host' => 'localhost',
            'port' => '9999',
            'dbname' => 'datalayer',
            'username' => 'datalayer',
            'passwd' => 'datalayer',
            'options' => []
        ];
    }

    public function test_datalayer_constructor()
    {
        $model = new User($this->database_config);

        $this->assertInstanceOf(DataLayer::class, $model);
    }

    public function test_datalayer_set()
    {
        $model = new User($this->database_config);
        $model->teste = 'teste';

        $this->assertEquals('teste', $model->teste);
    }

    public function test_datalayer_isset()
    {
        $model = new User($this->database_config);
        $model->teste = 'teste';

        $this->assertTrue(isset($model->teste));
    }

    public function test_datalayer_get_method()
    {
        $model = new User($this->database_config);

        $this->assertEquals('teste_method', $model->teste_method());
    }

    public function test_datalayer_get_method_camel_case()
    {
        $model = new User($this->database_config);

        $this->assertEquals('testeMethodCamelCase', $model->testeMethodCamelCase());
    }
}
