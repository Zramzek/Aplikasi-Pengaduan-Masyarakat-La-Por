<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin extends CI_Controller{

	public function __construct(){	
	parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('dompdf_gen');
		$this->load->model('Pengaduan_model');
		$this->load->model('Login_model');
		$data['jumlah_pengaduan'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'])->num_rows();
		
	}

	public function index(){
		$data['judul'] = "Halaman Utama";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();

		$config['total_rows'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'])->num_rows();
		$config['per_page'] = 2;
	
		$config['base_url'] = 'http://localhost/altukk/admin/index';
		
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

		$this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function historipengaduan(){
		$data['judul'] = "Histori Pengaduan";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori_pengaduan'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status_pengaduan'] = ['invalid','menunggu','proses','ditanggapi','lanjutan','selesai'];
		$data['jumlah'] = [10, 25, 50];

		$config['base_url'] = 'http://localhost/altukk/admin/historipengaduan';
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
			$this->db->order_by('tgl_pengaduan', $this->input->post('filter_urut'));
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], $config['per_page'], $data['start'])->result_array();
		}else{
			$this->db->order_by('status_pengaduan', 'DESC');
			$data['pengaduan'] = $this->db->get('pengaduan', $config['per_page'], $data['start'])->result_array();
		}
		
		$this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/historipengaduan', $data, FALSE);
		$this->load->view('templates/footer');
	}

	public function terimapengaduan($id){

		$data = [
			'status_pengaduan' => 2
		];

		$this->db->where('id_pengaduan', $id);
		$this->db->update('pengaduan', $data);
		$this->session->set_flashdata('message', 'Menerima');
		redirect('admin');
	}

	public function tolakpengaduan($id){

		$data = [
			'status_pengaduan' => 0
		];

		$this->db->where('id_pengaduan', $id);
		$this->db->update('pengaduan', $data);
		$this->session->set_flashdata('message', 'Menolak');
		redirect('admin');
	}

	public function detailpengaduan($id){
		$data['judul'] = "Detail Pengaduan";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
		$data['pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();

		$this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/detailpengaduan', $data);
		$this->load->view('templates/footer', $data);
	}

	public function generatelaporan($id){
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
		$data['pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();

		$this->load->view('generate/laporan.php', $data);
		
		$paper_size = 'A4';
		$orientation = 'potrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);
		
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan.pdf", array('Attachment' => 0));
		
	}
	
	public function daftaranggota(){
		$data['judul'] = "Daftar Anggota";
		$data['anggota'] = $this->db->get('anggota')->result_array();
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		
		$config['base_url'] = 'http://localhost/altukk/admin/daftaranggota';
		$config['total_rows'] = $this->db->get_where('anggota')->num_rows();
		$config['per_page'] = 5;
		
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
		
		$this->pagination->initialize($config);

		$data['pengaduan'] = $this->db->get_where('pengaduan', ['status_pengaduan' => '1'], $config['per_page'], $data['start'])->result_array();

		$this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/daftaranggota', $data);
		$this->load->view('templates/footer', $data);
	}

	public function nonaktifanggota($id){

		$data = [
			'aktif' => '0'
		];

		$this->db->where('id_anggota', $id);
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', 'Menonaktifkan');
		redirect('admin/daftaranggota');
	}

	public function aktifanggota($id){

		$data = [
			'aktif' => '1'
		];

		$this->db->where('id_anggota', $id);
		$this->db->update('anggota', $data);
		$this->session->set_flashdata('message', 'Mengaktifkan');
		redirect('admin/daftaranggota');
	}

	public function daftarpetugas(){
		$data['judul'] = "Daftar Petugas";
		$data['petugas'] = $this->db->get('petugas')->result_array();
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['start'] = $this->uri->segment(3);

		$this->form_validation->set_rules('nama_petugas', 'Nama', 'required|trim|is_unique[petugas.nama_petugas]');
		$this->form_validation->set_rules('password_petugas', 'Password', 'required|trim');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/headeradmin', $data);
			$this->load->view('admin/daftarpetugas', $data);
			$this->load->view('templates/footer');
		}else{
			$data = [
				'nama_petugas' => $this->input->post('nama_petugas', true),
				'password_petugas' => $this->input->post('password_petugas', true),
				'level' => $this->input->post('level', true),
				'aktif' => '1'
			];
	
			$this->db->insert('petugas', $data);
			$this->session->set_flashdata('message', 'Menambah');
			redirect('admin/daftarpetugas');
		}
	}

	public function hapuspetugas($id){
		$this->db->where('id_petugas', $id);
		$this->db->delete('petugas');

		$this->session->set_flashdata('message', 'Menghapus');
		redirect('admin/daftarpetugas');
	}

	public function nonaktifpetugas($id){

		$data = [
			'aktif' => '0'
		];

		$this->db->where('id_petugas', $id);
		$this->db->update('petugas', $data);
		$this->session->set_flashdata('message', 'Menonaktifkan');
		redirect('admin/daftarpetugas');
	}

	public function aktifpetugas($id){

		$data = [
			'aktif' => '1'
		];

		$this->db->where('id_petugas', $id);
		$this->db->update('petugas', $data);
		$this->session->set_flashdata('message', 'Mengaktifkan');
		redirect('admin/daftarpetugas');
	}
	
	public function daftarpelaksana(){
		$data['judul'] = "Daftar Pelaksana";
		$data['pelaksana'] = $this->db->get('pelaksana')->result_array();
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['start'] = $this->uri->segment(3);

		$this->form_validation->set_rules('nama_pelaksana', 'Nama', 'required|trim|is_unique[pelaksana.nama_pelaksana]');
		$this->form_validation->set_rules('password_pelaksana', 'Password', 'required|trim');
		$this->form_validation->set_rules('bidang', 'Bidang', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/headeradmin', $data);
			$this->load->view('admin/daftarpelaksana', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data = [
				'nama_pelaksana' => $this->input->post('nama_pelaksana', true),
				'password_pelaksana' => $this->input->post('password_pelaksana', true),
				'bidang' => $this->input->post('bidang', true)
			];
	
			$this->db->insert('pelaksana', $data);
			$this->session->set_flashdata('message', 'Menambah');
			redirect('admin/daftarpelaksana');
	}
}

	public function hapuspelaksana($id){
		$this->db->where('id_pelaksana', $id);
		$this->db->delete('pelaksana');

		$this->session->set_flashdata('message', 'Menghapus');
		redirect('admin/daftarpelaksana');
	}
	
	public function cetaklaporan(){
		$data['judul'] = "Generate Laporan";
		$data['username'] = $this->db->get_where('petugas', ['nama_petugas' => $this->session->userdata('nama_petugas')])->row_array();
		$data['pengaduan'] = $this->db->get('pengaduan');
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status'] = ['invalid','menunggu','proses','lanjutan','selesai'];
		
		$this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/cetaklaporan', $data);
		$this->load->view('templates/footer', $data);
	}

	public function filterlaporan($bidang){
		$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $bidang])->result_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status'] = ['invalid','menunggu','proses','lanjutan','selesai'];
		$data['start'] = $this->uri->segment(3);

		$this->load->view('generate/filterlaporan', $data, FALSE);
	}

	public function logout(){
		$this->session->unset_userdata('nama_petugas');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							  Berhasil Logout</div>');
				redirect('auth/loginpetugas');
	}

}