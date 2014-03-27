<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Singer_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'singer'; //model queries from singer table.

		var $album_title 	= '';
		var $album_year	 	= '';
		var $album_genre 	= '';
		var $album_price 	= '';
		var $album_length 	= '';
		var $album_img_url 	= '';
	}

	function getSinger(){
		$SQL = "SELECT * FROM ".$this->table_name;
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all singer query '.$this->db->last_query());
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

	function addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img){
		$SQL = "INSERT INTO singer (singerFistName, singerLastName, stageName, singerBirthday, singerDescrip, singerImg
				VALUES ("."'".$firstName."',".$lastName.",'".$stageName."','".$birthday."',".$descrip.",'".$img.")";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function searchSingerbySongTitle($title){
		$SQL = "SELECT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM singersingssong s WHERE 
				LOWER(s.sssSongTitle) LIKE LOWER("."'%".$title."%')";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all singer query by title '.$this->db->last_query());
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

	function searchSingerbyAlbumTitle($title){
		$SQL = "SELECT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM singersingssong s WHERE 
				LOWER(s.sssAlbumTitle) LIKE LOWER("."'%".$title."%')";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all singer query by title '.$this->db->last_query());
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

	function searchSingerbyYear($year){
		//this function is applicable to both album and song since they have the same year
		$SQL = "SELECT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM singersingssong s WHERE 
				s.sssAlbumYear = "."'".$year."'";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all singer query by title '.$this->db->last_query());
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

	function searchSingerbyGenre($genre){
		//this function is applicable to both album and song since they have the same genre
		$SQL = "SELECT ss.sssSingerFirstName, ss.sssSingerLastName, ss.sssSingerStageName FROM singersingssong ss, song s WHERE 
				LOWER(s.songGenre) LIKE LOWER("."'%".$genre."%') AND ss.sssSongTitle = s.songTitle";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all album query by genre '.$this->db->last_query());
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

	function searchSingerbyBirthday($birthday=FALSE,$lowerBirthday=FALSE,$upperBirthday=FALSE){

		if(!$lowerBirthday && !$upperBirthday) {
			$SQL = "SELECT * FROM song
					WHERE singerBirthday = ".$birthday;
		}	
		else{
			$SQL = "SELECT * FROM song
					WHERE singerBirthday BETWEEN ".$lowerBirthday." AND ".$upperBirthday;
		}
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all album query by birthday range'.$this->db->last_query());
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

	function searchSingerbyName($name=FALSE, $firstName=FALSE, $lastName=FALSE){
		//this function receives $name if only one word was typed. eg. Taylor. 
		//if 2 words were given, it is assumed to be in the format "firstname lastname". So this function will not receive $name. it will only receive $firstname and $lastname.
		if(!$firstName && !$lastName) {
			$SQL = "SELECT * FROM song
					WHERE ((LOWER(singerFistName) LIKE LOWER('%".$name."%'))
					OR (LOWER(singerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(singerStageName) LIKE LOWER('%".$name."%')))";
		}	
		else{
			$SQL = "SELECT * FROM song
					WHERE (
						(LOWER(singerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(singerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(singerStageName) LIKE LOWER('%".$firstName." ".$lastName"%'))
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

?>