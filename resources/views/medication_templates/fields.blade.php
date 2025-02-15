<div id="app" class="form-group col-sm-12">
    <template>
        <invima-register :data='@json($invimas ?? null)' :select='@json($invimasSelect ?? null)' :medicationTemplate='@json($medicationTemplate ?? null)' ></invima-register>
    </template>
</div>
<script src="{{ asset('js/app.js') }}"></script>
