<?php

namespace App\Exports\CumiLab;
use App\Models\cumiLab_rate;
use App\Exports\CumiLab\CumiLab_export;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CumiLab_export implements WithMultipleSheets
{
    use Exportable;

    public function __construct()
    {
        
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $cumiLabCost = DB::table('cumi_lab_rates as clr')
        ->leftJoinSub(
            DB::table('procedures')
                ->select('code', 'description')
                ->groupBy('code', 'description')
                ->limit(1),
            'pr',
            'pr.code',
            '=',
            'clr.cups'
        )
        ->select(
            'clr.cups',
            'pr.description',
            'clr.total_months',
            'clr.average_months',
            'clr.cumilab_rate',
            'clr.mutual_rate',
            'clr.pxq',
            DB::raw('(clr.part_percentage/100) AS part_percentage'),
            'clr.adminlog_percentage',
            'clr.cd_percentage',
            'clr.total'
        )
        ->whereNull('clr.deleted_at')
        ->get();

        $cumiLabProduc = DB::table('cumi_lab_rates as clr')
        ->join('procedures as pr', 'pr.code', '=', 'clr.cups')
        ->select(
            'clr.period', 
            'clr.cups', 
            'pr.description', 
            'clr.january', 
            'clr.february', 
            'clr.march', 
            'clr.april', 
            'clr.may', 
            'clr.june',
            'clr.july', 
            'clr.august', 
            'clr.september', 
            'clr.october', 
            'clr.november', 
            'clr.december'
        )
        ->where('pr.manual_type', '=', '256')
        ->whereNull('clr.deleted_at')
        ->get();

        //dd($cumiLabProduc);
        return [
            new FirstSheetExport($cumiLabCost),
            new SecondSheetExport($cumiLabProduc)
        ];
    }    
}
