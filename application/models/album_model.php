<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Album_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'album'; //model queries from album table.

		var $album_title 	= '';
		var $album_year	 	= '';
		var $album_genre 	= '';
		var $album_price 	= '';
		var $album_length 	= '';
		var $album_img_url 	= '';
	}

	function getAlbum(){

	}

	function addAlbum(){

	}

	function searchAlbumbyTitle(){

	}

	function searchAlbumbyYear(){

	}

	function searchAlbumbyGenre(){

	}

	function searchAlbumbyPriceRange(){

	}

	function searchAlbumbyArtist(){

	}

	function searchAlbumbyComposer(){
		
	}

?>