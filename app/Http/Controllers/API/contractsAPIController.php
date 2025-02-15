<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecontractsAPIRequest;
use App\Http\Requests\API\UpdatecontractsAPIRequest;
use App\Models\contracts;
use App\Repositories\contractsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class contractsController
 * @package App\Http\Controllers\API
 */

class contractsAPIController extends AppBaseController
{
    /** @var  contractsRepository */
    private $contractsRepository;

    public function __construct(contractsRepository $contractsRepo)
    {
        $this->contractsRepository = $contractsRepo;
    }

    /**
     * Display a listing of the contracts.
     * GET|HEAD /contracts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $contracts = $this->contractsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($contracts->toArray(), 'Contracts retrieved successfully');
    }

    /**
     * Store a newly created contracts in storage.
     * POST /contracts
     *
     * @param CreatecontractsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecontractsAPIRequest $request)
    {
        $input = $request->all();

        $contracts = $this->contractsRepository->create($input);

        return $this->sendResponse($contracts->toArray(), 'Contracts saved successfully');
    }

    /**
     * Display the specified contracts.
     * GET|HEAD /contracts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var contracts $contracts */
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            return $this->sendError('Contracts not found');
        }

        return $this->sendResponse($contracts->toArray(), 'Contracts retrieved successfully');
    }

    /**
     * Update the specified contracts in storage.
     * PUT/PATCH /contracts/{id}
     *
     * @param int $id
     * @param UpdatecontractsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontractsAPIRequest $request)
    {
        $input = $request->all();

        /** @var contracts $contracts */
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            return $this->sendError('Contracts not found');
        }

        $contracts = $this->contractsRepository->update($input, $id);

        return $this->sendResponse($contracts->toArray(), 'contracts updated successfully');
    }

    /**
     * Remove the specified contracts from storage.
     * DELETE /contracts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var contracts $contracts */
        $contracts = $this->contractsRepository->find($id);

        if (empty($contracts)) {
            return $this->sendError('Contracts not found');
        }

        $contracts->delete();

        return $this->sendSuccess('Contracts deleted successfully');
    }
}
