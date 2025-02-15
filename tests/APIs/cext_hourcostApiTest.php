<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cext_hourcost;

class cext_hourcostApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cext_hourcosts', $cextHourcost
        );

        $this->assertApiResponse($cextHourcost);
    }

    /**
     * @test
     */
    public function test_read_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/cext_hourcosts/'.$cextHourcost->id
        );

        $this->assertApiResponse($cextHourcost->toArray());
    }

    /**
     * @test
     */
    public function test_update_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();
        $editedcext_hourcost = cext_hourcost::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cext_hourcosts/'.$cextHourcost->id,
            $editedcext_hourcost
        );

        $this->assertApiResponse($editedcext_hourcost);
    }

    /**
     * @test
     */
    public function test_delete_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cext_hourcosts/'.$cextHourcost->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cext_hourcosts/'.$cextHourcost->id
        );

        $this->response->assertStatus(404);
    }
}
