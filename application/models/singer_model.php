<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Singer_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'singer'; //model queries from singer table.
	

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function getSinger(){
		$SQL = "SELECT * FROM singer";
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
		return $result;
	}

	function getAllSingerImg(){
		$SQL = "SELECT singerImg FROM singer";
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
		return $result;
	}

	function addSinger($firstName,$lastName,$stageName,$birthday,$descrip, $img){
		$SQL = "INSERT INTO singer (singerFistName, singerLastName, stageName, singerBirthday, singerDescrip, singerImg)
				VALUES ('".$firstName."','".$lastName."','".$stageName."','".$birthday."','".$descrip.",'".$img."'')";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function getSingerSongs(){
		$SQL = "SELECT * FROM singersingssong GROUP BY sssAlbumTitle, sssAlbumYear";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - getting all singer and songs '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		return $result;
	}

	function searchSingerbySongTitle($title){
		$SQL = "SELECT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM singersingssong s WHERE 
				LOWER(s.sssSongTitle) LIKE LOWER('%".$title."%')";
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
		return $result;
	}

	function searchSingerbyAlbumTitle($title){
		$SQL = "SELECT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM singersingssong s WHERE 
				LOWER(s.sssAlbumTitle) LIKE LOWER('%".$title."%')";
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
		return $result;
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
		return $result;
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
		return $result;
	}

	function searchSingerbyBirthday($birthday=FALSE,$lowerBirthday=FALSE,$upperBirthday=FALSE){

		if(!$lowerBirthday && !$upperBirthday) {
			$SQL = "SELECT * FROM singer
					WHERE singerBirthday = ".$birthday;
		}	
		else{
			$SQL = "SELECT * FROM singer
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
		return $result;
	}

	function searchSingerbyName($name=FALSE, $firstName=FALSE, $lastName=FALSE){
		//this function receives $name if only one word was typed. eg. Taylor. 
		//if 2 words were given, it is assumed to be in the format "firstname lastname". So this function will not receive $name. it will only receive $firstname and $lastname.
		if(!$firstName && !$lastName) {
			$SQL = "SELECT * FROM singer
					WHERE ((LOWER(singerFistName) LIKE LOWER('%".$name."%'))
					OR (LOWER(singerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(singerStageName) LIKE LOWER('%".$name."%'))";
		}	
		else{
			$SQL = "SELECT * FROM singer
					WHERE ((LOWER(singerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(singerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(singerStageName) LIKE LOWER('%".$firstName." ".$lastName."%')))";
		}
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - search album by singer name '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'singer_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function singerGenericSearch($searchCheck){
		$SQL = "SELECT DISTINCT * FROM album a WHERE a.albumTitle IN (
				SELECT ss. sssAlbumTitle FROM singersingssong ss WHERE  LOWER(ss.sssSingerFirstName) LIKE LOWER('%".$searchCheck."%') OR 
				LOWER(ss.sssSingerLastName) LIKE LOWER('%".$searchCheck."%') OR LOWER(ss.sssSingerStageName) LIKE LOWER('%".$searchCheck."%') OR 
				LOWER(ss.sssSongTitle) LIKE LOWER('%".$searchCheck."%') OR ss.sssSongYear LIKE '%".$searchCheck."%' OR LOWER('%".$searchCheck."%') LIKE LOWER('%".$searchCheck."%') OR
				a.albumYear LIKE ''%".$searchCheck."%' OR a.numSongs<='%".$searchCheck."%' OR a.albumPrice<='%".$searchCheck."%' OR LOWER(a.albumGenre) LIKE LOWER('%".$searchCheck."%') OR 
				LOWER(a.albumDescrip) LIKE LOWER('%".$searchCheck."%') OR a.albumTitle IN (SELECT cc.ccsAlbumTitle FROM composercomposessong cc WHERE  
				LOWER(cc.ccsComposerFirstName) LIKE LOWER('%".$searchCheck."%') OR LOWER(cc.ccsComposerLastName) LIKE LOWER('%".$searchCheck."%')))";

		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - generic search'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'singer_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchMostPopular(){
		$SQL = "SELECT DISTINCT s.sssSingerFirstName, s.sssSingerLastName, s.sssSingerStageName FROM purchases p, singersingssong s 
				WHERE p.pSongTitle=s.sssSongTitle AND p.pAlbumTitle=s.sssAlbumTitle GROUP BY s.sssSingerFirstName, s.sssSingerLastName, 
				s.sssSingerStageName, p.pSongTitle, p.pSongYear ORDER BY COUNT(*) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - popular search'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'singer_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function updateSinger($update_data, $singer_identifier) {
 		if(is_array($update_data) && count($update_data)){
 			$data = array();
 			foreach ($update_data as $key=>$value) {
 				$SQL = "UPDATE singer s SET s.".$key."= "."'".$value."'"." WHERE s.singerFirstName= "."'".$singer_identifier['firstName']."'"." AND s.singerLastName= "."'".$singer_identifier['lastName']."'"." AND s.stageName= "."'".$singer_identifier['stageName']."'";
 				$query = $this->db->query($SQL);
 				log_message("debug","update singer SQL " . $this->db->last_query());
 			}
 			
 			return (true);

 		}
 		return false;
 	}

	function deleteSinger($firstName, $lastName, $stageName){
		$SQL = "DELETE FROM singer s WHERE LOWER(s.singerLastName) LIKE LOWER("."'%".$lastName."%') and 
				LOWER(s.singerFirstName) LIKE LOWER("."'%".$firstName."%') AND 
				LOWER(s.stageName) LIKE LOWER("."'%".$stageName."%')";
		$query = $this->db->query($SQL);
		log_message('info', 'singer_model - delete album by title and year '.$this->db->last_query());
		if($query)
			return TRUE;
		else 
			return FALSE;
	}
}

?>