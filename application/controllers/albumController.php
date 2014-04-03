<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AlbumController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
		// Models
		// $this->load->model('album_model');
	 }
	 
	public function index()
	{
		$data['albumImg'] = $this->getAllAlbumImg();
		log_message('debug','creating something here in album');
		$this->load->view('_home_header_styles');
		$this->load->view('albummenu',$data);
		$this->load->view('_home_footer_script');
	}

	function getAlbum(){
		$albums = $this->album_model->getAlbum();
		return $albums;
	}

	function getAllAlbumImg(){
		log_message('info', 'entered the getAllComposers function in composer controller');
		$img = $this->album_model->getAllAlbumImg();
		return $img;
	}

	function addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip){
		$this->album_model->addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip);
	}

	function searchAlbumbyTitle($title){
		$result = $this->album_model->searchAlbumbyTitle(($title);
		return $result;
	}

	function searchAlbumbyYear($year){
		$this->album_model->searchAlbumbyYear($year);
	}

	function searchAlbumbyGenre($genre){
		$this->album_model->searchAlbumbyGenre($genre);
	}

	function searchAlbumbyPriceRange($lowerPrice,$upperPrice){
		$this->album_model->searchAlbumbyPriceRange($lowerPrice,$upperPrice);
	}

	function searchAlbumbyArtist($name, $firstName, $lastName){
		$this->album_model->searchAlbumbyArtist($name, $firstName, $lastName);
	}

	function updateAlbum($update_data, $album_identifier){
		$this->album_model->updateAlbum($update_data, $album_identifier);
	}

	function deleteAlbum($albumTitle, $albumYear){
		$this->album_model->deleteAlbum($albumTitle, $albumYear);
	}

	function albumGenericSearch($searchCheck){
		$this->album_model->albumGenericSearch($searchCheck);
	}

	function searchMostPopular(){
		$this->album_model->searchMostPopular();
	}

	
}

?>