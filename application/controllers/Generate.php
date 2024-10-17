<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Generate extends CI_Controller{

    public function __construct(){	
        parent::__construct();
            $this->load->library('form_validation');
            $this->load->library('pagination');
            $this->load->model('Pengaduan_model');
            $this->load->model('Login_model');
            $data['jumlah_pengaduan'] = $this->db->get_where('pengaduan', ['status_pengaduan' => 'menunggu'])->num_rows();
            
        }

    public function index(){
        $data['judul'] = "Generate Laporan";
        $data['bidang'] = $this->Pengaduan_model->getAllBidang();
		$data['kategori'] = ['Pertanyaan', 'Pengaduan', 'Aspirasi'];
		$data['status'] = ['invalid','menunggu','proses','lanjutan','selesai'];

        $this->load->view('templates/headeradmin', $data);
		$this->load->view('admin/cetaklaporan', $data);
		$this->load->view('templates/footer', $data);
    }

}