<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-image"></span>
        <span class="brand-text">SITOQUE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Início</p>
                    </a>
                </li>
                @if (session()->get('nv') == 3 || session()->get('nv') == 2)
                    <li class="nav-header">Pedidos</li>
                    <li class="nav-item">
                        <a href="{{ route('pedidos') }}"
                           class="nav-link  {{ (request()->is('pedidos.index')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Pedidos</p>
                        </a>
                    </li>
                @if (session()->get('nv') == 2)
                    <li class="nav-item">
                        <a href="{{ route('pedidoSolicitado') }}"
                           class="nav-link  {{ (request()->is('pedidos.pedidosSolicitados')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-layer-group"></i>
                            <p>Pedidos Solicitados</p>
                        </a>
                    </li>
                @endif
                @endif
                @if (session()->get('nv') == 2)
                    <li class="nav-header">Gerencial</li>
                    <li class="nav-item">
                        <a href="{{ route('produtos') }}"
                           class="nav-link {{ (request()->is('produtos')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-dolly"></i>
                            <p>Produtos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categorias') }}"
                           class="nav-link {{ (request()->is('categorias')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cube"></i>
                            <p>Categoria</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subcategoria') }}"
                           class="nav-link {{ (request()->is('subcategorias')) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cubes"></i>
                            <p>Subcategoria</p>
                        </a>
                    </li>
                @endif
                <li class="nav-header">Conta</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" {{ (request()->is('minhaconta/*')) ? 'active' : '' }}>
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Minha conta
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dados Principais</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Meus pedidos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
