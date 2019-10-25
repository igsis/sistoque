@extends('layout.main')

@section('conteudo')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">Subcategorias</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <button href="" class="btn btn-success btn-block" onclick="novaSubcategoria()">Adicionar</button>
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
                                <h3 class="card-title">Subcategorias Cadastradas</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tabela" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="25%">Nome</th>
                                        <th>Categoria</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subs as $sub)
                                        <tr>
                                            <td>{{ $sub->id }}</td>
                                            <td>{{ $sub->nome }}</td>
                                            <td>{{ $sub->categoria->nome }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editar({{ $sub->id }})">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="modalApagar({{ $sub->id }})">
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
                                        <th>Categoria</th>
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
    <div class="modal fade" id="modalSubCategoria" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioProduto"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalFormularioProduto"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmSubcategoria">
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" maxlength="50"
                                   placeholder="Nome da subcategoria" required>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria:</label>
                            <select class="form-control" id="categoria" required>
                            </select>
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

    <div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioProduto"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Apagar Subcategoria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idApagar">
                    <p>Você deseja mesmo apagar esta subcategoria?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-outline-light" onclick="apagar()">Sim</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

@section('scriptPlus')
    {{--    <script src="{{asset('bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>--}}
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript">

        //Função que vai carregar o token
        //Isso é feito para poder fazer requisição de get e post via ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        function carregarCategorias() {
            $.getJSON('{{ route('api.listarCategorias') }}', function (data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value="' + data[i].id + '" >' + data[i].nome + '</option>';

                    $('#categoria').append(opcao);
                }
            })
        }

        function tituloModal(tipo) {
            $('#modalSubCategoria').find('.modal-title').text(tipo + ' de Subcategoria')
        }

        function novaSubcategoria() {
            // Coloca titulo da ação no modal
            tituloModal('Cadastro')

            // zera todos os valores form
            $('#id').val('')
            $('#nome').val('')
            $('#categoria').val('')

            // exibe o modal
            $("#modalSubCategoria").modal('show')
        }

        function cadastroSubcategoria() {
            var sub = {
                nome: $('#nome').val(),
                categoria: $('#categoria').val()
            };

            $.ajax({
                data: sub,
                url: "{{ route('api.cadatroSubcategoria') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    let subcategoria = jQuery.parseJSON(JSON.stringify(data));

                    let linha = "<tr>" +
                        "<td>" + subcategoria.id + "</td>" +
                        "<td>" + subcategoria.nome + "</td>" +
                        "<td>" + $('#categoria option:selected').text() + "</td>" +
                        "<td>" +
                        "<button class='btn btn-sm btn-primary' onclick='editar(" + subcategoria.id + ")'>" +
                        "<i class='fas fa-edit'></i> Editar" +
                        "</button>" +
                        "<button class='btn btn-sm btn-danger' onclick='apagar(" + subcategoria.id + ")'>" +
                        "<i class='fas fa-trash'></i> Apagar" +
                        "</button>" +
                        "</td>" +
                        "</tr>"
                    if ($('.dataTables_empty').length) {
                        let pai = $('.dataTables_empty').closest('.odd')
                        pai.remove();
                    }
                    $('#tabela>tbody').append(linha)

                    Swal.fire({
                        type: 'success',
                        title: 'Subcategoria adicionado com sucesso!',
                        backdrop: ` rgba(0,0,123,0.4)
                                url("https://media.giphy.com/media/7lsw8RenVcjCM/giphy.gif")
                                center right
                                no-repeat`
                    })

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function editar(id) {
            tituloModal('Editação')
            $.getJSON("http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/subcategorias/"+id, function (data) {

                $('#id').val(data.id)
                $('#nome').val(data.nome)
                $('#categoria').val(data.categoria_produtos_id)

                $('#modalSubCategoria').modal('show');
            })

        }
        function modalApagar(id) {
            $('#idApagar').val(id)
            $('#modal-danger').modal('show')
        }

        function apagar(){
            let id = $('#idApagar').val()
            $.ajax({
                type: 'DELETE',
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/subcategorias/" + id,
                context: this,
                success: function () {
                    console.log('Apagado com sucesso');
                    let linhas = $('#tabela>tbody>tr');

                    e = linhas.filter(function (i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e)
                        e.remove();
                    $('#modal-danger').modal('hide')
                    Swal.fire({
                        type: 'success',
                        title: 'Subcategoria apagada com sucesso!',
                        backdrop: ` rgba(0,0,123,0.4)
                                url("https://media.giphy.com/media/7lsw8RenVcjCM/giphy.gif")
                                center right
                                no-repeat`
                    })
                },
                error: function (error) {
                    console.error(error)
                }

            })
        }

        function editarSubcategoria() {
            var sub = {
                id: $('#id').val(),
                nome: $('#nome').val(),
                categoria: $('#categoria').val()
            };
            $.ajax({
                data: sub,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/subcategorias/"+sub.id,
                type: "PUT",
                context: this,
                success: function (data) {
                    sub = JSON.parse(data);
                    linhas = $('#tabela>tbody>tr');
                    e =linhas.filter(function (i, elemento) {
                        return (elemento.cells[0].textContent == sub.id);
                    });
                    try {
                        if(e){
                            e[0].cells[0].textContent = sub.id;
                            e[0].cells[1].textContent = sub.nome;
                            e[0].cells[2].textContent = $('#categoria option:selected').text();
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


        $('#frmSubcategoria').submit(function (event) {
            event.preventDefault()
            if ($('#id').val() != '') {
                editarSubcategoria()
            } else {
                cadastroSubcategoria()
            }

            $("#modalSubCategoria").modal('hide')

        })


        $(function () {
            carregarCategorias()
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
