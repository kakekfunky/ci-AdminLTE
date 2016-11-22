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
              <a href="<?php echo site_url('management/user/add') ?>" class="btn btn-primary">
                <i class="fa fa-plus">Add User</i>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>First name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Groups</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($content as $user): ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $user->username ?></td>
                        <td><?php echo $user->first_name ?></td>
                        <td><?php echo $user->last_name ?></td>
                        <td><?php echo $user->email ?></td>
                        <td><?php echo ($user->active) ? anchor("management/user/deactivate/".$user->id, lang('index_active_link')) : anchor("management/user/activate/". $user->id, lang('index_inactive_link'));?></td>
                        <td>
                          <?php foreach ($user->groups as $group): ?>
                            <?php echo anchor("management/group/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                          <?php endforeach; ?>
                        </td>
                        <td>
                          <?php echo anchor('management/user/edit/'.$user->id, 'Edit') ?> |
                          <?php echo anchor('management/user/detail/'.$user->id, 'Delete') ?>
                        </td>
                      </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
              </table>
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
