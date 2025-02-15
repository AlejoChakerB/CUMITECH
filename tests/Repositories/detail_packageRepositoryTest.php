<?php namespace Tests\Repositories;

use App\Models\detail_package;
use App\Repositories\detail_packageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detail_packageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detail_packageRepository
     */
    protected $detailPackageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detailPackageRepo = \App::make(detail_packageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detail_package()
    {
        $detailPackage = detail_package::factory()->make()->toArray();

        $createddetail_package = $this->detailPackageRepo->create($detailPackage);

        $createddetail_package = $createddetail_package->toArray();
        $this->assertArrayHasKey('id', $createddetail_package);
        $this->assertNotNull($createddetail_package['id'], 'Created detail_package must have id specified');
        $this->assertNotNull(detail_package::find($createddetail_package['id']), 'detail_package with given id must be in DB');
        $this->assertModelData($detailPackage, $createddetail_package);
    }

    /**
     * @test read
     */
    public function test_read_detail_package()
    {
        $detailPackage = detail_package::factory()->create();

        $dbdetail_package = $this->detailPackageRepo->find($detailPackage->id);

        $dbdetail_package = $dbdetail_package->toArray();
        $this->assertModelData($detailPackage->toArray(), $dbdetail_package);
    }

    /**
     * @test update
     */
    public function test_update_detail_package()
    {
        $detailPackage = detail_package::factory()->create();
        $fakedetail_package = detail_package::factory()->make()->toArray();

        $updateddetail_package = $this->detailPackageRepo->update($fakedetail_package, $detailPackage->id);

        $this->assertModelData($fakedetail_package, $updateddetail_package->toArray());
        $dbdetail_package = $this->detailPackageRepo->find($detailPackage->id);
        $this->assertModelData($fakedetail_package, $dbdetail_package->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detail_package()
    {
        $detailPackage = detail_package::factory()->create();

        $resp = $this->detailPackageRepo->delete($detailPackage->id);

        $this->assertTrue($resp);
        $this->assertNull(detail_package::find($detailPackage->id), 'detail_package should not exist in DB');
    }
}
