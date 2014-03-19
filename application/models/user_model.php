<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends CI_Model {

	/*
	 | CLASS DATA
	 |
	 */
	 	var $table_name     = 'user'; //model queries from album table.
		var $userName 		= '';
		var $email 			= '';
		var $userFirstName 	= '';
		var $userLastName 	= '';
		var $userBirthday 	= '';
		var $paypalEmail 	= '';
		var $role			= '';

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function loadFromArray($array){
		$this->userName      = $array['userName'];
		$this->email         = $array['email'];
		$this->userFirstName = $array['userFirstName'];
		$this->userLastName  = $array['userLastName'];
		$this->userBirthday  = $array['userBirthday'];
		$this->paypalEmail   = $array['paypalEmail'];
		$this->role          = $array['role'];
	}

	function getUserLogin($email, $password){
		log_message('info', 'trying to get user info');
		$SQL = "SELECT * FROM ".$this->table_name." WHERE email = "."'".$email."'"." AND password = "."'".md5($password)."'";
		$query = $this->db->query($SQL);
		log_message('info', 'user_model - getting users query '.$this->db->last_query());
		$result = NULL;
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result_array() as $row)
		   {
		      $result[] = $row;
		   }
		}
		$this->loadFromArray($result[0]);
		log_message('info', 'user_model - result is '.print_r($result,TRUE));
		return $result[0];
	}

	function getUserByEmail($email){
		$SQL = "SELECT * FROM ".$this->table_name." WHERE email = "."'".$email."'";
		$query = $this->db->query($SQL);
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

}

?>