<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Composer_model extends CI_Model {
	 	
	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'composer'; //model queries from song table.

		var $composerFirstName = '';
		var $composerLastName  = '';
		var $composerBirthday  = '';
		var $composerDescrip   = '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	

	function getAllComposers(){
		$SQL = "SELECT * FROM composer";
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - getting all composers query '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function addComposer($data){
		$SQL = "INSERT INTO composer (composerFirstName, composerLastName, composerBirthday, composerDescrip)
				VALUES ("."'".$data['composerFirstName']."',".$data['composerLastName'].",'".$data['composerBirthday']."','".$data['composerDescrip']."')";

		//do not need trigger here. because can have composers who do not have songs. only need trigger for adding song
		$query = $this->db->query($SQL);
		log_message("debug","add composer SQL " . $this->db->last_query());
		if($query)
			return TRUE;
		else
			return FALSE;
	}

	function deleteComposer($composerFirstName, $composerLastName, $composerBirthday){
		//on delete cascase will remove corresponsing tuples in composercomposessong
		$SQL = "DELETE FROM composer c WHERE c.composerFirstName= "."'".$composerFirstName."'"." AND c.composerLastName= "."'".$composerLastName."'"." AND c.composerBirthday= "."'".$composerBirthday."'";

		$query = $this->db->query($SQL);
		log_message("debug","delete composer SQL " . $this->db->last_query());
		if($query)
			return TRUE;
		else
			return FALSE;
	}

 	function updateComposer($update_data, $composer_identifier) {
 		//on update cascase will update corresponsing tuples in composercomposessong
 		if(is_array($update_data) && count($update_data)){
 			$data = array();
 			foreach ($update_data as $key=>$value) {
 				$SQL = "UPDATE composer c SET c.".$key."= "."'".$value."'"." WHERE c.composerFirstName= "."'".$composer_identifier['composerFirstName']."'"." AND c.composerLastName= "."'".$composer_identifier['composerLastName']."'"." AND c.composerBirthday= "."'".$composer_identifier['composerBirthday']."'";
 				$query = $this->db->query($SQL);
 				log_message("debug","update composer SQL " . $this->db->last_query());
 			}
 			return (true);
 		}

 		return false;
 	}

	function searchGeneric($term){
		$SQL = "SELECT DISTINCT * FROM composer c WHERE LOWER(c.composerFirstName) LIKE LOWER('%".$term."%') OR c.composerBirthday LIKE ('%".$term."%') OR LOWER(c.composerLastName) LIKE LOWER('%".$term."%') OR LOWER(c.composerDescrip) LIKE LOWER('%".$term."%') OR c.composerFirstName IN (
				SELECT ccs.ccsComposerFirstName FROM composercomposessong ccs WHERE  LOWER(ccs.ccsAlbumTitle) LIKE LOWER('%".$term."%') OR ccs.ccsAlbumYear LIKE ('%".$term."%') OR LOWER(ccs.ccsSongTitle) LIKE LOWER('%".$term."%') OR ccs.ccsSongYear LIKE ('%".$term."%'))";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer generic'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search generic result is '.print_r($result,TRUE));
		return $result;
	}

	function searchComposerBySong($songTitle){
		$SQL = "SELECT * FROM composer c, composercomposessong ccs WHERE 
				ccs.ccsComposerFirstName= c.composerFirstName AND ccs.ccsComposerLastName = c.composerLastName AND ccs.ccsComposerBirthday = c.composerBirthday
				AND LOWER(ccs.ccsSongTitle) LIKE LOWER('%".$songTitle."%')";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer by song'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search composer by song result is '.print_r($result,TRUE));
		return $result;
	}

	function searchComposerByName($name){
		$SQL = "SELECT * FROM composer c WHERE LOWER(c.composerFirstName) LIKE LOWER('%".$name."%') OR LOWER(c.composerLastName) LIKE LOWER('%".$name."%')";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer by composer name'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search composer by composer name is '.print_r($result,TRUE));
		return $result;
	}

	function searchComposerByBirthday($birthday, $lower, $higher){
		//have ranges (can use union in the SQL)
		$result = NULL;	
		log_message('info', 'in composer model searching composer by birthday. parameters are '.print_r($birthday,true).' and '.print_r($lower,true).' and '.print_r($higher,true));
		if ($birthday)
			$SQL = "SELECT * FROM composer c WHERE c.composerBirthday = '".$birthday."'";
		elseif($lower && !$higher)
			$SQL = "SELECT * FROM composer c WHERE c.composerBirthday < '".$lower."'";
		elseif (!$lower && $higher) {
			$SQL = "SELECT * FROM composer c WHERE c.composerBirthday > '".$higher."'";
		}
		elseif ($lower && $higher) {
			$SQL = "SELECT * FROM composer c WHERE c.composerBirthday BETWEEN '".$lower."'"." AND '".$higher."'";
		}
		else {
			log_message('info', 'all of the conditions failed');
			return FALSE;
		}

		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer by bday'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search composer by bday result is '.print_r($result,TRUE));
		return $result;

	}

	function searchComposerByAlbum($album){
		$SQL = "SELECT DISTINCT c.composerFirstName, c.composerLastName, c.composerBirthday, c.composerDescrip FROM composercomposessong ccs, composer c WHERE ccs.ccsComposerFirstName= c.composerFirstName AND ccs.ccsComposerLastName = c.composerLastName AND ccs.ccsComposerBirthday = c.composerBirthday AND LOWER(ccs.ccsAlbumTitle) LIKE LOWER('%".$album."%')";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer by album'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search composer by album result is '.print_r($result,TRUE));
		return $result;
	}

	function searchComposerByGenre($genre){
		$SQL = "SELECT DISTINCT c.composerFirstName, c.composerLastName, c.composerBirthday, c.composerDescrip FROM composercomposessong ccs, composer c, song s WHERE ccs.ccsComposerFirstName= c.composerFirstName AND ccs.ccsComposerLastName = c.composerLastName AND ccs.ccsComposerBirthday = c.composerBirthday AND LOWER(s.songGenre) LIKE LOWER('%".$genre."%') AND ccs.ccsSongTitle=s.songTitle";
		$result = NULL;
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - search composer by genre'.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'composer_model - search composer by genre result is '.print_r($result,TRUE));
		return $result;
	}

	function getComposerByKey($composerFirstName, $composerLastName, $composerBirthday){
		$SQL = "SELECT * FROM composer c WHERE LOWER(composerFirstName) LIKE LOWER('%".$composerFirstName."%') AND "."LOWER(composerLastName) LIKE LOWER('%".$composerLastName."%') AND "."composerBirthday = '".$composerBirthday."'";
		$query = $this->db->query($SQL);
		log_message('info', 'composer_model - getting composer by primary key query '.$this->db->last_query());
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