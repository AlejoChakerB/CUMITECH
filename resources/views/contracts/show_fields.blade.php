<!-- Salary Field -->
<div class="col-sm-12">
    {!! Form::label('salary', 'Salary:') !!}
    <p>{{ $contracts->salary }}</p>
</div>

<!-- Start Date Contract Field -->
<div class="col-sm-12">
    {!! Form::label('start_date_contract', 'Start Date Contract:') !!}
    <p>{{ $contracts->start_date_contract }}</p>
</div>

<!-- Employe Id Field -->
<div class="col-sm-12">
    {!! Form::label('employe_id', 'Employe Id:') !!}
    <p>{{ $contracts->employe_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $contracts->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $contracts->updated_at }}</p>
</div>

