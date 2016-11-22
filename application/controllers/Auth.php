<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->lang->load('auth');

    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
  }

	public function index()
	{
    if (!$this->ion_auth->logged_in()) {
      redirect('auth/login', 'refresh');
    } else if (!$this->ion_auth->is_admin()) {
      return show_error('You must be an administrator to view this page.');
    }else {
      $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
      redirect('management/dashboard', 'refresh');
    }
	}

  public function login()
  {

    //validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

    if ($this->form_validation->run() == true)
		{

      $remember = (bool) $this->input->post('remember');

      if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
      {
        //login sukses, balik ke dashboard
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('management/dashboard', 'refresh');
      }
      else
      {
        // login gagal, balik ke halaman login
        $this->session->set_flashdata('message', $this->ion_auth->errors());
        redirect('auth/login', 'refresh');
      }

    } else
    {
		  $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

      $this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
        'class' => 'form-control'
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
        'class' => 'form-control'
			);

      $this->load->view('auth/login', $this->data);
		}
  }

  public function logout()
  {
    $this->data['title'] = "Logout";

    // log the user out
    $logout = $this->ion_auth->logout();

    // redirect them to the login page
    $this->session->set_flashdata('message', $this->ion_auth->messages());
    redirect('auth/login', 'refresh');
  }
}
