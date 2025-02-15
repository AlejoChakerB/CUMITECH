<?php

namespace App\Http\Controllers;

use App\Http\Requests\Creategeneral_costsRequest;
use App\Http\Requests\Updategeneral_costsRequest;
use App\Repositories\general_costsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\General_costs;
use Flash;
use Response;

class general_costsController extends AppBaseController
{
    /** @var general_costsRepository $generalCostsRepository*/
    private $generalCostsRepository;

    public function __construct(general_costsRepository $generalCostsRepo)
    {
        $this->generalCostsRepository = $generalCostsRepo;
    }

    /**
     * Display a listing of the general_costs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_generalCosts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $generalCostsQuery = general_costs::query();

        if (!empty($search)) {
            $generalCostsQuery->where('description', 'LIKE', '%' . $search . '%')
                        ->orWhere('id', 'LIKE', '%' . $search . '%');
        }

        $generalCosts = $generalCostsQuery->paginate($perPage);

        return view('general_costs.index', compact('generalCosts'));
    }

    /**
     * Show the form for creating a new general_costs.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_generalCosts');
        return view('general_costs.create');
    }

    /**
     * Store a newly created general_costs in storage.
     *
     * @param Creategeneral_costsRequest $request
     *
     * @return Response
     */
    public function store(Creategeneral_costsRequest $request)
    {
        $this->authorize('create_generalCosts');
        $input = $request->all();

        $generalCosts = $this->generalCostsRepository->create($input);

        Flash::success('General Costs saved successfully.');

        return redirect(route('generalCosts.index'));
    }

    /**
     * Display the specified general_costs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_generalCosts');
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            Flash::error('General Costs not found');

            return redirect(route('generalCosts.index'));
        }

        return view('general_costs.show')->with('generalCosts', $generalCosts);
    }

    /**
     * Show the form for editing the specified general_costs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_generalCosts');
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            Flash::error('General Costs not found');

            return redirect(route('generalCosts.index'));
        }

        return view('general_costs.edit')->with('generalCosts', $generalCosts);
    }

    /**
     * Update the specified general_costs in storage.
     *
     * @param int $id
     * @param Updategeneral_costsRequest $request
     *
     * @return Response
     */
    public function update($id, Updategeneral_costsRequest $request)
    {
        $this->authorize('update_generalCosts');
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            Flash::error('General Costs not found');

            return redirect(route('generalCosts.index'));
        }

        $generalCosts = $this->generalCostsRepository->update($request->all(), $id);

        Flash::success('General Costs updated successfully.');

        return redirect(route('generalCosts.index'));
    }

    /**
     * Remove the specified general_costs from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_generalCosts');
        $generalCosts = $this->generalCostsRepository->find($id);

        if (empty($generalCosts)) {
            Flash::error('General Costs not found');

            return redirect(route('generalCosts.index'));
        }

        $this->generalCostsRepository->delete($id);

        Flash::success('General Costs deleted successfully.');

        return redirect(route('generalCosts.index'));
    }
}
