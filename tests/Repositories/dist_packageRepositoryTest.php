<?php namespace Tests\Repositories;

use App\Models\dist_package;
use App\Repositories\dist_packageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class dist_packageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var dist_packageRepository
     */
    protected $distPackageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->distPackageRepo = \App::make(dist_packageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_dist_package()
    {
        $distPackage = dist_package::factory()->make()->toArray();

        $createddist_package = $this->distPackageRepo->create($distPackage);

        $createddist_package = $createddist_package->toArray();
        $this->assertArrayHasKey('id', $createddist_package);
        $this->assertNotNull($createddist_package['id'], 'Created dist_package must have id specified');
        $this->assertNotNull(dist_package::find($createddist_package['id']), 'dist_package with given id must be in DB');
        $this->assertModelData($distPackage, $createddist_package);
    }

    /**
     * @test read
     */
    public function test_read_dist_package()
    {
        $distPackage = dist_package::factory()->create();

        $dbdist_package = $this->distPackageRepo->find($distPackage->id);

        $dbdist_package = $dbdist_package->toArray();
        $this->assertModelData($distPackage->toArray(), $dbdist_package);
    }

    /**
     * @test update
     */
    public function test_update_dist_package()
    {
        $distPackage = dist_package::factory()->create();
        $fakedist_package = dist_package::factory()->make()->toArray();

        $updateddist_package = $this->distPackageRepo->update($fakedist_package, $distPackage->id);

        $this->assertModelData($fakedist_package, $updateddist_package->toArray());
        $dbdist_package = $this->distPackageRepo->find($distPackage->id);
        $this->assertModelData($fakedist_package, $dbdist_package->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_dist_package()
    {
        $distPackage = dist_package::factory()->create();

        $resp = $this->distPackageRepo->delete($distPackage->id);

        $this->assertTrue($resp);
        $this->assertNull(dist_package::find($distPackage->id), 'dist_package should not exist in DB');
    }
}
