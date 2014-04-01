<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ComposerController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
		// Models
		$this->load->model('composer_model');
		$this->load->model('user_model');
	 }
	 
	public function index()
	{
		$data['composers_list'] = $this->getAllComposers();
		$data['title'] = "Composer Catalogue";
		$this->load->view('_home_header_styles');
		$this->load->view('composermenu', $data);
		$this->load->view('_home_footer_script');
	}

	function getAllComposers(){
		log_message('info', 'entered the getAllComposers function in composer controller');
		$data_composers = $this->composer_model->getAllComposers();
		return $data_composers;
	}

	function getUserByEmail(){
		$this->user_model->getUserByEmail('admin@gmail.com');
	}

	function addComposer(){
		//form input
		$data_insert = NULL;
		$this->composer_model->addComposer($data_insert);
	}

	function updateSinger(){
		//get info from form
		$this->composer_model->updateComposer($update_data, $composer_identifier);
	}

	function deleteComposer(){
		//get info from table form
		$this->composer_model->deleteComposer($composerFirstName, $composerLastName, $composerBirthday);
	}

	function composerGenericSearch(){
		//get search term from search bar
		$term = "achraf";
		$this->composer_model->searchGeneric($term);
	}

	function searchComposerBySong($songTitle){
		$this->composer_model->searchComposerBySong($songTitle);
	}

	function searchComposerByName($name){
		$this->composer_model->searchComposerByName($name);
	}

	function searchComposerByAlbum($album){
		$this->composer_model->searchComposerByAlbum($album);
	}

	function searchComposerByGenre($genre){
		$this->composer_model->searchComposerByGenre($genre);
	}

	function searchComposerByBirthday($birthday, $lower, $higher){
		$this->composer_model->searchComposerByBirthday($birthday, $lower, $higher);
	}
	
}

?>