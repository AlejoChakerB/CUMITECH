<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function index()
    {
        $this->authorize('view_productions');
        return view('productions.index');
    }

    public function cextProduction()
    {
        $this->authorize('cextProduction_reportsbi');
        return view('productions.cextProduction');
    }

    public function imagingProduction()
    {
        $this->authorize('imagingProduction_reportsbi');
        return view('productions.imagingProduction');
    }

    public function surgeryProduction()
    {
        $this->authorize('surgeryProduction_reportsbi');
        return view('productions.surgeryProduction');
    }

    public function urgencyProduction()
    {
        $this->authorize('urgencyProduction_reportsbi');
        return view('productions.urgencyProduction');
    }

    public function endoscopyProduction()
    {
        $this->authorize('endoscopyProduction_reportsbi');
        return view('productions.endoscopyProduction');
    }

    public function utriocumiProduction()
    {
        $this->authorize('utriocumiProduction_reportsbi');
        return view('productions.utriocumiProduction');
    }
}
