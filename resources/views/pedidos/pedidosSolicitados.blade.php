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
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Data do pedido</th>
                                        <th>Solicitante</th>
                                        <th>Unidade</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($peds as $ped)
                                        <tr>
                                            <td>{{ $ped->id }}</td>
                                            <td>{{ $ped->produto->nome }}</td>
                                            <td>{{ $ped->quantidade }}</td>
                                            <td>{{ date('d/m/Y', strtotime($ped->data_pedido)) }}</td>
                                            <td>{{  $ped->user->nome }}</td>
                                            <td>{{ $ped->user->unidade->nome }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info"
                                                        onclick="alterar('{{ $ped->id }}', {{$ped->status_pedidos_id}})">
                                                    <i class="fas fa-edit"></i> Alterar status
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Data do pedido</th>
                                        <th>Solicitante</th>
                                        <th>Unidade</th>
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

    <div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="ModalStatus"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Alterar status do pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idPedido">
                    <select class="form-control" id="statusPed"></select>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="mudarStatus()">Alterar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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


        function alterar(id, status) {
            $('#idPedido').val(id)
            $('#statusPed').val(status)

            $('#modal-status').modal('show');

        }

        function carregarStatus() {
            $.getJSON('{{route('status')}}', function (data) {
                for (i = 0; i < data.length; i++) {
                    opc = "<option value=" + data[i].id + ">" + data[i].status + "</option>"
                    $('#statusPed').append(opc)
                }
            })
        }

        function mudarStatus() {
            let status = {
                stat: $('#statusPed').val()
            }

            $.ajax({
                data: status,
                url: 'http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/statusPedido/' + $('#idPedido').val(),
                type: 'PUT',
                context: this,
                success: function () {
                    if ($('#statusPed').val() != 2) {
                        statu = JSON.parse(data);
                        let linhas = $('#tabela>tbody>tr');

                        e = linhas.filter(function (i, elemento) {
                            return elemento.cells[0].textContent == $('#idPedido').val();
                        });
                        if (e)
                            e.remove();
                        $('#modal-status').modal('hide')
                        Swal.fire({
                            type: 'success',
                            title: 'Status do pedido alterado com sucesso',
                            backdrop: ` rgba(0,0,123,0.4)
                                url("https://media.giphy.com/media/7lsw8RenVcjCM/giphy.gif")
                                center right
                                no-repeat`
                        })
                    }
                    else{
                        Swal.fire({
                            type: 'success',
                            title: 'Status do pedido alterado com sucesso!<br>Mas foi para Solicitado.',
                            backdrop: ` rgba(0,0,123,0.4)
                                url("https://media.giphy.com/media/7lsw8RenVcjCM/giphy.gif")
                                center right
                                no-repeat`
                        })
                    }
                },
                error: function (error) {
                    console.error(error)
                }

            })
        }

        $(function () {

            carregarStatus()

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
