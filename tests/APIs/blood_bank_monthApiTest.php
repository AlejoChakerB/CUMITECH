<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\blood_bank_month;

class blood_bank_monthApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/blood_bank_months', $bloodBankMonth
        );

        $this->assertApiResponse($bloodBankMonth);
    }

    /**
     * @test
     */
    public function test_read_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/blood_bank_months/'.$bloodBankMonth->id
        );

        $this->assertApiResponse($bloodBankMonth->toArray());
    }

    /**
     * @test
     */
    public function test_update_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();
        $editedblood_bank_month = blood_bank_month::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/blood_bank_months/'.$bloodBankMonth->id,
            $editedblood_bank_month
        );

        $this->assertApiResponse($editedblood_bank_month);
    }

    /**
     * @test
     */
    public function test_delete_blood_bank_month()
    {
        $bloodBankMonth = blood_bank_month::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/blood_bank_months/'.$bloodBankMonth->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/blood_bank_months/'.$bloodBankMonth->id
        );

        $this->response->assertStatus(404);
    }
}
