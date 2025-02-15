<!-- Delivery Date Card Field -->
<div class="col-sm-12">
    {!! Form::label('delivery_date_card', 'Fecha de entrega:') !!}
    <p>{{ $card->delivery_date_card->format('Y-m-d')}}</p>
</div>

<!-- Signature Employe Card Field -->
<div class="col-sm-12">
    {!! Form::label('signature_employe_card', 'Firma del empleado:') !!}
    <p><img src="{{ $card->signature_employe_card }}" alt="Firma del empleado"></p>
</div>

<!-- Card Item Field -->
<div class="col-sm-12">
    {!! Form::label('card_item', 'Item entregado:') !!}
    <p>{{ $card->card_item }}</p>
</div>

<!-- Employe Id Field -->
<div class="col-sm-12">
    {!! Form::label('employe_id', 'Empleado:') !!}
    <p>{{ $card->employe_id ? $card->employe->name : 'Sin ID'}}</p>
</div>

<script>
    window.open('{{ $pdfUrl }}', '_blank');
</script>
