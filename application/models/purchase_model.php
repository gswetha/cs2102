<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchase_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	}

	function getAllPurchases(){
		
	}

	function getRevenue(){

	}

	function getPurchasesByUser($userEmail){
		
	}

	function getRevenueBySinger($firstName, $lastName){
		
	}

	function getRevenueByGenre($genre){
		$SQL = "SELECT a.albumGenre, SUM(p.amountPaid) FROM album a, purchases p WHERE a.albumTitle = p.pAlbumTitle AND a.albumYear = p.pAlbumYear AND
				LOWER(a.albumGenre) LIKE LOWER('%".$genre."%') GROUP BY a.albumGenre, SUM(p.amountPaid) ORDER BY SUM(p.amountPaid) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get revenue by genre'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'purchase_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function getRevenueByAlbum($title, $year){
		$SQL = "SELECT p.pAlbumTitle, p.pAlbumYear, SUM(p.amountPaid) FROM purchases p WHERE 
				LOWER(p.pAlbumTitle) LIKE LOWER('%".$title."%') AND p.pAlbumYear = $year GROUP BY p.pAlbumTitle, p.pAlbumYear, SUM(p.amountPaid)
				ORDER BY SUM(p.amountPaid) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get revenue by album'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'purchase_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function getRevenueByComposer($firstName, $lastName){
		$SQL = "SELECT ccs.ccsComposerFirstName, ccs.ccsComposerLastName, SUM(p.amountPaid) FROM composercomposessong ccs, purchases p WHERE 
				ccs.ccsAlbumTitle = p.pAlbumTitle AND ccs.ccsAlbumYear = p.pAlbumYear AND
				LOWER(ccs.ccsComposerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(ccs.ccs.ccsComposerLastName) LIKE LOWER('%".$lastName."%')
				GROUP BY ccs.ccsComposerFirstName, ccs.ccsComposerLastName, SUM(p.amountPaid) ORDER BY SUM(p.amountPaid) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get revenue by genre'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'purchase_model - result is '.print_r($result,TRUE));
		return $result;
	}

	function getRevenueBySong($songTitle, $songYear, $albumTitle, $albumYear){
		$SQL = "SELECT p.pSongTitle, p.pSongYear, SUM(p.amountPaid) FROM purchases p WHERE 
				LOWER(p.pAlbumTitle) LIKE LOWER('%".$albumTitle."%') AND p.pAlbumYear = $albumYear AND
				LOWER(p.pSongTitle) LIKE LOWER('%".$songTitle."%') AND p.pSongYear = $songYear AND
				GROUP BY p.pSongTitle, p.pSongYear, SUM(p.amountPaid)
				ORDER BY SUM(p.amountPaid) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get revenue by genre'.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'purchase_model - result is '.print_r($result,TRUE));
		return $result;
	}

?>