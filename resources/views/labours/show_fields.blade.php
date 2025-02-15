<!-- Position Field -->
<div class="col-sm-12">
    {!! Form::label('position', 'Position:') !!}
    <p>{{ $labour->position }}</p>
</div>

<!-- Salary Field -->
<div class="col-sm-12">
    {!! Form::label('salary', 'Salary:') !!}
    <p>{{ $labour->salary }}</p>
</div>

<!-- Labor Value Field -->
<div class="col-sm-12">
    {!! Form::label('labor_value', 'Labor Value:') !!}
    <p>{{ $labour->labor_value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $labour->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $labour->updated_at }}</p>
</div>

