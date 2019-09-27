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
            <h1 class="page-header"><i class="fa fa-paperclip" aria-hidden="true"></i> Cadastrar Produto</h1>
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
                                <input class="form-control" type="text" name="descricao" id="descricao" value="{{old('descricao')}}">
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="categoria">Categoria</label>
                                <select class="form-control" name="categoria"
                                        id="categoria">
                                    <option value="" selected>Selecione uma Opção</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Subcategoria</label>
                                <select class="form-control" name="subcategoria" id="subcategotia">
                                    <option value="" selected>Selecione uma Opção</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 has-feedback">
                                <label for="name">Quantidade</label>
                                <input class="form-control" type="number" name="quantidade" id="quantidade" value="{{old('quantidade')}}">
                            </div>
                            <div class="form-group col-md-4 has-feedback">
                                <label for="name">Tipo Quantidade</label>
                                <select class="form-control" name="tipoQuantidade" id="tipoQuantidade">
                                    <option value="" selected>Selecione uma Opção</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4 has-feedback">
                                <label for="name">Nível de Emergência</label>
                                <input class="form-control" type="number" name="emergencia" id="emergencia" value="{{old('emergencia')}}">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('home')}}">Voltar</a>
                        <input class="btn btn-primary pull-right" type="submit" value="Adicionar">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
