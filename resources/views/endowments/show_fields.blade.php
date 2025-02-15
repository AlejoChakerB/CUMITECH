<!-- Item Field -->
<div class="col-sm-12">
    {!! Form::label('item', 'Item:') !!}
    <p>{{ $endowment->item }}</p>
</div>

<!-- Deliver Date Field -->
<div class="col-sm-12">
    {!! Form::label('deliver_date', 'Deliver Date:') !!}
    <p>{{ $endowment->deliver_date }}</p>
</div>

<!-- Employe Signature Field -->
<div class="col-sm-12">
    {!! Form::label('employe_signature', 'Employe Signature:') !!}
    <p><img src="{{ $endowment->employe_signature }}" alt="Firma del empleado"></p>
</div>

<!-- Contract Id -->
<div class="col-sm-12">
    {!! Form::label('contract_id', 'Contract Id, Contracts,Id:') !!}
    <p>{{ $endowment->contract_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $endowment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $endowment->updated_at }}</p>
</div>

<script>
    var pdfUrl = '{{ session('pdfUrl') }}';
    window.open('{{ $pdfUrl }}', '_blank');
</script>