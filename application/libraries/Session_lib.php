<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

/*
 * Class Session_lib
 */

class Session_lib {

	protected $CI;
	
	function __construct() {

		$this->CI =& get_instance();

	}
	// End of function __construct

	/**
	 * @return true or redirect
	 */
	public function check_session() {

		// is already sessions
		if (! $this->CI->session->userdata('user_id')) {

			$this->CI->session->set_flashdata('alert-error', 'Sesi telah berakhir');

			redirect('login');
		} else {

			return true;
		}
		// End of if already sessions
	}
	// End of function check_session

}
/* End of file Session_lib.php */
/* Location: ./application/libraries/Session_lib.php/ */

