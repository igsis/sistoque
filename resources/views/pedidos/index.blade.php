@extends('layout.main')

@section('conteudo')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">Pedidos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <button class="btn btn-success btn-block" onclick="novoPedido()">Adicionar</button>
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
                                <h3 class="card-title">Pedidos realizados</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabela" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Data do pedido</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($peds as $ped)
                                        <tr>
                                            <td>{{ $ped->id }}</td>
                                            <td>{{ $ped->produto->nome }}</td>
                                            <td>{{ date('d/m/Y', strtotime($ped->data_pedido)) }}</td>
                                            <td>{{ $ped->status->status }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="">
                                                    <i class="fas fa-trash"></i> Apagar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Data do pedido</th>
                                        <th>Status</th>
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
    <div class="modal fade" id="formPedido" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioProduto"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalFormularioProduto"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmPedido">
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="produto">Produto:</label>
                            <select class="form-control" id="produto">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" class="form-control" id="quantidade"
                                   maxlength="50" placeholder="Ex: 100" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('scriptPlus')
    <script src="{{ asset('bower_components/admin-lte/dist/js/demo.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.js')}}"></script>

    <script>
        //Função que vai carregar o token
        //Isso é feito para poder fazer requisição de get e post via ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        });

        function tituloModal(tipo) {
            $('#formPedido').find('.modal-title').text(tipo + ' de Pedido')
        }

        function novoPedido() {
            // Coloca titulo da ação no modal
            tituloModal('Solicitação')

            // zera todos os valores form
            $('#id').val('')
            $('#produto').val('')
            $('#quantidade').val('')

            // exibe o modal
            $("#formPedido").modal('show')
        }

        function carregarProduto() {
            $.getJSON('{{ route('api.listaProduto') }}', function (data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value="' + data[i].id + '" >' + data[i].nome + '</option>';

                    $('#produto').append(opcao);
                }
            })
        }

        function cadastroPedido() {

            let data = new Date()


            var ped = {
                produto_id: $('#produto').val(),
                quantidade: $('#quantidade').val(),
                data_pedido: (data.getMonth()+1)+'-'+data.getDate()+'-'+data.getFullYear(),
                usuario_id: '{{ $user }}',
            };

            $.ajax({
                data: ped,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/pedidos",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    let pedido = jQuery.parseJSON(JSON.stringify(data));

                    let dataNova = pedido.data_pedido.split('-')

                    dataNova = dataNova[2]+'/'+dataNova[1]+'/'+dataNova[0]

                    let linha = "<tr>" +
                        "<td>" + pedido.id + "</td>" +
                        "<td>" + $('#produto option:selected').text() + "</td>" +
                        "<td>" + dataNova  + "</td>" +
                        "<td> Solicitado </td>" +
                        "<td>" +
                        "<button class='btn btn-sm btn-primary' onclick='editar("+ pedido.id +")'>" +
                        "<i class='fas fa-edit'></i> Editar" +
                        "</button>" +
                        "<button class='btn btn-sm btn-danger' onclick='apagar("+ pedido.id +")'>" +
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
                        title: 'Pedido solicitado com sucesso!',
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

        $('#frmPedido').submit(function (event) {
            event.preventDefault()
            if ($('#id').val() != '') {
                editarPpedido()
            } else {
                cadastroPedido()
            }

            $("#formProduto").modal('hide')

        })

        $(function () {

            carregarProduto()

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
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@stop
