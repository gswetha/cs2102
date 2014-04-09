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
		
		// Models
		$this->load->model('song_model');
	 }
	 
	public function index()
	{
		$data['songs_list'] = $this->getAllSongs();
		$data['title'] = "Song Catalogue";
		$this->load->view('_home_header_styles');
		$this->load->view('songmenu', $data);
		$this->load->view('_home_footer_script');
	}

	function getAllSongs(){
		//display songs in catalogue
		$result = $this->song_model->getAllSongs();
		return $result;
	}

	function addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength){
		//get form input (album info, song info, singer info, composer info)
		$result = $this->song_model->addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength);
		return $result;
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