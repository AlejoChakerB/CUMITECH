<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createaccommodation_costRequest;
use App\Http\Requests\Updateaccommodation_costRequest;
use App\Repositories\accommodation_costRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use App\Models\accommodation_cost;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\accommodation_export\AccommodationExport;

class accommodation_costController extends AppBaseController
{
    /** @var accommodation_costRepository $accommodationCostRepository*/
    private $accommodationCostRepository;

    public function __construct(accommodation_costRepository $accommodationCostRepo)
    {
        $this->accommodationCostRepository = $accommodationCostRepo;
    }

    /**
     * Display a listing of the accommodation_cost.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('view_accommodationCosts');
        return view('accommodation_costs.index');
    }

    /**
     * Show the form for creating a new accommodation_cost.
     *
     * @return Response
     */

     public function service(Request $request){
        $input = $request->all();
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $year = '2024';
        $cost_center = $input['service'];
        $accommodationCostsQuery = accommodation_cost::query()
            ->select('service')
            ->where('year', $year)
            ->where('cost_center', $cost_center)
            ->groupBy('service');
        
        if (!empty($search)) {
            $accommodationCostsQuery->where('service', 'LIKE', '%' . $search . '%');
        }
        $accommodationCosts = $accommodationCostsQuery->paginate($perPage);
        return view('accommodation_costs.show_ccenter', compact('accommodationCosts', 'cost_center'));
     }

    public function create()
    {
        $this->authorize('create_accommodationCosts');
        return view('accommodation_costs.create');
    }

    /**
     * Store a newly created accommodation_cost in storage.
     *
     * @param Createaccommodation_costRequest $request
     *
     * @return Response
     */
    public function store(Createaccommodation_costRequest $request)
    {
        $input = $request->all();
        if ($input['beds'] == 0 || $input['days_produced'] == 0 || $input['bedrooms'] == 0) {
            Flash::error('Habitaciones, camas, días producidos no pueden ser 0');
            return redirect(route('accommodationCosts.index'));
        }
        $input['hours_produced'] = $input['days_produced'] * 24;
        $input['minutes_produced'] = $input['hours_produced'] * 60;
        $input['total_cost'] = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['plant_labour'] + $input['labour'];
        $input['daily_cost'] = $input['total_cost']/$input['days_produced'];
        $input['bedxday_cost'] = $input['daily_cost']/$input['beds'];
        $input['dayAccommodation_cost'] = $input['daily_cost']/$input['bedrooms'];
        $input['hourAccommodation_cost'] = $input['total_cost']/$input['hours_produced'];
        $input['bedxhour_cost'] = $input['hourAccommodation_cost']/$input['beds'];
        $input['bedxminute_cost'] = $input['bedxhour_cost']/60;
        //dd($input);
        $accommodationCost = $this->accommodationCostRepository->create($input);

        session()->flash('success', "¡¡Estancia de " . $input['service'] . " añadida correctamente!!");

        return redirect(route('accommodationCosts.index'));
    }

    /**
     * Display the specified accommodation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_accommodationCosts');
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            Flash::error('Accommodation Cost not found');

            return redirect(route('accommodationCosts.index'));
        }

        return view('accommodation_costs.show')->with('accommodationCost', $accommodationCost);
    }

    public function showCostCenter(Request $request)
    {
        // Establecer valores predeterminados y manejar los parámetros de manera segura
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $year = '2024';
        
        // Obtener el servicio de manera segura, ya sea de la sesión o del request
        $service = $request->session()->get('service');
        
        if ($request->has('service')) {
            $service = $request->input('service');
            // Guardar en sesión para mantener el valor entre páginas
            $request->session()->put('service', $service);
        }
        
        // Verificar si tenemos un servicio válido
        if (empty($service)) {
            return redirect()->back()->with('error', 'No se ha especificado un servicio válido');
        }
        
        // Construir la consulta
        $accommodationCostsQuery = accommodation_cost::query()
            ->where('year', $year)
            ->where('service', $service)
            ->orderBy('year', 'DESC');

        if (!empty($search)) {
            $accommodationCostsQuery->where('service', 'LIKE', '%' . $search . '%');
        }
        
        $accommodationCosts = $accommodationCostsQuery->paginate($perPage);
        
        return view('accommodation_costs.show_services', compact('accommodationCosts', 'service', 'year'));
    }

    /**
     * Show the form for editing the specified accommodation_cost.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_accommodationCosts');
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            Flash::error('Accommodation Cost not found');

            return redirect(route('accommodationCosts.index'));
        }

        return view('accommodation_costs.edit')->with('accommodationCost', $accommodationCost);
    }

    /**
     * Update the specified accommodation_cost in storage.
     *
     * @param int $id
     * @param Updateaccommodation_costRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccommodation_costRequest $request)
    {
        $accommodationCost = $this->accommodationCostRepository->find($id);
        $input = $request->all();
        if (empty($accommodationCost)) {
            Flash::error('Accommodation Cost not found');
            return redirect(route('accommodationCosts.index'));
        }elseif ($input['beds'] == 0 || $input['days_produced'] == 0 || $input['bedrooms'] == 0) {
            Flash::error('Habitaciones, camas, días producidos no pueden ser 0');
            return redirect(route('accommodationCosts.index'));
        }
        $input['hours_produced'] = $input['days_produced'] * 24;
        $input['minutes_produced'] = $input['hours_produced'] * 60;
        $input['total_cost'] = $input['permanent_overhead'] + $input['variable_overhead'] + $input['administrative_twoLevel'] + $input['logistic_twoLevel'] + $input['plant_labour'] + $input['labour'];
        $input['daily_cost'] = $input['total_cost']/$input['days_produced'];
        $input['bedxday_cost'] = $input['daily_cost']/$input['beds'];
        $input['dayAccommodation_cost'] = $input['daily_cost']/$input['bedrooms'];
        $input['hourAccommodation_cost'] = $input['total_cost']/$input['hours_produced'];
        $input['bedxhour_cost'] = $input['hourAccommodation_cost']/$input['beds'];
        $input['bedxminute_cost'] = $input['bedxhour_cost']/60;
        $accommodationCost = $this->accommodationCostRepository->update($input, $id);

        session()->flash('success', "¡¡Estancia de " . $input['service'] . " actualizada correctamente!!");

        return redirect(route('accommodationCosts.index'));
    }

    /**
     * Remove the specified accommodation_cost from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_accommodationCosts');
        $accommodationCost = $this->accommodationCostRepository->find($id);

        if (empty($accommodationCost)) {
            Flash::error('Accommodation Cost not found');

            return redirect(route('accommodationCosts.index'));
        }

        $this->accommodationCostRepository->delete($id);

        session()->flash('success', "¡¡Estancia de " . $accommodationCost->service . " eliminada correctamente!!");

        return redirect(route('accommodationCosts.index'));
    }

    public function searchAccommodationService(Request $request)
    {
        $term = $request->input('term');
        $service = accommodation_cost::where('service', 'like', "%$term%")
        ->select('service')
        ->groupby('service')
        ->orderby('service', 'ASC')
        ->get();
        
        return response()->json($service);
    }

    public function searchAccommodationCostCenter(Request $request)
    {
        $term = $request->input('term');
        $costCenter = accommodation_cost::where('cost_center', 'like', "%$term%")
        ->select('cost_center')
        ->groupby('cost_center')
        ->orderby('cost_center')
        ->get();
        
        return response()->json($costCenter);
    }

    public function exportAccomodation (Request $request){
        $this->authorize('export_accommodationCosts');
        $input = $request->all();
        $fecha = now()->format('Y-m-d H:i:s');
        return Excel::download(new AccommodationExport($input), 'Costos_estancias_' . $input['options'] . '_' . $fecha . '.xlsx');
    }
}
