<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller{

	public function __construct(){	
	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Login_model');
	}

	public function index(){

		$this->form_validation->set_rules('email_anggota', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password_anggota', 'Password', 'trim|required');

		if ($this->form_validation->run() == False) {
			
		$data['judul'] = "Login Anggota";
		$this->load->view('auth/login', $data);
		
		}else{
			$email_anggota = $this->input->post('email_anggota');
			$password_anggota = $this->input->post('password_anggota');

			$user = $this->db->get_where('anggota', ['email_anggota' => $email_anggota])->row_array();
			
			if($user) {
				if($user['aktif'] == 1){ 
					if(password_verify($password_anggota, $user['password_anggota'])){
					$data = [
						'id_anggota' => $user['id_anggota'],
						'email_anggota' => $user['email_anggota']
					];
					$this->session->set_userdata($data);
					redirect('anggota');
					}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Password Salah</div>');
					redirect('auth');	
					}
				}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Email Belum Aktif</div>');
				redirect('auth');
				}
			}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Email Tidak Terdaftar</div>');
			redirect('auth');
			}
		}
	}

		public function buatakun(){
			$data['judul'] = "Form Registrasi";

			$this->form_validation->set_rules('nama_anggota', 'Nama', 'required');
			$this->form_validation->set_rules('email_anggota', 'Email', 'required|trim|valid_email|is_unique[anggota.email_anggota]');
			$this->form_validation->set_rules('password_anggota', 'Password', 'required|trim|matches[password2]');
			$this->form_validation->set_rules('password2', 'Ini', 'required|trim|matches[password_anggota]');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('auth/buatakun', $data);
			}else{

				$data = [
					'nama_anggota' => $this->input->post('nama_anggota', true),
					'password_anggota' => password_hash($this->input->post('password_anggota'), PASSWORD_DEFAULT),
					'email_anggota' => $this->input->post('email_anggota', true),
					'aktif' => '1'
				];

				$this->db->insert('anggota', $data);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							  Berhasil Membuat Akun</div>');
				redirect('auth');

		}
	}

	public function loginpetugas(){

		$this->form_validation->set_rules('nama_petugas', 'Nama', 'required');
		$this->form_validation->set_rules('password_petugas', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			
		$data['judul'] = "Login Petugas";
		$this->load->view('auth/loginpetugas', $data);
		
		}else{
			$nama_petugas = $this->input->post('nama_petugas');
			$password_petugas = $this->input->post('password_petugas');

			$petugas = $this->db->get_where('petugas', ['nama_petugas' => $nama_petugas])->row_array();
			
			if($petugas) {
				if($petugas['aktif'] == 1){ 
					if($password_petugas == $petugas['password_petugas']){
					$data = [
						'nama_petugas' => $petugas['nama_petugas']
					];
					$this->session->set_userdata($data);
					if($petugas['level'] == 1){
						redirect('admin');
					}else{
						redirect('petugas');
					}
					}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								Password Salah</div>');
					redirect('auth/loginpetugas');	
					}
				}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Petugas Non-Aktif</div>');
				redirect('auth/loginpetugas');
				}
			}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Petugas Tidak Terdaftar</div>');
			redirect('auth/loginpetugas');
			}

		}
	}

	public function LoginPelaksana(){

		$this->form_validation->set_rules('nama_pelaksana', 'Nama', 'trim|required');
		$this->form_validation->set_rules('password_pelaksana', 'Password', 'trim|required');

		if ($this->form_validation->run() == False) {
			
		$data['judul'] = "Login Pelaksana";
		$this->load->view('auth/loginpelaksana', $data);
		
		}else{
		$nama_pelaksana = $this->input->post('nama_pelaksana');
		$password_pelaksana = $this->input->post('password_pelaksana');

		$pelaksana = $this->db->get_where('pelaksana', ['nama_pelaksana' => $nama_pelaksana])->row_array();
		
		if($pelaksana) { 
				if($password_pelaksana == $pelaksana['password_pelaksana']){
				$data = [
					'id_pelaksana' => $pelaksana['id_pelaksana'],
					'nama_pelaksana' => $pelaksana['nama_pelaksana'],
					'bidang' => $pelaksana['bidang']
				];
				$this->session->set_userdata($data);
				redirect('pelaksana');
				}else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  Password Salah!!!</div>');
				redirect('auth/loginpelaksana');	
				}
		}else{
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					  Akun Petugas Tidak Terdaftar!!!</div>');
		redirect('auth/loginpelaksana');
		}

		}
	}

	

}

?>