<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\log_patology;

class log_patologyApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_log_patology()
    {
        $logPatology = log_patology::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/log_patologies', $logPatology
        );

        $this->assertApiResponse($logPatology);
    }

    /**
     * @test
     */
    public function test_read_log_patology()
    {
        $logPatology = log_patology::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/log_patologies/'.$logPatology->id
        );

        $this->assertApiResponse($logPatology->toArray());
    }

    /**
     * @test
     */
    public function test_update_log_patology()
    {
        $logPatology = log_patology::factory()->create();
        $editedlog_patology = log_patology::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/log_patologies/'.$logPatology->id,
            $editedlog_patology
        );

        $this->assertApiResponse($editedlog_patology);
    }

    /**
     * @test
     */
    public function test_delete_log_patology()
    {
        $logPatology = log_patology::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/log_patologies/'.$logPatology->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/log_patologies/'.$logPatology->id
        );

        $this->response->assertStatus(404);
    }
}
