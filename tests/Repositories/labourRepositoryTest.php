<?php namespace Tests\Repositories;

use App\Models\labour;
use App\Repositories\labourRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class labourRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var labourRepository
     */
    protected $labourRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->labourRepo = \App::make(labourRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_labour()
    {
        $labour = labour::factory()->make()->toArray();

        $createdlabour = $this->labourRepo->create($labour);

        $createdlabour = $createdlabour->toArray();
        $this->assertArrayHasKey('id', $createdlabour);
        $this->assertNotNull($createdlabour['id'], 'Created labour must have id specified');
        $this->assertNotNull(labour::find($createdlabour['id']), 'labour with given id must be in DB');
        $this->assertModelData($labour, $createdlabour);
    }

    /**
     * @test read
     */
    public function test_read_labour()
    {
        $labour = labour::factory()->create();

        $dblabour = $this->labourRepo->find($labour->id);

        $dblabour = $dblabour->toArray();
        $this->assertModelData($labour->toArray(), $dblabour);
    }

    /**
     * @test update
     */
    public function test_update_labour()
    {
        $labour = labour::factory()->create();
        $fakelabour = labour::factory()->make()->toArray();

        $updatedlabour = $this->labourRepo->update($fakelabour, $labour->id);

        $this->assertModelData($fakelabour, $updatedlabour->toArray());
        $dblabour = $this->labourRepo->find($labour->id);
        $this->assertModelData($fakelabour, $dblabour->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_labour()
    {
        $labour = labour::factory()->create();

        $resp = $this->labourRepo->delete($labour->id);

        $this->assertTrue($resp);
        $this->assertNull(labour::find($labour->id), 'labour should not exist in DB');
    }
}
