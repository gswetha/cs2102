<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserController extends CI_Controller {

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
		$this->load->view('_home_header_styles');
		$this->load->view('home_page');
		$this->load->view('_home_footer_script');
	}

	public function songmenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('songmenu');
		$this->load->view('_home_footer_script');
	}

	public function albummenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('albummenu');
		$this->load->view('_home_footer_script');
	}

	public function artistmenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('artistmenu');
		$this->load->view('_home_footer_script');
	}

	public function composermenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('composermenu');
		$this->load->view('_home_footer_script');
	}

	public function genremenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('genremenu');
		$this->load->view('_home_footer_script');
	}

	public function singlealbumview()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('singlealbummenu');
		$this->load->view('_home_footer_script');
	}

	public function top10songs()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10songs');
		$this->load->view('_home_footer_script');
	}

	public function top10albums()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10albums');
		$this->load->view('_home_footer_script');
	}

	public function top10singers()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10singers');
		$this->load->view('_home_footer_script');
	}

	public function purchases()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10singers');
		$this->load->view('_home_footer_script');
	}

	function login(){
		$data['start'] = $this->uri->segment(3);
		$data['error'] = "no error";
		$data['title'] = "login";
		if($this->isLoggedIn()){ //redirect back to home page
			redirect($this->config->item('base_url')."home");
		}
		else {
			
			if($this->input->post('submit_login') == "Sign in"){
				log_message('info', 'doing xss clean');
				$login = $this->input->post('submit_login');
				$login = $this->security->xss_clean($login);
				//check that input fields are not empty
				$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
				
				if ($this->form_validation->run()) { 
					log_message('info', 'ran validation');
					$rowData = $this->form_validation->get_data();
				 	log_message('info', 'form data is '.print_r($rowData,TRUE));
				 	$user_info = $this->user_model->getUserLogin($rowData['email'], $rowData['password']);
			 		 if($user_info) {
			 		 	log_message('info', 'user info is '.print_r($user_info,TRUE));
			 			 $this->session->set_userdata(array(
								'name'	=> $user_info['userName'],
								'status'	=> 'logged_in',
								'role'	=> $user_info['role'],
						));

			 			 log_message('info', 'session details are '.print_r($this->session->userdata('role'),TRUE));
			 			 redirect($this->config->item('base_url')."home");
			 		}
			 		else {
			 			$data['errors']['email'] = "Oops! Email and password did not match";
			 		}
			 	}
				else {
					//form validation failed
					log_message('info', 'validation did NOT work, trying to login');
					$error_list  = validation_errors();
					$error_array = $this->form_validation->error_fields();
					log_message("info","Errors back from login_form ".print_r($error_array,TRUE));
					if ($error_list != "") {
						$data['errors']       = $error_list;
						$data['error_array'] = $error_array;
					}
			 	}
			}
		}

			$this->load->view('_header_styles', $data);
			$this->load->view('login_form', $data);
			$this->load->view('_footer_script', $data);
	}

	private function getUserLogin($email, $password){
		log_message('info', 'in getUserLogin');
		$user = $this->user_model->getUserLogin($email, $password);
		log_message('info', 'controller getUserLogin - user info is '.print_r($user_info,TRUE));
		if(count($user) > 0)
			return $user;
		else
			return FALSE;
	}

	function getUserByName($name){

	}

	function getUserByEmail($email){

	}

	function logout(){
		 $this->session->set_userdata(array('name' => '', 'status' => '', 'role' => ''));
		 $this->session->sess_destroy();
		 redirect($this->config->item('base_url')."home");
	}

	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
	}

}

?>