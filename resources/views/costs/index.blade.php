@extends('layouts.app')
@section('content')
    @php
        $view_procedure = auth()->user()->can('view_procedure');
        $view_articles = auth()->user()->can('view_articles');
        $view_generalCosts = auth()->user()->can('view_generalCosts');
        $view_diferentialRates = auth()->user()->can('view_diferentialRates');
        $view_doctors = auth()->user()->can('view_doctors');
        $view_medicalFees = auth()->user()->can('view_medicalFees');
        $view_soat = auth()->user()->can('view_soat');
        $view_unitCosts = auth()->user()->can('view_unitCosts');
        $view_logoperationcosts = auth()->user()->can('view_logoperationcosts');
        $view_surgeries = auth()->user()->can('view_surgeries');
        $view_baskets = auth()->user()->can('view_baskets');
        $view_distPackages = auth()->user()->can('view_distPackages');
        $view_consumables = auth()->user()->can('view_consumables');
        $view_rentedEquipments = auth()->user()->can('view_rentedEquipments');
        $view_imagingProductionDetails = auth()->user()->can('view_imagingProductionDetails');
        $view_imagingProductionMonths = auth()->user()->can('view_imagingProductionMonths');
        $view_imagingProductionHourcosts = auth()->user()->can('view_imagingProductionHourcosts');
        $view_imagingProductionSupplies = auth()->user()->can('view_imagingProductionSupplies');
        $view_cextDetails = auth()->user()->can('view_cextDetails');
        $view_cextProductionMonths = auth()->user()->can('view_cextProductionMonths');
        $view_cextHourcosts = auth()->user()->can('view_cextHourcosts');
        $view_accommodationCosts = auth()->user()->can('view_accommodationCosts');
        $view_cumiLabRates = auth()->user()->can('view_cumiLabRates');
        $view_patologies = auth()->user()->can('view_patologies');
        $view_ambulanceCosts = auth()->user()->can('view_ambulanceCosts');
        $view_bloodBankMonths = auth()->user()->can('view_bloodBankMonths');
    @endphp

    <div id="app">
        <cost-menu :labour-Route='{{ json_encode(route('labours.index')) }}'
            :procedures-Route='{{ json_encode(route('procedures.index')) }}'
            :articles-Route='{{ json_encode(route('articles.index')) }}'
            :basket-Route='{{ json_encode(route('baskets.index')) }}'
            :consumable-Route='{{ json_encode(route('consumables.index')) }}'
            :Rate-Route='{{ json_encode(route('diferentialRates.index')) }}'
            :Fees-Route='{{ json_encode(route('medicalFees.index')) }}'
            :doctors-Route='{{ json_encode(route('doctors.index')) }}'
            :surgeries-Route='{{ json_encode(route('surgeries.index')) }}'
            :unit-Route='{{ json_encode(route('unitCosts.index')) }}'
            :general-Route='{{ json_encode(route('generalCosts.index')) }}'
            :soat-Route='{{ json_encode(route('soatGroups.index')) }}'
            :msurgery-Route='{{ json_encode(route('msurgeryProcedures.index')) }}'
            :log-Route='{{ json_encode(route('logOperationCosts.index')) }}'
            :rented-Route='{{ json_encode(route('rentedEquipments.index')) }}'
            :Lab-Route='{{ json_encode(route('cumiLabRates.index')) }}'
            :imagingdetail-Route='{{ json_encode(route('imagingProductionDetails.index')) }}'
            :imaginghour-Route='{{ json_encode(route('imagingProductionHourcosts.index')) }}'
            :imagingmonth-Route='{{ json_encode(route('imagingProductionMonths.index')) }}'
            :imagingsuplies-Route='{{ json_encode(route('imagingProductionSupplies.index')) }}'
            :cextdetail-Route='{{ json_encode(route('cextDetails.index')) }}'
            :cextmonth-Route='{{ json_encode(route('cextProductionMonths.index')) }}'
            :cexthour-Route='{{ json_encode(route('cextHourcosts.index')) }}'
            :accomodation-Route='{{ json_encode(route('accommodationCosts.index')) }}'
            :blood-Route='{{ json_encode(route('bloodBankMonths.index')) }}'
            :ambulance-Route='{{ json_encode(route('ambulanceCosts.index')) }}'
            :patologi-Route='{{ json_encode(route('patologies.index')) }}'
            :distpack-Route='{{ json_encode(route('distPackages.index')) }}'
            
            :view_procedure='@json($view_procedure)'
            :view_articles='@json($view_articles)'
            :view_generalCosts='@json($view_generalCosts)'
            :view_diferentialRates='@json($view_diferentialRates)'
            :view_doctors='@json($view_doctors)'
            :view_medicalFees='@json($view_medicalFees)'
            :view_soat='@json($view_soat)'
            :view_unitCosts='@json($view_unitCosts)'
            :view_logoperationcosts='@json($view_logoperationcosts)'
            :view_surgeries='@json($view_surgeries)'
            :view_baskets='@json($view_baskets)'
            :view_distPackages='@json($view_distPackages)'
            :view_consumables='@json($view_consumables)'
            :view_rentedEquipments='@json($view_rentedEquipments)'
            :view_imagingProductionDetails='@json($view_imagingProductionDetails)'
            :view_imagingProductionMonths='@json($view_imagingProductionMonths)'
            :view_imagingProductionHourcosts='@json($view_imagingProductionHourcosts)'
            :view_imagingProductionSupplies='@json($view_imagingProductionSupplies)'
            :view_cextDetails='@json($view_cextDetails)'
            :view_cextProductionMonths='@json($view_cextProductionMonths)'
            :view_cextHourcosts='@json($view_cextHourcosts)'
            :view_accommodationCosts='@json($view_accommodationCosts)'
            :view_cumiLabRates='@json($view_cumiLabRates)'
            :view_patologies='@json($view_patologies)'
            :view_ambulanceCosts='@json($view_ambulanceCosts)'
            :view_bloodBankMonths='@json($view_bloodBankMonths)'
            ></cost-menu>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
@endsection
