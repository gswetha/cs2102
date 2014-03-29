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

	function getAllSongs(){
		//display songs in catalogue
		$this->song_model->getAllSongs();
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
		$result = $this->song_model->updateSong($update_data, $song_identifier)
	}

	function searchSongbyTitle($title){
		$this->song_model->searchSongbyTitle($title);
	}

	function searchSongbyYear($year){
		$this->song_model->searchSongbyYear($year);
	}

	function searchSongbyGenre($genre){
		$this->song_model->searchSongbyGenre($genre);
	}

	function searchSongbyPriceRange($lower, $upper){
		$this->song_model->searchSongbyPriceRange($lower, $upper);
	}

	function searchSongbySinger($name, $firstname, $lastname){
		$this->song_model->searchSongbySinger($name, $firstname, $lastname);
	}

	function searchSongbyComposer($name){
		$this->song_model->searchSongbyComposer($name);
	}

	function searchSongGeneric($term){
		$this->song_model->searchGeneric($term);
	}
}

?>