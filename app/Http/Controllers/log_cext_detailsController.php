<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_cext_detailsRequest;
use App\Http\Requests\Updatelog_cext_detailsRequest;
use App\Repositories\log_cext_detailsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_cext_detailsController extends AppBaseController
{
    /** @var log_cext_detailsRepository $logCextDetailsRepository*/
    private $logCextDetailsRepository;

    public function __construct(log_cext_detailsRepository $logCextDetailsRepo)
    {
        $this->logCextDetailsRepository = $logCextDetailsRepo;
    }

    /**
     * Display a listing of the log_cext_details.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logCextDetails = $this->logCextDetailsRepository->all();

        return view('log_cext_details.index')
            ->with('logCextDetails', $logCextDetails);
    }

    /**
     * Show the form for creating a new log_cext_details.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_cext_details.create');
    }

    /**
     * Store a newly created log_cext_details in storage.
     *
     * @param Createlog_cext_detailsRequest $request
     *
     * @return Response
     */
    public function store(Createlog_cext_detailsRequest $request)
    {
        $input = $request->all();

        $logCextDetails = $this->logCextDetailsRepository->create($input);

        Flash::success('Log Cext Details saved successfully.');

        return redirect(route('logCextDetails.index'));
    }

    /**
     * Display the specified log_cext_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            Flash::error('Log Cext Details not found');

            return redirect(route('logCextDetails.index'));
        }

        return view('log_cext_details.show')->with('logCextDetails', $logCextDetails);
    }

    /**
     * Show the form for editing the specified log_cext_details.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            Flash::error('Log Cext Details not found');

            return redirect(route('logCextDetails.index'));
        }

        return view('log_cext_details.edit')->with('logCextDetails', $logCextDetails);
    }

    /**
     * Update the specified log_cext_details in storage.
     *
     * @param int $id
     * @param Updatelog_cext_detailsRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_cext_detailsRequest $request)
    {
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            Flash::error('Log Cext Details not found');

            return redirect(route('logCextDetails.index'));
        }

        $logCextDetails = $this->logCextDetailsRepository->update($request->all(), $id);

        Flash::success('Log Cext Details updated successfully.');

        return redirect(route('logCextDetails.index'));
    }

    /**
     * Remove the specified log_cext_details from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logCextDetails = $this->logCextDetailsRepository->find($id);

        if (empty($logCextDetails)) {
            Flash::error('Log Cext Details not found');

            return redirect(route('logCextDetails.index'));
        }

        $this->logCextDetailsRepository->delete($id);

        Flash::success('Log Cext Details deleted successfully.');

        return redirect(route('logCextDetails.index'));
    }
}
