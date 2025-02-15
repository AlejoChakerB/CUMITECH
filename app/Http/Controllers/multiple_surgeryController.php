<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createmultiple_surgeryRequest;
use App\Http\Requests\Updatemultiple_surgeryRequest;
use App\Repositories\multiple_surgeryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

use Carbon\Carbon;
use App\Models\doctors;
use App\Models\labour;
use App\Models\procedures;
use App\Models\basket;
use App\Models\surgery;
use App\Models\medical_fees;
use App\Models\msurgery_procedure;
use App\Models\multiple_surgery;

class multiple_surgeryController extends AppBaseController
{
    /** @var multiple_surgeryRepository $multipleSurgeryRepository*/
    private $multipleSurgeryRepository;

    public function __construct(multiple_surgeryRepository $multipleSurgeryRepo)
    {
        $this->multipleSurgeryRepository = $multipleSurgeryRepo;
    }

    /**
     * Display a listing of the multiple_surgery.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $multipleSurgeries = $this->multipleSurgeryRepository->all();

        return view('multiple_surgeries.index')
            ->with('multipleSurgeries', $multipleSurgeries);
    }

    /**
     * Show the form for creating a new multiple_surgery.
     *
     * @return Response
     */
    public function create()
    {
        return view('multiple_surgeries.create');
    }

    /**
     * Store a newly created multiple_surgery in storage.
     *
     * @param Createmultiple_surgeryRequest $request
     *
     * @return Response
     */
    public function store(Createmultiple_surgeryRequest $request)
    {
        $input = $request->all();

        $multipleSurgery = $this->multipleSurgeryRepository->create($input);

        Flash::success('Multiple Surgery saved successfully.');

        return redirect(route('multipleSurgeries.index'));
    }

    /**
     * Display the specified multiple_surgery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            Flash::error('Multiple Surgery not found');

            return redirect(route('multipleSurgeries.index'));
        }

        return view('multiple_surgeries.show')->with('multipleSurgery', $multipleSurgery);
    }

    /**
     * Show the form for editing the specified multiple_surgery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            Flash::error('Multiple Surgery not found');

            return redirect(route('multipleSurgeries.index'));
        }

        return view('multiple_surgeries.edit')->with('multipleSurgery', $multipleSurgery);
    }

    /**
     * Update the specified multiple_surgery in storage.
     *
     * @param int $id
     * @param Updatemultiple_surgeryRequest $request
     *
     * @return Response
     */
    public function update($id, Updatemultiple_surgeryRequest $request)
    {
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            Flash::error('Multiple Surgery not found');

            return redirect(route('multipleSurgeries.index'));
        }

        $multipleSurgery = $this->multipleSurgeryRepository->update($request->all(), $id);

        Flash::success('Multiple Surgery updated successfully.');

        return redirect(route('multipleSurgeries.index'));
    }

    /**
     * Remove the specified multiple_surgery from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $multipleSurgery = $this->multipleSurgeryRepository->find($id);

        if (empty($multipleSurgery)) {
            Flash::error('Multiple Surgery not found');

            return redirect(route('multipleSurgeries.index'));
        }

        $this->multipleSurgeryRepository->delete($id);

        Flash::success('Multiple Surgery deleted successfully.');

        return redirect(route('multipleSurgeries.index'));
    }

    public function getmsurgeries(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $studies = DB::connection('SismaSalud')->select("SELECT estudio, COUNT(*) AS num_servicio
            FROM(
                SELECT sm.con_estudio AS estudio
                FROM sis_maes sm
                LEFT JOIN hoja_cirugia hc ON hc.estudio = sm.con_estudio
                WHERE CONVERT(DATE, sm.fecha_ing) >= ?
                AND CONVERT(DATE, sm.fecha_ing) <= ?
                AND hc.fecha_anulado IS NULL
                AND hc.anulado != 1
                AND sm.estado = 'C'
            )AS subconsulta
            GROUP BY estudio
            ORDER BY num_servicio
        ",[$start_date, $end_date]);

         // Filtrar los resultados donde CantidadCodActQ es igual a 1
         $datas = array_filter($studies, function ($study) {
            return $study->num_servicio == 1;
        });

        foreach ($datas as $data) {

            // Buscamos cuantos procedimientos tiene asociado cada estudio
            //Tablas utilizadas: hoja_cirugia, hoja_cirugia_deta
            $services = DB::connection('SismaSalud')->select("SELECT CodActoQ,
                COUNT(*) AS procedimientos
                FROM (
                SELECT hc.num_servicio AS CodActoQ
                FROM hoja_cirugia hc
                LEFT JOIN hoja_cirugia_deta hcd ON hcd.num_servicio = hc.num_servicio
                    WHERE hc.estudio = ?
                    AND hc.fecha_anulado IS NULL
			        AND hc.anulado != 1
                ) AS Subconsulta
                GROUP BY CodActoQ
                ORDER BY procedimientos
            ", [$data->estudio]);
            
            foreach ($services as $service) {
                $codActQ = $service->CodActoQ;
                $package = DB::connection('SismaSalud')->select("SELECT * FROM sis_deta 
                    WHERE num_servicio = ?
                    AND tipo_qx = 1
                    AND total > 0 AND codigo_paquete IS NOT NULL
                ", [$codActQ]);

                if ($service->procedimientos >= 2 && !$package) {
                    $surgeries = DB::connection('SismaSalud')->select("SELECT CONVERT(VARCHAR(20), hcd.id) AS id_tabla,
                        hc.estudio AS Estudio, hc.num_servicio AS CodActoQ, CONVERT(DATE, hc.fecha) AS Fecha, hc.horaini AS HoraI, hc.horafin AS HoraF,
                        hc.duracion, hc.cod_medico AS Medico, sm.cedula AS CedulaMD1, sm.nombre AS Nombre,
                        hc.cod_medico_b AS Medico_2, sm2.cedula AS CedulaMD2, sm2.nombre, hc.cod_anaste AS Anestesiologo,
                        anes.cedula AS CedulaAn, anes.nombre AS NombreAn, hc.cod_ayudante, hc.cod_instrumentador,
                        hc.cod_rotador, smaes.autoid, spaci.NombreCompleto, 
                        spaci.nro_historia, NULL AS ns_corregido, CONVERT(VARCHAR(10), hc.sala_cirugia) AS sala_cirugia,
                        qf.nomgrupo, hcd.cod_cirugia AS Procedimiento, hcd.nom_cirugia AS Descripcion,
                        1 AS CantidadP,
                        CASE
                        WHEN hc.anulado = 1
                            THEN hc.fecha_anulado
                        ELSE NULL
                        END AS fecha_anulado,
						hcd.tipo_rea
                            FROM hoja_cirugia hc
                            LEFT JOIN
                                hoja_cirugia_deta hcd ON hcd.num_servicio = hc.num_servicio
                            LEFT JOIN 
                                sis_medi sm ON sm.codigo = hc.cod_medico
                            LEFT JOIN 
                                sis_medi sm2 ON sm2.codigo = hc.cod_medico_b
                            LEFT JOIN 
                                sis_medi anes ON anes.codigo = hc.cod_anaste
                            LEFT JOIN
                                quirofano qf ON qf.codigo = hc.sala_cirugia
                            LEFT JOIN
                                sis_maes smaes ON smaes.con_estudio = hc.estudio
                            LEFT JOIN
                                sis_paci spaci ON spaci.autoid = smaes.autoid
                            WHERE hc.num_servicio = ?
                            AND hc.fecha_anulado IS NULL
                            AND hc.anulado != 1
                            AND qf.codigo != 6
                            ORDER BY fecha, HoraI DESC
                    ", [$codActQ]);
                    //dd($surgeries);
                    
                    $count = 0;
                    foreach ($surgeries as $surgery) {
                        $count++;
                        $Medico2 = $surgery->Medico_2;
                        $Anestes = $surgery->Anestesiologo;
                        $cod_helper = $surgery->cod_ayudante;
                        $cod_instrumentator = $surgery->cod_instrumentador;
                        $cod_rotator = $surgery->cod_rotador;
                        $Medico2 = ($Medico2 === "" || $Medico2 === "0") ? NULL : $Medico2;
                        $Anestes = ($Anestes === "" || $Anestes === "0") ? NULL : $Anestes;
                        $cod_helper = ($cod_helper === "") ? 0 : $cod_helper;
                        $cod_instrumentator = ($cod_instrumentator === "") ? 0 : $cod_instrumentator;
                        $cod_rotator = ($cod_rotator === "") ? 0 : $cod_rotator;
                        if ($surgery->duracion === "NaN") {
                            $surgery->duracion = Carbon::parse($surgery->HoraF)->diffInMinutes(Carbon::parse($surgery->HoraI));
                        }
                        if ($count < 2) {
                            //dd($Anestes);
                            //Se valida que el procedimiento esté registrado
                            $existingSurgeries = Multiple_surgery::where('mcod_surgical_act', $codActQ)->first();
                            $doctors = Doctors::where('code', $surgery->Medico)->first();
                            if ($existingSurgeries && $doctors->category_doctor !== "Medico General") {              
                                // Actualiza los datos del la cirugia    
                                $existingSurgeries->mdate_surgery = $surgery->Fecha;   
                                $existingSurgeries->mstart_time = $surgery->HoraI;
                                $existingSurgeries->mend_time = $surgery->HoraF;
                                $existingSurgeries->msurgery_time = $surgery->duracion;
                                $existingSurgeries->moperating_room = $surgery->nomgrupo;
                                $existingSurgeries->mcod_surgical_act = $codActQ;
                                $existingSurgeries->mstudy_number = $surgery->Estudio;
                                $existingSurgeries->patient = $surgery->NombreCompleto;
                                $existingSurgeries->id_doctor = $surgery->Medico;
                                $existingSurgeries->id_doctor2 = $Medico2;
                                $existingSurgeries->id_anesth = $Anestes;
                                $existingSurgeries->category = "1,1,1";
                                $existingSurgeries->cod_helper = (int) $cod_helper;
                                $existingSurgeries->cod_instrumentator = (int) $cod_instrumentator;
                                $existingSurgeries->cod_rotator = (int) $cod_rotator;
                                $existingSurgeries->save();
                            }else {
                                if ($doctors->category_doctor !== "Medico General") {
                                    $newSurgery = new Multiple_surgery();
                                    $newSurgery->mdate_surgery = $surgery->Fecha;
                                    $newSurgery->mstart_time = $surgery->HoraI;
                                    $newSurgery->mend_time = $surgery->HoraF;
                                    $newSurgery->msurgery_time = $surgery->duracion;
                                    $newSurgery->moperating_room = $surgery->nomgrupo;
                                    $newSurgery->mcod_surgical_act = $codActQ;
                                    $newSurgery->mstudy_number = $surgery->Estudio;
                                    $newSurgery->patient = $surgery->NombreCompleto;
                                    $newSurgery->id_doctor = $surgery->Medico;
                                    $newSurgery->id_doctor2 = $Medico2;
                                    $newSurgery->id_anesth = $Anestes;
                                    $newSurgery->category = "1,1,*";
                                    $newSurgery->cod_helper = (int) $cod_helper;
                                    $newSurgery->cod_instrumentator = (int) $cod_instrumentator;
                                    $newSurgery->cod_rotator = (int) $cod_rotator;
                                    $newSurgery->save();
                                }
                            }
                        }
                        $this->addProcedures($surgery);
                        $this->addBasket($codActQ, $surgery->Estudio, $surgery->nomgrupo);
                    }
                }
            }
        }
        return redirect(route('multipleSurgeries.index'));
    }

    public function addProcedures($surgery)
    {
        //dd($surgery);
        $procedure = $this->validateProcedure($surgery->Procedimiento, $surgery->Medico, $surgery->CodActoQ);
        $existingProcedure = Msurgery_procedure::where('mcod_surgical_act', $surgery->CodActoQ)
                ->where('code_procedure', $procedure)->first();

            if ($existingProcedure) {
                $existingProcedure->amount = $surgery->CantidadP;
                $existingProcedure->type = $surgery->tipo_rea;
                $existingProcedure->mcod_surgical_act = $surgery->CodActoQ;
                $existingProcedure->code_procedure = $this->validateProcedure($surgery->Procedimiento, $surgery->Medico, $surgery->CodActoQ);
                $existingProcedure->save();
            }else {
                $newProcedure = new Msurgery_procedure();
                $newProcedure->amount = $surgery->CantidadP;
                $newProcedure->type = $surgery->tipo_rea;
                $newProcedure->mcod_surgical_act = $surgery->CodActoQ;
                $newProcedure->code_procedure = $this->validateProcedure($surgery->Procedimiento, $surgery->Medico, $surgery->CodActoQ);
                $newProcedure->save();
            }
        
    }

    public function validateProcedure($procedure, $doctor, $codActQ)
    {
        //Log::info("Surgery: " . $procedure . " " . $doctor. " ". $codActQ);
        //Datos del médico
        $doctor = Doctors::where('code', $doctor)->first();
        //Datos de los honorarios médicos
        $fees = Medical_fees::where('honorary_code', $doctor->id_fees)->first();
        //Procedimiento correspondiente
        $procedures = Procedures::where('code', $procedure)
        ->where('manual_type', $fees->fees_type)->first();

        if (!$procedures) {
            $procedures = Procedures::where('cups', $procedure)
            ->where('manual_type', $fees->fees_type)->first();
        }
        return $procedures->id;
    }

    public function addBasket($codActQ, $study, $opRoom)
    {
        $results = DB::connection('SismaSalud')->select("SELECT
            ms.estudio AS Estudio,
            (SELECT nombre FROM sis_costo WHERE codigo = ms.ccorigen) AS Bodega_origen,
            ms.articulo AS Articulo,
            ms.cantidad AS Cantidad,
            CASE WHEN
            (SELECT TOP 1 observacion from orden_enfer WHERE numero = ms.nro_orden AND tipo_transaccion = 15) IS NOT NULL
            THEN CAST(1 AS BIT) 
            ELSE CAST(0 AS BIT)   
            END AS Reutilizar_insumo,
            CONVERT(DATE, ms.fecha) AS Fecha
            FROM movStock ms 
            LEFT JOIN sis_deta AS sd ON sd.id = ms.servicio AND sd.cod_servicio = ms.articulo
            WHERE ms.estudio = ?
            AND ms.revertido = 0
        ", [$study]);
        //dd($results, $study);
        $bodega = "";
        if ($opRoom === 'QUIROFANO 1' || $opRoom === 'QUIROFANO 2' || $opRoom === 'QUIROFANO 3' || $opRoom === 'QUIROFANO 4' || $opRoom === 'QUIROFANO 5') {
            $bodega = "BODEGA CIRUGIA";
        }elseif ($opRoom === 'SALA DE ENDOSCOPIAS') {
            $bodega = "BODEGA CONSULTA EXTERNA";
        }elseif ($opRoom === "SALA DE PROCEDIMIENTOS IMAGENOLOGIA") {
            $bodega = "IMAGENOLOGIA";
        }elseif ($opRoom === "HEMODINAMIA") {
            $bodega = "HEMODINAMIA";
        }

        foreach ($results as $result) {
            $existingBasket = Basket::where('id_article', $result->Articulo)
                                    ->where('surgical_act', $codActQ)->first();
            $quantity = $result->Cantidad;
            if($quantity > 0 && $quantity < 1)
            {
                $quantity = 1;
            }
            if ($existingBasket) {              
                // Actualiza los datos de la canasta    
                $existingBasket->store = $bodega;
                $existingBasket->item_quantity = $quantity;
                $existingBasket->reusable = $result->Reutilizar_insumo;
                $existingBasket->id_article = $result->Articulo;
                $existingBasket->surgical_act = $codActQ;
                $existingBasket->save();
            }else {
                $newBasket = new Basket();
                $newBasket->store = $bodega;
                $newBasket->item_quantity = $quantity;
                $newBasket->reusable = $result->Reutilizar_insumo;
                $newBasket->id_article = $result->Articulo;
                $newBasket->surgical_act = $codActQ;
                $newBasket->save();
            }
        }
    }
}
