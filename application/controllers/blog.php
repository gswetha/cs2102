<?php
//include_once('oracle-test.php');
class Blog extends CI_Controller {

	public function index()
	{
		echo 'Hello World!';
	}

	function details($message_int) {
		$query = $this->db->query('SELECT * FROM test');
		var_dump($query);
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		      echo $row->id;
		      echo $row->name;
		   }
		}
		echo " Details function in Blog controller!";
		echo "the integer passed in is ".$message_int;
	}
}
?>