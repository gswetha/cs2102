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
		$this->load->model('user_model');
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
		$data['title'] = "Buy Song";
		echo "in purchaseSong";
		 if($this->input->post('buy_song') && $this->input->post('songTitle') && $this->input->post('songYear') && $this->input->post('sAlbumTitle') && $this->input->post('sAlbumYear') && $this->input->post('amountPaid') && $this->input->post('userEmail')) {

		 	$user_info = $this->user_model->getUserByEmail($this->input->post('userEmail'));

		 	$insert_data['pAlbumTitle']		 = $this->input->post('sAlbumTitle');
		 	$insert_data['pAlbumYear']		 = $this->input->post('sAlbumYear');
		 	$insert_data['pSongTitle'] 		 = $this->input->post('songTitle');
		 	$insert_data['pSongYear'] 		 = $this->input->post('songYear');
		 	$insert_data['pEmail']		 	 = $user_info['paypalEmail'];
		 	$insert_data['transactionDate']  = date('Y-m-d');
		 	$insert_data['amountPaid'] 		 = $this->input->post('amountPaid');
		 	$insert_data['purchaseType'] 	 = "song";
		 	if ($this->purchase_model->purchaseSong($insert_data)){
		 		echo "successfully purchased song";
		 		var_dump($insert_data);
		 	}
		 }
		 else{
		 	echo "Sorry, we do not have all the information needed to add the song to the DB";
		 	$data['error'][] = "Sorry, we do not have all the information needed to add the song to the DB";
		 	log_message('error', 'post information is '.print_r($_POST,true));
		 }
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