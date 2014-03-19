<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
   * Landing page for CS2102 project - Music DB app
	 */
	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		$this->load->library('session');
		
		// Models
		$this->load->model('user_model');
	}

	public function index()
	{
		$data['title'] = "home page";
		
		if ($this->isLoggedIn())
			$data['logged_in'] = TRUE;
		else
			$data['logged_in'] = FALSE;

		$this->load->view('_home_header_styles');
		$this->load->view('home_page',$data);
		$this->load->view('_home_footer_script');
	}

	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
