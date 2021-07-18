<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Class Login
 */
class Login extends CI_Controller {

    public function index() {

		// is submit post
		if ($this->input->post('btn-login')) {

            $username = strip_tags($this->input->post('username'));
            $password = strip_tags($this->input->post('password'));

			// is empty post
			if (empty($username) || empty($password)) {

				$this->session->set_flashdata('alert-error', 'Username & password harus diisi');

				redirect('login');

			} else {

                $query = $this->db->query("SELECT users.id, users.password
                                                FROM users
                                                WHERE username = '" . $username . "'");

				// is empty user
				if ($query->num_rows() > 0) {

                    $result = $query->row_array();

                    // Auth
                    if ($this->encryption->decrypt($result['password']) == $password) {

                        // Set Session
                        $data = array(
                                        'user_id'  => $result['id'],
                                        'username' => $username,
                        );

                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('alert-success', 'Login berhasil');

                        // Redirect
                        redirect('article');
                    } else {

                        $this->session->set_flashdata('alert-error', 'Password salah');

                        redirect('login');
                    }
                    // End of file auth

				} else {

					$this->session->set_flashdata('alert-error', 'Username tidak terdaftar');

					redirect('login');
				}	
				// End of if user not found

			}
			// End of if empty username || password

		}
		// End of if post btn-login

        if ($this->input->get('logout') == 1) {

			$this->session->set_flashdata('alert-success', 'Logout berhasil');
			redirect('login');
		}

		$this->load->view('login/login');
    }
    // End of function index

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */