@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Calcular costos</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::open(['route' => 'unitCosts.store']) !!}

        <div class="card-body">

            <div class="row">
                <!-- Room Cost Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('room_cost', 'Derecho de sala:') !!}
                    {!! Form::text('room_cost', $valueRoomTime, ['class' => 'form-control']) !!}
                </div>

                <!-- Gas Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('gas', 'Gas:') !!}
                    {!! Form::text('gas', $gases, ['class' => 'form-control']) !!}
                </div>

                <!-- Labour Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('labour', 'Mano de obra:') !!}
                    {!! Form::text('labour', $labour, ['class' => 'form-control']) !!}
                </div>

                <!-- Basket Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('basket', 'Canasta:') !!}
                    {!! Form::text('basket', $totalBasketCost, ['class' => 'form-control']) !!}
                </div>

                <!-- Medical Fees Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('medical_fees', 'Honorarios médico:') !!}
                    {!! Form::text('medical_fees', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Medical Fees Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('medical_fees2', 'Honorarios médico 2:') !!}
                    {!! Form::text('medical_fees2', 0, ['class' => 'form-control']) !!}
                </div>
                
                <!-- Medical Fees Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('anesthesiologist_fees', 'Honorarios especialistas:') !!}
                    {!! Form::text('anesthesiologist_fees', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Id Consumables Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('consumables', 'Consumibles:') !!}
                    {!! Form::text('consumables', $totalConsumableCost, ['class' => 'form-control custom-select']) !!}
                </div>

                <!-- Cod Surgical Act Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('cod_surgical_act', 'Codigo acto quirurgico:') !!}
                    {!! Form::text('cod_surgical_act', $surgery->cod_surgical_act, ['class' => 'form-control custom-select']) !!}
                </div>

                <!-- Total Value Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('total_value', 'Valor total:') !!}
                    {!! Form::number('total_value', null, ['class' => 'form-control']) !!}
                </div>
            </div>

        </div>

        <div class="card-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('unitCosts.index') }}" class="btn btn-default">Cancel</a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
@endsection
