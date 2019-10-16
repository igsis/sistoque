@extends('layout.main')

@section('conteudo')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">Categorias</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <button href="" class="btn btn-success btn-block" onclick="novaCategoria()">Adicionar</button>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Horizontal Form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Categorias Cadastradas</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabela" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cats as $cat)
                                        <tr>
                                            <td>{{ $cat->id }}</td>
                                            <td>{{ $cat->nome }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editar({{ $cat->id }})">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="apagar({{ $cat->id }})">
                                                    <i class="fas fa-trash"></i> Apagar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Ação</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioCategorias"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalFormularioCategorias"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmCategoria">
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" maxlength="50"
                                   placeholder="Nome da Categoria" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scriptPlus')
{{--    <script src="{{asset('bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>--}}
    <script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript">

        //Função que vai carregar o token
        //Isso é feito para poder fazer requisição de get e post via ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        function tituloModal(tipo) {
            $('#modalCategoria').find('.modal-title').text(tipo + ' de Categoria')
        }

        function novaCategoria() {
            // Coloca titulo da ação no modal
            tituloModal('Cadastro')

            // zera todos os valores form
            $('#id').val('')
            $('#nome').val('')

            // exibe o modal
            $("#modalCategoria").modal('show')
        }

        function cadastroCategoria() {
            var cat = {
                nome: $('#nome').val()
            };

            $.ajax({
                data: cat,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/categorias",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    let categoria = jQuery.parseJSON(JSON.stringify(data));

                    let linha = "<tr>" +
                        "<td>" + categoria.id + "</td>" +
                        "<td>" + categoria.nome + "</td>" +
                        "<td>" +
                        "<button class='btn btn-sm btn-primary' onclick='editar(" + categoria.id + ")'>" +
                        "<i class='fas fa-edit'></i> Editar" +
                        "</button>" +
                        "<button class='btn btn-sm btn-danger' onclick='apagar(" + categoria.id + ")'>" +
                        "<i class='fas fa-trash'></i> Apagar" +
                        "</button>" +
                        "</td>" +
                        "</tr>"
                    if ($('.dataTables_empty').length) {
                        let pai = $('.dataTables_empty').closest('.odd')
                        pai.remove();
                    }
                    $('#tabela>tbody').append(linha)

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function editar(id) {
            tituloModal('Editação')
            $.getJSON("http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/categorias/"+id, function (data) {

                $('#id').val(data.id)
                $('#nome').val(data.nome)

                $('#modalCategoria').modal('show');
            })

        }

        function apagar(id){
            $.ajax({
                type: 'DELETE',
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/categorias/" + id,
                context: this,
                success: function () {
                    console.log('Apagado com sucesso');
                    let linhas = $('#tabela>tbody>tr');

                    e = linhas.filter(function (i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e)
                        e.remove();
                },
                error: function (error) {
                    console.error(error)
                }

            })
        }

        function editarCategoria() {
            var cat = {
                id: $('#id').val(),
                nome: $('#nome').val()
            };
            $.ajax({
                data: cat,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/categorias/"+cat.id,
                type: "PUT",
                context: this,
                success: function (data) {
                    cat = JSON.parse(data);
                    linhas = $('#tabela>tbody>tr');
                    e =linhas.filter(function (i, elemento) {
                        return (elemento.cells[0].textContent == cat.id);
                    });
                    try {
                        if(e){
                            e[0].cells[0].textContent = cat.id;
                            e[0].cells[1].textContent = cat.nome;
                        }
                    }catch (error) {
                        console.error("Error: "+ error)
                        console.log(e.cells)
                    }


                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        $('#frmCategoria').submit(function (event) {
            event.preventDefault()
            if ($('#id').val() != '') {
                editarCategoria()
            } else {
                cadastroCategoria()
            }

            $("#modalCategoria").modal('hide')

        })

        $(function () {

            $('#tabela').DataTable({
                "oLanguage": {
                    "sEmptyTable": "Não há registros cadastrados",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Exibir _MENU_ Registros",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sSearch": "Pesquisar: ",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
        })


    </script>


@stop

@section('headPlus')
    <style>
        td {
            text-align: center;
        }
    </style>
    <link rel="stylesheet"
          href="{{asset('bower_components/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@stop
