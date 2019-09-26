<!DOCTYPE html>
<html>
@include('layouts.br')

@include('layouts.head')

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>SITOQUE</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @yield("conteudo")
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>
