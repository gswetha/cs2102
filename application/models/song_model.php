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

	function getAllSongs(){
		$SQL = "SELECT songTitle, songLength, songYear, songPrice, songGenre sAlbumTitle FROM song";
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - getting all songs query '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function addSong($sAlbumTitle,$sAlbumYear,$songTitle,$songYear,$songPrice,$songImg,$songGenre,$songLength){
		$SQL = "INSERT INTO song (sAlbumTitle, sAlbumYear, songTitle, songYear, songPrice, songImg, songGenre, songLength
				VALUES ("."'".$sAlbumTitle."',".$sAlbumYear.",'".$songTitle."','".$songYear."',".$songPrice.",'".$songImg."','".$songGenre."',".$songLength.")";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function searchSongbyTitle($title){
		$SQL = "SELECT songTitle, songLength, songYear, songPrice, songGenre sAlbumTitle FROM song
				WHERE LOWER(s.sssSingerFirstName) LIKE LOWER('%taylor%')";
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - getting all songs query '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchSongbyYear($year){
		$SQL = "SELECT songTitle, songLength, songYear, songPrice, songGenre sAlbumTitle FROM song
				WHERE songYear = "."'".$year."'";
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song by year'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;

	}

	function searchSongbyGenre($genre){
		$SQL = "SELECT songTitle, songLength, songYear, songPrice, songGenre sAlbumTitle FROM song
				WHERE songGenre LIKE "."'%".$genre."%'";
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song by genre'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;

	}

	function searchSongbyPriceRange($lower, $upper){
		$SQL = "SELECT songTitle, songLength, songYear, songPrice, songGenre sAlbumTitle FROM song
				WHERE songPrice BETWEEN ".$lower." AND ".$upper;
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song by price range'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;

	}

	function searchSongbyArtist($name=FALSE, $firstname=FALSE, $lastname=FALSE){
		//this function receives $name if only one word was typed. eg. Taylor. 
		//if 2 words were given, it is assumed to be in the format "firstname lastname". So this function will not receive $name. it will only receive $firstname and $lastname.
		if(!$firstname && !$lastname) {
			$SQL = "SELECT so.songTitle, so.songLength, so.songYear, so.songPrice, so.songGenre, so.sAlbumTitle FROM song so
					JOIN singersingssong s ON s.sssAlbumTitle = so.sAlbumTitle AND s.sssAlbumYear = so.sAlbumYear AND s.sssSongTitle = so.songTitle AND s.sssSongYear = so.songYear
					WHERE ((LOWER(s.sssSingerFirstName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$name."%')))";
		}	
		else{
			$SQL = "SELECT so.songTitle, so.songLength, so.songYear, so.songPrice, so.songGenre, so.sAlbumTitle FROM song so
					JOIN singersingssong s ON s.sssAlbumTitle = so.sAlbumTitle AND s.sssAlbumYear = so.sAlbumYear AND s.sssSongTitle = so.songTitle AND s.sssSongYear = so.songYear
					WHERE (
						(LOWER(s.sssSingerFirstName) LIKE LOWER('%".$firstname."%') AND LOWER(s.sssSingerLastName) LIKE LOWER('%".$lastname."%'))
						OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$firstname." ".$lastname"%'))
						)";
		}
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song by singer name '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchSongbyComposer(){
		
	}

?>