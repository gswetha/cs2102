<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Purchase_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function getAllPurchases(){
		$SQL = "SELECT * FROM purchases";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get all purchases'.$this->db->last_query());
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

	function purchaseSong($data){
		// var_dump($data);
		//echo "in purchaseSong in purchase_model";
		$SQL = "INSERT INTO purchases (pAlbumTitle, pAlbumYear, pSongTitle, pSongYear, pEmail, transactionDate, amountPaid, purchaseType)
				VALUES ("."'".$data['pAlbumTitle']."',"."'".$data['pAlbumYear']."',"."'".$data['pSongTitle']."',"."'".$data['pSongYear']."',"."'".$data['pEmail']."',"."'".$data['transactionDate']."',"."'".$data['amountPaid']."',"."'".$data['purchaseType']."'".")";
		if($this->db->query($SQL))
		{	
			log_message('info', 'purchase_model - get all purchases'.$this->db->last_query());
			return TRUE; 
		}
		log_message('info', 'purchase_model - get all purchases 2'.$this->db->last_query());
		return FALSE;
	}

	function getAllSongsInAlbum($albumTitle,$albumYear){
		$SQL = "SELECT so.songTitle, so.songYear, so.sAlbumTitle, so.sAlbumYear FROM song so
				WHERE LOWER(so.sAlbumTitle) LIKE LOWER('%".$albumTitle."%') AND so.sAlbumYear = '".$albumYear."'";
		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - getting songs in album for purchase '.$this->db->last_query());
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

	function checkPurchased($userEmail,$albumTitle,$albumYear,$songTitle,$songYear){
		$SQL = "SELECT COUNT(*) AS counter FROM purchases WHERE LOWER(pAlbumTitle) LIKE LOWER('%".$albumTitle."%') AND pAlbumYear = '".$albumYear."' AND LOWER(pSongTitle) LIKE LOWER('%".$songTitle."%') AND pSongYear = '".$songYear."' AND pEmail = '".$userEmail."'";
		$query = $this->db->query($SQL);
		$result = NULL;
		log_message('info', 'purchase_model - checking is purchased '.$this->db->last_query());
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		log_message('info', 'purchase_model - check purchased resutl is '.print_r($result,TRUE));
		if($result[0]['counter'] != "0")
			return TRUE;
		else
			return FALSE;
	}

	function getTotalRevenue(){
		$SQL = "SELECT SUM(p.amountPaid) FROM purchases p";
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

	function getPurchasesByUser($userEmail){
		//union of results based on paypal email and user email?
		$SQL = "SELECT * FROM purchases p WHERE p.pEmail = '".$userEmail."'".
				"UNION SELECT p.pAlbumTitle,p.pAlbumYear,p.pSongTitle,p.pSongYear,p.pEmail,p.transactionId,p.transactionDate,p.amountPaid 
				FROM purchases p, user u WHERE u.paypalEmail=p.pEmail AND u.email = '".$userEmail."'";
		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get purchases by user'.$this->db->last_query());
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

	function getRevenueBySinger($firstName, $lastName){
		$SQL = "SELECT sss.sssSingerFirstName, sss.sssSingerLastName, sss.sssSingerStageName, SUM(p.amountPaid) FROM singersingssong sss, purchases p WHERE 
		sss.sssAlbumTitle = p.pAlbumTitle AND sss.sssAlbumYear = p.pAlbumYear AND
		LOWER(sss.sssSingerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(sss.sssSingerLastName) LIKE LOWER('%".$lastName."%')
		GROUP BY ccs.ccsComposerFirstName, ccs.ccsComposerLastName, SUM(p.amountPaid) ORDER BY SUM(p.amountPaid) DESC";

		$query = $this->db->query($SQL);
		log_message('info', 'purchase_model - get revenue by singer'.$this->db->last_query());
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
				ccs.ccsAlbumTitle = p.pAlbumTitle AND ccs.ccsAlbumYear = p.pAlbumYear AND
				LOWER(ccs.ccsComposerFirstName) LIKE LOWER('%".$firstName."%') AND LOWER(ccs.ccsComposerLastName) LIKE LOWER('%".$lastName."%')
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
}

?>