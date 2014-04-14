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

		//Models
		$this->load->model('song_model');
		$this->load->model('album_model');
		$this->load->model('composer_model');
		
	 }
	 
	public function index()
	{
		$data['add'] = NULL;
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit',$data);
		$this->load->view('_home_footer_script');
	}

	function searchItem(){
		if($this->input->post('searchSubmit')) {
			$result = NULL;
			switch ($this->input->post('searchOption')) {
				case 'Song':
					$result = $this->song_model->searchSongbyTitle($this->input->post('searchInput'));
					$data['category']="song";
					break;
				case 'Album':
					$result = $this->album_model->searchAlbumbyTitle($this->input->post('searchInput'));
					$data['category']="album";
					break;
				case 'Composer':
					$result = $this->composer_model->searchComposerByName($this->input->post('searchInput'));
					$data['category']="composer";
					break;
				default:
					$result = "No Input";
					break;
			}
			if(count($result)){
				//var_dump($result);
				$data['searchResults'] = $result;	
			}
			else
				$data['searchResults'] = NULL;

			$this->load->view('_home_header_styles');
			$this->load->view('admin_edit_searchItem',$data);
			$this->load->view('_home_footer_script');
		}

		//to redirect to home controller function add_song_album
		//redirect($this->config->item('base_url')."home/add_song_album");
	}

	function deleteAlbum(){
		echo "in deletealbum";
		if($this->input->post('deleteAlbum')) {
			$albumTitle = $this->input->post('albumTitle');
			$albumYear = $this->input->post('albumYear');
			$result = $this->album_model->deleteAlbum($albumTitle, $albumYear);
			if($result){
				$data['delete'] = "Album : ".$albumTitle." is successfully deleted!";
			}else{
				$data['delete'] = "Failed to delete Album : ".$albumTitle;
			}
			$this->load->view('_home_header_styles');
			$this->load->view('admin_edit_deleteAlbum',$data);
			$this->load->view('_home_footer_script');
		}else{
			echo "nothing	";
		}
		
	}

	function deleteSong(){
		var_dump($_POST);
		if($this->input->post('deleteSong')) {
			$sAlbumTitle = $this->input->post('sAlbumTitle');
			$sAlbumYear = $this->input->post('sAlbumYear');
			$songTitle = $this->input->post('songTitle');
			$songYear = $this->input->post('songYear');
			$result = $this->song_model->deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear);
			$delete_data['sAlbumTitle'] = $sAlbumTitle;
			$delete_data['sAlbumYear'] = $sAlbumYear;
			$delete_data['songTitle'] = $songTitle;
			$delete_data['songYear'] = $songYear;

			if($result){
				$data['notify_type'] = "delete song";
				$data['song_info'] = $delete_data;			
			}else{
				$data['errors'][] = "Failed to delete song. Please verify all the fields";
			}

			$this->load->view('_home_header_styles');
			$this->load->view('admin_edit_songNotify',$data);
			$this->load->view('_home_footer_script');
		} else{
			echo "nothing	";
		}
	}

}

?>