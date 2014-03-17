<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Song_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'song'; //model queries from song table.

		var $song_title 	= '';
		var $song_year	 	= '';
		var $song_genre 	= '';
		var $song_price 	= '';
		var $song_length 	= '';
		var $song_img_url 	= '';
	}

	function getSong(){

	}

	function addSong(){

	}

	function searchSongbyTitle(){

	}

	function searchSongbyYear(){

	}

	function searchSongbyGenre(){

	}

	function searchSongbyPriceRange(){

	}

	function searchSongbyArtist(){

	}

	function searchSongbyComposer(){
		
	}

?>