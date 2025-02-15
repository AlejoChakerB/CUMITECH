<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcext_detailsAPIRequest;
use App\Http\Requests\API\Updatecext_detailsAPIRequest;
use App\Models\cext_details;
use App\Repositories\cext_detailsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cext_detailsController
 * @package App\Http\Controllers\API
 */

class cext_detailsAPIController extends AppBaseController
{
    /** @var  cext_detailsRepository */
    private $cextDetailsRepository;

    public function __construct(cext_detailsRepository $cextDetailsRepo)
    {
        $this->cextDetailsRepository = $cextDetailsRepo;
    }

    /**
     * Display a listing of the cext_details.
     * GET|HEAD /cextDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cextDetails = $this->cextDetailsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cextDetails->toArray(), 'Cext Details retrieved successfully');
    }

    /**
     * Store a newly created cext_details in storage.
     * POST /cextDetails
     *
     * @param Createcext_detailsAPIRequest $request
     *
     * @return Response
     */
    public function store(Createcext_detailsAPIRequest $request)
    {
        $input = $request->all();

        $cextDetails = $this->cextDetailsRepository->create($input);

        return $this->sendResponse($cextDetails->toArray(), 'Cext Details saved successfully');
    }

    /**
     * Display the specified cext_details.
     * GET|HEAD /cextDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cext_details $cextDetails */
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            return $this->sendError('Cext Details not found');
        }

        return $this->sendResponse($cextDetails->toArray(), 'Cext Details retrieved successfully');
    }

    /**
     * Update the specified cext_details in storage.
     * PUT/PATCH /cextDetails/{id}
     *
     * @param int $id
     * @param Updatecext_detailsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_detailsAPIRequest $request)
    {
        $input = $request->all();

        /** @var cext_details $cextDetails */
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            return $this->sendError('Cext Details not found');
        }

        $cextDetails = $this->cextDetailsRepository->update($input, $id);

        return $this->sendResponse($cextDetails->toArray(), 'cext_details updated successfully');
    }

    /**
     * Remove the specified cext_details from storage.
     * DELETE /cextDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cext_details $cextDetails */
        $cextDetails = $this->cextDetailsRepository->find($id);

        if (empty($cextDetails)) {
            return $this->sendError('Cext Details not found');
        }

        $cextDetails->delete();

        return $this->sendSuccess('Cext Details deleted successfully');
    }
}
