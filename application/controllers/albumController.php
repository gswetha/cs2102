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
		
		// Models

		 $this->load->model('album_model');
	 }
	 
	public function index()
	{

		$albumData['albumList'] = $this->getAlbum();
		$albumData['albumSongs'] = $this->getAlbumSongs();
		log_message('debug','creating something here in album');
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

	function addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip){
		$this->album_model->addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip);
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
		$this->album_model->searchAlbumbyPriceRange($lowerPrice,$upperPrice);
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

	function searchInAlbum(){
		if ($this->input->post('searchSubmit')) {
			$result = NULL;
			switch ($this->input->post('searchOptions')) {
				case '0':
					$result = $this->albumGenericSearch($this->input->post('searchInput'));
					break;
				case '1':
					$result = $this->searchAlbumbyTitle($this->input->post('searchInput'));
					break;
				case '2':
					$result = $this->searchAlbumbySongTitle($this->input->post('searchInput'));
					break;
				case '3':
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
				case '4':
					$result = $this->searchAlbumbyYear($this->input->post('searchInput'));
					break;
				case '5':
					$result = $this->searchAlbumbyComposer($this->input->post('searchInput'),FALSE,FALSE);
					break;
				case '6':
					$result = $this->searchAlbumbyGenre($this->input->post('searchInput'));
					break;
				default:
					$result = $this->albumGenericSearch($this->input->post('searchInput'));
					break;
			}

			//process result and show page
			var_dump($result);
			$albumData['albumList'] = $result;
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