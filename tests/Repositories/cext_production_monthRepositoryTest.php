<?php namespace Tests\Repositories;

use App\Models\cext_production_month;
use App\Repositories\cext_production_monthRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cext_production_monthRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cext_production_monthRepository
     */
    protected $cextProductionMonthRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cextProductionMonthRepo = \App::make(cext_production_monthRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->make()->toArray();

        $createdcext_production_month = $this->cextProductionMonthRepo->create($cextProductionMonth);

        $createdcext_production_month = $createdcext_production_month->toArray();
        $this->assertArrayHasKey('id', $createdcext_production_month);
        $this->assertNotNull($createdcext_production_month['id'], 'Created cext_production_month must have id specified');
        $this->assertNotNull(cext_production_month::find($createdcext_production_month['id']), 'cext_production_month with given id must be in DB');
        $this->assertModelData($cextProductionMonth, $createdcext_production_month);
    }

    /**
     * @test read
     */
    public function test_read_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();

        $dbcext_production_month = $this->cextProductionMonthRepo->find($cextProductionMonth->id);

        $dbcext_production_month = $dbcext_production_month->toArray();
        $this->assertModelData($cextProductionMonth->toArray(), $dbcext_production_month);
    }

    /**
     * @test update
     */
    public function test_update_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();
        $fakecext_production_month = cext_production_month::factory()->make()->toArray();

        $updatedcext_production_month = $this->cextProductionMonthRepo->update($fakecext_production_month, $cextProductionMonth->id);

        $this->assertModelData($fakecext_production_month, $updatedcext_production_month->toArray());
        $dbcext_production_month = $this->cextProductionMonthRepo->find($cextProductionMonth->id);
        $this->assertModelData($fakecext_production_month, $dbcext_production_month->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cext_production_month()
    {
        $cextProductionMonth = cext_production_month::factory()->create();

        $resp = $this->cextProductionMonthRepo->delete($cextProductionMonth->id);

        $this->assertTrue($resp);
        $this->assertNull(cext_production_month::find($cextProductionMonth->id), 'cext_production_month should not exist in DB');
    }
}
