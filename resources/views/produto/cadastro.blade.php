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
                <form method="POST" action="{{route('produto.gravar')}}" >
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12 has-feedback">
                                <label for="name">Descrição do produto</label>
                                <input class="form-control" type="text" name="descricao" id="descricao" value="{{old('descricao')}}">
                            </div>
                            <div id="divCategoria"class="form-group col-xs-7 col-md-5 has-feedback">
                                <label for="categoria">Categoria</label>
                                <select class="form-control" name="categoria"
                                        id="categoria">
                                    <option value="" selected>Selecione uma Opção</option>
                                    @foreach ($categorias as $categoria)
                                        @if ($categoria->id == old('categoria'))
                                            <option value="{{$categoria->id}}" selected>{{$categoria->nome}}</option>
                                        @else
                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-xs-2 col-md-1">
                                <label for="addCategoria">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                                        data-target="#addCategoria">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
                            </div>

                            <div id="divSubCategoria"class="form-group col-xs-7 col-md-5 has-feedback">
                                <label for="name">Subcategoria</label>
                                <select class="form-control" name="subcategoria" id="subcategoria">
                                    <option value="" selected>Selecione uma Opção</option>

                                </select>
                            </div>

                            <div class="form-group col-xs-2 col-md-1">
                                <label for="addSubCategoria">&emsp;</label>
                                <button type="button" class="btn btn-info btn-block" data-toggle="modal"
                                        data-target="#addCategoria">
                                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"/>
                                </button>
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
                            <p id="demo"> </p>
                            <div class="form-group col-md-4 has-feedback">
                                <label for="name">Nível de Emergência</label>
                                <input class="form-control" type="number" name="nivelEmergencia" id="nivelEmergencia" value="{{old('emergencia')}}">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('home')}}">Voltar</a>
                        <input class="btn btn-primary pull-right" type="submit" value="Adicionar">
                    </div>
                </form>
            </div>


            @include('layouts.modal', ['idModal' => 'addCategoria', 'titulo' => 'Adicionar Categoria', 'actionForm' => 'createCategoria', 'nameModal' => 'nome', 'equipamentoId' => '0', 'idInput' => 'novaSubAdm', 'funcaoJS' => 'insertSubAdm'])
        </section>
    </div>
@endsection

@section('scripts_adicionais')
    <script>
       $('#categoria').on('change',function(e){
           console.log(e);

           var cat_id = e.target.value;
           $('#subcategoria').empty();
           $.get('/ajax-subcat?cat_id=' + cat_id, function (data) {
               $.each(data, function(subcatObj){
                   $('#subcategoria').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');
               });
           });
       });

    </script>

@endsection
