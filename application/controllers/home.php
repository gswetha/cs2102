<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
   * Landing page for CS2102 project - Music DB app
	 */
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
		$this->load->model('user_model');
	}

	public function index()
	{
		$data['title'] = "home page";
		$data['username'] = "Guest";
		$data['role'] = "guest";
		if ($this->isLoggedIn()) {
			$data['logged_in'] = TRUE;
			log_message('info','email of user is '.print_r($this->session->all_userdata(),TRUE));
			$data['username'] = $this->session->userdata('name');
			$data['role'] = $this->session->userdata('role');
		}
		else
			$data['logged_in'] = FALSE;

		$this->load->view('_home_header_styles');
		$this->load->view('home_page',$data);
		$this->load->view('_home_footer_script');
	}

	public function guest() {
		$this->load->view('_home_header_styles');
		$this->load->view('guest_home_page');
		$this->load->view('_home_footer_script');
	}

	public function user() {
		$this->load->view('_home_header_styles');
		$this->load->view('user_home_page');
		$this->load->view('_home_footer_script');
	}

	public function admin() {
		$this->load->view('_home_header_styles');
		$this->load->view('admin_home_page');
		$this->load->view('_home_footer_script');
	}

	public function songmenu() {
		$this->load->view('_home_header_styles');
		$this->load->view('songmenu');
		$this->load->view('_home_footer_script');
	}

	public function albummenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('albummenu');
		$this->load->view('_home_footer_script');
	}

	public function albummenu_searchAlbum()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('albummenu_searchAlbum');
		$this->load->view('_home_footer_script');
	}

	public function singermenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('singermenu');
		$this->load->view('_home_footer_script');
	}

	public function singermenu_searchSinger()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('singermenu_searchSinger');
		$this->load->view('_home_footer_script');
	}

	public function singermenu_rankSinger()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('singermenu_rankSinger');
		$this->load->view('_home_footer_script');
	}

	public function composermenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('composermenu');
		$this->load->view('_home_footer_script');
	}

	public function genremenu()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('genremenu');
		$this->load->view('_home_footer_script');
	}

	public function singlealbumview()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('singlealbumview');
		$this->load->view('_home_footer_script');
	}

	public function top10songs()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10songs');
		$this->load->view('_home_footer_script');
	}

	public function top10albums()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10albums');
		$this->load->view('_home_footer_script');
	}

	public function top10singers()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('top10singers');
		$this->load->view('_home_footer_script');
	}

	public function purchases()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('purchases');
		$this->load->view('_home_footer_script');
	}

	public function admin_edit()
	{	
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit');
		$this->load->view('_home_footer_script');
	}

	public function admin_edit_addAblum()
	{	
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit_addAblum');
		$this->load->view('_home_footer_script');
	}

	public function admin_edit_deleteAlbum()
	{	
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit_deleteAlbum');
		$this->load->view('_home_footer_script');
	}

	public function admin_edit_searchItem()
	{	
		$this->load->view('_home_header_styles');
		$this->load->view('admin_edit_searchItem');
		$this->load->view('_home_footer_script');
	}

	public function purchaseReceipt()
	{	
		$data['result'][] = "";
		$this->load->view('_home_header_styles');
		$this->load->view('purchaseReceipt',$data);
		$this->load->view('_home_footer_script');
	}


	public function add_song_album()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('add_song_album');
		$this->load->view('_home_footer_script');
	}

	public function edit_song()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('add_song_album');
		$this->load->view('_home_footer_script');
	}

	public function add_album()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('add_album');
		$this->load->view('_home_footer_script');
	}

	public function edit_album()
	{
		if($this->input->post('editAlbum')) {
			$data['albumTitle'] = $this->input->post('albumTitle');
			$data['albumYear'] = $this->input->post('albumYear');
			$data['numSongs'] = $this->input->post('numSongs');
			$data['albumGenre'] = $this->input->post('albumGenre');
			$data['albumPrice'] = $this->input->post('albumPrice');
			$data['albumImg'] = $this->input->post('albumImg');
			$data['albumDescrip'] = $this->input->post('albumDescrip');

			$this->load->view('_home_header_styles');
			$this->load->view('edit_album',$data);
			$this->load->view('_home_footer_script');
		}else{
			echo "nothing	";
		}
	}

	public function add_artist_composer()
	{
		$this->load->view('_home_header_styles');
		$this->load->view('add_artist_composer');
		$this->load->view('_home_footer_script');
	}

	function isLoggedIn(){
		if($this->session->userdata('status') == 'logged_in')
			return TRUE;
		else
			return FALSE;
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
