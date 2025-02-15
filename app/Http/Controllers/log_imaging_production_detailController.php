<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_imaging_production_detailRequest;
use App\Http\Requests\Updatelog_imaging_production_detailRequest;
use App\Repositories\log_imaging_production_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_imaging_production_detailController extends AppBaseController
{
    /** @var log_imaging_production_detailRepository $logImagingProductionDetailRepository*/
    private $logImagingProductionDetailRepository;

    public function __construct(log_imaging_production_detailRepository $logImagingProductionDetailRepo)
    {
        $this->logImagingProductionDetailRepository = $logImagingProductionDetailRepo;
    }

    /**
     * Display a listing of the log_imaging_production_detail.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logImagingProductionDetails = $this->logImagingProductionDetailRepository->all();

        return view('log_imaging_production_details.index')
            ->with('logImagingProductionDetails', $logImagingProductionDetails);
    }

    /**
     * Show the form for creating a new log_imaging_production_detail.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_imaging_production_details.create');
    }

    /**
     * Store a newly created log_imaging_production_detail in storage.
     *
     * @param Createlog_imaging_production_detailRequest $request
     *
     * @return Response
     */
    public function store(Createlog_imaging_production_detailRequest $request)
    {
        $input = $request->all();

        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->create($input);

        Flash::success('Log Imaging Production Detail saved successfully.');

        return redirect(route('logImagingProductionDetails.index'));
    }

    /**
     * Display the specified log_imaging_production_detail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            Flash::error('Log Imaging Production Detail not found');

            return redirect(route('logImagingProductionDetails.index'));
        }

        return view('log_imaging_production_details.show')->with('logImagingProductionDetail', $logImagingProductionDetail);
    }

    /**
     * Show the form for editing the specified log_imaging_production_detail.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            Flash::error('Log Imaging Production Detail not found');

            return redirect(route('logImagingProductionDetails.index'));
        }

        return view('log_imaging_production_details.edit')->with('logImagingProductionDetail', $logImagingProductionDetail);
    }

    /**
     * Update the specified log_imaging_production_detail in storage.
     *
     * @param int $id
     * @param Updatelog_imaging_production_detailRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_imaging_production_detailRequest $request)
    {
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            Flash::error('Log Imaging Production Detail not found');

            return redirect(route('logImagingProductionDetails.index'));
        }

        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->update($request->all(), $id);

        Flash::success('Log Imaging Production Detail updated successfully.');

        return redirect(route('logImagingProductionDetails.index'));
    }

    /**
     * Remove the specified log_imaging_production_detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logImagingProductionDetail = $this->logImagingProductionDetailRepository->find($id);

        if (empty($logImagingProductionDetail)) {
            Flash::error('Log Imaging Production Detail not found');

            return redirect(route('logImagingProductionDetails.index'));
        }

        $this->logImagingProductionDetailRepository->delete($id);

        Flash::success('Log Imaging Production Detail deleted successfully.');

        return redirect(route('logImagingProductionDetails.index'));
    }
}
