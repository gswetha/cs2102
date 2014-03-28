<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SingerController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
		// Models
		$this->load->model('singer_model');
	 }
	 
	public function index()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('home_page');
		$this->load->view('_home_footer_script');
	}

	function getSinger(){
		$this->singer_model->getSinger();
	}

	function addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img){
		$this->singer_model->addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img);
	}

	function searchSingerbySongTitle($title){
		$this->singer_model->searchAlbumbyTitle(($title);
	}

	function searchSingerbyAlbumTitle($title){
		$this->singer_model->searchAlbumbyYear($year);
	}

	function searchSingerbyYear($year){
		$this->singer_model->searchAlbumbyGenre($genre);
	}

	function searchSingerbyGenre($genre){
		$this->singer_model->searchAlbumbyPriceRange($lowerPrice,$upperPrice);
	}

	function searchSingerbyBirthday($birthday,$lowerBirthday,$upperBirthday){
		$this->singer_model->searchSingerbyBirthday($birthday,$lowerBirthday,$upperBirthday);
	}

	function searchSingerbyName($name, $firstName, $lastName){
		$this->singer_model->searchSingerbyName($name, $firstName, $lastName);
	}
	
	function updateSingerName($newFirstName, $newLastName, $oldFirstName, $oldLastName, $stageName){
		$this->singer_model->updateSingerName($newFirstName, $newLastName, $oldFirstName, $oldLastName, $stageName);
	}

	function updateSingerBirthday($birthday, $firstName, $lastName, $stageName){
		$this->singer_model->updateSingerBirthday($birthday, $firstName, $lastName, $stageName);
	}

	function updateSingerStageName($newStageName, $firstName, $lastName, $oldStageName){
		$this->singer_model->updateSingerStageName($newStageName, $firstName, $lastName, $oldStageName);
	}

	function deleteSinger($firstName, $lastName, $stageName){
		$this->singer_model->searchSingerbyName($name, $firstName, $lastName);
	}

	function singerGenericSearch(){
		$this->singer_model->singerGenericSearch();
	}

	function searchMostPopular(){
		$this->singer_model->searchMostPopular();
	}

}

?>