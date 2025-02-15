<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateconsumableRequest;
use App\Http\Requests\UpdateconsumableRequest;
use App\Repositories\consumableRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Consumable;
use App\Models\Articles;
use Flash;
use Response;

class consumableController extends AppBaseController
{
    /** @var consumableRepository $consumableRepository*/
    private $consumableRepository;

    public function __construct(consumableRepository $consumableRepo)
    {
        $this->consumableRepository = $consumableRepo;
    }

    /**
     * Display a listing of the consumable.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_consumables');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $consumablesQuery = Consumable::query();

        if (!empty($search)) {
            $consumablesQuery->where('consumable_quantity', 'LIKE', '%' . $search . '%')
                    ->orWhere('level', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('articles', function ($query) use ($search) {
                        $query->where('item_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%');
                    });
        }

        $consumables = $consumablesQuery->paginate($perPage);

        return view('consumables.index', compact('consumables'));
    }

    /**
     * Show the form for creating a new consumable.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_consumables');
        $articles = Articles::orderBy('description')->get(['id', 'description', 'item_code'])
        ->mapWithKeys(function ($article) {
            return [$article->item_code => $article->description . ' - ' . $article->item_code];
        });
        return view('consumables.create', compact('articles'));
    }

    /**
     * Store a newly created consumable in storage.
     *
     * @param CreateconsumableRequest $request
     *
     * @return Response
     */
    public function store(CreateconsumableRequest $request)
    {
        $this->authorize('create_consumables');
        $input = $request->all();
        $article = Articles::where('item_code', $input['id_article'])->value('last_cost');
        $input['unit_price'] = $article/$input['package_quantity'];
        $consumable = $this->consumableRepository->create($input);

        Flash::success('Consumable saved successfully.');

        return redirect(route('consumables.index'));
    }

    /**
     * Display the specified consumable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_consumables');
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            Flash::error('Consumable not found');

            return redirect(route('consumables.index'));
        }

        return view('consumables.show')->with('consumable', $consumable);
    }

    /**
     * Show the form for editing the specified consumable.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_consumables');
        $consumable = $this->consumableRepository->find($id);
        $articles = Articles::orderBy('description')->get(['id', 'description', 'item_code'])
        ->mapWithKeys(function ($article) {
            return [$article->item_code => $article->description . ' - ' . $article->item_code];
        });
        if (empty($consumable)) {
            Flash::error('Consumable not found');

            return redirect(route('consumables.index'));
        }

        return view('consumables.edit', compact('consumable','articles'));
    }

    /**
     * Update the specified consumable in storage.
     *
     * @param int $id
     * @param UpdateconsumableRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconsumableRequest $request)
    {
        $this->authorize('update_consumables');
        $input = $request->all();
        $article = Articles::where('item_code', $input['id_article'])->value('last_cost');
        $input['unit_price'] = $article/$input['package_quantity'];
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            Flash::error('Consumable not found');

            return redirect(route('consumables.index'));
        }

        $consumable = $this->consumableRepository->update($input, $id);

        Flash::success('Consumable updated successfully.');

        return redirect(route('consumables.index'));
    }

    /**
     * Remove the specified consumable from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_consumables');
        $consumable = $this->consumableRepository->find($id);

        if (empty($consumable)) {
            Flash::error('Consumable not found');

            return redirect(route('consumables.index'));
        }

        $this->consumableRepository->delete($id);

        Flash::success('Consumable deleted successfully.');

        return redirect(route('consumables.index'));
    }
}
