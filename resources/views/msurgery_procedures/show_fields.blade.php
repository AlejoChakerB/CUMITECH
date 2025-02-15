<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $msurgeryProcedure->amount }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $msurgeryProcedure->type }}</p>
</div>

<!-- Mcod Surgical Act Field -->
<div class="col-sm-12">
    {!! Form::label('mcod_surgical_act', 'Mcod Surgical Act:') !!}
    <p>{{ $msurgeryProcedure->mcod_surgical_act }}</p>
</div>

<!-- Code Procedure Field -->
<div class="col-sm-12">
    {!! Form::label('code_procedure', 'Code Procedure:') !!}
    <p>{{ $msurgeryProcedure->code_procedure }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $msurgeryProcedure->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $msurgeryProcedure->updated_at }}</p>
</div>

