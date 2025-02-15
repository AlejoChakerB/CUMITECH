<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createstand_assistanceRequest;
use App\Http\Requests\Updatestand_assistanceRequest;
use App\Repositories\stand_assistanceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class stand_assistanceController extends AppBaseController
{
    /** @var stand_assistanceRepository $standAssistanceRepository*/
    private $standAssistanceRepository;

    public function __construct(stand_assistanceRepository $standAssistanceRepo)
    {
        $this->standAssistanceRepository = $standAssistanceRepo;
    }

    /**
     * Display a listing of the stand_assistance.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_standAssistances');
        $standAssistances = $this->standAssistanceRepository->all();

        return view('stand_assistances.index')
            ->with('standAssistances', $standAssistances);
    }

    /**
     * Show the form for creating a new stand_assistance.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_standAssistances');
        return view('stand_assistances.create');
    }

    /**
     * Store a newly created stand_assistance in storage.
     *
     * @param Createstand_assistanceRequest $request
     *
     * @return Response
     */
    public function store(Createstand_assistanceRequest $request)
    {
        $input = $request->all();

        $standAssistance = $this->standAssistanceRepository->create($input);

        Flash::success('Stand Assistance saved successfully.');

        return redirect(route('standAssistances.index'));
    }

    /**
     * Display the specified stand_assistance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_standAssistances');
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            Flash::error('Stand Assistance not found');

            return redirect(route('standAssistances.index'));
        }

        return view('stand_assistances.show')->with('standAssistance', $standAssistance);
    }

    /**
     * Show the form for editing the specified stand_assistance.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_standAssistances');
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            Flash::error('Stand Assistance not found');

            return redirect(route('standAssistances.index'));
        }

        return view('stand_assistances.edit')->with('standAssistance', $standAssistance);
    }

    /**
     * Update the specified stand_assistance in storage.
     *
     * @param int $id
     * @param Updatestand_assistanceRequest $request
     *
     * @return Response
     */
    public function update($id, Updatestand_assistanceRequest $request)
    {
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            Flash::error('Stand Assistance not found');

            return redirect(route('standAssistances.index'));
        }

        $standAssistance = $this->standAssistanceRepository->update($request->all(), $id);

        Flash::success('Stand Assistance updated successfully.');

        return redirect(route('standAssistances.index'));
    }

    /**
     * Remove the specified stand_assistance from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_standAssistances');
        $standAssistance = $this->standAssistanceRepository->find($id);

        if (empty($standAssistance)) {
            Flash::error('Stand Assistance not found');

            return redirect(route('standAssistances.index'));
        }

        $this->standAssistanceRepository->delete($id);

        Flash::success('Stand Assistance deleted successfully.');

        return redirect(route('standAssistances.index'));
    }

    public function qrcode_scan()
    {
        $this->authorize('scan_code');
        return view('stand_assistances.scan_qrcode');
    }

    public function viewer()
    {
        $this->authorize('view_viewer');
        return view('stand_assistances.viewer');
    }
}
