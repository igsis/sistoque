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
            <h1 class="page-header"><i class="fa fa-address-book-o"></i> Minha Conta</h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box box-primary">
                <form action="">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12 has-feedback">
                                <label for="name">Nome</label>
                                <input type="text" name="nome" id="nome" value="{{old('nome')}}">
                            </div>
                            <div class="form-group col-md-12 has-feedback">
                                <label for="name">E-mail</label>
                                <input type="text" name="email" id="email" value="{{old('email')}}">
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Alterar Senha</label>
                                <input type="text" name="email" id="email" value="{{old('senha')}}">
                            </div>
                            <div class="form-group col-md-6 has-feedback">
                                <label for="name">Confirmar Senha</label>
                                <input type="text" name="email" id="email" value="{{old('confirmar_senha')}}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
