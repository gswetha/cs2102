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
		return $result;
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
		return $result;
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
		return $result;
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
		return $result;
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
		return $result;
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
		log_message('info', 'album_model - search album by singer name '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchAlbumbyComposer($name=FALSE, $firstName=FALSE, $lastName=FALSE){
		if(!$firstName && !$lastName) {
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre FROM album a
					JOIN composercomposessong c ON c.ccsAlbumTitle = a.albumTitle AND c.cssAlbumYear = a.albumYear WHERE ((LOWER(c.ccsSingerFirstName) LIKE LOWER('%".$name."%'))
					OR (LOWER(c.ccsSingerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(c.ccsSingerStageName) LIKE LOWER('%".$name."%')))";
		}	
		else{
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre FROM album a
					JOIN composercomposessong c ON c.ccsAlbumTitle = a.albumTitle AND c.cssAlbumYear = a.albumYear WHERE ((LOWER(c.ccsSingerFirstName) LIKE LOWER('%".$firstName."%') 
						AND LOWER(c.ccsSingerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(c.ccsSingerStageName) LIKE LOWER('%".$firstName." ".$lastName"%'))
						)";
		}
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - search album by compoer name '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function albumGenericSearch($searchCheck){
		$SQL = "SELECT DISTINCT * FROM album a WHERE a.albumTitle IN (
				SELECT ss.sssAlbumTitle FROM singersingssong ss WHERE  LOWER(ss.sssSingerFirstName) LIKE LOWER('%".$searchCheck."%') OR LOWER(ss.sssSingerLastName) LIKE LOWER('%".$searchCheck."%') OR 
				LOWER(ss.sssSingerStageName) LIKE LOWER('%".$searchCheck."%') OR LOWER(ss.sssSongTitle) LIKE LOWER('%".$searchCheck."%') OR ss.sssSongYear LIKE '%".$searchCheck."%') OR LOWER(a.albumTitle) LIKE 
				LOWER('%".$searchCheck."%') OR a.albumYear LIKE '%".$searchCheck."%' OR a.numSongs<='%".$searchCheck."%' OR a.albumPrice<='%".$searchCheck."%' OR LOWER(a.albumGenre) LIKE LOWER('%".$searchCheck."%') OR LOWER(a.albumDescrip) 
				LIKE LOWER('%".$searchCheck."%') OR a.albumTitle IN (SELECT cc.ccsAlbumTitle FROM composercomposessong cc WHERE  LOWER(cc.ccsComposerFirstName) LIKE LOWER('%".$searchCheck."%') OR 
				LOWER(cc.ccsComposerLastName) LIKE LOWER('%".$searchCheck."%'))";

		$query = $this->db->query($SQL);
		log_message('info', 'album_model - generic search'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;

	}

	function searchMostPopular(){
		$SQL = "SELECT p.pAlbumTitle, p.pAlbumYear, a.albumImg FROM purchases p, album a WHERE a.albumTitle=p.pAlbumTItle AND a.albumYear=p.pAlbumYear GROUP BY p.pAlbumTitle, p.pAlbumYear, a.albumImg ORDER BY COUNT(*) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'album_model - popular search'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function updateAlbum($update_data, $album_identifier) {
 		if(is_array($update_data) && count($update_data)){
 			$data = array();
 			foreach ($update_data as $key=>$value) {
 				$SQL = "UPDATE album a SET a.".$key."= "."'".$value."'"." WHERE a.albumTitle= "."'".$album_identifier['albumTitle']."'"." AND a.albumYear= "."'".$album_identifier['albumYear']."'";
 				$query = $this->db->query($SQL);
 				log_message("debug","update singer SQL " . $this->db->last_query());
 			}
 			
 			return (true);

 		}
 		return false;
 	}

	function deleteAlbum($albumTitle, $albumYear){
		$SQL = "DELETE FROM album a WHERE LOWER(a.albumTitle) LIKE LOWER("."'%".$albumTitle."%') and a.albumYear = ".$albumYear.;
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - delete album by title and year '.$this->db->last_query());
		if($query)
			return TRUE;
		else 
			return FALSE;
	}
?>