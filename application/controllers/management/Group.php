<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

    function __construct()
    {
      parent::__construct();

      $this->load->library(array('form_validation', 'session', 'ion_auth'));
      $this->load->helper('form');
      $this->lang->load('auth');
    }

    public function index()
    {
      $this->data['title'] = "Group Management";
      if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
      {
          redirect('auth/login', 'refresh');
      }
      else
      {
          $this->data['groups'] = $this->ion_auth->groups()->result();

          $this->load->view('management/group/index', $this->data);
      }
    }

    // create a new group
  	public function create_group()
  	{
  		$this->data['title'] = $this->lang->line('create_group_title');

  		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
  		{
  			redirect('auth', 'refresh');
  		}

  		// validate form input
  		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

  		if ($this->form_validation->run() == TRUE)
  		{
  			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
  			if($new_group_id)
  			{
  				// check to see if we are creating the group
  				// redirect them back to the admin page
  				$this->session->set_flashdata('message', $this->ion_auth->messages());
  				redirect("management/group/", 'refresh');
  			}
  		}
  		else
  		{
  			// display the create group form
  			// set the flash data error message if there is one
  			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

  			$this->data['group_name'] = array(
  				'name'  => 'group_name',
  				'id'    => 'group_name',
  				'type'  => 'text',
  				'value' => $this->form_validation->set_value('group_name'),
  			);
  			$this->data['description'] = array(
  				'name'  => 'description',
  				'id'    => 'description',
  				'type'  => 'text',
  				'value' => $this->form_validation->set_value('description'),
  			);

  			$this->load->view('management/group/group_add', $this->data);
  		}
  	}

  	// edit a group
  	public function edit_group($id)
  	{
  		// bail if no group id given
  		if(!$id || empty($id))
  		{
  			redirect('auth', 'refresh');
  		}

  		$this->data['title'] = $this->lang->line('edit_group_title');

  		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
  		{
  			redirect('auth', 'refresh');
  		}

  		$group = $this->ion_auth->group($id)->row();

  		// validate form input
  		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

  		if (isset($_POST) && !empty($_POST))
  		{
  			if ($this->form_validation->run() === TRUE)
  			{
  				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

  				if($group_update)
  				{
  					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
  				}
  				else
  				{
  					$this->session->set_flashdata('message', $this->ion_auth->errors());
  				}
  				redirect("management/group/", 'refresh');
  			}
  		}

  		// set the flash data error message if there is one
  		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

  		// pass the user to the view
  		$this->data['group'] = $group;

  		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

  		$this->data['group_name'] = array(
  			'name'    => 'group_name',
  			'id'      => 'group_name',
  			'type'    => 'text',
  			'value'   => $this->form_validation->set_value('group_name', $group->name),
  			$readonly => $readonly,
  		);
  		$this->data['group_description'] = array(
  			'name'  => 'group_description',
  			'id'    => 'group_description',
  			'type'  => 'text',
  			'value' => $this->form_validation->set_value('group_description', $group->description),
  		);

  		$this->load->view('management/group/group_edit', $this->data);
  	}


}
