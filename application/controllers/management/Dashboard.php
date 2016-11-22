<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('management/Dashboard_model');

  }

  public function index()
  {
    if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
    {
        redirect('auth/login', 'refresh');
    }
    else
    {
        $data['tittle'] = "Dashboard";

        $data['users_count'] = $this->Dashboard_model->count_record('users');
        $data['groups_count'] = $this->Dashboard_model->count_record('groups');
        $data['memory_usage'] = $this->Dashboard_model->memory_usage();


        $this->load->view('management/dashboard', $data);
    }
  }
}
