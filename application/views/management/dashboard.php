<?php
$this->load->view('template/header');
$this->load->view('management/template/topbar');
$this->load->view('management/template/sidebar');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $tittle; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Info boxes -->
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">CPU Traffic</span>
                    <span class="info-box-number">90<small>%</small></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-red"><i class="fa fa-microchip"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Memory Usage</span>
                    <span class="info-box-number"><?php echo $memory_usage ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <!-- fix for small devices only -->
              <div class="clearfix visible-sm-block"></div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-green"><i class="fa fa-shield"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Groups</span>
                    <span class="info-box-number"><?php echo $groups_count ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Members</span>
                    <span class="info-box-number"><?php echo $users_count ?></span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
$this->load->view('template/footer');
?>
