<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- menu-open по списку <li> делает меню открытым -->
                <li class="nav-item has-treeview">
                    <!-- active по ссылке <a> подсвечивает ссылку как активную -->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Пользователь
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <!-- active по ссылке <a> подсвечивает ссылку как активную -->
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Пользователи</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.userr.index') }}" class="nav-link">
                                <i class="fas fa-unlock nav-icon"></i>
                                <p>Роли</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- -->
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book nav-icon"></i>
                        <p>
                            Справочники
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.instrument.index') }}" class="nav-link">
                                <i class="fas fa-tools nav-icon"></i>
                                <p>Инструменты</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.good.index') }}" class="nav-link">
                                <!--<i class="fab fa-penny-arcade nav-icon"></i>-->
                                <i class="fas fa-pen nav-icon"></i>
                                <p>Вид товара</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.basis.index') }}" class="nav-link">
                                <i class="fas fa-pen nav-icon"></i>
                                <p>Код базаса</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-pen nav-icon"></i>
                                <p>Код лота</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-pen nav-icon"></i>
                                <p>Способ поставки</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-bell nav-icon"></i>
                        <p>Данные торгов  <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.parse.data') }}" class="nav-link">
                                <i class="far fa-hourglass nav-icon"></i>
                                <p>Обновление данных</p>
                            </a>
                            <a href="{{ route('admin.show.data') }}" class="nav-link">
                                <i class="far fa-eye nav-icon"></i>
                                <p>Анализ торгов</p>
                            </a>
                        </li>

                    </ul>

                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.post.index') }}" class="nav-link">
                        <!--<i class="fas fa-bullhorn nav-icon"></i>-->
                        <i class="far fa-address-card nav-icon"></i>
                        <!-- новости это посты posts ) -->
                        <p>Новости</p>
                    </a>
                </li>

                <li class="nav-item">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon "></i>
                        <p>Выход</p>
                    </a>
                </li>
                <!-- -->
                <!--<li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>-->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
