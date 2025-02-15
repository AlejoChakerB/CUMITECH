<?php

namespace App\Exports;
use App\Models\Employe;
use App\Models\Contracts;
use App\Exports\EmployeExport;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    private $period;
    private $year;

    public function __construct($period, $year)
    {
        $this->period = $period;
        $this->year = $year;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $threeMonthsAgo = now()->subMonths(3);

        if ($this->period == 'Abril') {
            $date = '2023-04-01';    
        } elseif ($this->period == 'Agosto') {
            $date = '2023-08-01'; 
        } elseif ($this->period == 'Diciembre') {
            $date = '2023-12-01'; 
        }        

        $endowment = DB::select("
        SELECT e.dni, e.name, e.work_position, e.cost_center, e.service
        FROM employes e
        LEFT JOIN contracts c ON e.id = c.employe_id
        WHERE e.id NOT IN (
            SELECT e.id
            FROM employes e
            LEFT JOIN contracts c ON e.id = c.employe_id
            LEFT JOIN endowments en ON c.id = en.contract_id
            WHERE en.period = ?
            AND YEAR(en.deliver_date) = ?
        )
        AND e.unit != 'Deshabilitado'
        AND (
            ? <> (SELECT MAX(period) FROM endowments)
            OR DATE_SUB(?, INTERVAL 3 MONTH) >= c.start_date_contract
        )
        AND c.salary < 2600000
        ORDER BY e.name;
        ", [$this->period, $this->year, $this->period, $date]);
        return new Collection($endowment);
    }

    public function headings(): array
    {
        return [
            'DNI',
            'NOMBRE',
            'PUESTO DE TRABAJO',
            'CENTRO DE COSTO',
            'SERVICIO'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }
}
