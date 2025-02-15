<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesurgeryRequest;
use App\Http\Requests\UpdatesurgeryRequest;
use App\Repositories\surgeryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use Carbon\Carbon;
use App\Models\Articles;
use App\Models\doctors;
use App\Models\labour;
use App\Models\procedures;
use App\Models\basket;
use App\Models\surgery;
use App\Models\medical_fees;
use App\Models\msurgery_procedure;

//Sisma Salud
use App\Models\SismaSalud\sis_deta;
use App\Models\SismaSalud\sis_maes;
use App\Models\SismaSalud\hoja_cirugia;
use App\Models\SismaSalud\movStock;

//Sisma inventario
use App\Models\SismaInventario\articulos;

class surgeryController extends AppBaseController
{
    /** @var surgeryRepository $surgeryRepository*/
    private $surgeryRepository;

    public function __construct(surgeryRepository $surgeryRepo)
    {
        $this->surgeryRepository = $surgeryRepo;
    }

    /**
     * Display a listing of the surgery.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_surgeries');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $surgeriesQuery = Surgery::query();

        if (!empty($search)) {
            $surgeriesQuery->where('date_surgery', 'LIKE', '%' . $search . '%')
                    ->orWhere('operating_room', 'LIKE', '%' . $search . '%')
                    ->orWhere('cod_surgical_act', 'LIKE', '%' . $search . '%')
                    ->orWhere('study_number', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('doctors', function ($query) use ($search) {
                        $query->where('code', 'LIKE', '%' . $search . '%')
                        ->orWhere('dni', 'LIKE', '%' . $search . '%')
                        ->orWhere('full_name', 'LIKE', '%' . $search . '%');
                    });
        }

        $surgeries = $surgeriesQuery->orderBy('date_surgery', 'DESC')->paginate($perPage);

        return view('surgeries.index', compact('surgeries'));
    }

    /**
     * Show the form for creating a new surgery.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_surgeries');
        $doctors = Doctors::orderby('full_name')->pluck('full_name', 'id');
        $assistants = Doctors::orderby('full_name')->pluck('full_name', 'id');
        $anesthesiologists = Doctors::orderby('full_name')->pluck('full_name', 'id');
        $labours = Labour::orderby('position')->pluck('position', 'id');
        $procedures = Procedures::orderby('code')->pluck('description', 'id');
        $baskets = Basket::orderby('id')->pluck('id');
        return view('surgeries.create', compact('doctors', 'assistants', 'anesthesiologists', 'labours', 'procedures', 'baskets'));
    }

    /**
     * Store a newly created surgery in storage.
     *
     * @param CreatesurgeryRequest $request
     *
     * @return Response
     */
    public function store(CreatesurgeryRequest $request)
    {
        $this->authorize('create_surgeries');
        $input = $request->all();

        $startTime = Carbon::parse($request->input('start_time'));
        $endTime = Carbon::parse($request->input('end_time')); 
        $surgeryTime = $endTime->diffInMinutes($startTime);

        $input['surgeryTime'] = $surgeryTime;

        $surgery = $this->surgeryRepository->create($input);

        Flash::success('Surgery saved successfully.');

        return redirect(route('surgeries.index'));
    }

    /**
     * Display the specified surgery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_surgeries');
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            Flash::error('Surgery not found');

            return redirect(route('surgeries.index'));
        }

        return view('surgeries.show')->with('surgery', $surgery);
    }

    /**
     * Show the form for editing the specified surgery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_surgeries');
        $surgery = $this->surgeryRepository->find($id);
        $doctors = Doctors::orderby('full_name')->pluck('full_name', 'code');
        $doctors2 = Doctors::orderby('full_name')->pluck('full_name', 'code');
        $assistants = Doctors::orderby('full_name')->pluck('full_name', 'id');
        $anesthesiologists = Doctors::orderby('full_name')->pluck('full_name', 'id');
        $labours = Labour::orderby('position')->pluck('position', 'id');
        $procedures = Procedures::orderby('code')->pluck('description', 'id');
        $baskets = Basket::orderby('id')->pluck('id');
        if (empty($surgery)) {
            Flash::error('Surgery not found');

            return redirect(route('surgeries.index'));
        }

        return view('surgeries.edit', compact('surgery', 'doctors', 'doctors2', 'assistants', 'anesthesiologists', 'labours', 'procedures', 'baskets'));
    }

    /**
     * Update the specified surgery in storage.
     *
     * @param int $id
     * @param UpdatesurgeryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesurgeryRequest $request)
    {
        $this->authorize('update_surgeries');
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            Flash::error('Surgery not found');
            return redirect(route('surgeries.index'));
        }

        $startTime = Carbon::parse($request->input('start_time'));
        $endTime = Carbon::parse($request->input('end_time'));

        // Verificar si las fechas son válidas antes de calcular la diferencia
        if ($startTime->greaterThanOrEqualTo($endTime)) {
            Flash::error('La hora final debe ser mayor a la hora de inicio ');
            return redirect()->back()->withInput();
        }

        $surgeryTime = $endTime->diffInMinutes($startTime);

        $input = $request->all();
        $input['surgeryTime'] = $surgeryTime;
        $input['start_time'] = $startTime->format('H:i');
        $input['end_time'] = $endTime->format('H:i');
        $this->surgeryRepository->update($input, $id);

        Flash::success('Surgery updated successfully.');

        return redirect(route('surgeries.index'));
    }


    /**
     * Remove the specified surgery from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_surgeries');
        $surgery = $this->surgeryRepository->find($id);

        if (empty($surgery)) {
            Flash::error('Surgery not found');

            return redirect(route('surgeries.index'));
        }

        $this->surgeryRepository->delete($id);

        Flash::success('Surgery deleted successfully.');

        return redirect(route('surgeries.index'));
    }

    public function getSurgery(Request $request)
    {
        ini_set('max_execution_time', 1800);
        // Obtener la fecha actual
        $today = now()->toDateString();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        
        //Buscamos los estudios y a su vez miramos cuantos actos quirurgicos
        //Tiene asociado ese estudio
        //Tablas utilizadas: sis_medi, hoja cirugia
        $studies = sis_maes::leftjoin('hoja_cirugia', 'hoja_cirugia.estudio', '=', 'sis_maes.con_estudio')
                    ->select('sis_maes.con_estudio', DB::raw('COUNT(*) AS actos_quirurgicos'))
                    ->whereDate('hoja_cirugia.fecha', '>=', $start_date)
                    ->whereDate('hoja_cirugia.fecha', '<=', $end_date)
                    ->whereNull('hoja_cirugia.fecha_anulado')
                    ->where('hoja_cirugia.anulado', '!=', 1)
                    ->where('sis_maes.estado', 'C')
                    ->groupBy('sis_maes.con_estudio')
                    ->orderBy('actos_quirurgicos')
                    ->get();

        foreach ($studies as $studie) 
        {
            $quantyStudie = sis_maes::leftjoin('hoja_cirugia', 'hoja_cirugia.estudio', '=', 'sis_maes.con_estudio')
                    ->select('sis_maes.con_estudio', DB::raw('COUNT(*) AS actos_quirurgicos'))
                    ->where('sis_maes.con_estudio', $studie->con_estudio)
                    ->whereNull('hoja_cirugia.fecha_anulado')
                    ->where('hoja_cirugia.anulado', '!=', 1)
                    ->where('sis_maes.estado', 'C')
                    ->groupBy('sis_maes.con_estudio')
                    ->orderBy('actos_quirurgicos')
                    ->first();


            switch ($quantyStudie->actos_quirurgicos) {
                case '1':
                    $this->oneSurgery($quantyStudie);
                    break;
                default:
                    $this->moreSurgeries($quantyStudie);
                    break;
            } 
        }
        session()->flash('success', "Cirugias actualizadas correctamente!!");
        ini_restore('max_execution_time');
        return redirect(route('surgeries.index'));
    }

    public function oneSurgery($studie)
    {   
        Log::info("UN SOLO ACTO QUIRURGICO " . $studie->con_estudio);
        $surgeries = hoja_cirugia::leftjoin('hoja_cirugia_deta', 'hoja_cirugia_deta.num_servicio', '=', 'hoja_cirugia.num_servicio')
            ->leftjoin('sis_medi', 'sis_medi.codigo', '=', 'hoja_cirugia.cod_medico')
            ->leftjoin('sis_medi as sis_medi2', 'sis_medi2.codigo', '=', 'hoja_cirugia.cod_medico_b')
            ->leftjoin('sis_medi as anes', 'anes.codigo', '=', 'hoja_cirugia.cod_anaste')
            ->leftjoin('quirofano', 'quirofano.codigo', '=', 'hoja_cirugia.sala_cirugia')
            ->leftjoin('sis_maes', 'sis_maes.con_estudio', '=', 'hoja_cirugia.estudio')
            ->leftjoin('sis_paci', 'sis_paci.autoid', '=', 'sis_maes.autoid')
            ->leftjoin('contratos', 'contratos.codigo', '=', 'sis_maes.contrato')
            ->where('hoja_cirugia.estudio', $studie->con_estudio)
            ->where('hoja_cirugia.anulado', '!=', 1)
            ->where('quirofano.codigo', '!=', 6)
            ->whereNotNull('hoja_cirugia_deta.id')
            ->whereNotNull('hoja_cirugia_deta.cod_cirugia')
            ->select(DB::raw('CONVERT(VARCHAR(20), hoja_cirugia_deta.id) AS id_tabla'), 'hoja_cirugia.estudio', 'hoja_cirugia.num_servicio', DB::raw('CONVERT(DATE, hoja_cirugia.fecha) AS Fecha'), 'hoja_cirugia.horaini', 'hoja_cirugia.horafin', 'hoja_cirugia.duracion',
                'hoja_cirugia.cod_medico', 'sis_medi.cedula', 'sis_medi.nombre', 'hoja_cirugia.cod_medico_b', 'sis_medi2.cedula', 'sis_medi2.nombre', 'hoja_cirugia.cod_anaste',
                'anes.cedula', 'anes.nombre', 'hoja_cirugia.cod_ayudante', 'hoja_cirugia.cod_instrumentador', 'hoja_cirugia.cod_rotador', 'sis_paci.NombreCompleto', 'quirofano.nomgrupo',
                'sis_maes.contrato', 'contratos.nombre', 'hoja_cirugia_deta.cod_cirugia', 'hoja_cirugia_deta.nom_cirugia', 'hoja_cirugia_deta.tipo_rea')
            ->orderBy('hoja_cirugia.fecha')
            ->orderBy('hoja_cirugia.horaini')
            ->get();

        //dd($surgeries);
        $quantyProcedures = $surgeries->count();
        $category = "";
        if ($quantyProcedures == 1) {
            $category = "1 Proced";
        }elseif ($quantyProcedures > 1) {
            $category = "Mult Proced";
        }

        $count = 0;
        foreach ($surgeries as $surgery) 
        {
            $validate_service = sis_deta::where('sis_deta.num_servicio',  $surgery->num_servicio) 
            ->join('sis_maes', 'sis_maes.con_estudio', '=', 'sis_deta.estudio')
            ->join('hcingres', 'hcingres.con_estudio', '=', 'sis_deta.estudio')
            ->where('sis_deta.tipo_qx', 1)
            ->where('sis_maes.estado', 'C')
            ->where('sis_deta.total', '>', 0)
            ->select('sis_deta.id', 'sis_deta.num_servicio', 'sis_deta.cod_servicio', 'sis_deta.descripcion', 'sis_deta.porcentaje', 'sis_deta.codigo_cirugia', 'sis_deta.tipo', 'sis_deta.total', 'sis_deta.codigo_paquete', 'sis_maes.estado')
            ->first();

            if ($validate_service) {
                //Log::info("Registrado ". $surgerie->Fecha . " " . $surgerie->Estudio . " " . $surgerie->CodActoQ . " " . $cantidad);
                $Medico2 = ($surgery->cod_medico_b === "" || $surgery->cod_medico_b === "0") ? NULL : $surgery->cod_medico_b;
                $Anestes = ($surgery->cod_anaste === "" || $surgery->cod_anaste === "0") ? NULL : $surgery->cod_anaste;
                $cod_helper = ($surgery->cod_ayudante === "") ? 0 : $surgery->cod_ayudante;
                $cod_instrumentator = ($surgery->cod_instrumentador === "") ? 0 : $surgery->cod_instrumentador;
                $cod_rotator = ($surgery->cod_rotador === "") ? 0 : $surgery->cod_rotador;
    
                if ($surgery->duracion === "NaN") {
                    $surgery->duracion = Carbon::parse($surgery->HoraF)->diffInMinutes(Carbon::parse($surgery->HoraI));
                }
                $existingSurgeries = Surgery::where('cod_surgical_act', $surgery->num_servicio)->first();
                if ($existingSurgeries) {              
                    //Se valida si hay cambios
                    $validate = Surgery::where('cod_surgical_act', $surgery->num_servicio)
                    ->where('date_surgery', $surgery->Fecha)->where('start_time', $surgery->horaini)
                    ->where('end_time', $surgery->horafin)->where('surgeryTime', $surgery->duracion)
                    ->where('operating_room', $surgery->nomgrupo)->where('study_number', $surgery->estudio)
                    ->where('patient', $surgery->NombreCompleto)->where('id_doctor', $surgery->Medico)
                    ->where('id_doctor2', $Medico2)->where('id_anesthesiologist', $Anestes)
                    ->where('cod_helper', (int) $cod_helper)->where('cod_instrumentator', (int) $cod_instrumentator)
                    ->where('cod_rotator', (int) $cod_rotator)->where('category', $category)
                    ->where('code_contract', $surgery->contrato)->where('name_contract', $surgery->nombre)
                    ->first();
                    //dd($validate);
                    // Actualiza los datos del procedimiento    
                    if (!$validate) {
                        $existingSurgeries->update(
                        [
                            'date_surgery' => $surgery->Fecha, 
                            'start_time' => $surgery->horaini,
                            'end_time' => $surgery->horafin,
                            'surgeryTime' => $surgery->duracion,
                            'operating_room' => $surgery->nomgrupo,
                            'cod_surgical_act' => $surgery->num_servicio,
                            'study_number' => $surgery->estudio,
                            'patient' => $surgery->NombreCompleto,
                            'id_doctor' => $surgery->cod_medico,
                            'id_doctor2' => $Medico2,
                            'id_anesthesiologist' => $Anestes,
                            'cod_helper' => (int) $cod_helper,
                            'cod_instrumentator' => (int) $cod_instrumentator,
                            'cod_rotator' => (int) $cod_rotator,
                            'category' => $category,
                            'code_contract' => $surgery->contrato,
                            'name_contract' => $surgery->nombre
                        ]);
                    }  
                    $this->addProcedures($surgery);
                    $this->addBasket($surgery->num_servicio, $surgery->estudio, $surgery->nomgrupo);
                }else {
                    Surgery::create(
                    [
                        'date_surgery' => $surgery->Fecha, 
                        'start_time' => $surgery->horaini,
                        'end_time' => $surgery->horafin,
                        'surgeryTime' => $surgery->duracion,
                        'operating_room' => $surgery->nomgrupo,
                        'cod_surgical_act' => $surgery->num_servicio,
                        'study_number' => $surgery->estudio,
                        'patient' => $surgery->NombreCompleto,
                        'id_doctor' => $surgery->cod_medico,
                        'id_doctor2' => $Medico2,
                        'id_anesthesiologist' => $Anestes,
                        'cod_helper' => (int) $cod_helper,
                        'cod_instrumentator' => (int) $cod_instrumentator,
                        'cod_rotator' => (int) $cod_rotator,
                        'category' => $category,
                        'code_contract' => $surgery->contrato,
                        'name_contract' => $surgery->nombre
                    ]);
                    $this->addProcedures($surgery);
                    $this->addBasket($surgery->num_servicio, $surgery->estudio, $surgery->nomgrupo);
                }
            }
        } 
    }

    public function moreSurgeries($studie)
    {
        Log::info("VARIOS ACTOS QUIRURGICOS " . $studie->con_estudio);
    }


    public function addBasket($codActQ, $study, $opRoom)
    {
        $bodega = "";
        switch ($opRoom) {
            case 'QUIROFANO 1':
            case 'QUIROFANO 2':
            case 'QUIROFANO 3':
            case 'QUIROFANO 4':
            case 'QUIROFANO 5':
                $bodega = "BODEGA CIRUGIA";
                break;
            case 'SALA DE ENDOSCOPIAS':
                $bodega = "BODEGA CONSULTA EXTERNA";
                break;
            case "SALA DE PROCEDIMIENTOS IMAGENOLOGIA":
                $bodega = "IMAGENOLOGIA";
                break;
            case "HEMODINAMIA":
                $bodega = "HEMODINAMIA";
                break;
        }

        $results = movStock::leftjoin('sis_deta', function ($join) {
                $join->on('sis_deta.id', '=', 'movStock.servicio')
                    ->on('sis_deta.cod_servicio', '=', 'movStock.articulo');
                })
            ->where('movStock.estudio', $study)
            ->where('movStock.revertido', 0)
            ->where(DB::raw('(SELECT nombre FROM sis_costo WHERE codigo = movStock.ccorigen)'), $bodega)
            ->select('movStock.estudio', DB::raw('(SELECT nombre FROM sis_costo WHERE codigo = movStock.ccorigen) AS Bodega_origen'), 'movStock.articulo', 'movStock.cantidad',
            DB::raw(
                'CASE WHEN
                    (SELECT TOP 1 observacion from orden_enfer WHERE numero = movStock.nro_orden AND tipo_transaccion = 15) IS NOT NULL
                    THEN CAST(1 AS BIT)
                    ELSE CAST(0 AS BIT)
                END AS Reutilizar_insumo,
                CONVERT(DATE, movStock.fecha) AS Fecha'))
            ->get();
        //dd($results);
        
        foreach ($results as $result) {
            $basketCost = 0;
            $existingBasket = Basket::where('id_article', $result->articulo)
                                    ->where('surgical_act', $codActQ)->first();
            $quantity = $result->cantidad;
            if($quantity > 0 && $quantity < 1)
            {
                $quantity = 1;
            }elseif ($quantity > 100) {
                $concentration = articulos::where('codigo', $result->articulo)->first();
                if ($quantity < $concentration->cantidad_concentrada) {
                    $quantity = 1;
                }elseif ($quantity >= $concentration->cantidad_concentrada) {
                    $quantity = (int) ($quantity/$concentration->cantidad_concentrada);
                }
            }
            Log::info($result->articulo);
            $article = Articles::where('item_code', $result->articulo)->first();
            $value_article = $article->last_cost;
            if ($value_article == 1) {
                $value_article = $article->average_cost;
            }
            if ($article->usage_quantity > 0) {
                $basketCost = ($value_article/$article->usage_quantity) * $quantity;
            }else {
                $basketCost = $quantity * $value_article;
            }
            
            if ($existingBasket) {   
                $validate = Basket::where('store', $bodega)
                ->where('item_quantity', $quantity)
                ->where('reusable', $result->Reutilizar_insumo)
                ->where('article_cost', $basketCost)
                ->where('id_article', $result->articulo)
                ->where('surgical_act', $codActQ)
                ->first();
                if (!$validate) {
                    $existingBasket->update(
                    [
                        'store' => $bodega,
                        'item_quantity' => $quantity,
                        'reusable' => $result->Reutilizar_insumo,
                        'article_cost' => $basketCost,
                        'id_article' => $result->articulo,
                        'surgical_act' => $codActQ
                    ]);       
                }
            }else {
                Basket::create(
                [
                    'store' => $bodega,
                    'item_quantity' => $quantity,
                    'reusable' => $result->Reutilizar_insumo,
                    'article_cost' => $basketCost,
                    'id_article' => $result->articulo,
                    'surgical_act' => $codActQ
                ]);
            }
        }
    }

    public function addProcedures($surgery)
    {
        //dd($surgery);
        $procedure = $this->validateProcedure($surgery->cod_cirugia, $surgery->cod_medico, $surgery->num_servicio);
        $existingProcedure = Msurgery_procedure::where('cod_surgical_act', $surgery->num_servicio)
        ->where('code_procedure', $procedure->id)->first();
        
        $observation = "";
        if ($procedure->code === '0') {
            $observation = $surgery->cod_cirugia;
            $existingProcedure = Msurgery_procedure::where('cod_surgical_act', $surgery->num_servicio)
                ->where('code_procedure', $procedure->id)
                ->where('observation', $observation)->first();
            
        }

        if ($existingProcedure) {
            $existingProcedure->update(
            [
                'amount' => 1,
                'type' => $surgery->tipo_rea,
                'cod_surgical_act' => $surgery->num_servicio,
                'code_procedure' => $procedure->id,
                'observation' => $observation
            ]);
        }else {
            Msurgery_procedure::create(
            [
                'amount' => 1,
                'type' => $surgery->tipo_rea,
                'cod_surgical_act' => $surgery->num_servicio,
                'code_procedure' => $procedure->id,
                'observation' => $observation
            ]);
        }
    }

    public function validateProcedure($procedure, $doctor, $codActQ)
    {
        Log::info("Surgery: " . $procedure . " " . $doctor. " ". $codActQ);
        //Datos del médico
        $doctor = Doctors::where('code', $doctor)->first();
        //Datos de los honorarios médicos
        $fees = Medical_fees::where('honorary_code', $doctor->id_fees)->first();
        //Procedimiento correspondiente
        if (!$fees) {
            $fees = Medical_fees::where('honorary_code', 13)->first();
        }
        $procedures = Procedures::where('code', $procedure)
        ->where('manual_type', $fees->fees_type)->first();
        Log::info("Procedures: " . $procedures);
        if (!$procedures) {
            $procedures = Procedures::where('cups', $procedure)
            ->where('manual_type', $fees->fees_type)->first();
            if (!$procedures) {
                $procedures = Procedures::where('code', '0')
                ->where('cups', '0')->first();
                //Log::info("Procedures: " . $procedures);
            }
        }
        return $procedures;
    }
}
