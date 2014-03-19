<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
   * Landing page for CS2102 project - Music DB app
	 */
	public function index() {
		$this->load->view('_home_header_styles');
		$this->load->view('guest_home_page');
		$this->load->view('_home_footer_script');
	}

	public function guest() {
		$this->load->view('_home_header_styles');
		$this->load->view('guest_home_page');
		$this->load->view('_home_footer_script');
	}

	public function user() {
		$this->load->view('_home_header_styles');
		$this->load->view('user_home_page');
		$this->load->view('_home_footer_script');
	}

	public function admin() {
		$this->load->view('_home_header_styles');
		$this->load->view('admin_home_page');
		$this->load->view('_home_footer_script');
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
