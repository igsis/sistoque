@extends('layouts.master2')

@section('titulo', 'Pedidos')

@section('conteudo')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-th-list"></i> Pedidos</h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <table id="tabela1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Descricao</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Data Pedido</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Descricao</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Data Pedido</th>
                    <th>Status</th>
                </tr>
                </tfoot>
            </table>
        </section>
    </div>
@endsection
