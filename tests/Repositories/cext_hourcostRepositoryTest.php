<?php namespace Tests\Repositories;

use App\Models\cext_hourcost;
use App\Repositories\cext_hourcostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cext_hourcostRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cext_hourcostRepository
     */
    protected $cextHourcostRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cextHourcostRepo = \App::make(cext_hourcostRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->make()->toArray();

        $createdcext_hourcost = $this->cextHourcostRepo->create($cextHourcost);

        $createdcext_hourcost = $createdcext_hourcost->toArray();
        $this->assertArrayHasKey('id', $createdcext_hourcost);
        $this->assertNotNull($createdcext_hourcost['id'], 'Created cext_hourcost must have id specified');
        $this->assertNotNull(cext_hourcost::find($createdcext_hourcost['id']), 'cext_hourcost with given id must be in DB');
        $this->assertModelData($cextHourcost, $createdcext_hourcost);
    }

    /**
     * @test read
     */
    public function test_read_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();

        $dbcext_hourcost = $this->cextHourcostRepo->find($cextHourcost->id);

        $dbcext_hourcost = $dbcext_hourcost->toArray();
        $this->assertModelData($cextHourcost->toArray(), $dbcext_hourcost);
    }

    /**
     * @test update
     */
    public function test_update_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();
        $fakecext_hourcost = cext_hourcost::factory()->make()->toArray();

        $updatedcext_hourcost = $this->cextHourcostRepo->update($fakecext_hourcost, $cextHourcost->id);

        $this->assertModelData($fakecext_hourcost, $updatedcext_hourcost->toArray());
        $dbcext_hourcost = $this->cextHourcostRepo->find($cextHourcost->id);
        $this->assertModelData($fakecext_hourcost, $dbcext_hourcost->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cext_hourcost()
    {
        $cextHourcost = cext_hourcost::factory()->create();

        $resp = $this->cextHourcostRepo->delete($cextHourcost->id);

        $this->assertTrue($resp);
        $this->assertNull(cext_hourcost::find($cextHourcost->id), 'cext_hourcost should not exist in DB');
    }
}
