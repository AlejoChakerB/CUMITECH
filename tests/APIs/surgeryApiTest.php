<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\surgery;

class surgeryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_surgery()
    {
        $surgery = surgery::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/surgeries', $surgery
        );

        $this->assertApiResponse($surgery);
    }

    /**
     * @test
     */
    public function test_read_surgery()
    {
        $surgery = surgery::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/surgeries/'.$surgery->id
        );

        $this->assertApiResponse($surgery->toArray());
    }

    /**
     * @test
     */
    public function test_update_surgery()
    {
        $surgery = surgery::factory()->create();
        $editedsurgery = surgery::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/surgeries/'.$surgery->id,
            $editedsurgery
        );

        $this->assertApiResponse($editedsurgery);
    }

    /**
     * @test
     */
    public function test_delete_surgery()
    {
        $surgery = surgery::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/surgeries/'.$surgery->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/surgeries/'.$surgery->id
        );

        $this->response->assertStatus(404);
    }
}
