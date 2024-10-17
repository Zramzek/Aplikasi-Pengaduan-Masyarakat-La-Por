<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelaksana extends CI_Controller{

    public function __construct(){	
        parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->model('Pengaduan_model');
            $this->load->model('Login_model');
            
        }

    public function index(){
		$data['judul'] = "Halaman Utama";
		$data['pelaksana'] = $this->db->get_where('pelaksana', ['nama_pelaksana' => $this->session->userdata('nama_pelaksana')])->row_array();
		$data['nama_pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();
		$data['kategori_pengaduan'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status_pengaduan'] = ['proses','lanjutan'];
		$data['jumlah'] = [10, 25, 50];

        $config['base_url'] = 'http://localhost/altukk/pelaksana/index';
		$config['total_rows'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => 'proses'])->num_rows();
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
		
		$this->pagination->initialize($config);

		if ($this->input->post('filter_kategori')){
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'kategori_pengaduan' => $this->input->post('filter_kategori')])->result_array();
		}elseif ($this->input->post('filter_status')){
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => $this->input->post('filter_status')])->result_array();
		}elseif ($this->input->post('filter_urut')){
			$this->db->order_by('tgl_pengaduan', $this->input->post('filter_urut'));
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => 'proses'])->result_array();
		}else{
			$this->db->order_by('status_pengaduan', 'DESC');
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => 'proses'])->result_array();
		}

		$data['jumlah_pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => 'proses'])->num_rows();
		
		$this->load->view('templates/headerpelaksana', $data);
		$this->load->view('pelaksana/index', $data);
		$this->load->view('templates/footer', $data);
	}

    public function detailpengaduan($id){
		$data['judul'] = "Detail Pengaduan";
		$data['pelaksana'] = $this->db->get_where('pelaksana', ['nama_pelaksana' => $this->session->userdata('nama_pelaksana')])->row_array();
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['nama_pelaksana'] = $this->Pengaduan_model->getPelaksana('tanggapan', 'pelaksana', 'tanggapan.id_pelaksana = pelaksana.id_pelaksana')->row();
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
        
		$this->form_validation->set_rules('isi_tanggapan', 'Isi Tanggapan', 'required');
        $this->form_validation->set_rules('foto_tanggapan', 'Bukti');
		
		$this->load->view('templates/headerpelaksana', $data);
		$this->load->view('pelaksana/detailpengaduan', $data);
		$this->load->view('templates/footer', $data);
        
	}		
		
		public function inputtanggapan(){

			$id = $this->input->post('id_pengaduan');

			$config['upload_path'] = './gambar/';
			$config['allowed_types'] = 'jpeg|jpg|png|gif';
			$config['max_size']  = '2048';
			$config['overwrite'] = FALSE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto_tanggapan')){

			}else {

				$foto_tanggapan = $this->upload->data();
				$foto_tanggapan = $foto_tanggapan['file_name'];

				$data = [
					'id_pengaduan' => $id,
					'id_pelaksana' => $this->input->post('id_pelaksana', true),
					'isi_tanggapan' => $this->input->post('isi_tanggapan', true),
					'foto_tanggapan' => $foto_tanggapan,
					'tgl_tanggapan' => date('y-m-d'),
					'lanjutan_tanggapan' => ''
				];
			}
            $this->db->where('id_pengaduan', $id);
            $this->db->insert('tanggapan', $data);

            $data = [
                'status_pengaduan' => 'ditanggapi'
            ];
    
            $this->db->where('id_pengaduan', $id);
            $this->db->update('pengaduan', $data);

            $this->session->set_flashdata('message', 'Merespon');
            redirect('pelaksana');
    	}


		public function inputlanjutantanggapan(){

			$id = $this->input->post('id_pengaduan');

			$config['upload_path'] = './gambar/';
			$config['allowed_types'] = 'jpeg|jpg|png|gif';
			$config['max_size']  = '2048';
			$config['overwrite'] = FALSE;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto_lanjutan_tanggapan')){

			}else {

				$foto_lanjutan_tanggapan = $this->upload->data();
				$foto_lanjutan_tanggapan = $foto_lanjutan_tanggapan['file_name'];

				$data = [
					'lanjutan_tanggapan' => $this->input->post('lanjutan_tanggapan'),
					'foto_lanjutan_tanggapan' => $foto_lanjutan_tanggapan,
				];
			}
            $this->db->where('id_pengaduan', $id);
            $this->db->update('tanggapan', $data);

            $data = [
                'status_pengaduan' => 'selesai'
            ];
    
            $this->db->where('id_pengaduan', $id);
            $this->db->update('pengaduan', $data);

            $this->session->set_flashdata('message', 'Merespon');
            redirect('pelaksana');
		}
        

    public function historipengaduan(){
        $data['judul'] = "Halaman Utama";
		$data['pelaksana'] = $this->db->get_where('pelaksana', ['nama_pelaksana' => $this->session->userdata('nama_pelaksana')])->row_array();
		$data['kategori_pengaduan'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status_pengaduan'] = ['invalid','menunggu','proses','ditanggapi','lanjutan','selesai'];
		$data['jumlah'] = [10, 25, 50];

        $config['base_url'] = 'http://localhost/altukk/pelaksana/historipengaduan';
		$config['total_rows'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang')])->num_rows();
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
		
		$this->pagination->initialize($config);

		if ($this->input->post('filter_kategori')){
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'kategori_pengaduan' => $this->input->post('filter_kategori')], $config['per_page'], $data['start'])->result_array();
		}elseif ($this->input->post('filter_status')){
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => $this->input->post('filter_status')], $config['per_page'], $data['start'])->result_array();
		}elseif ($this->input->post('filter_urut')){
			$this->db->order_by('tgl_pengaduan', $this->input->post('filter_urut'));
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang'), 'status_pengaduan' => 'proses'])->result_array();
		}else{
			$this->db->order_by('status_pengaduan', 'DESC');
			$data['pengaduan'] = $this->db->get_where('pengaduan', ['bidang' => $this->session->userdata('bidang')], $config['per_page'], $data['start'])->result_array();
		}
		
		$this->load->view('templates/headerpelaksana', $data);
		$this->load->view('pelaksana/historipengaduan', $data);
		$this->load->view('templates/footer', $data);
    }

    public function detailhistori($id){
        $data['judul'] = "Detail Pengaduan";
		$data['pelaksana'] = $this->db->get_where('pelaksana', ['nama_pelaksana' => $this->session->userdata('nama_pelaksana')])->row_array();
		$data['pengaduan'] = $this->Pengaduan_model->getPengaduanById($id);
		$data['tanggapan'] = $this->Pengaduan_model->getTanggapanById($id);
		$data['nama_pelaksana'] = $this->Pengaduan_model->getPelaksana('pelaksana', 'tanggapan', 'pelaksana.id_pelaksana=tanggapan.id_pelaksana')->row();

        $this->load->view('templates/headerpelaksana', $data);
        $this->load->view('pelaksana/detailhistori', $data);
        $this->load->view('templates/footer', $data);
    }

    public function logout(){
        $this->session->unset_userdata('nama_pelaksana', 'bidang');
    
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              Berhasil Logout</div>');
                redirect('auth/loginpelaksana');
    }
}