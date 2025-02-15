<div class="form-group col-md-5 m-t-20 {{ $errors->has('name') ? ' is-invalid' : '' }}">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control form-control-line', 'placeholder'=> 'Nombre']) !!}
    @if ($errors->has('name'))
    <div class="invalid-feedback">
        {{ $errors->first('name') }}
    </div>
    @endif
</div>


<div class="form-group col-md-5 m-t-20 {{ $errors->has('email') ? ' is-invalid' : '' }}">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control form-control-line', 'placeholder'=> 'Correo']) !!}
    @if ($errors->has('email'))
    <div class="invalid-feedback">
        {{ $errors->first('email') }}
    </div>
    @endif
</div>


<!-- Password Field -->
<div class="form-group col-md-5 m-t-20 {{ $errors->has('password') ? ' is-invalid' : '' }}">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', ['class' => 'form-control form-control-line', 'placeholder'=> 'Contraseña']) !!}
    @if ($errors->has('password'))
    <div class="invalid-feedback">
        {{ $errors->first('password') }}
    </div>
    @endif
</div>

<!-- Password Field -->
<div class="form-group col-md-5 m-t-20 {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}">
    {!! Form::label('password_confirmation', 'Confirmar contraseña:') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control form-control-line', 'placeholder'=> 'Confirmar la contraseña']) !!}
    @if ($errors->has('password_confirmation'))
    <div class="invalid-feedback">
        {{ $errors->first('password_confirmation') }}
    </div>
    @endif
</div>

@push('css')
<link href="/css/pages/file-upload.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="/js/jasny-bootstrap.js"></script>
<script src="/plugins/styleswitcher/jQuery.style.switcher.js"></script>

@endpush