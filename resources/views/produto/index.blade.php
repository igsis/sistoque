@extends('layout.main')

@section('conteudo')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-9">
                        <h1 class="m-0 text-dark">Produtos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-3">
                        <button href="" class="btn btn-success btn-block" onclick="novoProduto()">Adicionar</button>
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
                                <h3 class="card-title">Produtos Cadastrados</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="tabela" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="25%">Nome</th>
                                        <th>Categoria</th>
                                        <th>SubCategoria</th>
                                        <th>Quantidade</th>
                                        <th>Ação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($prods as $prod)
                                        <tr>
                                            <td>{{ $prod->id }}</td>
                                            <td>{{ $prod->nome }}</td>
                                            <td>{{ $prod->categoria->nome }}</td>
                                            <td>{{ $prod->subcategoria->nome }}</td>
                                            <td>{{ $prod->quantidade }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="editar({{ $prod->id }})">
                                                    <i class="fas fa-edit"></i> Editar
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="apagar({{ $prod->id }})">
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
                                        <th>SubCategoria</th>
                                        <th>Quantidade</th>
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
    <div class="modal fade" id="formProduto" tabindex="-1" role="dialog" aria-labelledby="ModalFormularioProduto"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalFormularioProduto"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmProduto">
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" maxlength="50"
                                   placeholder="Nome de Produto" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" class="form-control" id="quantidade"
                                       maxlength="50" placeholder="Ex: 100" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="nvEmergencia">Nível de Emergência:</label>
                                <input type="number" class="form-control" id="nvEmergencia"
                                       placeholder="Ex: 10" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria:</label>
                            <select class="form-control" id="categoriaProduto" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategoria">Subcategoria:</label>
                            <select class="form-control" id="subcategoria" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipocategoria">Tipo Quantidade:</label>
                            <select class="form-control" id="tipoQuantidade" required>
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

        function tituloModal(tipo) {
            $('#formProduto').find('.modal-title').text(tipo + ' de Produto')
        }

        function novoProduto() {
            // Coloca titulo da ação no modal
            tituloModal('Cadastro')

            // zera todos os valores form
            $('#id').val('')
            $('#nome').val('')
            $('#quantidade').val('')
            $('#nvEmergencia').val('')
            $('#categoriaProduto').val('')
            $('#subcategoria').val('')
            $('#tipocategoria').val('')

            // exibe o modal
            $("#formProduto").modal('show')
        }

        function editar(id) {
            tituloModal('Editação')
            $.getJSON("http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/produtos/"+id, function (data) {

                $('#id').val(data.id)
                $('#nome').val(data.nome)
                $('#nvEmergencia').val(data.nivel_emergencia)
                $('#quantidade').val(data.quantidade)
                $('#categoriaProduto').val(data.categoria_produtos_id)

                carregarSubcategoria(data.categoria_produtos_id)

                $('#subcategoria').val(data.subcategoria_produtos_id)
                $('#tipoQuantidade').val(data.tipo_quantidades_id)

                $('#formProduto').modal('show');
            })

        }

        function carregarCategorias() {
            $.getJSON('{{ route('api.listarCategorias') }}', function (data) {
                for (i = 0; i < data.length; i++) {
                    opcao = '<option value="' + data[i].id + '" >' + data[i].nome + '</option>';

                    $('#categoriaProduto').append(opcao);
                }
            })
        }

        function carregarTipoQuantidade() {
            $.getJSON("{{ route('api.listarTipoCategoria') }}", function (data) {
                for (let y = 0; y < data.length; y++) {
                    opcao = '<option value="' + data[y].id + '" >' + data[y].tipo + '</option>';

                    $('#tipoQuantidade').append(opcao)
                }
            })
        }

        $('#categoriaProduto').on('change', function () {
            let valu = $('#categoriaProduto').val()
            $('#subcategoria').empty()
            carregarSubcategoria(valu)
        })

        function carregarSubcategoria(valu) {
            $.getJSON('api/subcategorias/' + valu, function (data) {
                for (let x = 0; x < data.length; x++) {
                    opcao = '<option value="' + data[x].id + '" >' + data[x].nome + '</option>';

                    $('#subcategoria').append(opcao)
                }
            })
        }

        function cadastroProduto() {
            var prod = {
                nome: $('#nome').val(),
                quantidade: $('#quantidade').val(),
                nivel_emergencia: $('#nvEmergencia').val(),
                categoria_produtos_id: $('#categoriaProduto').val(),
                subcategoria_produtos_id: $('#subcategoria').val(),
                tipo_quantidade_id: $('#tipoQuantidade').val()
            };

            $.ajax({
                data: prod,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/produtos",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    let produto = jQuery.parseJSON(JSON.stringify(data));

                    let linha = "<tr>" +
                        "<td>" + produto.id + "</td>" +
                        "<td>" + produto.nome + "</td>" +
                        "<td>" + $('#categoriaProduto option:selected').text() + "</td>" +
                        "<td>" + $('#subcategoria option:selected').text() + "</td>" +
                        "<td>" + produto.quantidade + "</td>" +
                        "<td>" +
                        "<button class='btn btn-sm btn-primary' onclick='editar("+ produto.id +")'>" +
                        "<i class='fas fa-edit'></i> Editar" +
                        "</button>" +
                        "<button class='btn btn-sm btn-danger' onclick='apagar("+ produto.id +")'>" +
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
                        title: 'Produto adicionado com sucesso!',
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

        function editarProduto() {
            var prod = {
                id: $('#id').val(),
                nome: $('#nome').val(),
                quantidade: $('#quantidade').val(),
                nivel_emergencia: $('#nvEmergencia').val(),
                categoria_produtos_id: $('#categoriaProduto').val(),
                subcategoria_produtos_id: $('#subcategoria').val(),
                tipo_quantidade_id: $('#tipoQuantidade').val()
            };
            $.ajax({
                data: prod,
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/produtos/"+prod.id,
                type: "PUT",
                context: this,
                success: function (data) {
                    prod = JSON.parse(data);
                    linhas = $('#tabela>tbody>tr');
                    e =linhas.filter(function (i, elemento) {
                        return (elemento.cells[0].textContent == prod.id);
                    });
                    try {
                        if(e){
                            e[0].cells[0].textContent = prod.id;
                            e[0].cells[1].textContent = prod.nome;
                            e[0].cells[2].textContent = $('#categoriaProduto option:selected').text();
                            e[0].cells[3].textContent = $('#subcategoria option:selected').text();
                            e[0].cells[4].textContent = prod.quantidade;
                        }

                        Swal.fire({
                            type: 'success',
                            title: 'Produto alterado com sucesso!',
                            backdrop: ` rgba(0,0,123,0.4)
                                url("https://media.giphy.com/media/7lsw8RenVcjCM/giphy.gif")
                                center right
                                no-repeat`
                        })
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

        function apagar(id){
            $.ajax({
                type: 'DELETE',
                url: "http://{{$_SERVER['HTTP_HOST']}}/sitoque/api/produtos/" + id,
                context: this,
                success: function () {
                    console.log('Apagado com sucesso');
                    let linhas = $('#tabela>tbody>tr');

                    e = linhas.filter(function (i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });
                    if (e)
                        e.remove();

                    Swal.fire({
                        type: 'success',
                        title: 'Produto apagado com sucesso!',
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

        $('#frmProduto').submit(function (event) {
            event.preventDefault()
            if ($('#id').val() != '') {
                console.log('é Editar')
                editarProduto()
            } else {
                cadastroProduto()
            }

            $("#formProduto").modal('hide')

        })

        $(function () {
            carregarCategorias()
            carregarTipoQuantidade()

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
