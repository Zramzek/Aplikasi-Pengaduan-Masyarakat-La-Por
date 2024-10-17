<?php

class Pengaduan_model extends CI_model{

	public function getAllPengaduan($limit, $start = null){

		$this->db->order_by('status_pengaduan', 'DESC');
		$query =  $this->db->get('pengaduan', $limit, $start);

		return $query->result_array();
	}

	public function getBidangPengaduan($limit, $start = null){

		$filter_bidang = $this->input->post('filter_bidang');
		$query =  $this->db->get_where('pengaduan', ['bidang' => $filter_bidang], $limit, $start);

		return $query->result_array();
	}
	
	public function getKategoriPengaduan($limit, $start = null){

		$filter_kategori = $this->input->post('filter_kategori');
		$query =  $this->db->get_where('pengaduan', ['kategori_pengaduan' => $filter_kategori], $limit, $start);

		return $query->result_array();
	}

	public function getStatusPengaduan($limit, $start = null){

		$filter_status = $this->input->post('filter_status');
		$query =  $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota'), 'status_pengaduan' => $filter_status], $limit, $start);

		return $query->result_array();
	}

	public function getBidangPengaduanUser($limit, $start = null){

		$filter_bidang = $this->input->post('filter_bidang');
		$query =  $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota') , 'bidang' => $filter_bidang], $limit, $start);

		return $query->result_array();
	}
	
	public function getKategoriPengaduanUser($limit, $start = null){

		$filter_kategori = $this->input->post('filter_kategori');
		$query =  $this->db->get_where('pengaduan', ['id_anggota' => $this->session->userdata('id_anggota'), 'kategori_pengaduan' => $filter_kategori], $limit, $start);

		return $query->result_array();
	}

	public function getStatusPengaduanUser($limit, $start = null){

		$filter_status = $this->input->post('filter_status');
		$query =  $this->db->get_where('pengaduan', ['status_pengaduan' => $filter_status], $limit, $start);

		return $query->result_array();
	}

	public function getAllBidang(){
		$query = $this->db->get('bidang');
		return $query->result_array();
	}

	public function getPengaduanById($id){
		return $this->db->get_where('pengaduan', ['id_pengaduan' => $id])->row_array();
	}
          
	public function getTanggapanById($id){
		return $this->db->get_where('tanggapan', ['id_pengaduan' => $id])->row_array();
	
	}

	public function getPelaksana($table, $tbljoin, $join){
		$this->db->join($tbljoin, $join);
		return $this->db->get($table);
	}

	public function caridataPengaduan(){
		$keyword = $this->input->post('keyword');
		$this->db->like('judul_pengaduan', $keyword);
		return $this->db->get('pengaduan')->result_array();
	}
}

?>