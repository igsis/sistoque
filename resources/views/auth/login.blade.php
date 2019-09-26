@extends('layouts.masterauth')

@section('conteudo')
    <div class="container">
        <h4>Coloque as informações para o login</h4><br>
    </div>
    <form action="{{route('login')}}" method="post">
        {!! csrf_field() !!}

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
        <div class="row">
            <div class="col-xs-8">
                <a href="{{ route('password.request') }}">Esqueci minha Senha</a>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <div class="auth-links">
    <!-- <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                   class="text-center"
                >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                <br> -->
        @if (config('adminlte.register_url', 'register'))
            <a href="{{ url(config('adminlte.register_url', 'register')) }}"
               class="text-center"
            >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
        @endif
    </div>
@endsection

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
