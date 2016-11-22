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
            <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputFirstName" class="col-sm-2 control-label">First name</label>

                  <div class="col-sm-10">
                    <?php echo form_input($first_name);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputlastName" class="col-sm-2 control-label">Last name</label>

                  <div class="col-sm-10">
                    <?php echo form_input($last_name);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPhone" class="col-sm-2 control-label">Phone Number</label>

                  <div class="col-sm-10">
                    <?php echo form_input($phone);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputCompany" class="col-sm-2 control-label">Company</label>

                  <div class="col-sm-10">
                    <?php echo form_input($company);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <?php echo form_input($password);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputRPassword" class="col-sm-2 control-label">Repeat Password</label>

                  <div class="col-sm-10">
                    <?php echo form_input($password_confirm);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="groups" class="col-sm-2 control-label">Groups</label>

                  <div class="col-sm-10">
                    <?php if ($this->ion_auth->is_admin()): ?>

                        <h3><?php echo lang('edit_user_groups_heading');?></h3>
                        <?php foreach ($groups as $group):?>
                            <label class="checkbox">
                            <?php
                                $gID=$group['id'];
                                $checked = null;
                                $item = null;
                                foreach($currentGroups as $grp) {
                                    if ($gID == $grp->id) {
                                        $checked= ' checked="checked"';
                                    break;
                                    }
                                }
                            ?>
                            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                            <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                            </label>
                        <?php endforeach?>

                    <?php endif ?>
                  </div>
                </div>

                <?php echo form_hidden('id', $user->id);?>
                <?php echo form_hidden($csrf); ?>

                <div class="form-group">
                  <label for="buttonSubmit" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-info">Update</button>
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
