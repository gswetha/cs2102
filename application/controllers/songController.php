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
		$this->song_model->addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength);
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
}

?>