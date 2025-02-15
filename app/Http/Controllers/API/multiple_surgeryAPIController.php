<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createmultiple_surgeryAPIRequest;
use App\Http\Requests\API\Updatemultiple_surgeryAPIRequest;
use App\Models\multiple_surgery;
use App\Repositories\multiple_surgeryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class multiple_surgeryController
 * @package App\Http\Controllers\API
 */

class multiple_surgeryAPIController extends AppBaseController
{
    /** @var  multiple_surgeryRepository */
    private $multipleSurgeryRepository;

    public function __construct(multiple_surgeryRepository $multipleSurgeryRepo)
    {
        $this->multipleSurgeryRepository = $multipleSurgeryRepo;
    }

    /**
     * Display a listing of the multiple_surgery.
     * GET|HEAD /multipleSurgeries
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $multipleSurgeries = $this->multipleSurgeryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($multipleSurgeries->toArray(), 'Multiple Surgeries retrieved successfully');
    }

    /**
     * Store a newly created multiple_surgery in storage.
     * POST /multipleSurgeries
     *
     * @param Createmultiple_surgeryAPIRequest $request
     *
     * @return Response
     */
    public function store(Createmultiple_surgeryAPIRequest $request)
    {
        $input = $request->all();

        $multipleSurgery = $this->multipleSurgeryRepository->create($input);

        return $this->sendResponse($multipleSurgery->toArray(), 'Multiple Surgery saved successfully');
    }

    /**
     * Display the specified multiple_surgery.
     * GET|HEAD /multipleSurgeries/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var multiple_surgery $multipleSurgery */
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            return $this->sendError('Multiple Surgery not found');
        }

        return $this->sendResponse($multipleSurgery->toArray(), 'Multiple Surgery retrieved successfully');
    }

    /**
     * Update the specified multiple_surgery in storage.
     * PUT/PATCH /multipleSurgeries/{id}
     *
     * @param int $id
     * @param Updatemultiple_surgeryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemultiple_surgeryAPIRequest $request)
    {
        $input = $request->all();

        /** @var multiple_surgery $multipleSurgery */
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            return $this->sendError('Multiple Surgery not found');
        }

        $multipleSurgery = $this->multipleSurgeryRepository->update($input, $id);

        return $this->sendResponse($multipleSurgery->toArray(), 'multiple_surgery updated successfully');
    }

    /**
     * Remove the specified multiple_surgery from storage.
     * DELETE /multipleSurgeries/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var multiple_surgery $multipleSurgery */
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            return $this->sendError('Multiple Surgery not found');
        }

        $multipleSurgery->delete();

        return $this->sendSuccess('Multiple Surgery deleted successfully');
    }
}
