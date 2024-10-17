<?php

class Anggota extends CI_Controller{

	public function __construct(){	
	parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('Pengaduan_model'));
		$this->load->model('Login_model');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
		/*if (!$this->session->userdata('email_anggota')) {
			redirect('auth');
		}*/
	}

	public function index(){
		$data['judul'] = "Halaman Utama";
		$data['anggota'] = $this->db->get_where('anggota', ['email_anggota' => $this->session->userdata('email_anggota')])->row_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori_pengaduan'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status_pengaduan'] = ['invalid','menunggu','proses','ditanggapi','lanjutan','selesai'];
		$data['jumlah'] = [10, 25, 50];

		$config['base_url'] = 'http://localhost/altukk/anggota/index';
		if ($this->input->post('filter_bidang')) {
			$config['total_rows'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], ['bidang' => $this->input->post('filter_bidang')])->num_rows();
		}elseif ($this->input->post('filter_kategori')){
			$config['total_rows'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], ['kategori_pengaduan' => $this->input->post('filter_kategori')])->num_rows();
		}elseif ($this->input->post('filter_status')){
			$config['total_rows'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], ['status_pengaduan' => $this->input->post('filter_status')])->num_rows();
		}else{
			$config['total_rows'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')])->num_rows();
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
		
		$data['start'] = $this->uri->segment(3);
		
		$this->pagination->initialize($config);

		if ($this->input->post('filter_bidang')) {
			$data['pengaduan'] = $this->Pengaduan_model->getBidangPengaduanUser($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_kategori')){
			$data['pengaduan'] = $this->Pengaduan_model->getKategoriPengaduanUser($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_status')){
			$data['pengaduan'] = $this->Pengaduan_model->getStatusPengaduanUser($config['per_page'], $data['start']);
		}elseif ($this->input->post('filter_urut')){
			$this->db->order_by('id_pengaduan', $this->input->post('filter_urut'));
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], $config['per_page'], $data['start'])->result_array();
		}else{
			$this->db->order_by('status_pengaduan', 'DESC');
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')], $config['per_page'], $data['start'])->result_array();
		}
		
		$data['jumlah_data'] = $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota')])->num_rows();
		
		$this->load->view('templates/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function tambahdataPengaduan(){
		$data['judul'] = "Buat Pengaduan";
		$data['anggota'] = $this->db->get_where('anggota', ['email_anggota' => $this->session->userdata('email_anggota')])->row_array();
		$data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori'] = ['Pertanyaan', 'Aspirasi', 'Pengaduan'];
		
		$this->form_validation->set_rules('judul_pengaduan', 'Judul', 'required');
		$this->form_validation->set_rules('isi_pengaduan', 'Isi Pengaduan', 'required');
		$this->form_validation->set_rules('kategori_pengaduan', 'Kategori', 'required');
		$this->form_validation->set_rules('bidang', 'Bidang', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('form/form_pengaduan', $data);
		$this->load->view('templates/footer');

		$config['upload_path'] = './gambar/';
        $config['allowed_types'] = 'jpeg|jpg|png|gif';
        $config['max_size']  = '2048';
		$config['overwrite'] = FALSE;

		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('foto_pengaduan'))
			{

			}
			else
			{
				$foto_pengaduan = $this->upload->data();
				$foto_pengaduan = $foto_pengaduan['file_name'];

				$data = [
					'id_anggota' => $this->input->post('id_anggota', true),
					'tgl_pengaduan' => date('y-m-d'),
					'judul_pengaduan' => $this->input->post('judul_pengaduan', true),
					'isi_pengaduan' => $this->input->post('isi_pengaduan', true),
					'bidang' => $this->input->post('bidang', true),
					'kategori_pengaduan' => $this->input->post('kategori_pengaduan', true),
					'foto_pengaduan' => $foto_pengaduan,
					'status_pengaduan' => 'menunggu',
					'lanjutan_pengaduan' => ''
				];
				$this->db->insert('pengaduan', $data);
				$this->session->set_flashdata('message', 'Menambah');
				redirect('anggota');
			}
		}
	
	public function detailpengaduan($id){
		$data['judul'] = "Detail Pengaduan";
		$data['anggota'] = $this->db->get_where('anggota', ['email_anggota' => $this->session->userdata('email_anggota')])->row_array();
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
		$data['pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();

		$this->load->view('templates/header', $data);
		$this->load->view('user/detail', $data);
		$this->load->view('templates/footer', $data);

		if ($this->input->post('lanjutan_pengaduan')) {
			$data = [
				'lanjutan_pengaduan' => $this->input->post('lanjutan_pengaduan'),
				'status_pengaduan' => 'proses'
			];
		
			$this->db->where('id_pengaduan', $id);
			$this->db->update('pengaduan', $data);
			$this->session->set_flashdata('message', 'Meneruskan');
			redirect('anggota');
		}			
	}
	
	public function lanjutkanpengaduan($id){

			$data = [
                'status_pengaduan' => 'lanjutan'
            ];
    
            $this->db->where('id_pengaduan', $id);
            $this->db->update('pengaduan', $data);

            $this->session->set_flashdata('message', 'Menyelesaikan');
            redirect('anggota');
	}

	public function selesaikanpengaduan($id){
			
			$data = [
                'status_pengaduan' => 'selesai'
            ];
    
            $this->db->where('id_pengaduan', $id);
            $this->db->update('pengaduan', $data);

            $this->session->set_flashdata('message', 'Melanjutkan');
            redirect('anggota');
		}

	public function logout(){
		$this->session->unset_userdata('email_anggota');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							  Berhasil Logout</div>');
				redirect('auth');
	}
}


?>