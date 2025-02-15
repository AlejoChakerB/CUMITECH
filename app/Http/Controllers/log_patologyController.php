<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createlog_patologyRequest;
use App\Http\Requests\Updatelog_patologyRequest;
use App\Repositories\log_patologyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class log_patologyController extends AppBaseController
{
    /** @var log_patologyRepository $logPatologyRepository*/
    private $logPatologyRepository;

    public function __construct(log_patologyRepository $logPatologyRepo)
    {
        $this->logPatologyRepository = $logPatologyRepo;
    }

    /**
     * Display a listing of the log_patology.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logPatologies = $this->logPatologyRepository->all();

        return view('log_patologies.index')
            ->with('logPatologies', $logPatologies);
    }

    /**
     * Show the form for creating a new log_patology.
     *
     * @return Response
     */
    public function create()
    {
        return view('log_patologies.create');
    }

    /**
     * Store a newly created log_patology in storage.
     *
     * @param Createlog_patologyRequest $request
     *
     * @return Response
     */
    public function store(Createlog_patologyRequest $request)
    {
        $input = $request->all();

        $logPatology = $this->logPatologyRepository->create($input);

        Flash::success('Log Patology saved successfully.');

        return redirect(route('logPatologies.index'));
    }

    /**
     * Display the specified log_patology.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            Flash::error('Log Patology not found');

            return redirect(route('logPatologies.index'));
        }

        return view('log_patologies.show')->with('logPatology', $logPatology);
    }

    /**
     * Show the form for editing the specified log_patology.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            Flash::error('Log Patology not found');

            return redirect(route('logPatologies.index'));
        }

        return view('log_patologies.edit')->with('logPatology', $logPatology);
    }

    /**
     * Update the specified log_patology in storage.
     *
     * @param int $id
     * @param Updatelog_patologyRequest $request
     *
     * @return Response
     */
    public function update($id, Updatelog_patologyRequest $request)
    {
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            Flash::error('Log Patology not found');

            return redirect(route('logPatologies.index'));
        }

        $logPatology = $this->logPatologyRepository->update($request->all(), $id);

        Flash::success('Log Patology updated successfully.');

        return redirect(route('logPatologies.index'));
    }

    /**
     * Remove the specified log_patology from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $logPatology = $this->logPatologyRepository->find($id);

        if (empty($logPatology)) {
            Flash::error('Log Patology not found');

            return redirect(route('logPatologies.index'));
        }

        $this->logPatologyRepository->delete($id);

        Flash::success('Log Patology deleted successfully.');

        return redirect(route('logPatologies.index'));
    }
}
