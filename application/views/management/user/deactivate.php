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
        <div class="box">
            <div class="box-header with-border">
              <h1><?php echo lang('deactivate_heading');?></h1>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


              <p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

              <?php echo form_open("management/user/deactivate/".$user->id);?>

                <p>
                	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
                  <input type="radio" name="confirm" value="yes" checked="checked" />
                  <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
                  <input type="radio" name="confirm" value="no" />
                </p>

                <?php echo form_hidden($csrf); ?>
                <?php echo form_hidden(array('id'=>$user->id)); ?>

                <p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

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
