<?php namespace Tests\Repositories;

use App\Models\detail_packages_temp;
use App\Repositories\detail_packages_tempRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class detail_packages_tempRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var detail_packages_tempRepository
     */
    protected $detailPackagesTempRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->detailPackagesTempRepo = \App::make(detail_packages_tempRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->make()->toArray();

        $createddetail_packages_temp = $this->detailPackagesTempRepo->create($detailPackagesTemp);

        $createddetail_packages_temp = $createddetail_packages_temp->toArray();
        $this->assertArrayHasKey('id', $createddetail_packages_temp);
        $this->assertNotNull($createddetail_packages_temp['id'], 'Created detail_packages_temp must have id specified');
        $this->assertNotNull(detail_packages_temp::find($createddetail_packages_temp['id']), 'detail_packages_temp with given id must be in DB');
        $this->assertModelData($detailPackagesTemp, $createddetail_packages_temp);
    }

    /**
     * @test read
     */
    public function test_read_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();

        $dbdetail_packages_temp = $this->detailPackagesTempRepo->find($detailPackagesTemp->id);

        $dbdetail_packages_temp = $dbdetail_packages_temp->toArray();
        $this->assertModelData($detailPackagesTemp->toArray(), $dbdetail_packages_temp);
    }

    /**
     * @test update
     */
    public function test_update_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();
        $fakedetail_packages_temp = detail_packages_temp::factory()->make()->toArray();

        $updateddetail_packages_temp = $this->detailPackagesTempRepo->update($fakedetail_packages_temp, $detailPackagesTemp->id);

        $this->assertModelData($fakedetail_packages_temp, $updateddetail_packages_temp->toArray());
        $dbdetail_packages_temp = $this->detailPackagesTempRepo->find($detailPackagesTemp->id);
        $this->assertModelData($fakedetail_packages_temp, $dbdetail_packages_temp->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_detail_packages_temp()
    {
        $detailPackagesTemp = detail_packages_temp::factory()->create();

        $resp = $this->detailPackagesTempRepo->delete($detailPackagesTemp->id);

        $this->assertTrue($resp);
        $this->assertNull(detail_packages_temp::find($detailPackagesTemp->id), 'detail_packages_temp should not exist in DB');
    }
}
