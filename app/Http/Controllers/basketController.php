<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebasketRequest;
use App\Http\Requests\UpdatebasketRequest;
use App\Repositories\basketRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Flash;
use Response;
use App\Models\articles;
use App\Models\basket;
use App\Models\surgery;

class basketController extends AppBaseController
{
    /** @var basketRepository $basketRepository*/
    private $basketRepository;

    public function __construct(basketRepository $basketRepo)
    {
        $this->basketRepository = $basketRepo;
    }

    /**
     * Display a listing of the basket.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_baskets');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $basketQuery = Basket::query();

        if (!empty($search)) {
            $basketQuery->where('surgical_act', 'LIKE', '%' . $search . '%');
        }

        $basketQuery->select('surgical_act', DB::raw('COUNT(*) as total'), DB::raw('SUM(article_cost) AS unit_cost'))->groupBy('surgical_act');

        $baskets = $basketQuery->paginate($perPage);
        
        return view('baskets.index', compact('baskets'));
    }

    /**
     * Show the form for creating a new basket.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_baskets');
        $articles = Articles::orderby('description')->pluck('description', 'id');
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        return view('baskets.create', compact('articles', 'surgical_acts'));
    }

    /**
     * Store a newly created basket in storage.
     *
     * @param CreatebasketRequest $request
     *
     * @return Response
     */
    public function store(CreatebasketRequest $request)
    {
        $this->authorize('create_baskets');
        $input = $request->all();
        $basket = $this->basketRepository->create($input);

        Flash::success('Basket saved successfully.');

        return redirect(route('baskets.index'));
    }

    /**
     * Display the specified basket.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_baskets');
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            Flash::error('Basket not found');

            return redirect(route('baskets.index'));
        }

        return view('baskets.show')->with('basket', $basket);
    }

    public function showBasket(Request $request, $id)
    {
        $this->authorize('view_baskets');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $basketQuery = Basket::query();
        $basketQuery = Basket::where('surgical_act', $id);

        if (!empty($search)) {
            $basketQuery->where('store', 'LIKE', '%' . $search . '%')
                        ->orWhere('reusable', 'LIKE', '%' . $search . '%')
                        ->orWhere('id_article', 'LIKE', '%' . $search . '%')
                        ->orWhere('surgical_act', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('articles', function ($query) use ($search) {
                            $query->where('description', 'LIKE', '%' . $search . '%');
                        });
        }
        $cost = $basketQuery->sum('article_cost');
        $quanty = $basketQuery->count();
        $baskets = $basketQuery->paginate($perPage);

        return view('baskets.basket_show', compact('baskets', 'cost', 'quanty'));
    }

    /**
     * Show the form for editing the specified basket.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_baskets');
        $basket = $this->basketRepository->find($id);
        $articles = Articles::orderby('description')->pluck('description', 'item_code');
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        if (empty($basket)) {
            Flash::error('Basket not found');

            return redirect(route('baskets.index'));
        }

        return view('baskets.edit', compact('basket','articles', 'surgical_acts'));
    }

    /**
     * Update the specified basket in storage.
     *
     * @param int $id
     * @param UpdatebasketRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebasketRequest $request)
    {
        $this->authorize('update_baskets');
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            Flash::error('Basket not found');

            return redirect(route('baskets.index'));
        }

        $basket = $this->basketRepository->update($request->all(), $id);

        Flash::success('Basket updated successfully.');

        return redirect(route('baskets.index'));
    }

    /**
     * Remove the specified basket from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_baskets');
        $basket = $this->basketRepository->find($id);

        if (empty($basket)) {
            Flash::error('Basket not found');

            return redirect(route('baskets.index'));
        }

        $this->basketRepository->delete($id);

        Flash::success('Basket deleted successfully.');

        return redirect(route('baskets.index'));
    }
}
