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
		$this->load->library('session');
		
		// Models
		$this->load->model('purchase_model');
		$this->load->model('user_model');
	 }
	 
	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
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
		$data['error'][] = "";
		$data['result'][] = "";
		//echo "in purchaseSong in PurchasesController";
		 if($this->input->post('buy_song') && $this->input->post('songTitle') && $this->input->post('songYear') && $this->input->post('sAlbumTitle') && $this->input->post('sAlbumYear') && $this->input->post('amountPaid') && $this->input->post('userEmail')) {

		 	$user_info = $this->user_model->getUserByEmail($this->input->post('userEmail'));
		 	//log_message('info', 'songs in album are '.print_r($songsInAlbum,TRUE));
		 	//if(count($songsInAlbum)){
		 		//foreach ($songsInAlbum as $key => $value) {
		 		// 	$albumTitle = str_ireplace("'", "\'", $value['sAlbumTitle']);
					// $songTitle = str_ireplace("'", "\'", $value['songTitle']);
		 			$isAlreadyPurchased = $this->purchase_model->checkPurchased($user_info['paypalEmail'],$this->input->post('sAlbumTitle'),$this->input->post('sAlbumYear'),$this->input->post('songTitle'), $this->input->post('songYear')); 
		 			if($isAlreadyPurchased){
		 				$data['error'] = "Error. Song is already purchased.";
					 	$data['isPurchaseSuccessful'] = false;
					 	//echo "error insert problem";
		 				
		 			}else{
			 			$insert_data['pAlbumTitle']		 = $this->input->post('sAlbumTitle');
					 	$insert_data['pAlbumYear']		 = $this->input->post('sAlbumYear');
					 	$insert_data['pSongTitle'] 		 = $this->input->post('songTitle');
					 	$insert_data['pSongYear'] 		 = $this->input->post('songYear');
					 	$insert_data['pEmail']		 	 = $user_info['paypalEmail'];
					 	$insert_data['transactionDate']  = date('Y-m-d');
					 	$insert_data['amountPaid'] 		 = $this->input->post('amountPaid');
					 	$insert_data['purchaseType'] 	 = "song";
					 	if ($this->purchase_model->purchaseSong($insert_data)){
					 		$data['isPurchaseSuccessful'] = true;
					 		// var_dump($insert_data);
					 	}else{
					 		$data['error'][] = "Error inserting purchase : album";
					 		$data['isPurchaseSuccessful'] = false;
					 	}
		 			}
		 		//}
		 		if($data['isPurchaseSuccessful']){
		 			$data['result'] = '- Song title : '.$this->input->post('songTitle');
		 		}
		 	//}

		 }
		 else{
		 	echo "Sorry, we do not have all the information needed to add the song to the DB";
		 	$data['error'][] = "Sorry, we do not have all the information needed to add the song to the DB";
		 	log_message('error', 'post information is '.print_r($_POST,true));
		 }

		$this->load->view('_home_header_styles');
		$this->load->view('purchaseReceipt',$data);
		$this->load->view('_home_footer_script');
	}

	function purchaseAlbum(){
		$data['title'] = "Buy Album";
		$data['error'][] = "";
		$data['result'][] = "";
		 if($this->input->post('buy_album') && $this->input->post('albumTitle') && $this->input->post('albumYear') && $this->input->post('amountPaid') && $this->input->post('userEmail')) {

		 	$user_info = $this->user_model->getUserByEmail($this->input->post('userEmail'));
		 	$songsInAlbum = $this->purchase_model->getAllSongsInAlbum($this->input->post('albumTitle'), $this->input->post('albumYear'));

		 	if(count($songsInAlbum)){
		 		foreach ($songsInAlbum as $key => $value) {
		 			$albumTitle = str_ireplace("'", "\'", $value['sAlbumTitle']);
					$songTitle = str_ireplace("'", "\'", $value['songTitle']);
		 			$isAlreadyPurchased = $this->purchase_model->checkPurchased($user_info['paypalEmail'],$albumTitle,$value['sAlbumYear'],$songTitle,$value['songYear']); 
		 			if($isAlreadyPurchased){
		 				$data['error'] = "Error. Album is already purchased.";
					 	$data['isPurchaseSuccessful'] = false;
					 	echo "error insert problem";
		 				break;
		 			}else{
			 			$insert_data['pAlbumTitle']		 = $albumTitle;
					 	$insert_data['pAlbumYear']		 = $value['sAlbumYear'];
					 	$insert_data['pSongTitle'] 		 = $songTitle;
					 	$insert_data['pSongYear'] 		 = $value['songYear'];
					 	$insert_data['pEmail']		 	 = $user_info['paypalEmail'];
					 	$insert_data['transactionDate']  = date('Y-m-d');
					 	$insert_data['amountPaid'] 		 = $this->input->post('amountPaid');
					 	$insert_data['purchaseType'] 	 = "album";
					 	if ($this->purchase_model->purchaseSong($insert_data)){
					 		$data['isPurchaseSuccessful'] = true;
					 		// var_dump($insert_data);
					 	}else{
					 		$data['error'][] = "Error inserting purchase : album";
					 		$data['isPurchaseSuccessful'] = false;
					 	}
		 			}
		 		}
		 		if($data['isPurchaseSuccessful']){
		 			$data['result'] = '- album title : '.$albumTitle;
		 		}
		 	}
		 }
		 else{
		 	$data['error'] = "Sorry, we do not have all the information needed to purchase the album";
		 	$data['isPurchaseSuccessful'] = false;
		 	log_message('error', 'post information is '.print_r($_POST,true));
		 }
		
		$this->load->view('_home_header_styles');
		$this->load->view('purchaseReceipt',$data);
		$this->load->view('_home_footer_script');
	}

	function getRevenue(){
		$this->singer_model->getRevenue();
	}

	function getPurchasesByUser(){
		$user_info = NULL;
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
			$user_info = $this->user_model->getUserByEmail($data['email']);
		}
		else
			$data['logged_in'] = FALSE;
		if($data['role'] == "admin") {
			$data['result'] = $this->purchase_model->getPurchasesByEveryone();
		}
		else {
			$data['result'] = $this->purchase_model->getPurchasesByUser($data['email']);
		}
		//var_dump($data['result']);
		$this->load->view('_home_header_styles');
		$this->load->view('purchases',$data);
		$this->load->view('_home_footer_script');
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