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
		$this->load->model('album_model');
	 }
	 
	public function index()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('home_page');
		$this->load->view('_home_footer_script');
	}

	function getAlbum(){
		$this->album_model->getAlbum();
	}

	function addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip){
		$this->album_model->addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip);
	}

	function searchAlbumbyTitle($title){
		$this->album_model->searchAlbumbyTitle(($title);
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

	function updateAlbumTitle($newTitle, $oldTitle, $albumYear){
		$this->album_model->updateAlbumTitle($newTitle, $oldTitle, $albumYear);
	}

	function updateAlbumPrice($price,$albumTitle, $albumYear){
		$this->album_model->updateAlbumPrice($price,$albumTitle, $albumYear);
	}

	function updateAlbumGenre($genre, $albumTitle, $albumYear){
		$this->album_model->updateAlbumGenre($genre, $albumTitle, $albumYear);
	}

	function deleteAlbum($albumTitle, $albumYear){
		$this->album_model->deleteAlbum($albumTitle, $albumYear);
	}

	function albumGenericSearch(){
		$this->album_model->albumGenericSearch();
	}

	function searchMostPopular(){
		$this->album_model->searchMostPopular();
	}

	
}

?>