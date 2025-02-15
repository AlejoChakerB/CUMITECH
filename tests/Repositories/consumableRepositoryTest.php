<?php namespace Tests\Repositories;

use App\Models\consumable;
use App\Repositories\consumableRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class consumableRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var consumableRepository
     */
    protected $consumableRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->consumableRepo = \App::make(consumableRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_consumable()
    {
        $consumable = consumable::factory()->make()->toArray();

        $createdconsumable = $this->consumableRepo->create($consumable);

        $createdconsumable = $createdconsumable->toArray();
        $this->assertArrayHasKey('id', $createdconsumable);
        $this->assertNotNull($createdconsumable['id'], 'Created consumable must have id specified');
        $this->assertNotNull(consumable::find($createdconsumable['id']), 'consumable with given id must be in DB');
        $this->assertModelData($consumable, $createdconsumable);
    }

    /**
     * @test read
     */
    public function test_read_consumable()
    {
        $consumable = consumable::factory()->create();

        $dbconsumable = $this->consumableRepo->find($consumable->id);

        $dbconsumable = $dbconsumable->toArray();
        $this->assertModelData($consumable->toArray(), $dbconsumable);
    }

    /**
     * @test update
     */
    public function test_update_consumable()
    {
        $consumable = consumable::factory()->create();
        $fakeconsumable = consumable::factory()->make()->toArray();

        $updatedconsumable = $this->consumableRepo->update($fakeconsumable, $consumable->id);

        $this->assertModelData($fakeconsumable, $updatedconsumable->toArray());
        $dbconsumable = $this->consumableRepo->find($consumable->id);
        $this->assertModelData($fakeconsumable, $dbconsumable->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_consumable()
    {
        $consumable = consumable::factory()->create();

        $resp = $this->consumableRepo->delete($consumable->id);

        $this->assertTrue($resp);
        $this->assertNull(consumable::find($consumable->id), 'consumable should not exist in DB');
    }
}
