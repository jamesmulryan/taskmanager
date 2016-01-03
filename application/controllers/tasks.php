<?php

class Tasks extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Load the necessary stuff...
		$this->load->helper(array('language', 'url', 'form', 'account/ssl'));
		$this->load->library(array('account/authentication', 'account/authorization'));
		$this->load->model(array('account/account_model'));
	}

	function index()
	{
		maintain_ssl();

		if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}

		$this->load->view('home', isset($data) ? $data : NULL);
	}
	
	
		function dashboard()
	{
	
	$this->output->enable_profiler(TRUE);
		
	// Enable SSL
    maintain_ssl($this->config->item("ssl_enabled"));
	
	// Get account data if signed in
	if ($this->authentication->is_signed_in())
		{
			$data['account'] = $this->account_model->get_by_id($this->session->userdata('account_id'));
		}

    // Redirect unauthenticated users to signin page
    if ( ! $this->authentication->is_signed_in())
    {
      redirect('account/sign_in/?continue='.urlencode(base_url().'home/dashboard'));
    }

    // Redirect unauthorized users to account profile page
    if ( ! $this->authorization->is_permitted('tasks_dashboard'))
    {
      redirect('account/account_profile');
    }
		$this->load->model('tasks_model');
		$data['tasks'] = $this->tasks_model->get();
		$this->load->view('dashboard', isset($data) ? $data : NULL);
	}

}


/* End of file home.php */
/* Location: ./system/application/controllers/home.php */