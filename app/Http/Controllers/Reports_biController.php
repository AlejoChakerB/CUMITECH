<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reports_biController extends Controller
{
    public function index()
    {
        $this->authorize('view_reportsbi');
        return view('reports_bi.index');
    }

    public function financial_report()
    {
        $this->authorize('financialReport_reportsbi');
        return view('reports_bi.financial_report');
    }

    public function financial_execution()
    {
        $this->authorize('financialExecution_reportsbi');
        return view('reports_bi.financial_execution');
    }

    public function pgp_ut_riocumi_projection()
    {
        $this->authorize('pgpUtriocumiProjection_reportsbi');
        return view('reports_bi.pgp_ut_riocumi_projection');
    }

    public function Pgp_ut_riocumi_planning()
    {
        $this->authorize('PgpUtRiocumiPlanning_reportsbi');
        return view('reports_bi.Pgp_ut_riocumi_planning');
    }

    public function occupation()
    {
        $this->authorize('occupation_reportsbi');
        return view('reports_bi.occupation');
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

    public function billingStatistic()
    {
        $this->authorize('billing_statistic_reportsbi');
        return view('reports_bi.billing_statistic');
    }

    public function reportCost()
    {
        $this->authorize('reportCost_reportsbi');
        return view('reports_bi.reportCost');
    }

    public function ponal_contract_cardiovascular()
    {
        $this->authorize('ponalContractCardiovascular_reportsbi');
        return view('reports_bi.ponal_contract_cardiovascular');
    }

    public function ut_ponal_hospital_emergency_contract()
    {
        $this->authorize('utPonalHospitalEmergencyContract_reportsbi');
        return view('reports_bi.ut_ponal_hospital_emergency_contract');
    }
}
