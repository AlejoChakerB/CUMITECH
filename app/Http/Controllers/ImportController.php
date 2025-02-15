<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CalendarsImport;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');

        Excel::import(new CalendarsImport, $file);

        return redirect()->back()->with('success', 'Importación completada');
    }
}

