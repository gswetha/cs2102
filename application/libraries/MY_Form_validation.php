<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* Form Validation Class
*
* @package        CodeIgniter
* @subpackage    Libraries
* @author        MRF
*/
class MY_Form_validation extends CI_Form_validation {

/**
* Get the error's per field for the system to handle them more effectively.
*
* @access    public
* @return    void
*/

	public function __construct($rules = array())
	{
		parent::__construct($rules);
		$this->ci =& get_instance();

	}

	public function error_fields () {
		$errorArray = array();
		foreach ($this->_field_data as $key=>$val)
		{
			if ($val['error'] != '') {
				$errorArray[$val['field']] = $val['error'];
			}

		}

		return $errorArray;
	}

	public function get_data() {

		$form_data = array();
		foreach ($this->_field_data as $val) {
			$form_data[$val['field']] = $val['postdata'];
		}

		return($form_data);
	}

	function remove_non_numeric($str) {
		return preg_replace('/[^0-9,.]/', '', $str);
	}

	// Remove the comma as well
	function remove_non_digit($str) {
		return preg_replace('/[^0-9.]/', '', $str);
	}
	
	function check_zip($str) {
		$regex = '/(^\d{5}$)|(^\d{5}-\d{4}$)/';
		if (!preg_match($regex,$str)) {
				$this->set_message('check_zip', "$str is not a valid US zipcode format. A valid zipcode contains 5 digits.");
				return(false);
		}
		return(true);
	}

	
	/**
	 * Check whether this is a valid monetary value
	 *
	 */
	public function is_money($str) {
		$regex = '/^[0-9]*(\.[0-9]{0,2})?$/';

		$stripped = preg_replace('/[^0-9.]/', '', $str);
		log_message('debug','is_money ' . $stripped);
		if (!preg_match($regex,$stripped) || $stripped > 99999999.99) {
			$this->set_message('is_money', "$"."$str is not a valid monetary format or is too high.");
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check for a valid phone number
	 *
	 */
	function check_phone($str) {
		$regex = '/^(\(?[0-9]{3}\)?)?[ .-]?[0-9]{3}[ .-]?[0-9]{4}$/';
		if (!preg_match($regex,$str)) {
			$this->set_message('check_phone', "$str is not a valid US Phone number format.");
			return(false);
		}
		return(true);
	}

	/* check for vaild PSP Number
	 *
	 */

	
	function check_nine($str) {
		$regex = '/^[0-9]{9}$/';
		if (strpos($str,"*****")===0) { // Masked
			return(true);
		}
		$str =  $this->remove_non_numeric($str);
		if (!preg_match($regex,$str)) {
			$this->set_message('check_nine', "$str is not a valid format for a bank routing number (9 digits).");
			return(false);
		}
		return(true);
	}

	function is_date($str) {
		$ddmmyyy='/^(19|20)[0-9]{2}[- \/.](0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])$/';
		if(preg_match($ddmmyyy, $str)) {
			return TRUE;
		} else {
			$this->set_message('is_date', 'Please enter yyyy-mm-dd');
			return FALSE;
		}
	}

	/**
	 * Check this date is specifically in the format mm/dd/yyyy
	 *
	 * @param int
	 * @param string
	 *
	 */
	function is_date_mmddyy($str) {
		// Removed (-.) as separators as strtotime does not parse that.  Adding them back in will cause other
		// parts of the system to fail (for example, meter reading entries)
		$ddmmyyy='/^(0[1-9]|1[012])[\/.](0[1-9]|[12][0-9]|3[01])[\/.](19|20)[0-9]{2}$/';
		log_message('debug','OLDDATE  ' .$str);
		if(preg_match($ddmmyyy, $str)) {
			$newdate = strtotime($str);
			log_message('debug','NEWDATE  ' . date("Y-m-d",$newdate));
			return date("Y-m-d",$newdate);
		} else {
			$this->set_message('is_date_mmddyy', 'The %s field must contain a valid date in the format mm/dd/yyyy, not '.$str.'.');
			return FALSE;
		}
	}

	/**
	 * Check this date is specifically in the format mm/yyyy.  This format is often used by GATS for generation periods.
	 *
	 * @param int
	 * @param bool
	 *
	 */
	function is_date_mmyyy($str) {
		$mmyyy='/^(0[1-9]|1[012])[\/.](19|20)[0-9]{2}$/';
		if(preg_match($mmyyy, $str)) {
			return TRUE;
		} else {
			$this->set_message('is_date_mmyyy', 'The %s field contain a valid date in the format mm/dd/yyyy.');
			return FALSE;
		}
	}

	/**
	 * Check that this is a number only (no other characters)
	 *
	 * @param  int
	 * @return bool
	 *
	 */
	function only_integer($number) {
		if(preg_match('/[^0-9.]/', $number)) {
			$this->set_message('only_integer', "The %s field must contain numbers only (" . $number . " should be ". preg_replace('/[^0-9.]/', '', $number) .").");
			return FALSE;

		}

		return TRUE;
	}

	function required_ifnot($str, $postname) {
		log_message("info","CHECK required if not  $str and $postname");
		log_message("info","CHECK  $postname ".$this->ci->input->post($postname));
		if ($this->ci->input->post($postname) ) {
			log_message("info","CHECK  ok by post $postname");
			return(true); // If postname set not required
		}
		if ($str !="") {
			log_message("info","CHECK  ok by value $str");
			return(true); // Not empty is required
		}
		log_message("info","CHECK  fail");
		$this->set_message('required_ifnot', "is required when $postname is empty");
		return FALSE;
	}

	function after($str, $earlier_date) {
		log_message("info","CHECK  earlier date $str must be before $earlier_date");
		if (strtotime($str) < strtotime($earlier_date)) {
			$this->set_message('after', "The date must be after the interconnection date of $earlier_date");
			return FALSE;
		}
		return(true);
	}

	/**
	 * not numeric - numbers are ok but entire thingh can't be numeric for other
	 */
	function notnumeric($str) {
		if (is_numeric($str)) {
			$this->set_message('notnumeric', "Model Name cannot be a simple number");
			return(false);
		}
		return(true);
	}
}
?>