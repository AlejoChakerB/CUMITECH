<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\employe;

class employeeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validateArray = array_map(function ($value) {
            return ($value === "") ? null : $value;
        }, $row);
        //dd($row);
        $existing_rate = employe::where('dni', $row['cedula'])->first();
        $employee_data = [
            'dni' => $row['cedula'],
            'name' => $row['nombre'],
            'work_position' => $row['cargo'],
            'unit' => 'otros',
            'cost_center' => $row['centro_de_costo'],
            'service'  => $row['centro_de_costo']
        ];

        if ($existing_rate) {
            $existing_rate->update($employee_data);
            $result = $existing_rate;
        } else {
            $result = employe::create($employee_data);
        }

        $this->getEmployees_sqlsrv($row['cedula']);

        return $result;
    }

    public function getEmployees_sqlsrv($dni_employe)
    {
        $result = Employe::where('dni', $dni_employe)->first();
        if ($result) {       
            $existing_sqlrv = \App\Models\CumiSystem_SQLSRV\Employe::where('dni', $result->dni)->first();
            //dd($dni_employe, $existing_sqlrv);
            $employee_data = [
                'dni' => $result->dni,
                'name' => $result->name,
                'work_position' => $result->work_position,
                'unit' => $result->unit,
                'cost_center' => $result->cost_center,
                'service' => $result->service
            ];
            
            if ($existing_sqlrv) {
                $existing_sqlrv->update($employee_data);
            } else {
                DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT employes ON');
                // Crear un nuevo registro
                $employee_data['id'] = $result->id;
                \App\Models\CumiSystem_SQLSRV\Employe::create($employee_data);
                DB::connection('cumisystem_sqlsrv')->unprepared('SET IDENTITY_INSERT employes OFF');
            }
        }
    }
}
