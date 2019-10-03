@extends('layouts.master2')

@section('linksAdicionais')
    @includeIf('links.tabelas_AdminLTE')
@endsection

@section('titulo', 'Pedidos')

@section('conteudo')
    <div class="content-wrapper">

        <cludeIf('layouts.erros')
            </div>
        </div>
        div class="row">
        <div class="col-xs-12">
            @in
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-th-list"></i> Produtos</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pesquisa de Funcionários</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="btn-tabela">
                        </div>
                        <table id="tabela1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Descricao</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Quantidade</th>
                                <th>Adicionar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->descricao }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $produto->quantidade }}</td>
                                    <td>
                                            <a href="" class="btn btn-info pull-left" style="margin-right: 3px"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                            @include('layouts.excluir_confirm')
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Descricao</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Quantidade</th>
                                <th>Adicionar</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts_adicionais')
    @includeIf('scripts.tabelas_admin')
@endsection
