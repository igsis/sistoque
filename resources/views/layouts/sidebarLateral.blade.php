<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><center>Menu Principal</center></li>

            <li><a href="{{route('pedido.solicitar')}}"><i class="glyphicon glyphicon-plus"></i> Solicitar Pedidio</a></li>
            <li><a href="{{route('pedidos')}}"> <i class="glyphicon glyphicon-list-alt"></i>Pedidos</a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-paperclip" aria-hidden="true"></i><span>Produtos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('produto.cadastro')}}"> Cadastrar</a></li>
                    <li><a href="{{route('produto.listar')}}"> Listar</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-address-book-o"></i> <span>Minha Conta</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('minha_conta')}}"> Dados Principais</a></li>
                    <li><a href=""> Meus pedidos</a></li>
                </ul>
            </li>
        </ul>


    </section>
    <!-- /.sidebar -->
</aside>
