<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createunit_costsRequest;
use App\Http\Requests\Updateunit_costsRequest;
use App\Repositories\unit_costsRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\EncryptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Flash;
use Response;
use Carbon\Carbon;

use App\Exports\Procedure_export\ProcedureExport;

use App\Models\consumable;
use App\Models\surgery;
use App\Models\general_costs;
use App\Models\labour;
use App\Models\articles;
use App\Models\basket;
use App\Models\Diferential_rates;
use App\Models\Medical_fees;
use App\Models\Procedures;
use App\Models\procedures_homologator;
use App\Models\Doctors;
use App\Models\unit_costs;
use App\Models\Soat_group;
use App\Models\msurgery_procedure;
use App\Models\log_operation_cost;
use App\Models\rented_equipment;
use App\Models\accommodation_cost;
use App\Models\dist_package;
use App\Models\imaging_production_details;
use App\Models\cumiLab_rate;
use App\Models\detail_package;
use App\Models\detail_packages_temp;
use App\Models\SismaSalud\sis_deta;
use App\Models\SismaSalud\paquete_maes;
use App\Models\pq_cumi\cargos;
use App\Models\pq_cumi\maes_fra;




class unit_costsController extends AppBaseController
{
    /** @var unit_costsRepository $unitCostsRepository*/
    private $unitCostsRepository;

    public function __construct(unit_costsRepository $unitCostsRepo)
    {
        $this->unitCostsRepository = $unitCostsRepo;
    }

    /**
     * Display a listing of the unit_costs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_unitCosts');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $unitCostsQuery = unit_costs::query();

        if (!empty($search)) {
            $unitCostsQuery->where('cod_surgical_act', 'LIKE', '%' . $search . '%');
        }

        $unitCosts = $unitCostsQuery->orderBy('id', 'DESC')->paginate($perPage);

        return view('unit_costs.index', compact('unitCosts'));
    }

    /**
     * Show the form for creating a new unit_costs.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_unitCosts');
        $consumables = Consumable::orderby('id')->pluck('id');
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act');
        return view('unit_costs.create', compact('consumables', 'surgical_acts'));
    }

    /**
     * Store a newly created unit_costs in storage.
     *
     * @param Createunit_costsRequest $request
     *
     * @return Response
     */
    public function store(Createunit_costsRequest $request)
    {
        $this->authorize('create_unitCosts');
        $input = $request->all();

        $total = $input['room_cost'] + $input['gas'] +  $input['basket'] +  $input['medical_fees'] + $input['medical_fees2'] + $input['anest_fees'] + $input['consumables'] + $input['rented'];
        $input['total_value'] = $total;
        $input['mode'] = 'manual';

        $unitCosts = $this->unitCostsRepository->create($input);

        session()->flash('success', "¡¡Costo unitario registrado con éxito!!");

        return redirect(route('unitCosts.index'));
    }

    /**
     * Display the specified unit_costs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_unitCosts');
        $unitCosts = $this->unitCostsRepository->find($id);

        if (empty($unitCosts)) {
            Flash::error('Unit Costs not found');

            return redirect(route('unitCosts.index'));
        }

        return view('unit_costs.show')->with('unitCosts', $unitCosts);
    }

    /**
     * Show the form for editing the specified unit_costs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_unitCosts');
        $unitCosts = $this->unitCostsRepository->find($id);
        $surgical_acts = Surgery::orderby('cod_surgical_act')->pluck('cod_surgical_act', 'cod_surgical_act');
        if (empty($unitCosts)) {
            Flash::error('Unit Costs not found');

            return redirect(route('unitCosts.index'));
        }
        
        return view('unit_costs.edit')
        ->with('unitCosts', $unitCosts)
        ->with('surgical_acts', $surgical_acts);
    }

    /**
     * Update the specified unit_costs in storage.
     *
     * @param int $id
     * @param Updateunit_costsRequest $request
     *
     * @return Response
     */
    public function update($id, Updateunit_costsRequest $request)
    {
        $this->authorize('update_unitCosts');
        $unitCosts = $this->unitCostsRepository->find($id);
        //dd($unitCosts);
        if (empty($unitCosts)) {
            Flash::error('Unit Costs not found');

            return redirect(route('unitCosts.index'));
        }
        $input = $request->all();
        $total = $input['room_cost'] + $input['gas'] +  $input['basket'] +  $input['medical_fees'] + $input['medical_fees2'] + $input['anest_fees'] + $input['consumables'] + $input['rented'];
        $input['total_value'] = $total;
        $input['mode'] = 'manual';
        //dd($unitCosts);
        $unitCosts = $this->unitCostsRepository->update($input, $id);

        return redirect(route('unitCosts.index'));
    }

    /**
     * Remove the specified unit_costs from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_unitCosts');
        $unitCosts = $this->unitCostsRepository->find($id);

        if (empty($unitCosts)) {
            Flash::error('Unit Costs not found');

            return redirect(route('unitCosts.index'));
        }

        $this->unitCostsRepository->delete($id);

        session()->flash('success', "¡¡Costo unitario eliminado con éxito!!");

        /* return redirect(route('unitCosts.index')); */
    }

    public function calculate($id) {
        $this->authorize('calculate_cost');
        //Surgery time
        $surgery = Surgery::find($id);
        $this->oneProcedure($surgery);

        session()->flash('success', "¡¡Costo unitario registrado con éxito!!");
        return redirect(route('unitCosts.index'));
    }
    
    public function costSurgeries(Request $request){
        ini_set('max_execution_time', 0);
        $this->authorize('calculate_cost');
        $surgeries = Surgery::where('date_surgery', '>=', $request->start_date)
        ->where('date_surgery', '<=', $request->end_date)->get();
        
        foreach ($surgeries as $surgery) {
            $this->oneProcedure($surgery);
        }
        session()->flash('success', "¡¡Costos unitarios registrado con éxito!!");
        ini_restore('max_execution_time');
        /* return redirect(route('unitCosts.index')); */
    }

    public function oneProcedure($surgery)
    {
        //dd($surgery);
        $package = false;
        $time = $surgery->surgeryTime;
        $surgical_acts = $surgery->cod_surgical_act;
        $codigosServicio = [];
        $category = ""; $observation = "";
        $countNotFound = 0;
        $dist_package = 0; $totalRentedCost = 0; $fees_value = 0; $fees_value2 = 0; $antest_value = 0; 
        $valueRoomTime = 0; $gasesValue = 0; $totalLaborCost = 0; $labour = 0; $totalBasketCost = 0;

        $doctor = Doctors::where('code', $surgery->id_doctor)
        ->leftjoin('medical_fees', 'medical_fees.honorary_code', '=', 'doctors.id_fees')
        ->first();

        $details = sis_deta::where('sis_deta.num_servicio',  $surgical_acts) 
            ->join('sis_maes', 'sis_maes.con_estudio', '=', 'sis_deta.estudio')
            ->join('hcingres', 'hcingres.con_estudio', '=', 'sis_deta.estudio')
            ->where('sis_deta.tipo_qx', 1)
            ->where('sis_maes.estado', 'C')
            ->where('sis_deta.total', '>', 0)
            ->select('sis_deta.id', 'sis_deta.num_servicio', 'sis_deta.cod_servicio', 'sis_deta.descripcion', 'sis_deta.porcentaje', 'sis_deta.codigo_cirugia', 'sis_deta.tipo', 'sis_deta.total', 'sis_deta.codigo_paquete', 'sis_maes.estado')
            ->get();
    
        $totalLiquid = $details->sum('total');
        Log::info($details);
        //Se crean coleccions de cada agrupacion de cada procedimiento facturado
        $records = sis_deta::where('num_servicio', $surgical_acts)  
            ->where('tipo_qx', 1)
            ->select('id', 'num_servicio', 'cod_servicio', 'descripcion', 'porcentaje', 'codigo_cirugia', 'tipo', 'total')   
            ->get();
        //Se crean dos variables que van a almacenar colecciones
        $groupedRecords = collect();//Variable que almacena las colecciones
        $currentGroup = collect();

        foreach ($records as $record) {
            if ($record->total > 0 && $currentGroup->isNotEmpty()) {
                $groupedRecords->push($currentGroup);
                $currentGroup = collect();
            }
            $currentGroup->push($record);
        }

        if ($currentGroup->isNotEmpty()) {
            $groupedRecords->push($currentGroup);
        }

        $count = $groupedRecords->count();
        //dd($details);
        foreach ($details as $detail) {
            // Obtener la colección donde un id específico es igual al id facturado
            $id_fact = $detail->id;
            $percentage = 0; $log_dist_package = 0;
            $incorrectProcedure = false;
            $procedureFact = NULL; $package_code = NULL;
            $category_log = '';
            if ($doctor->specialty == 'Medico General' && $doctor->payment_type == 'nomina') {
                Log::info("MEDICO GENERAL HONORARIOS 0 ". $detail);
                $doctor_perce = 0; $doctor2_perce = 0; $anest_perce = 0;
            }else {
                $procedureFact = Procedures::where('code', $detail->cod_servicio)
                ->where('manual_type', $doctor->fees_type)
                ->first();
                if (!$procedureFact) {
                    $procedureFact = Procedures::where('cups', $detail->cod_servicio)
                    ->where('manual_type', $doctor->fees_type)
                    ->first();
                }
                if (!$procedureFact) {
                    Log::info("PROCIDIMIENTO A HOMOLOGAR ". $detail);
                    //$this->homologator($detail, $doctor->fees_type);
                }if (!$procedureFact) {
                    Log::info("PROCIDIMIENTO NO ENCONTRADO ". $detail);
                    $incorrectProcedure = true;
                    $countNotFound += 1;
                    $observation = "Pendiente revisar";
                }else {
                    //Se busca si ese procedimiento tiene un equipo rentado
                    if (!in_array($detail->cod_servicio, $codigosServicio)) {
                        $rented = rented_equipment::where('procedure_id', $procedureFact->cups)->first();
                        if ($rented) {
                            $totalRentedCost += $rented->value;
                        }
            
                        $codigosServicio[] = $detail->cod_servicio;
                    }
        
                    //Se calcula en procentaje de participación en base al total liquidado
                    $percentage = $detail->total/$totalLiquid;
        
                    //Se busca en la coleccion el grupo que contiene el id de facturacion de la iteracion del ciclo
                    $specificGroup = $groupedRecords->filter(function ($group) use ($id_fact) {
                        return $group->contains('id', $id_fact);
                    });

                    //Se obtiene el porcentaje liquidado del médico
                    $doctor_perce = $specificGroup->flatMap(function ($group) {
                        return $group->filter(function ($item) {
                            return $item->cod_servicio === 's41101' || $item->cod_servicio === 'S41101' 
                            || $item->cod_servicio === '39000' || $item->cod_servicio === '39001' || $item->cod_servicio === '39002' || $item->cod_servicio === '39003'
                            || $item->cod_servicio === '39004' || $item->cod_servicio === '39005' || $item->cod_servicio === '39006' || $item->cod_servicio === '39007';
                        });
                    })
                    ->first();
                    
                    if (!$doctor_perce) {
                        if ($detail->codigo_paquete) {
                            $package_value = paquete_maes::where('codigo', $detail->codigo_paquete)->value('valor');
                            if ($package_value != 0) {
                                $doctor_perce = $detail->total/$package_value;
                            }else {
                                //Log::info("Codigo " . $detail->codigo_paquete);
                                $doctor_perce = 0;
                            }
                            $package_code = $detail->codigo_paquete;
                        }else {
                            $doctor_perce = 0;
                        }
                    }else {
                        if ($doctor_perce->porcentaje > 100) {
                            $perce_temp = $specificGroup->flatMap(function ($group) {
                                return $group->filter(function ($item) {
                                    return $item->cod_servicio === 'S41201'
                                    || $item->cod_servicio === '39100' || $item->cod_servicio === '39101' || $item->cod_servicio === '39102' || $item->cod_servicio === '39103'
                                    || $item->cod_servicio === '39104' || $item->cod_servicio === '39105' || $item->cod_servicio === '39106' || $item->cod_servicio === '39107';
                                });
                            })
                            ->first();
                            if (!$perce_temp || $perce_temp->porcentaje > 100) {
                                $perce_temp = $specificGroup->flatMap(function ($group) {
                                    return $group->filter(function ($item) {
                                        return $item->cod_servicio === 'S41301'
                                        || $item->cod_servicio === '39117' || $item->cod_servicio === '39118' || $item->cod_servicio === '39119' || $item->cod_servicio === '39120'
                                        || $item->cod_servicio === '39204' || $item->cod_servicio === '39205' || $item->cod_servicio === '39207' || $item->cod_servicio === '39208'
                                        || $item->cod_servicio === '39211';
                                    });
                                })
                                ->first();
                                if (!$perce_temp || $perce_temp->porcentaje > 100) {
                                    $perce_temp = $specificGroup->flatMap(function ($group) {
                                        return $group->where('cod_servicio', 'S23305');
                                    })
                                    ->first();
                                    if (!$perce_temp || $perce_temp->porcentaje > 100) {
                                        $perce_temp = $specificGroup->flatMap(function ($group) {
                                            return $group->filter(function ($item) {
                                                return $item->cod_servicio === 'S55113' || $item->cod_servicio === 'S23201' 
                                                || $item->cod_servicio === 'S55103' || $item->cod_servicio === 'S23102' || $item->cod_servicio === 'S55102';
                                            });
                                        })
                                        ->first();
                                        if (!$perce_temp || $perce_temp->porcentaje > 100) {
                                            if ($count == 1) {
                                                $perce_temp = collect();
                                                $perce_temp->push((object)['porcentaje' => 100]);
                                                $perce_temp = $perce_temp->firstWhere('porcentaje', 100);
                                            }else {
                                                $perce_temp = collect();
                                                $perce_temp->push((object)['porcentaje' => 0]);
                                                $perce_temp = $perce_temp->firstWhere('porcentaje', 0);
                                                $category_log = 'Pendiente revisar';
                                            }
                                        }
                                    }
                                    $doctor_perce = $perce_temp->porcentaje/100;
                                }else {
                                    $doctor_perce = $perce_temp->porcentaje/100;
                                }
                            }else {
                                $doctor_perce = $perce_temp->porcentaje/100;
                            }
                        }else {
                            $doctor_perce = $doctor_perce->porcentaje/100;
                        }
                    }
                    
                    //dd($doctor_perce);
                    //Se calculan los honorarios médicos
                    $fees_log = 0;
                    //Se busca si el médico tiene una tarifa diferencial, si no la tiene, se calcula por UVR o UVT
                    $diferential_rate = Diferential_rates::where('id_doctor', $surgery->id_doctor)
                    ->where('id_procedure', $procedureFact->id)->first();
               
                    if ($diferential_rate) {
                        $fees_value += $diferential_rate->value1 * $doctor_perce;
                        $fees_log = ($diferential_rate->value1 * ($doctor_perce));
                        $category = "Tarifa diferencial";
                    } else{
                        $fees = Doctors::where('code', $surgery->id_doctor)
                        ->join('medical_fees', 'medical_fees.honorary_code', '=', 'doctors.id_fees')
                        ->first();
                        $category = "Honorario";      
                        if ($procedureFact->uvr == 0) {
                            switch ($fees->honorary_code) {
                                case 13:
                                    $fees_value += ($procedureFact->value * 1.1 * $doctor_perce);
                                    $fees_log = ($procedureFact->value * 1.1 * $doctor_perce);
                                    break;
                                case 52:
                                    $fees_value += ($procedureFact->value * 1.2 * $doctor_perce);
                                    $fees_log = ($procedureFact->value * 1.2 * $doctor_perce);
                                    break;
                                case 65:
                                    $fees_value += ($procedureFact->value * 1.28 * $doctor_perce);
                                    $fees_log = ($procedureFact->value * 1.28 * $doctor_perce);
                                    break;
                                case 30:
                                case 23:
                                    $fees_value += ($procedureFact->value * 1.3 * $doctor_perce);
                                    $fees_log = ($procedureFact->value * 1.3 * $doctor_perce);
                                    break;
                            }
                        }elseif ($procedureFact->uvr != 0) {      
                            switch ($fees->honorary_code) {
                                case 13:
                                    $fees_value += ($procedureFact->uvr * 1270 * 1.1 * $doctor_perce);
                                    $fees_log = ($procedureFact->uvr * 1270 * 1.1 * $doctor_perce);
                                    break;
                                case 52:
                                    $fees_value += ($procedureFact->uvr * 1270 * 1.2 * $doctor_perce);
                                    $fees_log = ($procedureFact->uvr * 1270 * 1.2 * $doctor_perce);
                                    break;
                                case 65:
                                    $fees_value += ($procedureFact->uvr * 1270 * 1.28 * $doctor_perce);
                                    $fees_log = ($procedureFact->uvr * 1270 * 1.28 * $doctor_perce);
                                    break;
                                case 30:
                                case 23:
                                    $fees_value += ($procedureFact->uvr * 1270 * 1.3 * $doctor_perce);
                                    $fees_log = ($procedureFact->uvr * 1270 * 1.3 * $doctor_perce);
                                    break;
                                case 56:
                                case 57:
                                case 68:
                                    $group = soat_group::where('group', $procedureFact->uvr)->first();
                                    if ($group != NULL) {
                                        $fees_value += $group->surgeon * $doctor_perce;
                                        $fees_log = $group->surgeon * $doctor_perce;
                                    }else {
                                        $fees_value += 0;
                                        $fees_log = 0;
                                    }
                                    break;
                            }
                        }
                    }
        
                    //Honorarios médicos de médico ayudante
                    $fees_log2 = 0;
                    //Se buscan los datos del médico ayudante
                    $doctor2 = Doctors::where('code', $surgery->id_doctor2)
                    ->join('medical_fees', 'medical_fees.honorary_code', '=', 'doctors.id_fees')
                    ->first();
        
                    //Se obtiene el porcentaje liquidado del médico ayudante
                    $doctor2_perce = $specificGroup->flatMap(function ($group) {
                        return $group->filter(function ($item) {
                            return $item->cod_servicio === 'S41301'
                            || $item->cod_servicio === '39117' || $item->cod_servicio === '39118' || $item->cod_servicio === '39119' || $item->cod_servicio === '39120';
                        });
                    })->first();
        
                    if (!$doctor2_perce) {
                        if ($detail->codigo_paquete) {
                            $doctor2_perce = $doctor_perce;
                        }else {
                            $doctor2_perce = 0;
                        }
                    }else {
                        if ($doctor2_perce->porcentaje > 100) {
                            $doctor2_perce = $specificGroup->flatMap(function ($group) {
                                return $group->where('cod_servicio', 'S41201');
                            })
                            ->first();
                            if (!$doctor2_perce || $doctor2_perce->porcentaje > 100) {
                                $doctor2_perce = $specificGroup->flatMap(function ($group) {
                                    return $group->where('cod_servicio', 'S23204');
                                })
                                ->first();
                                if (!$doctor2_perce || $doctor2_perce->porcentaje > 100) {
                                    $doctor2_perce = $specificGroup->flatMap(function ($group) {
                                        return $group->where('cod_servicio', 'S55113');
                                    })
                                    ->first();
                                    if (!$doctor2_perce || $doctor2_perce->porcentaje > 100) {
                                        if ($count == 1) {
                                            $doctor2_perce = collect();
                                            $doctor2_perce->push((object)['porcentaje' => 100]);
                                            $doctor2_perce = $doctor2_perce->firstWhere('porcentaje', 100);
                                        }else {
                                            $doctor2_perce = collect();
                                            $doctor2_perce->push((object)['porcentaje' => 0]);
                                            $doctor2_perce = $doctor2_perce->firstWhere('porcentaje', 0);
                                            $category_log = 'Pendiente revisar';
                                        }
                                    }
                                }
                                $doctor2_perce = $doctor2_perce->porcentaje/100;
                            }else {
                                $doctor2_perce = $doctor2_perce->porcentaje/100;
                            }
                        }else {
                            $doctor2_perce = $doctor2_perce->porcentaje/100;
                        }
                    }
        
                    //Se busca si el medico tiene una tarifa diferencial, basandonos en los procedimientos facturados
                    //Si no la tiene se calcula por UVR o UVT
                    if ($doctor2 && $doctor2->fees_type == $procedureFact->manual_type) {
                        $diferential_rate_med2 = Diferential_rates::where('id_doctor', $surgery->id_doctor2)
                        ->where('id_procedure', $procedureFact->id)->first();
        
                        if ($diferential_rate_med2) {
                            $fees_value2 += ($diferential_rate_med2->value2 * $doctor2_perce);
                            $fees_log2 = ($diferential_rate_med2->value2 * $doctor2_perce);
                        } elseif ($procedureFact->uvr == 0) {
                            switch ($doctor2->honorary_code) {
                                case 13:
                                    $fees_value2 += ($procedureFact->value * 1.1 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->value * 1.1 * $doctor2_perce);
                                    break;
                                case 52:
                                    $fees_value2 += ($procedureFact->value * 1.2 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->value * 1.2 * $doctor2_perce);
                                    break;
                                case 65:
                                    $fees_value2 += ($procedureFact->value * 1.28 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->value * 1.28 * $doctor2_perce);
                                    break;
                                case 30:
                                case 23:
                                    $fees_value2 += ($procedureFact->value * 1.3 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->value * 1.3 * $doctor2_perce);
                                    break;
                            }
                        }elseif ($procedureFact->uvr != 0) {
                            switch ($doctor2->honorary_code) {
                                case 13:
                                    $fees_value2 += ($procedureFact->uvr * 960 * 1.1 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->uvr * 960 * 1.1 * ($doctor2_perce));
                                    break;
                                case 52:
                                    $fees_value2 += ($procedureFact->uvr * 960 * 1.2 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->uvr * 960 * 1.2 * ($doctor2_perce));
                                    break;
                                case 65:
                                    $fees_value2 += ($procedureFact->uvr * 960 * 1.28 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->uvr * 960 * 1.28 * ($doctor2_perce));
                                    break;
                                case 30:
                                case 23:
                                    $fees_value2 += ($procedureFact->uvr * 960 * 1.3 * $doctor2_perce);
                                    $fees_log2 = ($procedureFact->uvr * 960 * 1.3 * ($doctor2_perce));
                                    break;
                                case 56:
                                case 57:
                                case 68:
                                    $group = soat_group::where('group', $procedureFact->uvr)->first();
                                    if ($group != NULL) {
                                        $fees_value2 += $group->assistant * ($doctor2_perce);
                                        $fees_log2 = $group->assistant * ($doctor2_perce);
                                    }else {
                                        $fees_value2 += 0;
                                        $fees_log2 = 0;
                                    }
                                    break;
                            }
                        }
                    }else {
                        $fees_value2 += 0;
                        $fees_log2 = 0;
                    }
        
                    //Honorarios médicos de anestesiologo
                    $antest_log = 0;
                    //Se buscan los datos del médico anestesiologo
                    $anest = Doctors::where('code', $surgery->id_anesthesiologist)
                    ->join('medical_fees', 'medical_fees.honorary_code', '=', 'doctors.id_fees')
                    ->first();
        
                    $anest_perce = $specificGroup->flatMap(function ($group) {
                        return $group->filter(function ($item) {
                            return $item->cod_servicio === 'S41201'
                            || $item->cod_servicio === '39100' || $item->cod_servicio === '39101' || $item->cod_servicio === '39102' || $item->cod_servicio === '39103'
                            || $item->cod_servicio === '39104' || $item->cod_servicio === '39105' || $item->cod_servicio === '39106' || $item->cod_servicio === '39107';
                        });
                    })->first();
                    if (!$anest_perce) { 
                        if ($detail->codigo_paquete) {
                            $anest_perce = $doctor_perce;
                        }else {
                            $anest_perce = 0;
                        }
                    }else {
                        if ($anest_perce->porcentaje > 100) {
                            $anest_perce = $specificGroup->flatMap(function ($group) {
                                return $group->where('cod_servicio', 'S41101');
                            })->first();
                            if (!$anest_perce || $anest_perce->porcentaje > 100) {
                                $anest_perce = $specificGroup->flatMap(function ($group) {
                                    return $group->where('cod_servicio', 'S41301');
                                })
                                ->first();
                                if (!$anest_perce || $anest_perce->porcentaje > 100) {
                                    $anest_perce = $specificGroup->flatMap(function ($group) {
                                        return $group->where('cod_servicio', 'S23305');
                                    })
                                    ->first();
                                    if (!$anest_perce || $anest_perce->porcentaje > 100) {
                                        if ($count == 1) {
                                            $anest_perce = collect();
                                            $anest_perce->push((object)['porcentaje' => 100]);
                                            $anest_perce = $anest_perce->firstWhere('porcentaje', 100);
                                        }else {
                                            $anest_perce = collect();
                                            $anest_perce->push((object)['porcentaje' => 0]);
                                            $anest_perce = $anest_perce->firstWhere('porcentaje', 0);
                                            $category_log = 'Pendiente revisar';
                                        }
                                    }
                                    $anest_perce = $anest_perce->porcentaje/100;
                                }else {
                                    $anest_perce = $anest_perce->porcentaje/100;
                                }
                            }else {
                                $anest_perce = $anest_perce->porcentaje/100;
                            }
                        }else {
                            $anest_perce = $anest_perce->porcentaje/100;
                        }
                    }
                    
                    //Se busca si el medico tiene una tarifa diferencial, basandonos en los procedimientos facturados
                    //Si no la tiene se calcula por UVR o UVT
                    if ($anest && $anest->fees_type == $procedureFact->manual_type) {
                        $diferential_rate_anest = Diferential_rates::where('id_doctor', $surgery->id_anesthesiologist)
                        ->where('id_procedure', $procedureFact->id)->first();
                        
                        if ($diferential_rate_anest) {
                            $antest_value += ($diferential_rate_anest->value1 * $anest_perce);
                            $antest_log = ($diferential_rate_anest->value1 * $anest_perce);
                        } elseif ($procedureFact->uvr == 0) {
                            switch ($anest->honorary_code) {
                                case 13:
                                    $antest_value += ($procedureFact->value * 1.1 * $anest_perce);
                                    $antest_log = ($procedureFact->value * 1.1 * $anest_perce);
                                    break;
                                case 52:
                                    $antest_value += ($procedureFact->value * 1.2 * $anest_perce);
                                    $antest_log = ($procedureFact->value * 1.2 * $anest_perce);
                                    break;
                                case 65:
                                    $antest_value += ($procedureFact->value * 1.28 * $anest_perce);
                                    $antest_log = ($procedureFact->value * 1.28 * $anest_perce);
                                    break;
                                case 30:
                                case 23:
                                    $antest_value += ($procedureFact->value * 1.3 * $anest_perce);
                                    $antest_log = ($procedureFact->value * 1.3 * $anest_perce);
                                    break;
                            }
                        }elseif ($procedureFact->uvr != 0) {
                            switch ($anest->honorary_code) {
                                case 13:
                                    $antest_value += ($procedureFact->uvr * 960 * 1.1 * $anest_perce);
                                    $antest_log = ($procedureFact->uvr * 960 * 1.1 * $anest_perce);
                                    break;
                                case 52:
                                    $antest_value += ($procedureFact->uvr * 960 * 1.2 * $anest_perce);
                                    $fees_logAnest = ($procedureFact->uvr * 960 * 1.2 * ($anest_perce));
                                    break;
                                case 65:
                                    $antest_value += ($procedureFact->uvr * 960 * 1.28 * $anest_perce);
                                    $antest_log = ($procedureFact->uvr * 960 * 1.28 * ($anest_perce));
                                    break;
                                case 30:
                                case 23:
                                    $antest_value += ($procedureFact->uvr * 960 * 1.3 * $anest_perce);
                                    $antest_log = ($procedureFact->uvr * 960 * 1.3 * ($anest_perce));
                                    break;
                                case 56:
                                case 57:
                                case 68:
                                    $group = soat_group::where('group', $procedureFact->uvr)->first();
                                    if ($group != NULL) {
                                        $antest_value += $group->anesthed * ($anest_perce);
                                        $antest_log = $group->anesthed * ($anest_perce);
                                    }else {
                                        $antest_value += 0;
                                        $antest_log = 0;
                                    }
                                    break;
                                }
                            }
                        }else {
                            $antest_value += 0;
                            $antest_log = 0;
                        }
                }
                if ($incorrectProcedure == false) {
                    //Se obtiene el tiempo en base al porcentaje de participacion
                    $time = $percentage * $surgery->surgeryTime; 
                    if ($surgery->surgeryTime == 0) {
                        $start = Carbon::parse($surgery->start_time);
                        $end = Carbon::parse($surgery->end_time);
                        $timeSurgerie = $end->diffInMinutes($start);
                        $time = $percentage * $timeSurgerie; 
                    }
        
                    //Se calcula derecho de sala
                    $RoomTime = General_costs::where('description', $surgery->operating_room)->first();
                    $valueRoomTime += ($RoomTime->value/60) * $time;
                    $room_log = ($RoomTime->value/60) * $time;
        
                    //Se calculan el valor de los gases
                    $gases = General_costs::where('description', 'GASES')->first();
                    $gasesValue += ($gases->value/60) * $time;
                    $gases_log = ($gases->value/60) * $time;
        
                    if ($detail->codigo_paquete) {
                        $distri_pack = Maes_fra::where('Estudiosd', $surgery->study_number)->first();
                        if ($distri_pack) {
                            if ($distri_pack->Distrib_paq == 1) {
                                $log_dist_package = $this->package($surgery->study_number, $detail->codigo_paquete, $detail->cod_servicio, $detail->id);
                                $dist_package += $log_dist_package;
                                //dd($log_dist_package);
                            }
                        }
                    }

                    $existingLog = Log_operation_cost::where('cod_surgical_act', $surgical_acts)
                    ->where('id_fact', $id_fact)
                    ->first();
                    
                    if ($existingLog) {  
                        if ($existingLog->mode != 'Manual') {
                            $existingLog->update(
                            [
                                'percentage_parti' => $percentage,
                                'time_procedure' => $time,
                                'doctor_percentage' => $doctor_perce * 100,
                                'doctor_fees' => $fees_log,
                                'doctor2_percentage' => $doctor2_perce * 100,
                                'doctor2_fees' => $fees_log2,
                                'anest_percentage' => $anest_perce * 100,
                                'anest_fees' => $antest_log,
                                'value_liquidated' => $detail->total,
                                'total_liquidated' => $totalLiquid,
                                'room_cost' => $room_log,
                                'gases' => $gases_log,
                                'category' => $category_log,
                                'mode' => 'Auto',
                                'id_fact' => $id_fact,
                                'cod_package' => $package_code,
                                'dist_package' => $log_dist_package,
                                'cod_surgical_act' => $surgical_acts,
                                'code_procedure' => $procedureFact->id
                            ]);
                        }      
                    }else {
                        Log_operation_cost::create(
                        [
                            'percentage_parti' => $percentage,
                            'time_procedure' => $time,
                            'doctor_percentage' => $doctor_perce * 100,
                            'doctor_fees' => $fees_log,
                            'doctor2_percentage' => $doctor2_perce * 100,
                            'doctor2_fees' => $fees_log2,
                            'anest_percentage' => $anest_perce * 100,
                            'anest_fees' => $antest_log,
                            'value_liquidated' => $detail->total,
                            'total_liquidated' => $totalLiquid,
                            'room_cost' => $room_log,
                            'gases' => $gases_log,
                            'category' => $category_log,
                            'mode' => 'Auto',
                            'id_fact' => $id_fact,
                            'cod_package' => $package_code,
                            'dist_package' => $log_dist_package,
                            'cod_surgical_act' => $surgical_acts,
                            'code_procedure' => $procedureFact->id
                        ]);
                    }
                }
            }
        }

        
        if ($countNotFound != $count){
            //Canastas
            $baskets = basket::where('surgical_act', $surgical_acts)->get();
            $totalBasketCost = 0;
    
            foreach ($baskets as $basket) {
                $article = Articles::where('item_code', $basket->id_article)->first();
                $value_article = $article->last_cost;
                if ($value_article == 1) {
                    $value_article = $article->average_cost;
                }
                if ($article->usage_quantity > 0) {
                    $basketCost = ($value_article/$article->usage_quantity) * $basket->item_quantity;
                    $totalBasketCost += $basketCost;
                }else {
                    $basketCost = $basket->item_quantity * $value_article;
                    $totalBasketCost += $basketCost;
                }
            }
    
            //Consumibles
            $consumables = consumable::all();
            //dd($consumables);
            $totalConsumablesCost = 0;
            foreach ($consumables as $consumable) {
                $id_article = $consumable->id_article;
                $basket = $baskets->where('id_article', $id_article)->first();
                if (!$basket) {
                    $totalConsumablesCost += ( $consumable->unit_price * $consumable->consumable_quantity);
                }
            }
            $totalValue = $valueRoomTime + $gasesValue + $totalBasketCost + $totalRentedCost + $totalConsumablesCost + $fees_value + $fees_value2 + $antest_value;
            $existingCost = Unit_costs::where('cod_surgical_act', $surgical_acts)->first();
            //Log::info("Surgery: " . $surgery->study_number);
            if ($existingCost) {   
                if ($existingCost->mode != 'Manual') {
                    $existingCost->update(
                    [
                        'room_cost' => $valueRoomTime,
                        'gas' => $gasesValue,
                        'total_value' => $totalValue,
                        'consumables' => $totalConsumablesCost,
                        'basket' => $totalBasketCost,
                        'rented' => $totalRentedCost,
                        'medical_fees' => $fees_value,
                        'medical_fees2' => $fees_value2,
                        'anest_fees' => $antest_value,
                        'dist_pack' => $dist_package,
                        'cod_surgical_act' => $surgical_acts,
                        'category' => $category,
                        'mode' => 'Auto',
                        'observation' => $observation
                    ]);
                } 
            }else {
                Unit_costs::create(
                [
                    'room_cost' => $valueRoomTime,
                    'gas' => $gasesValue,
                    'total_value' => $totalValue,
                    'consumables' => $totalConsumablesCost,
                    'basket' => $totalBasketCost,
                    'rented' => $totalRentedCost,
                    'medical_fees' => $fees_value,
                    'medical_fees2' => $fees_value2,
                    'anest_fees' => $antest_value,
                    'dist_pack' => $dist_package,
                    'cod_surgical_act' => $surgical_acts,
                    'category' => $category,
                    'mode' => 'Auto',
                    'observation' => $observation
                ]);
            }  
        }
    }

    public function moreProcedures($surgery)
    {
        
        
    }

    public function package($study, $code_package, $surgical_acts, $id_factu)
    {

        $dist_package = 0;
        $package = DB::connection('PQ_CUMI')->select('CALL paq_estudio(?)', [$study]);
        /* $package = cargos::where('id_fact', 7543674)->first(); */
        $movstock = array_filter($package, function($item) use ($id_factu){
            return $item->tabla === 'movstock' && $item->idfact === (string) $id_factu;
        });

        $salidas_camas = array_filter($package, function($item) use ($id_factu){
            return $item->tabla === 'salidas_camas' && $item->idfact === (string) $id_factu;
        });

        $sis_deta_temp = array_filter($package, function($item) use ($id_factu){
            return $item->tabla === 'sis_deta_temp' && $item->idfact === (string) $id_factu;
        });
        
        $value_articles = 0;
        foreach ($movstock as $stock) {
            $article = Articles::where('item_code', $stock->Codserv)->first();
            if ($article->last_cost == 1) {
                $value_articles += $article->average_cost * $stock->Cant;
                $this->detailPackage('Articulo', $stock, $article->average_cost, $study);
            }else {
                $value_articles += $article->last_cost * $stock->Cant;
                $this->detailPackage('Articulo', $stock, $article->last_cost, $study);
            }
            
        }
        $this->saveTemp();
        if ($value_articles > 0) {
            $this->addDistPackage($value_articles, 'Articulos', $study, $code_package, $surgical_acts, $id_factu);
        }

        $value_accommodation = 0;
        foreach ($salidas_camas as $salida_cama) {
            $year = Carbon::parse($salida_cama->fecha)->year;
            $month = Carbon::parse($salida_cama->fecha)->month;
            $nameMonth = $this->getNameMonth($month);
            $accommodation = accommodation_cost::where('service', $salida_cama->uf)
            ->where('year', $year)
            ->where('month', $nameMonth)
            ->first();
            
            if (!$accommodation) {
                $accommodation = accommodation_cost::where('service', $salida_cama->uf)
                ->where('year', $year)
                ->latest()
                ->first();        
            }

            if (!$accommodation && $year < date('Y')) {
                $accommodation = accommodation_cost::where('service', $salida_cama->uf)
                    ->where('year', date('Y'))
                    ->first();
            }
            
            $value_accommodation += $accommodation->dayAccommodation_cost * $salida_cama->Cant;
            $this->detailPackage('Estancia', $salida_cama, $accommodation->dayAccommodation_cost, $study);
            
        }
        $this->saveTemp();
        if ($value_accommodation > 0) {
            $this->addDistPackage($value_accommodation, 'Estancias', $study, $code_package, $surgical_acts, $id_factu);
        }

        $value_imaging = 0; $value_laboratory = 0;
        foreach ($sis_deta_temp as $sis_temp) {
            $imaging = imaging_production_details::where('cups', $sis_temp->Codserv)->first();
            if (!$imaging) {
                $lab = cumiLab_rate::where('cups', $sis_temp->Codserv)->first();
                if ($lab) {
                    $value_laboratory += $lab->total * $sis_temp->Cant;
                    $this->detailPackage('Laboratorio', $sis_temp, $lab->total, $study);
                }else {
                    Log::info("Estudio " . $study . " CUPS " . $sis_temp->Codserv);
                }
            }else {
                $value_imaging += $imaging->total_cost * $sis_temp->Cant;
                $this->detailPackage('Imagen diagnostica', $sis_temp, $imaging->total_cost, $study);
            }
        }
        $this->saveTemp();
        if ($value_laboratory > 0) {
            $this->addDistPackage($value_laboratory, 'Laboratorios', $study, $code_package, $surgical_acts, $id_factu);
        }

        if ($value_imaging > 0) {
            $this->addDistPackage($value_imaging, 'Imagenes', $study, $code_package, $surgical_acts, $id_factu);
        }

        $dist_package = $value_articles + $value_accommodation + $value_laboratory + $value_imaging;
        //dd($dist_package);
        return $dist_package;
    }

    public function addDistPackage($value, $description, $study, $code_package, $surgical_acts, $id_factu)
    {
        $existing_dis_package = Dist_package::where('study', $study)
        ->where('id_factu', $id_factu)
        ->where('description', $description)
        ->first();

        if ($existing_dis_package) {
            $existing_dis_package->update(
                [
                   'description' =>  $description,
                   'value' => $value,
                   'cod_package' => $code_package,
                   'id_factu' => $id_factu,
                   'study' => $study,
                   'cod_surgical_act' => $surgical_acts
                ]);
        }else {
            Dist_package::create(
            [
                'description' =>  $description,
                'value' => $value,
                'cod_package' => $code_package,
                'id_factu' => $id_factu,
                'study' => $study,
                'cod_surgical_act' => $surgical_acts
            ]);
        }
    }

    public function getNameMonth($month){
        switch ($month) {
            case 1:
                return $nameMonth = 'Enero';
                break;
            case 2:
                return $nameMonth = 'Febrero';
                break;
            case 3:
                return $nameMonth = 'Marzo';
                break;
            case 4:
                return $nameMonth = 'Abril';
                break;
            case 5:
                return $nameMonth = 'Mayo';
                break;
            case 6:
                return $nameMonth = 'Junio';
                break;
            case 7:
                return $nameMonth = 'Julio';
                break;
            case 8:
                return $nameMonth = 'Agosto';
                break;
            case 9:
                return $nameMonth = 'Septiembre';
                break;
            case 10:
                return $nameMonth = 'Octubre';
                break;
            case 11:
                return $nameMonth = 'Noviembre';
                break;
            case 12:
                return $nameMonth = 'Diciembre';
                break;
            default:
                return $nameMonth = 'Mes inválido';
                break;
        }
    }

    public function exportProcedure (Request $request){
        $input = $request->all();
        // Verificar si 'specialty' no está presente en el array y asignarle null
        if (!array_key_exists('specialty', $input)) {
            $input['specialty'] = null;
        }

        // Verificar si 'code' no está presente en el array y asignarle null
        if (!array_key_exists('code', $input)) {
            $input['code'] = null;
        }
        
        $fecha = now()->format('Y-m-d H:i:s');
        return Excel::download(new ProcedureExport($input), 'Costos_cirugia_' . $input['options'] . '_' . $fecha . '.xlsx');
    }

    public function detailPackage($description, $item, $recorded_cost, $study){

        $unit_cost = $item->Cant * $recorded_cost;

        $validate = detail_packages_temp::where('code_service', $item->Codserv)
        ->where('cod_uf', $item->cod_uf)
        ->where('id_factu', $item->idfact)
        ->where('study', $study)
        ->first();

        if ($validate) {
            $validate->quanty += $item->Cant;
            $validate->unit_cost += $unit_cost;
            $validate->save();
        }else {
            detail_packages_temp::create([
                'description' => $description,
                'cod_uf' => $item->cod_uf,
                'funcional_unit' => $item->uf,
                'code_service' => $item->Codserv,
                'description_service' => $item->descripcion,
                'id_factu' => $item->idfact,
                'study' => $study,
                'quanty' => $item->Cant,
                'recorded_cost' => $recorded_cost,
                'unit_cost' => $unit_cost
            ]);
        }
    }

    public function saveTemp()
    {
        $tempRecords = detail_packages_temp::all();
        foreach ($tempRecords as $record) {

            $validate = detail_package::where('code_service', $record->code_service)
            ->where('cod_uf', $record->cod_uf)
            ->where('id_factu', $record->id_factu)
            ->where('study', $record->study)
            ->first();

            if ($validate) {
                $validate->update([
                    'description' => $record->description,
                    'cod_uf' => $record->cod_uf,
                    'funcional_unit' => $record->funcional_unit,
                    'code_service' => $record->code_service,
                    'description_service' => $record->description_service,
                    'id_factu' => $record->id_factu,
                    'study' => $record->study,
                    'quanty' => $record->quanty,
                    'recorded_cost' => $record->recorded_cost,
                    'unit_cost' => $record->unit_cost
                ]);
            }else {
                detail_package::create([
                    'description' => $record->description,
                    'cod_uf' => $record->cod_uf,
                    'funcional_unit' => $record->funcional_unit,
                    'code_service' => $record->code_service,
                    'description_service' => $record->description_service,
                    'id_factu' => $record->id_factu,
                    'study' => $record->study,
                    'quanty' => $record->quanty,
                    'recorded_cost' => $record->recorded_cost,
                    'unit_cost' => $record->unit_cost
                ]);
            }

        }

        detail_packages_temp::truncate();
    }

    public function homologator($detail, $manual_type)
    {
        $cupshomologations = Procedures_homologator::query();
        $procedureHomolo = null;
        switch ($manual_type) {
            case '256':
            case '312':
                $cupshomologations->where('cups_soat', $detail->cod_servicio);
                break;
            case 'SOAT':
                $cupshomologations->where('cups_iss', $detail->cod_servicio)
                                ->where('cups', $detail->cod_servicio);
                break;        
        }
        $cupshomologations = $cupshomologations->get();
        $count = $cupshomologations->count();
        if ($count == 1) {
            $cupshomologations = $cupshomologations->first();
            switch ($manual_type) {
                case '256':
                case '312':
                    $procedure = Procedures::where('code', $cupshomologations->cups_iss)->first();
                    break;
                case 'SOAT':
                    $procedure = Procedures::where('code', $cupshomologations->cups_soat)->first();
                    break;        
            }
            dd($procedure);
            return $procedure;
        } else {
            foreach ($cupshomologations as $cupshomologation) {

            }
            return $cupshomologations;
        }
    }

    public function report(){
        $this->authorize('reportbi_unitCost');

        $encryptionController = new EncryptionController();

        $url = $encryptionController->encrypt("https://app.powerbi.com/view?r=eyJrIjoiMGNlNmNkMWEtODZjOC00NWFlLTllMTItN2U0Y2VjOWEzNjI1IiwidCI6Ijk4NGRkMTg1LWM4MDMtNGRhMS05NzRmLTcxZTQwYzc0ZWNjZCJ9");
        return view('unit_costs.report', compact('url'));
    }

    
}

