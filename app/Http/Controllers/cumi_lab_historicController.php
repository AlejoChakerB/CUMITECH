<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createcumi_lab_historicRequest;
use App\Http\Requests\Updatecumi_lab_historicRequest;
use App\Repositories\cumi_lab_historicRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class cumi_lab_historicController extends AppBaseController
{
    /** @var cumi_lab_historicRepository $cumiLabHistoricRepository*/
    private $cumiLabHistoricRepository;

    public function __construct(cumi_lab_historicRepository $cumiLabHistoricRepo)
    {
        $this->cumiLabHistoricRepository = $cumiLabHistoricRepo;
    }

    /**
     * Display a listing of the cumi_lab_historic.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cumiLabHistorics = $this->cumiLabHistoricRepository->all();

        return view('cumi_lab_historics.index')
            ->with('cumiLabHistorics', $cumiLabHistorics);
    }

    /**
     * Show the form for creating a new cumi_lab_historic.
     *
     * @return Response
     */
    public function create()
    {
        return view('cumi_lab_historics.create');
    }

    /**
     * Store a newly created cumi_lab_historic in storage.
     *
     * @param Createcumi_lab_historicRequest $request
     *
     * @return Response
     */
    public function store(Createcumi_lab_historicRequest $request)
    {
        $input = $request->all();

        $cumiLabHistoric = $this->cumiLabHistoricRepository->create($input);

        Flash::success('Cumi Lab Historic saved successfully.');

        return redirect(route('cumiLabHistorics.index'));
    }

    /**
     * Display the specified cumi_lab_historic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            Flash::error('Cumi Lab Historic not found');

            return redirect(route('cumiLabHistorics.index'));
        }

        return view('cumi_lab_historics.show')->with('cumiLabHistoric', $cumiLabHistoric);
    }

    /**
     * Show the form for editing the specified cumi_lab_historic.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            Flash::error('Cumi Lab Historic not found');

            return redirect(route('cumiLabHistorics.index'));
        }

        return view('cumi_lab_historics.edit')->with('cumiLabHistoric', $cumiLabHistoric);
    }

    /**
     * Update the specified cumi_lab_historic in storage.
     *
     * @param int $id
     * @param Updatecumi_lab_historicRequest $request
     *
     * @return Response
     */
    public function update($id, Updatecumi_lab_historicRequest $request)
    {
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            Flash::error('Cumi Lab Historic not found');

            return redirect(route('cumiLabHistorics.index'));
        }

        $cumiLabHistoric = $this->cumiLabHistoricRepository->update($request->all(), $id);

        Flash::success('Cumi Lab Historic updated successfully.');

        return redirect(route('cumiLabHistorics.index'));
    }

    /**
     * Remove the specified cumi_lab_historic from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cumiLabHistoric = $this->cumiLabHistoricRepository->find($id);

        if (empty($cumiLabHistoric)) {
            Flash::error('Cumi Lab Historic not found');

            return redirect(route('cumiLabHistorics.index'));
        }

        $this->cumiLabHistoricRepository->delete($id);

        Flash::success('Cumi Lab Historic deleted successfully.');

        return redirect(route('cumiLabHistorics.index'));
    }
}
