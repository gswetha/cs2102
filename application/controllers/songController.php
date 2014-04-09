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
		$data['songs_list'] = $this->getAllSongs();
		$data['title'] = "Song Catalogue";
		$this->load->view('_home_header_styles');
		$this->load->view('songmenu', $data);
		$this->load->view('_home_footer_script');
	}

	function getAllSongs(){
		//display songs in catalogue
		$result = $this->song_model->getAllSongs();
		return $result;
	}

	function addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength){
		//get form input (album info, song info, singer info, composer info)
		$result = $this->song_model->addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength);
		return $result;
	}

	function deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear){
		//get form input
		$result = $this->song_model->deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear);
		return $result;
	}

	function updateSong(){
		//get form input
		$update_data = NULL;
		$song_identifier = NULL;
		$result = $this->song_model->updateSong($update_data, $song_identifier);
		return $result;
	}

	function searchSongbyTitle($title){
		$result = $this->song_model->searchSongbyTitle($title);
		return $result;
	}

	function searchSongbyYear($year){
		$result = $this->song_model->searchSongbyYear($year);
		return $result;
	}

	function searchSongbyGenre($genre){
		$result = $this->song_model->searchSongbyGenre($genre);
		return $result;
	}

	function searchSongbyPriceRange($lower, $upper){
		$result = $this->song_model->searchSongbyPriceRange($lower, $upper);
		return $result;
	}

	function searchSongbySinger($name, $firstname, $lastname){
		$result = $this->song_model->searchSongbySinger($name, $firstname, $lastname);
		return $result;
	}

	function searchSongbyComposer($name){
		$result = $this->song_model->searchSongbyComposer($name);
		return $result;
	}

	function searchSongGeneric($term){
		$result = $this->song_model->searchGeneric($term);
		return $result;
	}
}

?>