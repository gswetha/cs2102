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
		$SQL = "SELECT * FROM ".$this->table_name;
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result[0];
	}

	function addAlbum($albumTitle, $albumYear, $numSongs, $genre, $price, $img, $descrip){
		$SQL = "INSERT INTO album (albumTitle, albumYear, numSongs, albumGenre, albumPrice, albumImg, albumDescrip
				VALUES ("."'".$albumTitle."',".$albumYear.",'".$numSongs."','".$genre."',".$price.",'".$img."','".$descrip.")";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function searchAlbumbyTitle($title){
		$SQL = "SELECT * FROM ".$this->table_name." WHERE LOWER(albumTitle) LIKE LOWER("."'%".$title."%')";
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query by title '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result[0];
	}

	function searchAlbumbyYear($year){
		$SQL = "SELECT * FROM ".$this->table_name." WHERE albumYear = "."'".$year."'";
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query by year '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result[0];
	}

	function searchAlbumbyGenre($genre){
		$SQL = "SELECT * FROM ".$this->table_name." WHERE LOWER(albumGenre) LIKE LOWER("."'%".$genre."%')";
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query by genre '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result[0];
	}

	function searchAlbumbyPriceRange($lowerPrice,$upperPrice){
		$SQL = "SELECT * FROM album	WHERE albumPrice BETWEEN ".$lower." AND ".$upper;
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query by price range'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result[0];
	}

	function searchAlbumbyArtist($name=FALSE, $firstName=FALSE, $lastName=FALSE){
		//this function receives $name if only one word was typed. eg. Taylor. 
		//if 2 words were given, it is assumed to be in the format "firstname lastname". So this function will not receive $name. it will only receive $firstname and $lastname.
		if(!$firstName && !$lastName) {
			$SQL = "SELECT s.sssAlbumTitle, s.sssAlbumYear, a.albumPrice, a.albumGenre FROM album a
					JOIN singersingssong s ON s.sssAlbumTitle = a.albumTitle AND s.sssAlbumYear = a.albumYear WHERE ((LOWER(s.sssSingerFirstName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$name."%')))";
		}	
		else{
			$SQL = "SELECT s.sssAlbumTitle, s.sssAlbumYear, a.albumPrice, a.albumGenre FROM album a
					JOIN singersingssong s ON s.sssAlbumTitle = a.albumTitle AND s.sssAlbumYear = a.albumYear WHERE (
						(LOWER(s.sssSingerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(s.sssSingerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$firstName." ".$lastName"%'))
						)";
		}
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search album by singer name '.$this->db->last_query());
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

	function searchAlbumbyComposer($name=FALSE, $firstName=FALSE, $lastName=FALSE){

	}

?>