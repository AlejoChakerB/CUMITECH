<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatesurgeryAPIRequest;
use App\Http\Requests\API\UpdatesurgeryAPIRequest;
use App\Models\surgery;
use App\Repositories\surgeryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class surgeryController
 * @package App\Http\Controllers\API
 */

class surgeryAPIController extends AppBaseController
{
    /** @var  surgeryRepository */
    private $surgeryRepository;

    public function __construct(surgeryRepository $surgeryRepo)
    {
        $this->surgeryRepository = $surgeryRepo;
    }

    /**
     * Display a listing of the surgery.
     * GET|HEAD /surgeries
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $surgeries = $this->surgeryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($surgeries->toArray(), 'Surgeries retrieved successfully');
    }

    /**
     * Store a newly created surgery in storage.
     * POST /surgeries
     *
     * @param CreatesurgeryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatesurgeryAPIRequest $request)
    {
        $input = $request->all();

        $surgery = $this->surgeryRepository->create($input);

        return $this->sendResponse($surgery->toArray(), 'Surgery saved successfully');
    }

    /**
     * Display the specified surgery.
     * GET|HEAD /surgeries/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var surgery $surgery */
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            return $this->sendError('Surgery not found');
        }

        return $this->sendResponse($surgery->toArray(), 'Surgery retrieved successfully');
    }

    /**
     * Update the specified surgery in storage.
     * PUT/PATCH /surgeries/{id}
     *
     * @param int $id
     * @param UpdatesurgeryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesurgeryAPIRequest $request)
    {
        $input = $request->all();

        /** @var surgery $surgery */
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            return $this->sendError('Surgery not found');
        }

        $surgery = $this->surgeryRepository->update($input, $id);

        return $this->sendResponse($surgery->toArray(), 'surgery updated successfully');
    }

    /**
     * Remove the specified surgery from storage.
     * DELETE /surgeries/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var surgery $surgery */
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            return $this->sendError('Surgery not found');
        }

        $surgery->delete();

        return $this->sendSuccess('Surgery deleted successfully');
    }
}
