@extends('layouts.master2')

@section('titulo', 'Cadastrar Produto')

@section('conteudo')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-xs-12">
                @includeIf('layouts.erros')
            </div>
        </div>

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="page-header"><i class="glyphicon glyphicon-th-list"></i> Solicitar Pedido</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <form action="">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12 has-feedback">
                                <label for="name">Descrição do produto</label>
                                <select class="form-control" name="descricao" id="descricao">
                                    <option value="" selected>Selecione uma Opção</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="categoria">Categoria</label>
                                <input class="form-control" type="text" name="categoria" id="categoria" readonly>
                            </div>

                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Subcategoria</label>
                                <input class="form-control" type="text" name="subcategoria" id="subcategoria" readonly>
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Quantidade</label>
                                <input class="form-control" type="number" name="quantidade" id="quantidade" value="{{old('quantidade')}}">
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Tipo Quantidade</label>
                                <input class="form-control" type="text" name="tipoQuantidade" id="tipoQuantidade" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('home')}}">Voltar</a>
                        <input class="btn btn-primary pull-right" type="submit" value="Solicitar">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection


