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

	function searchItem(){
		if($this->input->post('searchSubmit'){
			$result = NULL;
			switch ($this->input->post('searchOptions')) {
				case 'Song':
					$result = $this->songController->searchSongbyTitle($this->input->post('searchInput'));
					$data['category']="song";
					break;
				case 'Album':
					$result = $this->albumController->searchAlbumbyTitle($this->input->post('searchInput'));
					$data['category']="album";
					break;
				default:
					$result = "No Input";
					break;
			}
			if(count($result)){
				$data['searchResults'] = $result;	
			}
			else
				$data['searchResults'] = NULL;

			$this->load->view('_home_header_styles');
			$this->load->view('admin_edit',$data);
			$this->load->view('_home_footer_script');
		}

		//to redirect to home controller function add_song_album
		//redirect($this->config->item('base_url')."home/add_song_album");
	}

}

?>