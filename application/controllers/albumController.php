<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AlbumController extends CI_Controller {

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

		 $this->load->model('album_model');
	 }
	 
	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
	}

	public function index()
	{

		$albumData['albumList'] = $this->getAlbum();
		$albumData['albumSongs'] = $this->getAlbumSongs();
		if ($this->isLoggedIn()) {
			$albumData['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$albumData['username'] = $this->session->userdata('name');
			$albumData['role'] = $this->session->userdata('role');
			$albumData['email'] = $this->session->userdata('email');
		}
		else
			$albumData['logged_in'] = FALSE;

		$this->load->view('_home_header_styles');
		$this->load->view('albummenu',$albumData);
		$this->load->view('_home_footer_script');
	}

	function getAlbum(){
		$albums = $this->album_model->getAlbum();
		return $albums;
	}

	function getAlbumSongs(){
		$songs = $this->album_model->getAllSongs();
		return $songs;
	}

	function addAlbum(){
		if ($this->input->post('addSubmit')) {
			$title = $this->input->post('title');
			$year = $this->input->post('year');
			$noSongs = $this->input->post('noSongs');
			$genre = $this->input->post('genre');
			$price = $this->input->post('price');
			$img = $this->input->post('img');
			$descrip = $this->input->post('descrip');
			// $result = $this->album_model->addAlbum($title, $year, $noSongs, $genre, $price, $img, $descrip);
			
			$result = FALSE;
			if($result){
				$resultData['result'] = array($title,$year,$noSongs,$genre,$price,$price,$img,$descrip);
				$this->load->view('_home_header_styles');
				$this->load->view('admin_edit',$resultData);
				$this->load->view('_home_footer_script');			
			}else{
				$resultData['result'] = array($title);
				$this->load->view('_home_header_styles');
				$this->load->view('admin_edit',$resultData);
				$this->load->view('_home_footer_script');	
			}
		}else{
			echo 'no';
		}
		
	}

	function searchAlbumbyTitle($title){
		$result = $this->album_model->searchAlbumbyTitle($title);
		return $result;
	}

	function searchAlbumbyYear($year){
		$albums = $this->album_model->searchAlbumbyYear($year);
		return $albums;
	}

	function searchAlbumbyGenre($genre){
		$albums = $this->album_model->searchAlbumbyGenre($genre);
		return $albums;
	}

	function searchAlbumbyPriceRange($lowerPrice,$upperPrice){
		$albums = $this->album_model->searchAlbumbyPriceRange($lowerPrice,$upperPrice);
		return $albums;
	}

	function searchAlbumbyArtist($name, $firstName, $lastName){
		$albums = $this->album_model->searchAlbumbyArtist($name, $firstName, $lastName);
		return $albums;
	}

	function updateAlbum($update_data, $album_identifier){
		$this->album_model->updateAlbum($update_data, $album_identifier);
	}

	function deleteAlbum($albumTitle, $albumYear){
		$this->album_model->deleteAlbum($albumTitle, $albumYear);
	}

	function albumGenericSearch($searchCheck){
		$albums = $this->album_model->albumGenericSearch($searchCheck);
		return $albums;
	}

	function searchAlbumbySongTitle($song){
		$albums = $this->album_model->searchAlbumbySongTitle($song);	
		return $albums;
	}

	function searchAlbumbyComposer($name, $firstName, $lastName){
		$albums = $this->album_model->searchAlbumbyComposer($name, $firstName, $lastName);	
		return $albums;
	}

	function searchInAlbum(){
		if ($this->input->post('searchSubmit')) {
			$result = NULL;
			switch ($this->input->post('searchOptions')) {
				case 'Search By..':
					$result = $this->albumGenericSearch($this->input->post('searchInput'));
					break;
				case 'Album Title':
					$result = $this->searchAlbumbyTitle($this->input->post('searchInput'));
					break;
				case 'Song Title':
					$result = $this->searchAlbumbySongTitle($this->input->post('searchInput'));
					break;
				case 'Artist':
					$term = explode(' ', $this->input->post('searchInput'));
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchAlbumbyArtist($term[0], FALSE, FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchAlbumbyArtist(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Year':
					$result = $this->searchAlbumbyYear($this->input->post('searchInput'));
					break;
				case 'Composer':
					$term = explode(' ', $this->input->post('searchInput'));
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchAlbumbyComposer($term[0], FALSE, FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchAlbumbyComposer(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Genre':
					$result = $this->searchAlbumbyGenre($this->input->post('searchInput'));
					break;
				case 'Price':
					$term = $this->input->post('searchInput');
					$term = explode(' ', $term);
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchAlbumbyPriceRange($term[0], FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchAlbumbyPriceRange($term[0], $term[1]);
					}
					break;
				default:
					$result = $this->albumGenericSearch($this->input->post('searchInput'));
					break;
			}

			//process result and show page
			// var_dump($result);
			if(count($result)){
				$albumData['albumList'] = $result;	
			}
			else
				$albumData['albumList'] = NULL;

			$albumData['albumSongs'] = $this->getAlbumSongs();
			$this->load->view('_home_header_styles');
			$this->load->view('albummenu', $albumData);
			$this->load->view('_home_footer_script');

		}else{
			echo "no";
			echo "<h1>Testings</h1>";
			redirect($this->config->item('base_url')."albumController");
		}
		
	}

	function searchMostPopular(){
		$this->album_model->searchMostPopular();
	}

	

	
}

?>