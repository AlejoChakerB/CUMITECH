<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedoctorsRequest;
use App\Http\Requests\UpdatedoctorsRequest;
use App\Repositories\doctorsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\medical_fees;
use App\Models\doctors;
use App\Models\SismaSalud\sis_especialidades;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;

class doctorsController extends AppBaseController
{
    /** @var doctorsRepository $doctorsRepository*/
    private $doctorsRepository;

    public function __construct(doctorsRepository $doctorsRepo)
    {
        $this->doctorsRepository = $doctorsRepo;
    }

    /**
     * Display a listing of the doctors.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view_doctors');
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $doctorsQuery = doctors::query();

        if (!empty($search)) {
            $doctorsQuery->where('dni', 'LIKE', '%' . $search . '%')
                    ->orWhere('full_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('category_doctor', 'LIKE', '%' . $search . '%')
                    ->orWhere('specialty', 'LIKE', '%' . $search . '%')
                    ->orWhere('payment_type', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%');
        }

        $doctors = $doctorsQuery->orderBy('full_name')->paginate($perPage);
        $total = doctors::count();
        $gen = doctors::where('category_doctor', 'Medico General')->count();
        $esp = doctors::where('category_doctor', 'Medico Especialista')->count();
        return view('doctors.index', compact('doctors', 'total', 'gen', 'esp'));
    }

    /**
     * Show the form for creating a new doctors.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create_doctors');
        $fees = Medical_fees::orderby('payment_manual')->pluck('payment_manual', 'honorary_code');
        $especiality = sis_especialidades::select('id', 'nombre')->orderby('nombre')->pluck('nombre','nombre');
        return view('doctors.create', compact('fees', 'especiality'));
    }

    /**
     * Store a newly created doctors in storage.
     *
     * @param CreatedoctorsRequest $request
     *
     * @return Response
     */
    public function store(CreatedoctorsRequest $request)
    {
        $this->authorize('create_doctors');
        $input = $request->all();
        //dd($input);
        $doctors = $this->doctorsRepository->create($input);

        session()->flash('success', "¡¡MÉDICO $request->full_name REGISTRADO CON EXITO!!");

        return redirect(route('doctors.index'));
    }

    /**
     * Display the specified doctors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('show_doctors');
        $doctors = $this->doctorsRepository->find($id);
        $payment = json_decode($doctors->payment);
        //dd($payment);
        if (empty($doctors)) {
            session()->flash('error', "¡¡MÉDICO NO ENCONTRADO!!");

            return redirect(route('doctors.index'));
        }

        return view('doctors.show', compact('doctors', 'payment'));
    }

    /**
     * Show the form for editing the specified doctors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update_doctors');
        $doctors = $this->doctorsRepository->find($id);
        $fees = Medical_fees::orderby('payment_manual')->pluck('payment_manual', 'honorary_code');
        $selectedItems = json_decode($doctors->payment);
        $especiality = sis_especialidades::select('id', 'nombre')->orderby('nombre')->pluck('nombre','nombre');
        if (empty($doctors)) {
            session()->flash('error', "¡¡MÉDICO NO ENCONTRADO!!");

            return redirect(route('doctors.index'));
        }

        return view('doctors.edit', compact('doctors', 'fees', 'selectedItems', 'especiality'));
    }

    /**
     * Update the specified doctors in storage.
     *
     * @param int $id
     * @param UpdatedoctorsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedoctorsRequest $request)
    {
        $this->authorize('update_doctors');
        $doctors = $this->doctorsRepository->find($id);
        //dd($request->all());
        if (empty($doctors)) {
            session()->flash('error', "¡¡MÉDICO NO ENCONTRADO!!");

            return redirect(route('doctors.index'));
        }

        $doctors = $this->doctorsRepository->update($request->all(), $id);

        session()->flash('success', "¡¡MÉDICO $request->full_name ACTUALIZADO CON EXITO!!");

        return redirect(route('doctors.index'));
    }

    /**
     * Remove the specified doctors from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('destroy_doctors');
        $doctors = $this->doctorsRepository->find($id);

        if (empty($doctors)) {
            session()->flash('error', "¡¡MÉDICO NO ENCONTRADO!!");

            return redirect(route('doctors.index'));
        }
        $name = $doctors->full_name;
        $this->doctorsRepository->delete($id);

        session()->flash('success', "¡¡MÉDICO $name ELIMINADO CORRECTAMENTE!!");

        return redirect(route('doctors.index'));
    }

    public function getDoctors()
    {
        $results = DB::connection('SismaSalud')->select("SELECT sm.codigo, sm.cedula, sm.nombre,
        se.desplegable AS Categoria, esp.nombre AS especialidad,
        sm.tipo_pago, sm.cod_manual_pago, smn.nombre AS manual_pago, smn.tipo, 
        sm.cod_manual_pago2, smn2.nombre AS manual_pago2, smn2.tipo AS tipo2
        FROM sis_medi sm
        INNER JOIN sis_especialidades esp ON esp.codigo = sm.especialidad
        RIGHT JOIN sismaelm se ON se.valor = sm.tipo
        LEFT JOIN sis_manual smn ON smn.codigo = sm.cod_manual_pago
        LEFT JOIN sis_manual smn2 ON smn2.codigo = sm.cod_manual_pago2
        WHERE se.tipo = 'PERSO'
        AND se.nro NOT IN (003, 004, 005)
        AND esp.id != 1
        AND sm.codigo NOT IN (1535)
        AND sm.es_medico = 1
        AND sm.estado = 1
        ORDER BY sm.codigo");
        //dd($results);
        foreach ($results as $result) {
            $codMPago = $result->cod_manual_pago;
            $codMPago2 = trim($result->cod_manual_pago2);
            Log::info($codMPago2);
            $codMPago = ($codMPago === '') ? NULL : $codMPago;
            $codMPago2 = ($codMPago2 === '') ? NULL : $codMPago2;
            //Se valida que el procedimiento esté registrado
            $existingDoctors = Doctors::where('dni', $result->cedula)->first();
            if ($existingDoctors) {              
                // Actualiza los datos del procedimiento    
                $existingDoctors->update(
                [
                    'code' => $result->codigo,
                    'dni' => $result->cedula,
                    'full_name' => $result->nombre,
                    'category_doctor' => $result->Categoria,
                    'specialty' => $result->especialidad,
                    'payment_type' => $result->tipo_pago,
                    'id_fees' => $codMPago,
                    'id_fees2' => $codMPago2  
                ]);
            }else {
                Doctors::create(
                [
                    'code' => $result->codigo,
                    'dni' => $result->cedula,
                    'full_name' => $result->nombre,
                    'category_doctor' => $result->Categoria,
                    'specialty' => $result->especialidad,
                    'payment_type' => $result->tipo_pago,
                    'id_fees' => $codMPago,
                    'id_fees2' => $codMPago2 
                ]);
            }
        }
        session()->flash('success', "¡¡MÉDICOS ACTUALIZADOS CORRECTAMENTE!!");
        return redirect(route('doctors.index'));
    }

    public function searchDoctors(Request $request)
    {
        $term = $request->input('term');
        $doctors = Doctors::where('full_name', 'like', "%$term%")->get();
        
        return response()->json($doctors);
    }

    public function searchSpecialty(Request $request)
    {
        $term = $request->input('term');
        $doctors = Doctors::select('specialty')
        ->where('specialty', 'like', "%$term%")
        ->groupby('specialty')
        ->orderby('specialty')
        ->get();

        return response()->json($doctors);
    }
}
