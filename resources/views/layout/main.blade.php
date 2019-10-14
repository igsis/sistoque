<!DOCTYPE html>
<html lang="pt-br">

@include('layout.head')

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    {{--  menu superior   --}}
    @include('layout.navbar')

    {{--  menu lateral  --}}
    @include('layout.aside')

    @yield('conteudo')

    {{--  footer  --}}
    @include('layout.footer')
</div>
<!-- ./wrapper -->
@include('layout.script')

@hasSection('scriptPlus')
    @yield('scriptPlus')
@endif

</body>
</html>
