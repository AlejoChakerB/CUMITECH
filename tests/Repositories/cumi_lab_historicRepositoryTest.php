<?php namespace Tests\Repositories;

use App\Models\cumi_lab_historic;
use App\Repositories\cumi_lab_historicRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cumi_lab_historicRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cumi_lab_historicRepository
     */
    protected $cumiLabHistoricRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cumiLabHistoricRepo = \App::make(cumi_lab_historicRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->make()->toArray();

        $createdcumi_lab_historic = $this->cumiLabHistoricRepo->create($cumiLabHistoric);

        $createdcumi_lab_historic = $createdcumi_lab_historic->toArray();
        $this->assertArrayHasKey('id', $createdcumi_lab_historic);
        $this->assertNotNull($createdcumi_lab_historic['id'], 'Created cumi_lab_historic must have id specified');
        $this->assertNotNull(cumi_lab_historic::find($createdcumi_lab_historic['id']), 'cumi_lab_historic with given id must be in DB');
        $this->assertModelData($cumiLabHistoric, $createdcumi_lab_historic);
    }

    /**
     * @test read
     */
    public function test_read_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();

        $dbcumi_lab_historic = $this->cumiLabHistoricRepo->find($cumiLabHistoric->id);

        $dbcumi_lab_historic = $dbcumi_lab_historic->toArray();
        $this->assertModelData($cumiLabHistoric->toArray(), $dbcumi_lab_historic);
    }

    /**
     * @test update
     */
    public function test_update_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();
        $fakecumi_lab_historic = cumi_lab_historic::factory()->make()->toArray();

        $updatedcumi_lab_historic = $this->cumiLabHistoricRepo->update($fakecumi_lab_historic, $cumiLabHistoric->id);

        $this->assertModelData($fakecumi_lab_historic, $updatedcumi_lab_historic->toArray());
        $dbcumi_lab_historic = $this->cumiLabHistoricRepo->find($cumiLabHistoric->id);
        $this->assertModelData($fakecumi_lab_historic, $dbcumi_lab_historic->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cumi_lab_historic()
    {
        $cumiLabHistoric = cumi_lab_historic::factory()->create();

        $resp = $this->cumiLabHistoricRepo->delete($cumiLabHistoric->id);

        $this->assertTrue($resp);
        $this->assertNull(cumi_lab_historic::find($cumiLabHistoric->id), 'cumi_lab_historic should not exist in DB');
    }
}
