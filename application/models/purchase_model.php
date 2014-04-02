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

	function getRevenueByGenre(){
		$SQL = "SELECT a.albumGenre, SUM(p.amountPaid) FROM album a, purchases p WHERE a.albumTitle = p.pAlbumTitle AND a.albumYear = p.pAlbumYear
				GROUP BY a.albumGenre, SUM(p.amountPaid) ORDER BY SUM(p.amountPaid) DESC";

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

	function getRevenueByAlbum(){
		$SQL = "SELECT p.pAlbumTitle, p.pAlbumYear, SUM(p.amountPaid) FROM purchases p GROUP BY p.pAlbumTitle, p.pAlbumYear, SUM(p.amountPaid)
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

	function getRevenueByComposer(){
		$SQL = "SELECT ccs.ccsComposerFirstName, ccs.ccsComposerLastName, SUM(p.amountPaid) FROM composercomposessong ccs, purchases p WHERE 
				ccs.ccsAlbumTitle = p.pAlbumTitle AND ccs.ccsAlbumYear = p.pAlbumYear
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

	function getRevenueBySong(){
		$SQL = "SELECT p.pSongTitle, p.pSongYear, SUM(p.amountPaid) FROM purchases p
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