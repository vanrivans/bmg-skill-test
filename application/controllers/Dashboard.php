<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Class Dashboard
 */

class Dashboard extends CI_Controller {

    var $title      = 'Dashboard';
    var $appName    = 'Management Article';

    function __construct() {

		parent::__construct();

		// Check session
		$this->session_lib->check_session();
	}
	// End of function __construct

    public function index() {

        $data = array(
                        'title'     => $this->title,
                        'appName'   => $this->appName
        );

        $this->layout_lib->default_template('layout/dashboard', $data);
    }
    // End of function index

	public function load_modal_sign_out() {

		$this->load->view('layout/modal-sign-out');
	}
	// End of function load_modal_sign_out
    
    public function destroy_sessions() {

		// Destroy session
		$this->session->sess_destroy();

		redirect('login/index?logout=1');
	}
	// End of function destroy_sessions

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */