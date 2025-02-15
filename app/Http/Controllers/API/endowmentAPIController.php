<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateendowmentAPIRequest;
use App\Http\Requests\API\UpdateendowmentAPIRequest;
use App\Models\endowment;
use App\Repositories\endowmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class endowmentController
 * @package App\Http\Controllers\API
 */

class endowmentAPIController extends AppBaseController
{
    /** @var  endowmentRepository */
    private $endowmentRepository;

    public function __construct(endowmentRepository $endowmentRepo)
    {
        $this->endowmentRepository = $endowmentRepo;
    }

    /**
     * Display a listing of the endowment.
     * GET|HEAD /endowments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $endowments = $this->endowmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($endowments->toArray(), 'Endowments retrieved successfully');
    }

    /**
     * Store a newly created endowment in storage.
     * POST /endowments
     *
     * @param CreateendowmentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateendowmentAPIRequest $request)
    {
        $input = $request->all();

        $endowment = $this->endowmentRepository->create($input);

        return $this->sendResponse($endowment->toArray(), 'Endowment saved successfully');
    }

    /**
     * Display the specified endowment.
     * GET|HEAD /endowments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var endowment $endowment */
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            return $this->sendError('Endowment not found');
        }

        return $this->sendResponse($endowment->toArray(), 'Endowment retrieved successfully');
    }

    /**
     * Update the specified endowment in storage.
     * PUT/PATCH /endowments/{id}
     *
     * @param int $id
     * @param UpdateendowmentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateendowmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var endowment $endowment */
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            return $this->sendError('Endowment not found');
        }

        $endowment = $this->endowmentRepository->update($input, $id);

        return $this->sendResponse($endowment->toArray(), 'endowment updated successfully');
    }

    /**
     * Remove the specified endowment from storage.
     * DELETE /endowments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var endowment $endowment */
        $endowment = $this->endowmentRepository->find($id);

        if (empty($endowment)) {
            return $this->sendError('Endowment not found');
        }

        $endowment->delete();

        return $this->sendSuccess('Endowment deleted successfully');
    }
}
