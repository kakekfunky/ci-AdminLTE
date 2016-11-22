<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
      parent::__construct();

      $this->load->library(array('form_validation', 'session', 'ion_auth'));
      $this->load->helper('form');
      $this->lang->load('auth');
      $this->load->model('management/User_model', 'User_model');

    }

    public function index()
    {
      $data['tittle'] = "All User";
      $data['content'] = $this->ion_auth->users()->result();

      foreach ($data['content'] as $key => $user) {
        $data['content'][$key]->groups = $this->ion_auth->get_users_groups($user->id)->result();
      }

      $this->load->view('management/user/index', $data);
    }

    public function add()
    {
      $data['tittle'] = "Add User";

      $this->form_validation->set_rules('firstname', 'Firstname', 'required');
      $this->form_validation->set_rules('lastname', 'Lastname', 'required');
      $this->form_validation->set_rules('phone', 'Phone', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[25]');
      $this->form_validation->set_rules('password', 'Password', 'required');
      $this->form_validation->set_rules('rpassword', 'Repeat Password', 'required|matches[password]');
      $this->form_validation->set_rules('email', 'Email', 'required');

      if ($this->form_validation->run() == TRUE) {

        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $repeat_password = $this->input->post('rpassword');

        $additional_data = array(
          'first_name' => $firstname,
          'last_name' => $lastname,
          'phone' => $phone
        );

        if ($this->ion_auth->register($username, $password, $email, $additional_data)) {
          $this->session->set_flashdata('message', $this->ion_auth->messages());
          echo $this->ion_auth->messages();
          redirect('management/user', 'refresh');
        } else {
          echo "register gagal".$this->ion_auth->errors();
          $this->session->set_flashdata('message', $this->ion_auth->messages());
          redirect('management/user/add', 'refresh');
        }
      } else {
        echo "load view";
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->load->view('management/user/user_add', $data);
      }

    }

    public function edit($id)
    {

      $this->data['tittle'] = "Edit User";
      if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
  		{
  			redirect('auth', 'refresh');
  		}

      $user = $this->ion_auth->user($id)->row();
  		$groups=$this->ion_auth->groups()->result_array();
  		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

  		// validate form input
  		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
  		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
  		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
  		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

      if (isset($_POST) && !empty($_POST))
  		{
  			// do we have a valid request?
  			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
  			{
  				show_error($this->lang->line('error_csrf'));
  			}

  			// update the password if it was posted
  			if ($this->input->post('password'))
  			{
  				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
  				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
  			}

  			if ($this->form_validation->run() === TRUE)
  			{
  				$data = array(
  					'first_name' => $this->input->post('first_name'),
  					'last_name'  => $this->input->post('last_name'),
  					'company'    => $this->input->post('company'),
  					'phone'      => $this->input->post('phone'),
  				);

  				// update the password if it was posted
  				if ($this->input->post('password'))
  				{
  					$data['password'] = $this->input->post('password');
  				}



  				// Only allow updating groups if user is admin
  				if ($this->ion_auth->is_admin())
  				{
  					//Update the groups user belongs to
  					$groupData = $this->input->post('groups');

  					if (isset($groupData) && !empty($groupData)) {

  						$this->ion_auth->remove_from_group('', $id);

  						foreach ($groupData as $grp) {
  							$this->ion_auth->add_to_group($grp, $id);
  						}

  					}
  				}

  			// check to see if we are updating the user
  			   if($this->ion_auth->update($user->id, $data))
  			    {
  			    	// redirect them back to the admin page if admin, or to the base url if non admin
  				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
  				    if ($this->ion_auth->is_admin())
  					{
  						redirect('management/user', 'refresh');
  					}
  					else
  					{
  						redirect('/', 'refresh');
  					}

  			    }
  			    else
  			    {
  			    	// redirect them back to the admin page if admin, or to the base url if non admin
  				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
  				    if ($this->ion_auth->is_admin())
  					{
  						redirect('auth', 'refresh');
  					}
  					else
  					{
  						redirect('/', 'refresh');
  					}

  			    }

  			}
  		}

      // display the edit user form
  		$this->data['csrf'] = $this->_get_csrf_nonce();

  		// set the flash data error message if there is one
  		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      // pass the user to the view
  		$this->data['user'] = $user;
  		$this->data['groups'] = $groups;
  		$this->data['currentGroups'] = $currentGroups;

  		$this->data['first_name'] = array(
  			'name'  => 'first_name',
  			'id'    => 'first_name',
  			'type'  => 'text',
        'class' => 'form-control',
  			'value' => $this->form_validation->set_value('first_name', $user->first_name),
  		);
  		$this->data['last_name'] = array(
  			'name'  => 'last_name',
  			'id'    => 'last_name',
  			'type'  => 'text',
        'class' => 'form-control',
  			'value' => $this->form_validation->set_value('last_name', $user->last_name),
  		);
  		$this->data['company'] = array(
  			'name'  => 'company',
  			'id'    => 'company',
  			'type'  => 'text',
        'class' => 'form-control',
  			'value' => $this->form_validation->set_value('company', $user->company),
  		);
  		$this->data['phone'] = array(
  			'name'  => 'phone',
  			'id'    => 'phone',
  			'type'  => 'text',
        'class' => 'form-control',
  			'value' => $this->form_validation->set_value('phone', $user->phone),
  		);
  		$this->data['password'] = array(
  			'name' => 'password',
  			'id'   => 'password',
  			'type' => 'password',
        'class' => 'form-control',
  		);
  		$this->data['password_confirm'] = array(
  			'name' => 'password_confirm',
  			'id'   => 'password_confirm',
  			'type' => 'password',
        'class' => 'form-control',
  		);
      $this->load->view('management/user/user_edit', $this->data);
    }

    public function delete($id)
    {
      # code...
    }

    public function detail($id)
    {
      $data['user_info'] = $this->ion_auth->user($id)->result();

      $this->load->view('management/user/user_detail');

    }

    public function activate($id, $code=false)
    {
      if ($code !== false)
      {
        $activation = $this->ion_auth->activate($id, $code);
      }
      else if ($this->ion_auth->is_admin())
      {
        $activation = $this->ion_auth->activate($id);
      }

      if ($activation)
      {
        // redirect them to the auth page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect("management/user/", 'refresh');
      }
      else
      {
        // redirect them to the forgot password page
        $this->session->set_flashdata('message', $this->ion_auth->errors());
        redirect("management/user/forgot_password", 'refresh');
      }
    }

    // deactivate the user
  	public function deactivate($id = NULL)
  	{
      $this->data['tittle'] = "User";

  		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
  		{
  			// redirect them to the home page because they must be an administrator to view this
  			return show_error('You must be an administrator to view this page.');
  		}

  		$id = (int) $id;

  		$this->load->library('form_validation');
  		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
  		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

  		if ($this->form_validation->run() == FALSE)
  		{
  			// insert csrf check
  			$this->data['csrf'] = $this->_get_csrf_nonce();
  			$this->data['user'] = $this->ion_auth->user($id)->row();

  			$this->load->view('management/user/deactivate', $this->data);
  		}
  		else
  		{
  			// do we really want to deactivate?
  			if ($this->input->post('confirm') == 'yes')
  			{
  				// do we have a valid request?
  				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
  				{
  					show_error($this->lang->line('error_csrf'));
  				}

  				// do we have the right userlevel?
  				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
  				{
  					$this->ion_auth->deactivate($id);
  				}
  			}

  			// redirect them back to the auth page
  			redirect('management/user/', 'refresh');
  		}
  	}

    public function _get_csrf_nonce()
  	{
  		$this->load->helper('string');
  		$key   = random_string('alnum', 8);
  		$value = random_string('alnum', 20);
  		$this->session->set_flashdata('csrfkey', $key);
  		$this->session->set_flashdata('csrfvalue', $value);

  		return array($key => $value);
  	}

    public function _valid_csrf_nonce()
    {
      $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
      if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
      {
        return TRUE;
      }
      else
      {
        return FALSE;
      }
    }
}
