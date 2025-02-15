<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatelabourRequest;
use App\Http\Requests\UpdatelabourRequest;
use App\Repositories\labourRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class labourController extends AppBaseController
{
    /** @var labourRepository $labourRepository*/
    private $labourRepository;

    public function __construct(labourRepository $labourRepo)
    {
        $this->labourRepository = $labourRepo;
    }

    /**
     * Display a listing of the labour.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_labour');
        $labours = $this->labourRepository->all();

        return view('labours.index')
            ->with('labours', $labours);
    }

    /**
     * Show the form for creating a new labour.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_labour');
        return view('labours.create');
    }

    /**
     * Store a newly created labour in storage.
     *
     * @param CreatelabourRequest $request
     *
     * @return Response
     */
    public function store(CreatelabourRequest $request)
    {
        $this->authorize('create_labour');
        $input = $request->all();

        $labour = $this->labourRepository->create($input);

        Flash::success('Labour saved successfully.');

        return redirect(route('labours.index'));
    }

    /**
     * Display the specified labour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view_labour');
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            Flash::error('Labour not found');

            return redirect(route('labours.index'));
        }

        return view('labours.show')->with('labour', $labour);
    }

    /**
     * Show the form for editing the specified labour.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_labour');
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            Flash::error('Labour not found');

            return redirect(route('labours.index'));
        }

        return view('labours.edit')->with('labour', $labour);
    }

    /**
     * Update the specified labour in storage.
     *
     * @param int $id
     * @param UpdatelabourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatelabourRequest $request)
    {
        $this->authorize('update_labour');
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            Flash::error('Labour not found');

            return redirect(route('labours.index'));
        }

        $labour = $this->labourRepository->update($request->all(), $id);

        Flash::success('Labour updated successfully.');

        return redirect(route('labours.index'));
    }

    /**
     * Remove the specified labour from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_labour');
        $labour = $this->labourRepository->find($id);

        if (empty($labour)) {
            Flash::error('Labour not found');

            return redirect(route('labours.index'));
        }

        $this->labourRepository->delete($id);

        Flash::success('Labour deleted successfully.');

        return redirect(route('labours.index'));
    }
}
