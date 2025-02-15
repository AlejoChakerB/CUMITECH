<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createimaging_production_suppliesRequest;
use App\Http\Requests\Updateimaging_production_suppliesRequest;
use App\Repositories\imaging_production_suppliesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\articles;
use App\Models\imaging_production_supplies;


class imaging_production_suppliesController extends AppBaseController
{
    /** @var imaging_production_suppliesRepository $imagingProductionSuppliesRepository*/
    private $imagingProductionSuppliesRepository;

    public function __construct(imaging_production_suppliesRepository $imagingProductionSuppliesRepo)
    {
        $this->imagingProductionSuppliesRepository = $imagingProductionSuppliesRepo;
    }

    /**
     * Display a listing of the imaging_production_supplies.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_imagingProductionSupplies');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $imagingProductionSuppliesQuery = imaging_production_supplies::query();

        if (!empty($search)) {
            $imagingProductionSuppliesQuery->where('service', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('articles', function ($query) use ($search) {
                            $query->where('item_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('description', 'LIKE', '%' . $search . '%');
                        });
        }

        $imagingProductionSupplies = $imagingProductionSuppliesQuery->orderBy('service')->paginate($perPage);

        return view('imaging_production_supplies.index')
            ->with('imagingProductionSupplies', $imagingProductionSupplies);
    }

    /**
     * Show the form for creating a new imaging_production_supplies.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_imagingProductionSupplies');
        $articles = Articles::orderBy('description')->get(['id', 'description', 'item_code'])
        ->mapWithKeys(function ($article) {
            return [$article->item_code => $article->description . ' - ' . $article->item_code];
        });
        return view('imaging_production_supplies.create', compact('articles'));
    }

    /**
     * Store a newly created imaging_production_supplies in storage.
     *
     * @param Createimaging_production_suppliesRequest $request
     *
     * @return Response
     */
    public function store(Createimaging_production_suppliesRequest $request)
    {
        $input = $request->all();
        $article = Articles::where('item_code', $input['id_article'])->first();
        $existingArticle = imaging_production_supplies::where('id_article', $input['id_article'])
        ->where('service', $input['service'])->first();
        if ($existingArticle) {
            session()->flash('error', "¡¡Insumo existente en la base de datos!!");
            return redirect(route('imagingProductionSupplies.index'));
        }elseif ($input['amount_week'] == 0) {
            session()->flash('error', "¡¡La cantidad semanal no puede ser 0!!");
            return redirect(route('imagingProductionSupplies.index'));
        }
        $valueArticle = $article->last_cost;
        if ($valueArticle == 1) {
            $valueArticle = $article->average_cost;
        }
        $input['unit_price'] = $valueArticle/$input['amount_week'];
        $input['id_article'] = $article->id;
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->create($input);

        session()->flash('success', "¡¡Insumo " . $article->description . " para el servicio de " . $input['service'] . " añadido correctamente!!");

        return redirect(route('imagingProductionSupplies.index'));
    }

    /**
     * Display the specified imaging_production_supplies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_imagingProductionSupplies');
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);

        if (empty($imagingProductionSupplies)) {
            Flash::error('Imaging Production Supplies not found');

            return redirect(route('imagingProductionSupplies.index'));
        }

        return view('imaging_production_supplies.show')->with('imagingProductionSupplies', $imagingProductionSupplies);
    }

    /**
     * Show the form for editing the specified imaging_production_supplies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_imagingProductionSupplies');
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);
        $articles = Articles::orderBy('description')->get(['id', 'description', 'item_code'])
        ->mapWithKeys(function ($article) {
            return [$article->id => $article->description . ' - ' . $article->item_code];
        });
        if (empty($imagingProductionSupplies)) {
            Flash::error('Imaging Production Supplies not found');

            return redirect(route('imagingProductionSupplies.index'));
        }

        return view('imaging_production_supplies.edit', compact('imagingProductionSupplies', 'articles'));
    }

    /**
     * Update the specified imaging_production_supplies in storage.
     *
     * @param int $id
     * @param Updateimaging_production_suppliesRequest $request
     *
     * @return Response
     */
    public function update($id, Updateimaging_production_suppliesRequest $request)
    {
        $input = $request->all();
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);
        $article = Articles::where('id', $input['id_article'])->first();
        $existingArticle = imaging_production_supplies::where('id_article', $input['id_article'])
        ->where('service', $input['service'])
        ->where('id', '!=', $imagingProductionSupplies->id)
        ->first();
        if ($existingArticle) {
            session()->flash('error', "¡¡Insumo existente en la base de datos!!");
            return redirect(route('imagingProductionSupplies.index'));
        } elseif (empty($imagingProductionSupplies)) {
            Flash::error('Imaging Production Supplies not found');
            return redirect(route('imagingProductionSupplies.index'));
        }elseif ($input['amount_week'] == 0) {
            session()->flash('error', "¡¡La cantidad semanal no puede ser 0!!");
            return redirect(route('imagingProductionSupplies.index'));
        }
        $valueArticle = $article->last_cost;
        if ($valueArticle == 1) {
            $valueArticle = $article->average_cost;
        }
        $input['unit_price'] = $valueArticle/$input['amount_week'];
        $input['id_article'] = $article->id;
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->update($input, $id);

        session()->flash('success', "¡¡Insumo " . $article->description . " para el servicio de " . $input['service'] . " actualizado correctamente!!");

        return redirect(route('imagingProductionSupplies.index'));
    }

    /**
     * Remove the specified imaging_production_supplies from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_imagingProductionSupplies');
        $imagingProductionSupplies = $this->imagingProductionSuppliesRepository->find($id);
        $article = Articles::where('id', $imagingProductionSupplies->id_article)->first();
        if (empty($imagingProductionSupplies)) {
            Flash::error('Imaging Production Supplies not found');

            return redirect(route('imagingProductionSupplies.index'));
        }

        $this->imagingProductionSuppliesRepository->delete($id);

        session()->flash('success', "¡¡Insumo " . $article->description . " para el servicio de " . $imagingProductionSupplies->service . " eliminado correctamente!!");

        return redirect(route('imagingProductionSupplies.index'));
    }

    public function getSupplies(){
        $this->authorize('create_imagingProductionSupplies');
        $supplies = Imaging_production_supplies::all();
        foreach ($supplies as $supplie) {
            $unit_price = 0;
            $article = Articles::where('id', $supplie->id_article)->first();
            $valueArticle = $article->last_cost;
            if ($valueArticle == 1) {
                $valueArticle = $article->average_cost;
            }
            $unit_price = $valueArticle/$supplie->amount_week;
            if ($supplie->quantity_used > 1) {
                $unit_price = $valueArticle * $supplie->quantity_used;
            }
            if ($supplie->unit_price != $unit_price) {
                $supplie->update([
                    'unit_price' => $unit_price
                ]);
            }
        }
        session()->flash('success', "¡¡Percios de insumos actualizados correctamente!!");
        return redirect(route('imagingProductionSupplies.index'));
    }
}
