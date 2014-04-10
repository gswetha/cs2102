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
		$this->load->model('purchase_model');
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

	function purchaseSong(){
		echo "in purchaseSong";
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

	function getRevenueByGenre(){
		$this->singer_model->getRevenueByGenre();
	}

	function getRevenueByAlbum(){
		$this->singer_model->getRevenueByAlbum();
	}

	function getRevenueByComposer(){
		$this->singer_model->getRevenueByComposer();
	}

	function getRevenueBySong(){
		$this->singer_model->getRevenueBySong();
	}

	
}

?>