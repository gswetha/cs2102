<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Album_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	var $table_name     = 'album';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function getAllSongs(){
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle, s.sAlbumYear, s.songImg FROM song s";
		$query = $this->db->query($SQL);
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

	function getAlbum(){
		$SQL = "SELECT * FROM album";
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
		$SQL = "INSERT INTO album (albumTitle, albumYear, numSongs, albumGenre, albumPrice, albumImg, albumDescrip) VALUES ("."'".$albumTitle."',".$albumYear.",'".$numSongs."','".$genre."',".$price.",'".$img."','".$descrip."')";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function searchAlbumbyTitle($title){
		log_message('info','searching now!!!');
		$SQL = "SELECT * FROM album WHERE LOWER(albumTitle) LIKE LOWER('%".$title."%')";
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
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchAlbumbyYear($year){
		$SQL = "SELECT * FROM album WHERE albumYear LIKE '".$year."'";
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
		log_message('info', 'album_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function searchAlbumbyGenre($genre){
		$SQL = "SELECT * FROM album WHERE LOWER(albumGenre) LIKE LOWER('%".$genre."%')";
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

	function searchAlbumbySongTitle($song){
		$SQL = "SELECT a.albumImg,a.albumTitle,a.albumYear,a.albumGenre,a.numSongs,a.albumPrice FROM song s, album a WHERE 
				a.albumTitle = s.sAlbumTitle AND a.albumYear = s.sAlbumYear AND LOWER(songTitle) LIKE LOWER('%".$song."%')
				GROUP BY a.albumImg,a.albumTitle,a.albumYear,a.albumGenre,a.numSongs,a.albumPrice";
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - getting all album query by song title '.$this->db->last_query());
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

		$SQL = "SELECT * FROM album	WHERE albumPrice BETWEEN ".$lowerPrice." AND ".$upperPrice;
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
		log_message('info', print_r($result,TRUE));
		return $result;
	}

	function searchAlbumbyArtist($name=FALSE, $firstName=FALSE, $lastName=FALSE){
		//this function receives $name if only one word was typed. eg. Taylor. 
		//if 2 words were given, it is assumed to be in the format "firstname lastname". So this function will not receive $name. it will only receive $firstname and $lastname.
		if(!$firstName && !$lastName) {
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs FROM album a
					JOIN singersingssong s ON s.sssAlbumTitle = a.albumTitle AND s.sssAlbumYear = a.albumYear WHERE (LOWER(s.sssSingerFirstName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerLastName) LIKE LOWER('%".$name."%'))
					OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$name."%')) GROUP BY a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs";
		}	
		else{
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs FROM album a
					JOIN singersingssong s ON s.sssAlbumTitle = a.albumTitle AND s.sssAlbumYear = a.albumYear WHERE 
						(LOWER(s.sssSingerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(s.sssSingerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(s.sssSingerStageName) LIKE LOWER('%".$firstName." ".$lastName."%')) GROUP BY a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs";

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
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs FROM album a, composercomposessong c WHERE c.ccsAlbumTitle = a.albumTitle AND c.ccsAlbumYear = a.albumYear AND 
					(LOWER(c.ccsComposerFirstName) LIKE LOWER('%".$name."%'))
					OR (LOWER(c.ccsComposerLastName) LIKE LOWER('%".$name."%'))
					GROUP BY a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs";
		}	
		else{
			$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs FROM album a
					JOIN composercomposessong c ON c.ccsAlbumTitle = a.albumTitle AND c.ccsAlbumYear = a.albumYear WHERE 
					(LOWER(c.ccsComposerFirstName) LIKE LOWER('%".$firstName."%') 
						AND LOWER(c.ccsComposerLastName) LIKE LOWER('%".$lastName."%'))
						OR (LOWER(c.ccsComposerFirstName) LIKE LOWER('%".$firstName." ".$lastName."%')) GROUP BY a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs";
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
		$SQL = "SELECT a.albumTitle, a.albumYear, a.albumPrice, a.albumGenre, a.albumImg, a.numSongs, COUNT(*) FROM purchases p, album a WHERE a.albumTitle=p.pAlbumTitle AND a.albumYear=p.pAlbumYear AND p.purchaseType LIKE 'album' GROUP BY a.albumTitle, a.albumYear ORDER BY COUNT(*) DESC";

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
		$SQL = "DELETE FROM album WHERE LOWER(albumTitle) LIKE LOWER('%".$albumTitle."%') AND albumYear = '".$albumYear."'";
		$query = $this->db->query($SQL);
		log_message('info', 'album_model - delete album by title and year '.$this->db->last_query());
		if($query)
			return TRUE;
		else 
			return FALSE;
	}

	function getAlbumbyKey($title, $year){
		$SQL = "SELECT * FROM album WHERE LOWER(albumTitle) LIKE LOWER('%".$title."%') AND "."LOWER(albumYear) LIKE LOWER('%".$year."%')";
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
}
?>