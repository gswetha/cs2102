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
		$data['allSingers'] = $this->getSinger();
		$data['allSingerSongs'] = $this->getSingerSongs();
		$this->load->view('_home_header_styles');
		$this->load->view('singermenu',$data);
		$this->load->view('_home_footer_script');
	}

	function getSinger(){
		$singers = $this->singer_model->getSinger();
		return $singers;
	}

	// function searchResult($some){
	// 	redirect back to somewhere
	// }
	function getAllSingerImg(){
		$images = $this->singer_model->getAllSingerImg();
		return $images;
	}

	function getSingerSongs(){
		$allInfo = $this->singer_model->getSingerSongs();
		return $allInfo;
	}

	function addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img){
		$this->singer_model->addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img);
	}

	function searchSingerbySongTitle($title){
		$this->singer_model->searchAlbumbyTitle($title);
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
	
	function updateSinger($update_data, $singer_identifier){
		$this->singer_model->updateSinger($update_data, $singer_identifier);
	}

	function deleteSinger($firstName, $lastName, $stageName){
		$this->singer_model->searchSingerbyName($name, $firstName, $lastName);
	}

	function singerGenericSearch($searchCheck){
		$this->singer_model->singerGenericSearch();
	}

	function searchMostPopular(){
		$this->singer_model->searchMostPopular();
	}

}

?>