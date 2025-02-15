<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cext_details;

class cext_detailsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cext_details()
    {
        $cextDetails = cext_details::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cext_details', $cextDetails
        );

        $this->assertApiResponse($cextDetails);
    }

    /**
     * @test
     */
    public function test_read_cext_details()
    {
        $cextDetails = cext_details::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cext_details/'.$cextDetails->id
        );

        $this->assertApiResponse($cextDetails->toArray());
    }

    /**
     * @test
     */
    public function test_update_cext_details()
    {
        $cextDetails = cext_details::factory()->create();
        $editedcext_details = cext_details::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cext_details/'.$cextDetails->id,
            $editedcext_details
        );

        $this->assertApiResponse($editedcext_details);
    }

    /**
     * @test
     */
    public function test_delete_cext_details()
    {
        $cextDetails = cext_details::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cext_details/'.$cextDetails->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cext_details/'.$cextDetails->id
        );

        $this->response->assertStatus(404);
    }
}
