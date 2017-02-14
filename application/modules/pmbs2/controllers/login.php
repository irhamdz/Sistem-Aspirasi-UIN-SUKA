<?php

class Login extends CI_Controller {
	
	function index(){
		$data['main_content'] = 'login/login_form';
		$this->load->view('blue_login/content', $data);		
	}
	
	function validate_credentials()
	{		
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		
		if($query) // if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('artmin/members_area');
		}
		else // incorrect username or password
		{
			$this->index();
		}
	}	
	
	function signup()
	{
		$data['main_content'] = 'signup_form';
		$this->load->view('fishy/content', $data);
	}
	
	function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('is_logged_in');
		$this->session->sess_destroy();
		$this->index();
	}	
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)		{
			redirect('login');
			die();		
			
		}		
	}
}