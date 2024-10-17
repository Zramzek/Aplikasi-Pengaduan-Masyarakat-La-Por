<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Petugas extends CI_Controller{

	public function __construct(){	
	parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('Pengaduan_model');
		$this->load->model('Login_model');
	}

public function index(){
		$data['judul'] = "Halaman Utama";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		
		$config['base_url'] = 'http://localhost/altukk/petugas/index';
		$config['total_rows'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'])->num_rows();
		$config['per_page'] = 2;
		
		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['first_link'] = '&laquo';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = '&raquo';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		
		$config['attributes'] = array('class' => 'page-link');
	
		$this->pagination->initialize($config);
		
		$data['start'] = $this->uri->segment(3);

		if ($this->input->post('filter_urut')){
			$this->db->order_by('tgl_pengaduan', $this->input->post('filter_urut'));
		}
		
		$data['pengaduan'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'], $config['per_page'], $data['start'])->result_array();
		$data['jumlah_pengaduan'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'])->num_rows();

		$this->load->view('templates/headerpetugas', $data);
		$this->load->view('petugas/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function terimapengaduan($id){

			$this->db->set('status_pengaduan', 'proses');
			$this->db->where('id_pengaduan', $id);
			$this->db->update('pengaduan');
	
			$this->session->set_flashdata('message', 'Menerima');
			redirect('petugas');	
	}

		public function tolakpengaduan($id){
				
			$this->db->set('status_pengaduan', 'invalid');
			$this->db->where('id_pengaduan', $id);
			$this->db->update('pengaduan');

			$this->session->set_flashdata('message', 'Menolak');
			redirect('petugas');
			}

	public function detailpengaduan($id){
		$data['judul'] = "Detail Pengaduan";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
		$data['pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();

		$this->load->view('templates/headerpetugas', $data);
		$this->load->view('petugas/detailpengaduan', $data);
		$this->load->view('templates/footer', $data);
	}

	public function historipengaduanpetugas(){
		$data['judul'] = "Histori Pengaduan";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori_pengaduan'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status_pengaduan'] = ['invalid','menunggu','proses','ditanggapi','lanjutan','selesai'];
		$data['jumlah'] = [10, 25, 50];

		$config['base_url'] = 'http://localhost/altukk/petugas/historipengaduanpetugas';
		if ($this->input->post('filter_bidang')) {
			$config['total_rows'] = $this->db->get_where('pengaduan', ['bidang' => $this->input->post('filter_bidang')])->num_rows();
		}elseif ($this->input->post('filter_kategori')){
			$config['total_rows'] = $this->db->get_where('pengaduan', ['kategori_pengaduan' => $this->input->post('filter_kategori')])->num_rows();
		}elseif ($this->input->post('filter_status')){
			$config['total_rows'] = $this->db->get_where('pengaduan', ['status_pengaduan' => $this->input->post('filter_status')])->num_rows();
		}else{
			$config['total_rows'] = $this->db->get('pengaduan')->num_rows();
		}
		
		if ($this->input->post('filter_jumlah')) {
			$config['per_page'] = $this->input->post('filter_jumlah');
		}else{
			$config['per_page'] = 10;
		}
		
		$config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		
		$config['first_link'] = '&laquo';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		
		$config['last_link'] = '&raquo';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		
		$config['attributes'] = array('class' => 'page-link');
	
		$this->pagination->initialize($config);
		
		$data['start'] = $this->uri->segment(3);

		if ($this->input->post('filter_bidang')) {
			$data['pengaduan'] = $this->Pengaduan_model->getBidangPengaduan($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_kategori')){
			$data['pengaduan'] = $this->Pengaduan_model->getKategoriPengaduan($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_status')){
			$data['pengaduan'] = $this->Pengaduan_model->getStatusPengaduan($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_urut')){
			$this->db->order_by('id_pengaduan', $this->input->post('filter_urut'));
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['tgl_pengaduan' => $this->input->post('filter_urut')], $config['per_page'], $data['start'])->result_array();
		}else{
			$this->db->order_by('status_pengaduan', 'DESC');
			$data['pengaduan'] = $this->db->get('pengaduan', $config['per_page'], $data['start'])->result_array();
		}

		$this->load->view('templates/headerpetugas', $data);
		$this->load->view('petugas/historipengaduan', $data);
		$this->load->view('templates/footer');
	}

public function logout(){
	$this->session->unset_userdata('nama_petugas');

	$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  Berhasil Logout</div>');
			redirect('auth/loginpetugas');
}

}