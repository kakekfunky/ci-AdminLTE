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
        <?php echo $title; ?>
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
              <a href="<?php echo site_url('management/group/create_group') ?>" class="btn btn-primary">
                <i class="fa fa-plus">Add Group</i>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($groups as $group): ?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $group->name ?></td>
                        <td><?php echo $group->description ?></td>
                        <td><?php echo anchor('management/group/edit_group/'.$group->id, 'Edit') ?></td>
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
