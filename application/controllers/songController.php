<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SongController extends CI_Controller {

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
		$this->load->model('song_model');
		$this->load->model('album_model');
		$this->load->model('singer_model');
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
		$data['songs_list'] = $this->getAllSongs();
		$data['title'] = "Song Catalogue";
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
			$data['email'] = $this->session->userdata('email');
		}
		else
			$data['logged_in'] = FALSE;
		$this->load->view('_home_header_styles');
		$this->load->view('songmenu', $data);
		$this->load->view('_home_footer_script');
	}

	function getAllSongs(){
		//display songs in catalogue
		$result = $this->song_model->getAllSongs();
		return $result;
	}

	function addSong(){
		//get form input (album info, song info, singer info, composer info)
		// if album does not exist, throw an error.
		// if singer does not exist, throw error
		// if composer does not exist, throw error
		$result = FALSE;
		$data['song_info'] = NULL;
		$data['notify_type'] = "none";
		if ($this->input->post('submit_add_song')) {
			//echo "post result is "; var_dump($_POST);
			$album_exists = $this->album_model->getAlbumbyKey($this->input->post('sAlbumTitle'), $this->input->post('sAlbumYear'));
			$singer_exists = $this->singer_model->getSingerbyKey($this->input->post('singerFirstName'), $this->input->post('singerLastName'), $this->input->post('singerStageName'));
			$composer_exists = $this->composer_model->getComposerbyKey($this->input->post('composerFirstName'), $this->input->post('composerLastName'), $this->input->post('composerBirthday'));
			//echo "album_exists is"; var_dump($album_exists); 
			//echo "singer_exists is"; var_dump($singer_exists);
			//echo "composer_exists is"; var_dump($composer_exists);
			if($album_exists && $singer_exists && $composer_exists){
				$insert_data['sAlbumTitle'] = $this->input->post('sAlbumTitle');
				$insert_data['sAlbumYear'] = $this->input->post('sAlbumYear');
				$insert_data['songTitle'] = $this->input->post('songTitle');
				$insert_data['songYear'] = $this->input->post('songYear');
				$insert_data['songPrice'] = $this->input->post('songPrice');
				$insert_data['songImg'] = $this->input->post('songImg');
				$insert_data['songGenre'] = $this->input->post('songGenre');
				$insert_data['songLength'] = $this->input->post('songLength');
				$insert_data['singerFirstName'] = $this->input->post('singerFirstName');
				$insert_data['singerLastName'] = $this->input->post('singerLastName');
				$insert_data['singerStageName'] = $this->input->post('singerStageName');
				$insert_data['composerFirstName'] = $this->input->post('composerFirstName');
				$insert_data['composerLastName'] = $this->input->post('composerLastName');
				$insert_data['composerBirthday'] = $this->input->post('composerBirthday');
				//echo "adding song now";
				$result = $this->song_model->addSong($insert_data);
				//var_dump($result);
				$data['song_info'] = $insert_data;
				$data['notify_type'] = "add song";
				$this->load->view('_home_header_styles');
				$this->load->view('admin_edit_songNotify', $data);
				$this->load->view('_home_footer_script');
			}
			else{
				if(!$album_exists) {$data['errors'][] = "The album does not exist. Please enter valid album information"; }
				if(!$singer_exists) {$data['errors'][] = "The singer does not exist. Please enter valid singer information"; }
				if(!$composer_exists) {$data['errors'][] = "The composer does not exist. Please enter valid composer information"; }
				//var_dump($data['error']);
				$this->load->view('_home_header_styles');
				$this->load->view('add_song_album', $data);
				$this->load->view('_home_footer_script');

			}
		}
		else {
			redirect($this->config->item('base_url')."home/add_song_album");
		}

		//return $result;
	}

	function deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear){
		//get form input
		$result = $this->song_model->deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear);
		return $result;
	}

	function updateSong(){
		//get form input
		$update_data = NULL;
		$song_identifier = NULL;
		$result = $this->song_model->updateSong($update_data, $song_identifier);
		return $result;
	}

function search(){
		//get form input from search and based on what user wants to search for, direct to the correct function and display the result
		log_message('info', 'in search function in composer controller.');
		 if($this->input->post('search_submit')) {
		 	echo "post successful";
		 	$result = NULL;
		 	switch ($this->input->post('search_option')) {
		 		case 'Search By..':
					$result = $this->searchSongGeneric($this->input->post('search_term'));
					break;
				case 'Song Title':
					$result = $this->searchSongbyTitle($this->input->post('search_term'));
					break;
				case 'Singer':
					$term = $this->input->post('search_term');
					$term = explode(' ', $term);
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchSongbySinger($term[0], FALSE, FALSE);
					}
					else {
						//there is firstname and lastname or stagename
						$result = $this->searchSongbySinger(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Year':
					$result = $this->searchSongbyYear($this->input->post('search_term'));
					break;
				case 'Composer':
					$result = $this->searchSongbyComposer($this->input->post('search_term'));
					break;
				case 'Genre':
					$result = $this->searchSongbyGenre($this->input->post('search_term'));
					break;
				case 'Price':
					$term = $this->input->post('search_term');
					$term = explode(' ', $term);
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchSongbyPriceRange($term[0], FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchSongbyPriceRange($term[0], $term[1]);
					}
					break;
				case 'Album':
					$result = $this->searchSongbyAlbum($this->input->post('search_term'));
					break;
				default:
					$result = $this->searchSongGeneric($this->input->post('search_term'));
					break;
		 	}

			//process result and show page
			//var_dump($result);
			if(count($result))
				$data['songs_list'] = $result;
			else
				$data['songs_list'] = NULL;
			$data['title'] = "Song Catalogue";
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
			$this->load->view('_home_header_styles');
			$this->load->view('songmenu', $data);
			$this->load->view('_home_footer_script');
		}
		else
			redirect($this->config->item('base_url')."songcontroller");
	}

	function searchSongbyTitle($title){
		$result = $this->song_model->searchSongbyTitle($title);
		return $result;
	}

	function searchSongbyAlbum($album){
		$result = $this->song_model->searchSongbyAlbum($album);
		return $result;
	}

	function searchSongbyYear($year){
		$result = $this->song_model->searchSongbyYear($year);
		return $result;
	}

	function searchSongbyGenre($genre){
		$result = $this->song_model->searchSongbyGenre($genre);
		return $result;
	}

	function searchSongbyPriceRange($lower, $upper){
		$result = $this->song_model->searchSongbyPriceRange($lower, $upper);
		return $result;
	}

	function searchSongbySinger($name, $firstname, $lastname){
		$result = $this->song_model->searchSongbySinger($name, $firstname, $lastname);
		return $result;
	}

	function searchSongbyComposer($name){
		$result = $this->song_model->searchSongbyComposer($name);
		return $result;
	}

	function searchSongGeneric($term){
		$result = $this->song_model->searchGeneric($term);
		return $result;
	}
}

?>