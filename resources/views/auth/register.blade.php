@extends('layouts.masterauth')

@section('conteudo')
    <div class="container">
        <h3>Cadastro de Usuário</h3><br>
    </div>
    <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
        {!! csrf_field() !!}

        <div class="form-group has-feedback {{ $errors->has('nome') ? 'has-error' : '' }}">
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}"
                   placeholder="Nome">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('nome'))
                <span class="help-block">
                            <strong>{{ $errors->first('nome') }}</strong>
                        </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
            <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                   placeholder="E-mail">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <select class="form-control" name="unidade" id="unidade">
                <option value="" selected>Selecione uma unidade</option>

            </select>
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
            <input type="password" name="password" class="form-control"
                   placeholder="{{ trans('adminlte::adminlte.password') }}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
            @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
    </form>
    <center>
        <br>
        <a href="{{route('login')}}">Já possuo cadastro</a>
    </center>
@stop

