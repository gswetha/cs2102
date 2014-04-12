<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminEditController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
	 }
	 
	public function index()
	{
		$data['add'] = NULL;
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit',$data);
		$this->load->view('_home_footer_script');
	}

}

?>