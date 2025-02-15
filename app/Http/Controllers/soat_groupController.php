<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createsoat_groupRequest;
use App\Http\Requests\Updatesoat_groupRequest;
use App\Repositories\soat_groupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class soat_groupController extends AppBaseController
{
    /** @var soat_groupRepository $soatGroupRepository*/
    private $soatGroupRepository;

    public function __construct(soat_groupRepository $soatGroupRepo)
    {
        $this->soatGroupRepository = $soatGroupRepo;
    }

    /**
     * Display a listing of the soat_group.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_soat');
        $soatGroups = $this->soatGroupRepository->all();

        return view('soat_groups.index')
            ->with('soatGroups', $soatGroups);
    }

    /**
     * Show the form for creating a new soat_group.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_soat');
        return view('soat_groups.create');
    }

    /**
     * Store a newly created soat_group in storage.
     *
     * @param Createsoat_groupRequest $request
     *
     * @return Response
     */
    public function store(Createsoat_groupRequest $request)
    {
        $this->authorize('create_soat');
        $input = $request->all();
        $input['total'] = $input['surgeon'] + $input['anesthed'] + $input['assistant'] + $input['room'] + $input['materials'];
        $soatGroup = $this->soatGroupRepository->create($input);

        Flash::success('Soat Group saved successfully.');

        return redirect(route('soatGroups.index'));
    }

    /**
     * Display the specified soat_group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view_soat');
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            Flash::error('Soat Group not found');

            return redirect(route('soatGroups.index'));
        }

        return view('soat_groups.show')->with('soatGroup', $soatGroup);
    }

    /**
     * Show the form for editing the specified soat_group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_soat');
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            Flash::error('Soat Group not found');

            return redirect(route('soatGroups.index'));
        }

        return view('soat_groups.edit')->with('soatGroup', $soatGroup);
    }

    /**
     * Update the specified soat_group in storage.
     *
     * @param int $id
     * @param Updatesoat_groupRequest $request
     *
     * @return Response
     */
    public function update($id, Updatesoat_groupRequest $request)
    {
        $this->authorize('update_soat');
        $soatGroup = $this->soatGroupRepository->find($id);
        $input = $request->all();
        if (empty($soatGroup)) {
            Flash::error('Soat Group not found');

            return redirect(route('soatGroups.index'));
        }
        $input['total'] = $input['surgeon'] + $input['anesthed'] + $input['assistant'] + $input['room'] + $input['materials'];
        $soatGroup = $this->soatGroupRepository->update($input, $id);

        Flash::success('Soat Group updated successfully.');

        return redirect(route('soatGroups.index'));
    }

    /**
     * Remove the specified soat_group from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_soat');
        $soatGroup = $this->soatGroupRepository->find($id);

        if (empty($soatGroup)) {
            Flash::error('Soat Group not found');

            return redirect(route('soatGroups.index'));
        }

        $this->soatGroupRepository->delete($id);

        Flash::success('Soat Group deleted successfully.');

        return redirect(route('soatGroups.index'));
    }
}
