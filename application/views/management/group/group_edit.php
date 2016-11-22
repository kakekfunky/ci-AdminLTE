<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('template/header');
$this->load->view('management/template/topbar');
$this->load->view('management/template/sidebar');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Group
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="box">
            <div class="box-header with-border">
              <h1><?php echo lang('edit_group_heading');?></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p><?php echo lang('edit_group_subheading');?></p>

              <div id="infoMessage"><?php echo $message;?></div>

              <?php echo form_open(current_url(), 'class="form-horizontal"');?>
                  <div class="form-group">
                    <label for="inputGroupName" class="col-sm-2 control-label">Group name</label>
                    <div class="col-sm-10">
                          <?php echo form_input($group_name);?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputGroupDescription" class="col-sm-2 control-label">Group Description</label>
                    <div class="col-sm-10">
                          <?php echo form_input($group_description);?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="buttonSubmit" class="col-sm-2 control-label"></label>

                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-info">Confirm</button>
                      <button type="reset" class="btn">reset</button>
                    </div>
                  </div>

              <?php echo form_close();?>
            </div>
            <!-- /.box-body -->
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
