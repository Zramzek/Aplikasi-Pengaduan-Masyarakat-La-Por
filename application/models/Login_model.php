<?php

class Login_model extends CI_model{

	function cek_loginAnggota($where){
		return $this->db->get_where('anggota', $where);
	}

	function cek_loginPetugas($where){
		return $this->db->get_where('petugas', $where);
	}

	function cekpetugas($nama_petugas){
		$query = $this->db->query('SELECT * FROM petugas WHERE nama_petugas = "$nama_petugas"');

		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}

	function ceklogin($nama_petugas, $password_petugas){
		$query = $this->db->query('SELECT * FROM petugas WHERE nama_petugas = "$nama_petugas" and password_petugas = "$password_petugas"');

		if($query->num_rows()==1){
			return $query->result();
		}else{
			return false;
		}
	}
	
}

?>