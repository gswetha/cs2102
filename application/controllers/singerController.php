<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SingerController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');
		
		// Libraries
		$this->load->library('form_validation');
		
		// Models
		$this->load->model('singer_model');
	 }
	 
	public function index()
	{
		$data['allSingers'] = $this->getSinger();
		$data['allSingerSongs'] = $this->getSingerSongs();
		$this->load->view('_home_header_styles');
		$this->load->view('singermenu',$data);
		$this->load->view('_home_footer_script');
	}

	function getSinger(){
		$singers = $this->singer_model->getSinger();
		return $singers;
	}

	// function searchResult($some){
	// 	redirect back to somewhere
	// }
	function getAllSingerImg(){
		$images = $this->singer_model->getAllSingerImg();
		return $images;
	}

	function getSingerSongs(){
		$allInfo = $this->singer_model->getSingerSongs();
		return $allInfo;
	}

	function addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img){
		$this->singer_model->addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img);
	}

	function searchSingerbySongTitle($title){
		$singer = $this->singer_model->searchSingerbySongTitle($title);
		return $singer;
	}

	function searchSingerbyAlbumTitle($title){
		$singer = $this->singer_model->searchSingerbyAlbumTitle($title);
		return $singer;
	}

	function searchSingerbyYear($year){
		$singer = $this->singer_model->searchSingerbyYear($year);
		return $singer;
	}

	function searchSingerbyGenre($genre){
		$singer = $this->singer_model->searchSingerbyGenre($genre);
		return $singer;
	}

	function searchSingerbyBirthday($birthday,$lowerBirthday,$upperBirthday){
		$singer = $this->singer_model->searchSingerbyBirthday($birthday,$lowerBirthday,$upperBirthday);
		return $singer;
	}

	function searchSingerbyName($name, $firstName, $lastName){
		$singer = $this->singer_model->searchSingerbyName($name, $firstName, $lastName);
		return $singer;
	}
	
	function updateSinger($update_data, $singer_identifier){
		$this->singer_model->updateSinger($update_data, $singer_identifier);
	}

	function deleteSinger($firstName, $lastName, $stageName){
		$this->singer_model->deleteSinger($firstName, $lastName, $stageName);
	}

	function singerGenericSearch($searchCheck){
		$singer = $this->singer_model->singerGenericSearch($searchCheck);
		return $singer;
	}

	function searchMostPopular(){
		$this->singer_model->searchMostPopular();
	}

	function searchInSinger(){
		if ($this->input->post('searchSubmit')) {
			$result = NULL;
			switch ($this->input->post('searchOptions')) {
				case 'Search By..':
					$result = $this->singerGenericSearch($this->input->post('searchInput'));
					break;
				case 'Album Title':
					$result = $this->searchSingerbyAlbumTitle($this->input->post('searchInput'));
					break;
				case 'Album Release Date':
					$result = $this->searchSingerbyYear($this->input->post('searchInput'));
					break;
				case 'Song Title':
					$result = $this->searchSingerbySongTitle($this->input->post('searchInput'));
					break;
				case 'Artist Name':
					$term = explode(' ', $this->input->post('searchInput'));
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchSingerbyName($term[0], FALSE, FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchSingerbyName(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Birthday':
					$term = explode(' ', $this->input->post('searchInput'));
					log_message('debug','term is '.print_r($term,true));
					if(count($term) == 1) {
						log_message('info', 'count of term is 1');
						$result = $this->searchSingerbyBirthday($term[0], FALSE, FALSE);
					}
					else {
						//there is lower and higher
						$result = $this->searchSingerbyBirthday(FALSE, $term[0], $term[1]);
					}
					break;
				case 'Genre':
					$result = $this->searchSingerbyGenre($this->input->post('searchInput'));
					break;
				default:
					$result = $this->singerGenericSearch($this->input->post('searchInput'));
					break;
			}

			//process result and show page
			// var_dump($result);
			if(count($result))
				$data['allSingers'] = $result;	
			else
				$data['allSingers'] = NULL;

			$data['allSingerSongs'] = $this->getSingerSongs();
			$this->load->view('_home_header_styles');
			$this->load->view('singermenu', $data);
			$this->load->view('_home_footer_script');

		}else{
			echo "no";
			echo "<h1>Testings</h1>";
			redirect($this->config->item('base_url')."singerController");
		}
	}

}

?>