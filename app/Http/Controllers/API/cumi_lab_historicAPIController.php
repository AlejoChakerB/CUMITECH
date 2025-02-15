<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcumi_lab_historicAPIRequest;
use App\Http\Requests\API\Updatecumi_lab_historicAPIRequest;
use App\Models\cumi_lab_historic;
use App\Repositories\cumi_lab_historicRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cumi_lab_historicController
 * @package App\Http\Controllers\API
 */

class cumi_lab_historicAPIController extends AppBaseController
{
    /** @var  cumi_lab_historicRepository */
    private $cumiLabHistoricRepository;

    public function __construct(cumi_lab_historicRepository $cumiLabHistoricRepo)
    {
        $this->cumiLabHistoricRepository = $cumiLabHistoricRepo;
    }

    /**
     * Display a listing of the cumi_lab_historic.
     * GET|HEAD /cumiLabHistorics
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cumiLabHistorics = $this->cumiLabHistoricRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cumiLabHistorics->toArray(), 'Cumi Lab Historics retrieved successfully');
    }

    /**
     * Store a newly created cumi_lab_historic in storage.
     * POST /cumiLabHistorics
     *
     * @param Createcumi_lab_historicAPIRequest $request
     *
     * @return Response
     */
    public function store(Createcumi_lab_historicAPIRequest $request)
    {
        $input = $request->all();

        $cumiLabHistoric = $this->cumiLabHistoricRepository->create($input);

        return $this->sendResponse($cumiLabHistoric->toArray(), 'Cumi Lab Historic saved successfully');
    }

    /**
     * Display the specified cumi_lab_historic.
     * GET|HEAD /cumiLabHistorics/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cumi_lab_historic $cumiLabHistoric */
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            return $this->sendError('Cumi Lab Historic not found');
        }

        return $this->sendResponse($cumiLabHistoric->toArray(), 'Cumi Lab Historic retrieved successfully');
    }

    /**
     * Update the specified cumi_lab_historic in storage.
     * PUT/PATCH /cumiLabHistorics/{id}
     *
     * @param int $id
     * @param Updatecumi_lab_historicAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecumi_lab_historicAPIRequest $request)
    {
        $input = $request->all();

        /** @var cumi_lab_historic $cumiLabHistoric */
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            return $this->sendError('Cumi Lab Historic not found');
        }

        $cumiLabHistoric = $this->cumiLabHistoricRepository->update($input, $id);

        return $this->sendResponse($cumiLabHistoric->toArray(), 'cumi_lab_historic updated successfully');
    }

    /**
     * Remove the specified cumi_lab_historic from storage.
     * DELETE /cumiLabHistorics/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cumi_lab_historic $cumiLabHistoric */
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            return $this->sendError('Cumi Lab Historic not found');
        }

        $cumiLabHistoric->delete();

        return $this->sendSuccess('Cumi Lab Historic deleted successfully');
    }
}
