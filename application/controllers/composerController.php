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
		$this->load->library('session');
		
		// Models
		$this->load->model('composer_model');
	 }
	 
	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
	}

	public function index()
	{
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
		}
		else {
			$data['logged_in'] = FALSE;
		}
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

	function addComposer(){
		//form input
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
		}
		else {
			$data['logged_in'] = FALSE;
		}
		$result = FALSE;
		$data['composer_info'] = NULL;
		$data['notify_type'] = "none";
		$data['errors'] = NULL;
		$data_insert = NULL;
		if ($this->input->post('submit_add_composer') && $this->input->post('composerFirstName') && $this->input->post('composerLastName') && $this->input->post('composerBirthday') && $this->input->post('composerDescrip') ) {
			//var_dump($_POST);
			$insert_data['composerFirstName'] = $this->input->post('composerFirstName');
			$insert_data['composerLastName'] = $this->input->post('composerLastName');
			$insert_data['composerBirthday'] = $this->input->post('composerBirthday');
			$insert_data['composerDescrip'] = $this->input->post('composerDescrip');
			$result = $this->composer_model->addComposer($insert_data);
			if($result) {
				$data['notify_type'] = "add composer";
				$data['composer_info'] = $insert_data;
				$this->load->view('_home_header_styles');
				$this->load->view('admin_edit_composerNotify', $data);
				$this->load->view('_home_footer_script');
			}
			else{
				$data['errors'][] = "Could not add composer. Please verify your input fields.";
				$this->load->view('_home_header_styles');
				$this->load->view('add_composer', $data);
				$this->load->view('_home_footer_script');
			}

		}
	}

	function updateComposer(){
		//get info from form
		//var_dump($_POST);
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
		}
		else {
			$data['logged_in'] = FALSE;
		}
		$result = FALSE;
		$data['composer_info'] = NULL;
		$data['notify_type'] = "none";
		$data['errors'] = NULL;
		$update_data = NULL;
		if ($this->input->post('updateSubmit')) {
			$update_data['composerFirstName'] = $this->input->post('composerFirstName');
			$update_data['composerLastName'] = $this->input->post('composerLastName');
			$update_data['composerBirthday'] = $this->input->post('composerBirthday');
			$update_data['composerDescrip'] = $this->input->post('composerDescrip');

			$composer_identifier['composerFirstName'] = $this->input->post('composerFirstNameOriginal');
			$composer_identifier['composerLastName'] = $this->input->post('composerLastNameOriginal');
			$composer_identifier['composerBirthday'] = $this->input->post('composerBirthdayOriginal');

			$result = $this->composer_model->updateComposer($update_data,$composer_identifier);
			//var_dump($result);
			
			if($result){
				$data['notify_type'] = "edit composer";
				$data['composer_info'] = $update_data;
				$this->load->view('_home_header_styles');
				$this->load->view('admin_edit_composerNotify',$data);
				$this->load->view('_home_footer_script');			
			}else{
				$data['errors'][] = "Failed to update composer. Please verify all the fields";
				$this->load->view('_home_header_styles');
				$this->load->view('edit_composer',$data);
				$this->load->view('_home_footer_script');	
			}
		} else{
			echo 'no form submission';
		}
		//$this->composer_model->updateComposer($update_data, $composer_identifier);
	}

	function deleteComposer(){
		//get info from table form
		$this->composer_model->deleteComposer($composerFirstName, $composerLastName, $composerBirthday);
	}

	function search(){
		//get form input from search and based on what user wants to search for, direct to the correct function and display the result
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
		}
		else {
			$data['logged_in'] = FALSE;
		}
		echo "search function";
		log_message('info', 'in search function in composer controller.');
		if($this->input->post('search_submit')) {
			echo "post successful";
			$result = NULL;
			switch ($this->input->post('search_option')) {
				case 'Search By..':
					$result = $this->composerGenericSearch($this->input->post('search_term'));
					break;
				case 'Composer Name':
					$result = $this->searchComposerByName($this->input->post('search_term'));
					break;
				case 'Composer Birthday':
					$term = $this->input->post('search_term');
					$term = explode(' ', $term);
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchComposerByBirthday($term[0], FALSE, FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchComposerByBirthday(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Song':
					$result = $this->searchComposerBySong($this->input->post('search_term'));
					break;
				case 'Album':
					$result = $this->searchComposerByAlbum($this->input->post('search_term'));
					break;
				case 'Genre':
					$result = $this->searchComposerByGenre($this->input->post('search_term'));
					break;
				default:
					$result = $this->composerGenericSearch($this->input->post('search_term'));
					break;
			}

			//process result and show page
			//var_dump($result);
			$data['composers_list'] = $result;
			$data['title'] = "Composer Catalogue";
			$this->load->view('_home_header_styles');
			$this->load->view('composermenu_searchComposer', $data);
			$this->load->view('_home_footer_script');
		}
		else
			redirect($this->config->item('base_url')."ComposerController");
	}

	function composerGenericSearch($term){
		//$term = "achraf";
		$result = $this->composer_model->searchGeneric($term);
		return $result;
	}

	function searchComposerBySong($songTitle){
		$result = $this->composer_model->searchComposerBySong($songTitle);
		return $result;
	}

	function searchComposerByName($name){
		$result = $this->composer_model->searchComposerByName($name);
		return $result;
	}

	function searchComposerByAlbum($album){
		$result = $this->composer_model->searchComposerByAlbum($album);
		return $result;
	}

	function searchComposerByGenre($genre){
		$result = $this->composer_model->searchComposerByGenre($genre);
		return $result;
	}

	function searchComposerByBirthday($birthday, $lower, $higher){
		$result = $this->composer_model->searchComposerByBirthday($birthday, $lower, $higher);
		return $result;
	}
	
}

?>