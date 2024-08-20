<?php declare(strict_types=1);

namespace CoffeeCode\DataLayer\Tests;

use CoffeeCode\DataLayer\Tests\Models\Company;
use CoffeeCode\DataLayer\Tests\Models\User;
use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DataLayer::class)]
#[UsesClass(Connect::class)]
class DataLayerTest extends TestCase
{
    private $database_config = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->database_config = [
            'driver' => 'mysql',
            'host' => 'mariadb',
            'port' => '3306',
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

    public function test_columns()
    {
        $columns = (new User($this->database_config))->columns();
        $this->assertEquals('first_name', $columns[1]->Field);
    }

    public function test_data()
    {
        $user = (new User($this->database_config))->findById(1);
        $data = $user->data();
        $this->assertEquals('Robson', $data->first_name);
    }

    public function test_find_one()
    {
        $params = http_build_query(['name' => 'CoffeeCode']);
        $company = (new Company($this->database_config))->find('name = :name', $params)->fetch();
        $this->assertEquals('CoffeeCode', $company->name);
    }

    public function test_find_all_is_array()
    {
        $model = new Company($this->database_config);
        $users = $model->find()->fetch(true);
        $this->assertIsArray($users);
    }

    public function test_find_all_is_array_of_datalayer()
    {
        $model = new Company($this->database_config);
        $users = $model->find()->fetch(true);
        $this->assertInstanceOf(DataLayer::class, $users[0]);
    }

    public function test_find_all_limit_2()
    {
        $model = new User($this->database_config);
        $users = $model->find()->limit(2)->fetch(true);

        $this->assertEquals('Robson', $users[0]->first_name);
        $this->assertEquals('William', $users[1]->first_name);
    }

    public function test_find_all_limit_2_offset_2()
    {
        $model = new User($this->database_config);
        $users = $model->find()->limit(2)->offset(2)->fetch(true);

        $this->assertEquals('Alex Alan', $users[0]->first_name);
        $this->assertEquals('Elton', $users[1]->first_name);
    }

    public function test_find_all_limit_2_offset_2_order_first_name_asc()
    {
        $model = new User($this->database_config);
        $users = $model->find()->limit(2)->offset(2)->order('first_name ASC')->fetch(true);

        $this->assertEquals('Juliano', $users[0]->first_name);
        $this->assertEquals('Omni', $users[1]->first_name);
    }

    public function test_find_with_in_operator()
    {
        $model = new User($this->database_config);
        $users = $model->find()->in('id', [1, 3, 5, 7])->fetch(true);

        $this->assertEquals('Robson', $users[0]->first_name);
        $this->assertEquals('Alex Alan', $users[1]->first_name);
        $this->assertEquals('Wilder', $users[2]->first_name);
        $this->assertEquals('Juliano', $users[3]->first_name);
    }

    public function test_findbyid()
    {
        $user = (new User($this->database_config))->findById(1);
        $this->assertEquals('Robson', $user->first_name);
    }

    public function test_count()
    {
        $model = new User($this->database_config);
        $this->assertIsInt($model->find()->count());
    }

    public function test_required()
    {
        $newUser = new User($this->database_config);
        $newUser->first_name = 'Usuário';
        $this->assertFalse($newUser->save());
    }

    public function test_save_create()
    {
        $newUser = new User($this->database_config);
        $newUser->first_name = 'Usuário';
        $newUser->last_name = 'Teste';
        $this->assertTrue($newUser->save());
    }

    public function test_destroy()
    {
        $newUser = new User($this->database_config);
        $newUser->first_name = 'Usuário';
        $newUser->last_name = 'Teste';
        $newUser->save();
        $this->assertTrue($newUser->destroy());
    }

    public function test_destroy_empty_id()
    {
        $newUser = new User($this->database_config);
        $this->assertFalse($newUser->destroy());
    }
}
