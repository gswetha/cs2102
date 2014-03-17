<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SongController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');

		// Libraries
		$this->load->library('form_validation');
		
		// Models
		$this->load->model('song_model');
	 }
	 
	public function index()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('home_page');
		$this->load->view('_home_footer_script');
	}

	function getSong(){

	}

	function addSong(){

	}

	function searchSongbyTitle(){

	}

	function searchSongbyYear(){

	}

	function searchSongbyGenre(){

	}

	function searchSongbyPriceRange(){

	}
}

?>