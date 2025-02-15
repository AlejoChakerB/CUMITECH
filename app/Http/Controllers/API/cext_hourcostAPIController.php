<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createcext_hourcostAPIRequest;
use App\Http\Requests\API\Updatecext_hourcostAPIRequest;
use App\Models\cext_hourcost;
use App\Repositories\cext_hourcostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class cext_hourcostController
 * @package App\Http\Controllers\API
 */

class cext_hourcostAPIController extends AppBaseController
{
    /** @var  cext_hourcostRepository */
    private $cextHourcostRepository;

    public function __construct(cext_hourcostRepository $cextHourcostRepo)
    {
        $this->cextHourcostRepository = $cextHourcostRepo;
    }

    /**
     * Display a listing of the cext_hourcost.
     * GET|HEAD /cextHourcosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $cextHourcosts = $this->cextHourcostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cextHourcosts->toArray(), 'Cext Hourcosts retrieved successfully');
    }

    /**
     * Store a newly created cext_hourcost in storage.
     * POST /cextHourcosts
     *
     * @param Createcext_hourcostAPIRequest $request
     *
     * @return Response
     */
    public function store(Createcext_hourcostAPIRequest $request)
    {
        $input = $request->all();

        $cextHourcost = $this->cextHourcostRepository->create($input);

        return $this->sendResponse($cextHourcost->toArray(), 'Cext Hourcost saved successfully');
    }

    /**
     * Display the specified cext_hourcost.
     * GET|HEAD /cextHourcosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var cext_hourcost $cextHourcost */
        $cextHourcost = $this->cextHourcostRepository->find($id);

        if (empty($cextHourcost)) {
            return $this->sendError('Cext Hourcost not found');
        }

        return $this->sendResponse($cextHourcost->toArray(), 'Cext Hourcost retrieved successfully');
    }

    /**
     * Update the specified cext_hourcost in storage.
     * PUT/PATCH /cextHourcosts/{id}
     *
     * @param int $id
     * @param Updatecext_hourcostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecext_hourcostAPIRequest $request)
    {
        $input = $request->all();

        /** @var cext_hourcost $cextHourcost */
        $cextHourcost = $this->cextHourcostRepository->find($id);

        if (empty($cextHourcost)) {
            return $this->sendError('Cext Hourcost not found');
        }

        $cextHourcost = $this->cextHourcostRepository->update($input, $id);

        return $this->sendResponse($cextHourcost->toArray(), 'cext_hourcost updated successfully');
    }

    /**
     * Remove the specified cext_hourcost from storage.
     * DELETE /cextHourcosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var cext_hourcost $cextHourcost */
        $cextHourcost = $this->cextHourcostRepository->find($id);

        if (empty($cextHourcost)) {
            return $this->sendError('Cext Hourcost not found');
        }

        $cextHourcost->delete();

        return $this->sendSuccess('Cext Hourcost deleted successfully');
    }
}
