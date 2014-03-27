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
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle FROM song s";
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

	function addSong($data){
		$SQL = "INSERT INTO song (sAlbumTitle, sAlbumYear, songTitle, songYear, songPrice, songImg, songGenre, songLength
				VALUES ("."'".$data['sAlbumTitle']."',".$data['sAlbumYear'].",'".$data['songTitle']."','".$data['songYear']."',".$data['songPrice'].",'".$data['songImg']."','".$data['songGenre']."',".$data['songLength'].")";

		//need to create trigger to insert into album, singer, singersingssong, composercomposessong
		$query = $this->db->query($SQL);
		log_message("debug","add song SQL " . $this->db->last_query());
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function deleteSong($sAlbumTitle, $sAlbumYear, $songTitle, $songYear){
		$SQL = "DELETE FROM song s WHERE s.sAlbumTitle= "."'".$sAlbumTitle."'"." AND s.sAlbumYear= "."'".$sAlbumYear."'"." AND s.songTitle= "."'".$songTitle."'"." AND s.songYear= "."'".$songYear."'";

		$query = $this->db->query($SQL);
		if($query)
			return TRUE;
		else
			return FALSE;
	}

 	function updateSong($update_data, $song_identifier) {
 		if(is_array($update_data) && count($update_data)){
 			$data = array();
 			foreach ($update_data as $key=>$value) {
 				$SQL = "UPDATE song s SET s.".$key."= "."'".$value."'"." WHERE s.sAlbumTitle= "."'".$song_identifier['sAlbumTitle']."'"." AND s.sAlbumYear= "."'".$song_identifier['sAlbumYear']."'"." AND s.songTitle= "."'".$song_identifier['songTitle']."'"." AND s.songYear= "."'".$song_identifier['songYear']."'";
 				$query = $this->db->query($SQL);
 				log_message("debug","update song SQL " . $this->db->last_query());
 			}
 			
 			return (true);

 		}
 		return false;
 	}

	function searchSongbyTitle($title){
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle FROM song s
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
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle FROM song s
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
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle FROM song s
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
		$SQL = "SELECT s.songTitle, s.songLength, s.songYear, s.songPrice, s.songGenre, s.sAlbumTitle FROM song s
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

	function searchSongbyComposer($name){
		$SQL = "SELECT so.songTitle, so.songLength, so.songYear, so.songPrice, so.songGenre, so.sAlbumTitle FROM song so, composercomposessong ccs
				WHERE ccs.ccsAlbumTitle = so.sAlbumTitle AND ccs.ccsAlbumYear = so.sAlbumYear AND ccs.ccsSongTitle = so.songTitle AND ccs.ccsSongYear = so.songYear
				AND ((LOWER(ccs.ccsComposerFirstName) LIKE LOWER('%".$name."%') OR LOWER(ccs.ccsComposerLastName) LIKE LOWER('%".$name."%'))";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song by composer'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - search by composer result is '.print_r($result,TRUE));
		return $result;
	}

	function searchGeneric($term){
		$SQL = "SELECT DISTINCT so.songTitle, so.songYear, so.songLength, so.songGenre, so.songImg, so.songPrice FROM song so WHERE so.songTitle IN (
					SELECT sss.sssSongTitle FROM singersingssong sss WHERE  LOWER(sss.sssSingerFirstName) LIKE LOWER('%".$term."%') OR LOWER(sss.sssSingerLastName) LIKE LOWER('%".$term."%') OR LOWER(sss.sssSingerStageName) LIKE LOWER('%".$term."%')) OR LOWER(so.songTitle) LIKE LOWER('%".$term."%') OR so.songLength LIKE '%".$term."%' OR LOWER(so.songGenre) LIKE LOWER('%".$term."%') OR so.songPrice<='".$term."' OR LOWER(so.sAlbumTitle) LIKE LOWER('%".$term."%') OR so.sAlbumYear LIKE '%".$term."%' OR so.songTitle IN (
					SELECT ccs.ccsSongTitle FROM composercomposessong ccs WHERE  LOWER(ccs.ccsComposerFirstName) LIKE LOWER('%".$term."%') OR LOWER(ccs.ccsComposerLastName) LIKE LOWER('%".$term."%'))";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'song_model - search song generic'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'song_model - search generic result is '.print_r($result,TRUE));
		return $result;
	}

?>