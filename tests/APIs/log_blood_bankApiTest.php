<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_blood_bank;

class log_blood_bankApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_blood_banks', $logBloodBank
        );

        $this->assertApiResponse($logBloodBank);
    }

    /**
     * @test
     */
    public function test_read_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_blood_banks/'.$logBloodBank->id
        );

        $this->assertApiResponse($logBloodBank->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();
        $editedlog_blood_bank = log_blood_bank::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_blood_banks/'.$logBloodBank->id,
            $editedlog_blood_bank
        );

        $this->assertApiResponse($editedlog_blood_bank);
    }

    /**
     * @test
     */
    public function test_delete_log_blood_bank()
    {
        $logBloodBank = log_blood_bank::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_blood_banks/'.$logBloodBank->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_blood_banks/'.$logBloodBank->id
        );

        $this->response->assertStatus(404);
    }
}
