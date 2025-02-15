<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\imaging_production;
use App\Models\procedures;
use App\Models\doctors;
use App\Models\medical_fees;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class imagingProdImport implements ToModel, WithHeadingRow
{
    public $messages = [];

    public function __construct()
    {
        $this->messages = collect(); // Inicializa la propiedad $messages como una colección vacía
    }

    public function model(array $row)
    {
        //dd($row);
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        
        $firstName = $row['primer_nombre'] ?? '';
        $SecondName = $row['segundo_nombre'] ?? '';
        $firstLastName = $row['primer_apellido'] ?? '';
        $secondLastName = $row['segundo_apellido'] ?? '';
        $fullName = trim($firstName . ' ' . $SecondName . ' ' . $firstLastName . ' ' . $secondLastName);
        $date = Carbon::createFromFormat('d/m/Y', $row['fecha_solicitud'])->format('Y-m-d');
        //Procedimiento correspondiente
        $cups = (string) $row['cups'];
        
        $doctor = Doctors::where('dni', (string) $row['identificacion_medico'])->first();
        if (is_null($doctor)) {
            $identificacionMedico = $row['identificacion_medico'];
            if (!$this->messages->contains('Medico: ' . $identificacionMedico . ' - ' . $fullName)) {
                $this->messages->push('Medico: ' . $identificacionMedico . ' - ' . $fullName);
            }
        }else {
            $validateProcedure = $this->validateProcedure($cups, $doctor);
            $existing_prod = Imaging_production::where('cups', $validateProcedure->id)
            ->where('dni_patient', $row['identificacion'])
            ->where('date', $date)
            ->where('hour', $row['hora_estudio'])
            ->first();
            if ($existing_prod) {
                $existing_prod->update([
                    'go_study' => $row['numero_de_estudio'],
                    'id_order' => $row['id_orden'],
                    'modality' => $row['modalidad'],
                    'dni_patient' => $row['identificacion'],
                    'name_patient' => $fullName,
                    'income' => $row['servicio'],
                    'contract' => $row['empresa'],
                    'date' => $date,
                    'hour' => $row['hora_estudio'],
                    'cod_medi' => $doctor->code,
                    'cups' => $validateProcedure->id
                ]);
                return $existing_prod;
            }else {
                return new Imaging_production([
                    'go_study' => $row['numero_de_estudio'],
                    'id_order' => $row['id_orden'],
                    'modality' => $row['modalidad'],
                    'dni_patient' => $row['identificacion'],
                    'name_patient' => $fullName,
                    'income' => $row['servicio'],
                    'contract' => $row['empresa'],
                    'date' => $date,
                    'hour' => $row['hora_estudio'],
                    'cod_medi' => $doctor->code,
                    'cups' => $validateProcedure->id
                ]);
            }
        }
    }

    public function validateProcedure($procedure, $doctor)
    {
        //Datos de los honorarios médicos
        $fees = Medical_fees::where('honorary_code', $doctor->id_fees)->first();
        //Procedimiento correspondiente
        $procedures = Procedures::where('code', $procedure)
        ->where('manual_type', $fees->fees_type)->first();
        if (!$procedures) {
            $procedures = Procedures::where('cups', $procedure)
            ->where('manual_type', $fees->fees_type)->first();
            if (!$procedures) {
                $procedures = Procedures::where('code', '0')->first();
                //Log::info("Procedures: " . $procedures);
            }
        }
        return $procedures;
    }
}

