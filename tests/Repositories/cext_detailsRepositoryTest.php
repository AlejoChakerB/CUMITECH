<?php namespace Tests\Repositories;

use App\Models\cext_details;
use App\Repositories\cext_detailsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cext_detailsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cext_detailsRepository
     */
    protected $cextDetailsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cextDetailsRepo = \App::make(cext_detailsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cext_details()
    {
        $cextDetails = cext_details::factory()->make()->toArray();

        $createdcext_details = $this->cextDetailsRepo->create($cextDetails);

        $createdcext_details = $createdcext_details->toArray();
        $this->assertArrayHasKey('id', $createdcext_details);
        $this->assertNotNull($createdcext_details['id'], 'Created cext_details must have id specified');
        $this->assertNotNull(cext_details::find($createdcext_details['id']), 'cext_details with given id must be in DB');
        $this->assertModelData($cextDetails, $createdcext_details);
    }

    /**
     * @test read
     */
    public function test_read_cext_details()
    {
        $cextDetails = cext_details::factory()->create();

        $dbcext_details = $this->cextDetailsRepo->find($cextDetails->id);

        $dbcext_details = $dbcext_details->toArray();
        $this->assertModelData($cextDetails->toArray(), $dbcext_details);
    }

    /**
     * @test update
     */
    public function test_update_cext_details()
    {
        $cextDetails = cext_details::factory()->create();
        $fakecext_details = cext_details::factory()->make()->toArray();

        $updatedcext_details = $this->cextDetailsRepo->update($fakecext_details, $cextDetails->id);

        $this->assertModelData($fakecext_details, $updatedcext_details->toArray());
        $dbcext_details = $this->cextDetailsRepo->find($cextDetails->id);
        $this->assertModelData($fakecext_details, $dbcext_details->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cext_details()
    {
        $cextDetails = cext_details::factory()->create();

        $resp = $this->cextDetailsRepo->delete($cextDetails->id);

        $this->assertTrue($resp);
        $this->assertNull(cext_details::find($cextDetails->id), 'cext_details should not exist in DB');
    }
}
