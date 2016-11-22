<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Properties extends CI_Controller {

    function __construct()
    {
      parent::__construct();

      $this->load->library(array('form_validation', 'session', 'ion_auth'));
      $this->load->helper('form');
      $this->lang->load('auth');
    }

    public function index()
    {
      $this->load->view('management/properties/index');
    }
}
