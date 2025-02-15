<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\user_employees;

class user_employeesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_employees()
    {
        $userEmployees = user_employees::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_employees', $userEmployees
        );

        $this->assertApiResponse($userEmployees);
    }

    /**
     * @test
     */
    public function test_read_user_employees()
    {
        $userEmployees = user_employees::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/user_employees/'.$userEmployees->id
        );

        $this->assertApiResponse($userEmployees->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_employees()
    {
        $userEmployees = user_employees::factory()->create();
        $editeduser_employees = user_employees::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_employees/'.$userEmployees->id,
            $editeduser_employees
        );

        $this->assertApiResponse($editeduser_employees);
    }

    /**
     * @test
     */
    public function test_delete_user_employees()
    {
        $userEmployees = user_employees::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_employees/'.$userEmployees->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_employees/'.$userEmployees->id
        );

        $this->response->assertStatus(404);
    }
}
