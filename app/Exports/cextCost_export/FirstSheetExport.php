<?php

namespace App\Exports\cextCost_export;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Collection;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FirstSheetExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithTitle, WithColumnFormatting

{
    protected $input;

    public function __construct(Collection  $input)
    {
        $this->input = $input;
    }

    public function collection()
    {
        return new Collection($this->input);
    }

    public function headings(): array
    {
        return [
            'Especialidad',
            'Duración promedio',
            'Costo de sala',
            'Honorarios médicos',
            'Costo unitario'
        ];
    }

    public function title(): string
    {
        return 'Costo por especialidad';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'italic' => true]],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'E' como moneda
            'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'F' como moneda
            'E' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE, // Formatear columna 'G' como moneda
        ];
    }
}
