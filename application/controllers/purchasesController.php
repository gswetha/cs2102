<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PurchasesController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
		// Models
		$this->load->model('purchases_model');
	 }
	 
	public function index()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('home_page');
		$this->load->view('_home_footer_script');
	}

	function getAllPurchases(){
		$this->singer_model->getAllPurchases();
	}

	function getRevenue(){
		$this->singer_model->getRevenue();
	}

	function getPurchasesByUser($userEmail){
		$this->singer_model->getPurchasesByUser($userEmail);
	}

	function getRevenueBySinger($firstName, $lastName){
		$this->singer_model->getRevenueBySinger($firstName, $lastName);
	}

	function getRevenueByGenre($genre){
		$this->singer_model->getRevenueByGenre($genre);
	}

	function getRevenueByAlbum($title, $year){
		$this->singer_model->getRevenueByAlbum($title, $year);
	}

	function getRevenueByComposer($firstName, $lastName){
		$this->singer_model->getRevenueByComposer($firstName, $lastName);
	}

	function getRevenueBySong($songTitle, $songYear, $albumTitle, $albumYear){
		$this->singer_model->getRevenueBySong($songTitle, $songYear, $albumTitle, $albumYear);
	}

	
}

?>