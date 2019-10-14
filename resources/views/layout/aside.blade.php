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
                    <a href="{{-- route('pedido.solicitar') --}}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Início</p>
                    </a>
                </li>
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="{{-- route('pedido.solicitar') --}}" class="nav-link">
                        <i class="nav-icon fas fa-paper-plane"></i>
                        <p>Solicitar Pedidio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{-- route('pedidos') --}}" class="nav-link">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>Pedidos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('produtos') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>Produtos</p>
                    </a>
                </li>
                <li class="nav-header">Conta</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
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
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
