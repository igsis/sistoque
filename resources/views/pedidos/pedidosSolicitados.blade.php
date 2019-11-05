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
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
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
                                            <td>{{ date('d/m/Y', strtotime($ped->data_pedido)) }}</td>
                                            <td>{{  $ped->user->nome }}</td>
                                            <td>{{ $ped->user->unidade->nome }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info" onclick="editar({{$ped->id}})">
                                                    <i class="fas fa-edit"></i> Alterar status
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

    <div class="modal fade" id="modal-danger" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioProduto"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Cancelar Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idApagar">
                    <p>Você deseja mesmo cancelar este pedido?</p>
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
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@stop
