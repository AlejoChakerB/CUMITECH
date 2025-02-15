<?php namespace Tests\Repositories;

use App\Models\user_employees;
use App\Repositories\user_employeesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class user_employeesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var user_employeesRepository
     */
    protected $userEmployeesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userEmployeesRepo = \App::make(user_employeesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_employees()
    {
        $userEmployees = user_employees::factory()->make()->toArray();

        $createduser_employees = $this->userEmployeesRepo->create($userEmployees);

        $createduser_employees = $createduser_employees->toArray();
        $this->assertArrayHasKey('id', $createduser_employees);
        $this->assertNotNull($createduser_employees['id'], 'Created user_employees must have id specified');
        $this->assertNotNull(user_employees::find($createduser_employees['id']), 'user_employees with given id must be in DB');
        $this->assertModelData($userEmployees, $createduser_employees);
    }

    /**
     * @test read
     */
    public function test_read_user_employees()
    {
        $userEmployees = user_employees::factory()->create();

        $dbuser_employees = $this->userEmployeesRepo->find($userEmployees->id);

        $dbuser_employees = $dbuser_employees->toArray();
        $this->assertModelData($userEmployees->toArray(), $dbuser_employees);
    }

    /**
     * @test update
     */
    public function test_update_user_employees()
    {
        $userEmployees = user_employees::factory()->create();
        $fakeuser_employees = user_employees::factory()->make()->toArray();

        $updateduser_employees = $this->userEmployeesRepo->update($fakeuser_employees, $userEmployees->id);

        $this->assertModelData($fakeuser_employees, $updateduser_employees->toArray());
        $dbuser_employees = $this->userEmployeesRepo->find($userEmployees->id);
        $this->assertModelData($fakeuser_employees, $dbuser_employees->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_employees()
    {
        $userEmployees = user_employees::factory()->create();

        $resp = $this->userEmployeesRepo->delete($userEmployees->id);

        $this->assertTrue($resp);
        $this->assertNull(user_employees::find($userEmployees->id), 'user_employees should not exist in DB');
    }
}
