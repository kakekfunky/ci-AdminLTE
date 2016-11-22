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
      <div class="row">
        <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <a href="<?php echo site_url('management/user') ?>" class="btn btn-warning">
                List User
              </a>
            </div>
            <!-- /.box-header -->
            <?php
            echo validation_errors();
            echo $this->session->flashdata('message');
            ?>
            <!-- form start -->
            <?php echo form_open('management/user/add', 'class="form-horizontal"'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputFirstName" class="col-sm-2 control-label">First name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputlastName" class="col-sm-2 control-label">Last name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPhone" class="col-sm-2 control-label">Phone Number</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="08xxx">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUsername" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputRPassword" class="col-sm-2 control-label">Repeat Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="repeat password">
                  </div>
                </div>

                <div class="form-group">
                  <label for="buttonSubmit" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-info">Confirm</button>
                    <button type="reset" class="btn">reset</button>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
            <?php echo form_close(); ?>
          </div>
        <!-- /.box -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
$this->load->view('template/footer');
?>
