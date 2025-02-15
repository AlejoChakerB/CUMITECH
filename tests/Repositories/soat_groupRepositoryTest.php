<?php namespace Tests\Repositories;

use App\Models\soat_group;
use App\Repositories\soat_groupRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class soat_groupRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var soat_groupRepository
     */
    protected $soatGroupRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->soatGroupRepo = \App::make(soat_groupRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_soat_group()
    {
        $soatGroup = soat_group::factory()->make()->toArray();

        $createdsoat_group = $this->soatGroupRepo->create($soatGroup);

        $createdsoat_group = $createdsoat_group->toArray();
        $this->assertArrayHasKey('id', $createdsoat_group);
        $this->assertNotNull($createdsoat_group['id'], 'Created soat_group must have id specified');
        $this->assertNotNull(soat_group::find($createdsoat_group['id']), 'soat_group with given id must be in DB');
        $this->assertModelData($soatGroup, $createdsoat_group);
    }

    /**
     * @test read
     */
    public function test_read_soat_group()
    {
        $soatGroup = soat_group::factory()->create();

        $dbsoat_group = $this->soatGroupRepo->find($soatGroup->id);

        $dbsoat_group = $dbsoat_group->toArray();
        $this->assertModelData($soatGroup->toArray(), $dbsoat_group);
    }

    /**
     * @test update
     */
    public function test_update_soat_group()
    {
        $soatGroup = soat_group::factory()->create();
        $fakesoat_group = soat_group::factory()->make()->toArray();

        $updatedsoat_group = $this->soatGroupRepo->update($fakesoat_group, $soatGroup->id);

        $this->assertModelData($fakesoat_group, $updatedsoat_group->toArray());
        $dbsoat_group = $this->soatGroupRepo->find($soatGroup->id);
        $this->assertModelData($fakesoat_group, $dbsoat_group->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_soat_group()
    {
        $soatGroup = soat_group::factory()->create();

        $resp = $this->soatGroupRepo->delete($soatGroup->id);

        $this->assertTrue($resp);
        $this->assertNull(soat_group::find($soatGroup->id), 'soat_group should not exist in DB');
    }
}
