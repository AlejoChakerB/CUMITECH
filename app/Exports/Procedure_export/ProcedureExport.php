<?php

namespace App\Exports\Procedure_export;
use App\Models\log_operation_cost;
use App\Exports\Procedure_export\ProcedureExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProcedureExport implements WithMultipleSheets
{
    use Exportable;

    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        if ($this->input['options'] == 'All') {
            $surgeries = DB::table('log_operation_costs AS loc')
            ->join('surgeries AS qco', 'qco.cod_surgical_act', '=', 'loc.cod_surgical_act')
            ->join('unit_costs AS uc', 'uc.cod_surgical_act', '=', 'loc.cod_surgical_act')
            ->join('procedures AS proce', 'proce.id', '=', 'loc.code_procedure')
            ->leftJoin('doctors AS doc', 'doc.code', '=', 'qco.id_doctor')
            ->leftJoin('doctors AS doc2', 'doc2.code', '=', 'qco.id_doctor2')
            ->leftJoin('doctors AS anes', 'anes.code', '=', 'qco.id_anesthesiologist')
            ->select([
                'qco.name_contract AS Contrato',
                'qco.patient AS Paciente',
                'qco.study_number AS Estudio',
                'loc.cod_surgical_act AS Cod_acto_qco',
                'loc.id_fact AS Id_fact',
                'qco.date_surgery AS Fecha_cir',
                'qco.start_time AS Hora_ini',
                'qco.end_time AS Hora_fin',
                'qco.surgeryTime AS Tiempo',
                'doc.specialty AS Especialidad',
                'doc.full_name AS Medico',
                'doc2.full_name AS Medico2',
                'anes.full_name AS Anestesiologo',
                'qco.operating_room AS Sala',
                'proce.code AS Codigo',
                'proce.description AS Descripcion',
                'loc.cod_package AS Cod_paq',
                'loc.value_liquidated AS Valor_fact',
                'loc.percentage_parti AS Porc_partic',
                'loc.doctor_percentage AS Porc_liquida',
                'loc.doctor_fees AS Hon_medico',
                'loc.doctor2_fees AS Hon_medico2',
                'loc.anest_fees AS Hon_anestes',
                'loc.room_cost AS Costo_sala',
                DB::raw('uc.basket * loc.percentage_parti AS Canasta'),
                DB::raw('uc.consumables * loc.percentage_parti AS Consumibles'),
                DB::raw('uc.rented * loc.percentage_parti AS Equipos_rentados'),
                'loc.gases AS Gases',
                'loc.dist_package AS Distrib_paq',
                DB::raw('(loc.doctor_fees + loc.doctor2_fees + loc.anest_fees + loc.room_cost + uc.basket * loc.percentage_parti + uc.consumables * loc.percentage_parti + uc.rented * loc.percentage_parti + loc.gases + loc.dist_package) AS Total')
            ])
            ->get();

            $details = DB::table('log_operation_costs AS loc')
                ->join('surgeries AS qco', 'qco.cod_surgical_act', '=', 'loc.cod_surgical_act')
                ->join('unit_costs AS uc', 'uc.cod_surgical_act', '=', 'loc.cod_surgical_act')
                ->join('procedures AS proce', 'proce.id', '=', 'loc.code_procedure')
                ->leftJoin('doctors AS doc', 'doc.code', '=', 'qco.id_doctor')
                ->leftJoin('doctors AS doc2', 'doc2.code', '=', 'qco.id_doctor2')
                ->leftJoin('doctors AS anes', 'anes.code', '=', 'qco.id_anesthesiologist')
                ->select([
                    'proce.code AS Codigo',
                    'proce.description AS Descripcion',
                    'loc.cod_package AS Cod_paq',
                    'loc.percentage_parti AS Porc_partic',
                    'loc.doctor_percentage AS Porc_liquida',
                    DB::raw('COUNT(loc.id_fact) AS Cant'),
                    DB::raw('AVG(loc.value_liquidated) AS Valor_fact'),
                    DB::raw('AVG(loc.doctor_fees) AS Hon_medico'),
                    DB::raw('AVG(loc.doctor2_fees) AS Hon_medico2'),
                    DB::raw('AVG(loc.anest_fees) AS Hon_anestes'),
                    DB::raw('AVG(loc.room_cost) AS Costo_sala'),
                    DB::raw('AVG(uc.basket * loc.percentage_parti) AS Canasta'),
                    DB::raw('AVG(uc.consumables * loc.percentage_parti) AS Consumibles'),
                    DB::raw('AVG(uc.rented * loc.percentage_parti) AS Equipos_rentados'),
                    DB::raw('AVG(loc.gases) AS Gases'),
                    DB::raw('AVG(loc.dist_package) AS Distrib_paq'),
                    DB::raw('AVG(loc.doctor_fees +
                            loc.doctor2_fees +
                            loc.anest_fees +
                            loc.room_cost +
                            uc.basket * loc.percentage_parti +
                            uc.consumables * loc.percentage_parti +
                            uc.rented * loc.percentage_parti +
                            loc.gases +
                            loc.dist_package) AS Total')
                ])
                ->groupBy('proce.code', 'proce.description', 'loc.cod_package', 'loc.percentage_parti', 'loc.doctor_percentage')
                ->get();
        }else {
            //Armamos la consulta del costo de la cirugia
            $data_surgeries = log_operation_cost::query();
            $data_surgeries->select([
                'surgeries.name_contract AS Contrato',
                'surgeries.patient AS Paciente',
                'surgeries.study_number AS Estudio',
                'log_operation_costs.cod_surgical_act AS Cod_acto_qco',
                'log_operation_costs.id_fact AS Id_fact',
                'surgeries.date_surgery AS Fecha_cir',
                'surgeries.start_time AS Hora_ini',
                'surgeries.end_time AS Hora_fin',
                'surgeries.surgeryTime AS Tiempo',
                'doctors.specialty AS Especialidad',
                'doctors.full_name AS Medico',
                'doctors2.full_name AS Medico2',
                'anesthesiologists.full_name AS Anestesiologo',
                'surgeries.operating_room AS Sala',
                'procedures.code AS Codigo',
                'procedures.description AS Descripcion',
                'log_operation_costs.cod_package AS Cod_paq',
                'log_operation_costs.value_liquidated AS Valor_fact',
                'log_operation_costs.percentage_parti AS Porc_partic',
                DB::raw('(log_operation_costs.doctor_percentage/100) AS Porc_liquida'),
                'log_operation_costs.doctor_fees AS Hon_medico',
                'log_operation_costs.doctor2_fees AS Hon_medico2',
                'log_operation_costs.anest_fees AS Hon_anestes',
                'log_operation_costs.room_cost AS Costo_sala',
                DB::raw('unit_costs.basket * log_operation_costs.percentage_parti AS Canasta'),
                DB::raw('unit_costs.consumables * log_operation_costs.percentage_parti AS Consumibles'),
                DB::raw('unit_costs.rented * log_operation_costs.percentage_parti AS Equipos_rentados'),
                'log_operation_costs.gases AS Gases',
                'log_operation_costs.dist_package AS Distrib_paq',
                DB::raw('(log_operation_costs.doctor_fees +
                          log_operation_costs.doctor2_fees +
                          log_operation_costs.anest_fees +
                          log_operation_costs.room_cost +
                          unit_costs.basket * log_operation_costs.percentage_parti +
                          unit_costs.consumables * log_operation_costs.percentage_parti +
                          unit_costs.rented * log_operation_costs.percentage_parti +
                          log_operation_costs.gases +
                          log_operation_costs.dist_package) AS Total')
            ]);
            $data_surgeries->join('surgeries', 'surgeries.cod_surgical_act', '=', 'log_operation_costs.cod_surgical_act');
            $data_surgeries->join('unit_costs', 'unit_costs.cod_surgical_act', '=', 'log_operation_costs.cod_surgical_act');
            $data_surgeries->join('procedures', 'procedures.id', '=', 'log_operation_costs.code_procedure');
            $data_surgeries->leftJoin('doctors AS doctors', 'doctors.code', '=', 'surgeries.id_doctor');
            $data_surgeries->leftJoin('doctors AS doctors2', 'doctors2.code', '=', 'surgeries.id_doctor2');
            $data_surgeries->leftJoin('doctors AS anesthesiologists', 'anesthesiologists.code', '=', 'surgeries.id_anesthesiologist');
            
            if ($this->input['specialty']) {
                $data_surgeries->where('doctors.specialty', $this->input['specialty']);
            }
        
            if ($this->input['code']) {
                $data_surgeries->where('procedures.code', $this->input['code']);
            }
        
            if ($this->input['participe']) {
                $data_surgeries->where('log_operation_costs.percentage_parti', '>=', $this->input['participe']);
            }
        
            if ($this->input['Liquidation']) {
                $data_surgeries->where('log_operation_costs.doctor_percentage', '>=', $this->input['Liquidation']);
            }
            
            if ($this->input['start_date']) {
                $data_surgeries->whereDate('surgeries.date_surgery', '>=', $this->input['start_date']);
            }

            if ($this->input['end_date']) {
                $data_surgeries->whereDate('surgeries.date_surgery', '<=', $this->input['end_date']);
            }

            $surgeries = $data_surgeries->get();

            //Armamos la consulta del detalle del costo de la cirugia
            $data_details = log_operation_cost::query();
                $data_details->join('surgeries AS qco', 'qco.cod_surgical_act', '=', 'log_operation_costs.cod_surgical_act');
                $data_details->join('unit_costs AS uc', 'uc.cod_surgical_act', '=', 'log_operation_costs.cod_surgical_act');
                $data_details->join('procedures AS proce', 'proce.id', '=', 'log_operation_costs.code_procedure');
                $data_details->leftJoin('doctors AS doc', 'doc.code', '=', 'qco.id_doctor');
                $data_details->leftJoin('doctors AS doc2', 'doc2.code', '=', 'qco.id_doctor2');
                $data_details->leftJoin('doctors AS anes', 'anes.code', '=', 'qco.id_anesthesiologist');
                $data_details->select([
                    'proce.code AS Codigo',
                    'proce.description AS Descripcion',
                    'log_operation_costs.cod_package AS Cod_paq',
                    'log_operation_costs.percentage_parti AS Porc_partic',
                    DB::raw('(log_operation_costs.doctor_percentage/100) AS Porc_liquida'),
                    DB::raw('COUNT(log_operation_costs.id_fact) AS Cant'),
                    DB::raw('AVG(log_operation_costs.value_liquidated) AS Valor_fact'),
                    DB::raw('AVG(log_operation_costs.doctor_fees) AS Hon_medico'),
                    DB::raw('AVG(log_operation_costs.doctor2_fees) AS Hon_medico2'),
                    DB::raw('AVG(log_operation_costs.anest_fees) AS Hon_anestes'),
                    DB::raw('AVG(log_operation_costs.room_cost) AS Costo_sala'),
                    DB::raw('AVG(uc.basket * log_operation_costs.percentage_parti) AS Canasta'),
                    DB::raw('AVG(uc.consumables * log_operation_costs.percentage_parti) AS Consumibles'),
                    DB::raw('AVG(uc.rented * log_operation_costs.percentage_parti) AS Equipos_rentados'),
                    DB::raw('AVG(log_operation_costs.gases) AS Gases'),
                    DB::raw('AVG(log_operation_costs.dist_package) AS Distrib_paq'),
                    DB::raw('AVG(log_operation_costs.doctor_fees +
                              log_operation_costs.doctor2_fees +
                              log_operation_costs.anest_fees +
                              log_operation_costs.room_cost +
                              uc.basket * log_operation_costs.percentage_parti +
                              uc.consumables * log_operation_costs.percentage_parti +
                              uc.rented * log_operation_costs.percentage_parti +
                              log_operation_costs.gases +
                              log_operation_costs.dist_package) AS Total')
                ]);
            
                if ($this->input['specialty']) {
                    $data_details->where('doc.specialty', $this->input['specialty']);
                }

                if ($this->input['code']) {
                    $data_details->where('proce.code', $this->input['code']);
                }
            
                if ($this->input['participe']) {
                    $data_details->where('log_operation_costs.percentage_parti', '>=', $this->input['participe']);
                }
            
                if ($this->input['Liquidation']) {
                    $data_details->where('log_operation_costs.doctor_percentage', '>=', $this->input['Liquidation']);
                }

                if ($this->input['start_date']) {
                    $data_details->whereDate('qco.date_surgery', '>=', $this->input['start_date']);
                }
    
                if ($this->input['end_date']) {
                    $data_details->whereDate('qco.date_surgery', '<=', $this->input['end_date']);
                }

                $data_details->groupBy('proce.code', 'proce.description', 'log_operation_costs.cod_package', 'log_operation_costs.percentage_parti', 'log_operation_costs.doctor_percentage');
                $details = $data_details->get();

        }
        return [
            new FirstSheetExport($surgeries),
            new SecondSheetExport($details),
        ];
    }    
}
