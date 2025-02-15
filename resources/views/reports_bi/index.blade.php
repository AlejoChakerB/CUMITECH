@extends('layouts.app')
@section('content')

@php
    $asset = asset('');
    $financialReport = auth()->user()->can('financialReport_reportsbi');
    $financialExecution = auth()->user()->can('financialExecution_reportsbi');
    $pgpUtriocumiProjection = auth()->user()->can('pgpUtriocumiProjection_reportsbi');
    $PgpUtRiocumiPlanning = auth()->user()->can('PgpUtRiocumiPlanning_reportsbi');
    $occupation = auth()->user()->can('occupation_reportsbi');
    $imagingProduction = auth()->user()->can('imagingProduction_reportsbi');
    $cextProduction = auth()->user()->can('cextProduction_reportsbi');
    $surgeryProduction = auth()->user()->can('surgeryProduction_reportsbi');
    $urgencyProduction = auth()->user()->can('urgencyProduction_reportsbi');
    $billingStatistic = auth()->user()->can('billing_statistic_reportsbi');
    $endoscopyProduction = auth()->user()->can('endoscopyProduction_reportsbi');
    $utriocumiProduction = auth()->user()->can('utriocumiProduction_reportsbi');
    $reportCost = auth()->user()->can('reportCost_reportsbi');
    $ponalContractCardiovascular = auth()->user()->can('ponalContractCardiovascular_reportsbi');
    $utPonalHospitalEmergencyContract = auth()->user()->can('utPonalHospitalEmergencyContract_reportsbi');
@endphp
<div id="app">
    <resportsbi-menu :asset='@json($asset)'
    :financialReport='@json($financialReport)'
    :financialExecution='@json($financialExecution)'
    :pgpUtriocumiProjection='@json($pgpUtriocumiProjection)'
    :PgpUtRiocumiPlanning='@json($PgpUtRiocumiPlanning)'
    :occupation='@json($occupation)'
    :imagingProduction='@json($imagingProduction)'
    :cextProduction='@json($cextProduction)'
    :surgeryProduction='@json($surgeryProduction)'
    :urgencyProduction='@json($urgencyProduction)'
    :billingStatistic='@json($billingStatistic)'
    :endoscopyProduction='@json($endoscopyProduction)'
    :utriocumiProduction='@json($utriocumiProduction)'
    :reportCost='@json($reportCost)'
    :ponalContractCardiovascular='@json($ponalContractCardiovascular)'
    :utPonalHospitalEmergencyContract='@json($utPonalHospitalEmergencyContract)'
    ></resportsbi-menu>
</div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
