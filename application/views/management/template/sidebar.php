<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo site_url('management/dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

          </a>
        </li>
        <li class="header">Preferences</li>
        <li>
          <a href="<?php echo site_url('management/user') ?>">
            <i class="fa fa-user"></i> <span>Users</span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('management/group') ?>">
            <i class="fa fa-shield"></i> <span>Groups</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Properties</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('management/properties') ?>">
                <i class="fa fa-gear"></i> <span>System Properties</span>
              </a>
            </li>

          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
