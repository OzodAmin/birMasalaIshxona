<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Пользователи</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ route('users.index') }}">
                <i class="fa fa-circle-o"></i>&nbsp;
                <span>Пользователи</span>
              </a>
            </li>
            <li>
              <a href="{{ route('roles.index') }}">
                <i class="fa fa-circle-o"></i>&nbsp;
                <span>Роли</span>
              </a>
            </li>
            <li>
              <a href="{{ route('permissions.index') }}">
                <i class="fa fa-circle-o"></i>&nbsp;
                <span>Права</span>
              </a>
            </li>
            <li>
              <a href="{{ route('user_statuses.index') }}">
                <i class="fa fa-circle-o"></i>&nbsp;
                <span>Статусы пользователей</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- Product & categories -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-spinner"></i>
            <span>Товары</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{ route('products.index') }}">
                <i class="fa fa-circle-o"></i> <span>Товары</span>
              </a>
            </li>
            <li>
              <a href="{{ route('categories.index') }}">
                <i class="fa fa-circle-o"></i> <span>Категории</span>
              </a>
            </li>
            <li>
              <a href="{{ route('childCategories.index') }}">
                <i class="fa fa-circle-o"></i> <span>Дочерные категории</span>
              </a>
            </li>

            <li>
              <a href="{{ route('measures.index') }}">
                <i class="fa fa-circle-o"></i> <span>Ед. измерения</span>
              </a>
            </li>

            <li>
              <a href="{{ route('currencies.index') }}">
                <i class="fa fa-circle-o"></i> <span>Денежная единица</span>
              </a>
            </li>

            <li>
              <a href="{{ route('basises.index') }}">
                <i class="fa fa-circle-o"></i> <span>Базис</span>
              </a>
            </li>

            <li>
              <a href="{{ route('product_statuses.index') }}">
                <i class="fa fa-circle-o"></i> <span>Статус</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- Cities & Districts -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i>
            <span>Города</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('cities.index') }}"><i class="fa fa-circle-o"></i> <span>Регионы</span></a></li>
            <li><a href="{{ route('districts.index') }}"><i class="fa fa-circle-o"></i> <span>Районы</span></a></li>
          </ul>
        </li>
        <!-- RKP accounts -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-university"></i>
            <span>РКП</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li>
              <a href="{{ route('rkpsAdmin.index') }}">
                <i class="fa fa-circle-o"></i> 
                <span>Счета</span>
              </a>
            </li>
            <li>
              <a href="{{ route('payments.index') }}">
                <i class="fa fa-circle-o"></i> 
                <span>Платежи</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- Admin tools -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wrench"></i>
            <span>Настройки</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">
            <li>
              <a href="{{ route('holidays.index') }}">
                <i class="fa fa-circle-o"></i> 
                <span>Праздники</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>