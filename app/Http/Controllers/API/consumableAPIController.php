<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateconsumableAPIRequest;
use App\Http\Requests\API\UpdateconsumableAPIRequest;
use App\Models\consumable;
use App\Repositories\consumableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class consumableController
 * @package App\Http\Controllers\API
 */

class consumableAPIController extends AppBaseController
{
    /** @var  consumableRepository */
    private $consumableRepository;

    public function __construct(consumableRepository $consumableRepo)
    {
        $this->consumableRepository = $consumableRepo;
    }

    /**
     * Display a listing of the consumable.
     * GET|HEAD /consumables
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $consumables = $this->consumableRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($consumables->toArray(), 'Consumables retrieved successfully');
    }

    /**
     * Store a newly created consumable in storage.
     * POST /consumables
     *
     * @param CreateconsumableAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateconsumableAPIRequest $request)
    {
        $input = $request->all();

        $consumable = $this->consumableRepository->create($input);

        return $this->sendResponse($consumable->toArray(), 'Consumable saved successfully');
    }

    /**
     * Display the specified consumable.
     * GET|HEAD /consumables/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var consumable $consumable */
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            return $this->sendError('Consumable not found');
        }

        return $this->sendResponse($consumable->toArray(), 'Consumable retrieved successfully');
    }

    /**
     * Update the specified consumable in storage.
     * PUT/PATCH /consumables/{id}
     *
     * @param int $id
     * @param UpdateconsumableAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconsumableAPIRequest $request)
    {
        $input = $request->all();

        /** @var consumable $consumable */
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            return $this->sendError('Consumable not found');
        }

        $consumable = $this->consumableRepository->update($input, $id);

        return $this->sendResponse($consumable->toArray(), 'consumable updated successfully');
    }

    /**
     * Remove the specified consumable from storage.
     * DELETE /consumables/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var consumable $consumable */
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            return $this->sendError('Consumable not found');
        }

        $consumable->delete();

        return $this->sendSuccess('Consumable deleted successfully');
    }
}
