@if(isset($subCategoria))
    <div class="modal fade" id="{{$idModal}}" role="dialog" aria-labelledby="{{$idModal}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{$titulo}}</h4>
                </div>
                @if(isset( $actionForm ))
                    <form action="{{route($actionForm)}}" method="POST">
                        {{csrf_field()}}
                        @endif
                        <div class="modal-body">
                            <label>Categoria</label>
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
                        <div class="modal-body">
                            <label>{{isset($label)?$label:'Adicionar novo'}}</label>
                            <input class="form-control" type="text" name="{{$nameModal}}" id="{{$idInput}}">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            @if(isset($actionForm))
                                <button class="btn btn-success" type="submit">Adicionar</button>
                        </div>
                    </form>
                @else
                    <button class="btn btn-success" onclick="{{$funcaoJS}}(); arrumar();">Adicionar</button>
                @endif
            </div>
        </div>
    </div>
@else
    <div class="modal fade" id="{{$idModal}}" role="dialog" aria-labelledby="{{$idModal}}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{{$titulo}}</h4>
                </div>
                @if(isset( $actionForm ))
                    <form action="{{route($actionForm)}}" method="POST">
                        {{csrf_field()}}
                        @endif
                        <div class="modal-body">
                            <label>{{isset($label)?$label:'Adicionar novo'}}</label>
                            <input class="form-control" type="text" name="{{$nameModal}}" id="{{$idInput}}">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            @if(isset($actionForm))
                                <button class="btn btn-success" type="submit">Adicionar</button>
                        </div>
                    </form>
                @else
                    <button class="btn btn-success" onclick="{{$funcaoJS}}(); arrumar();">Adicionar</button>
                @endif
            </div>
        </div>
    </div>
@endif


