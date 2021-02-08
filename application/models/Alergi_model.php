<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alergi_model extends CI_Model {

    //Fungsi Lihat Data Alergi 
    public function getAlergi() {
        return $this->db->get('tb_alergi')->result_array();
    }

    // fungsi mengambil data hanya alergi
    public function getOnlyAlergi()
    {
        // $query = $this->db->query("SELECT * FROM tb_alergi WHERE id_jenis = 2");

        $results = array();
        $this->db->select('*');
        $this->db->from('tb_alergi');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            $results = $query->result_array();
        }
        return $results;
    }

    // fungsi mengambil data hanya hama
    public function getOnlyHama()
    {
        // $query = $this->db->query("SELECT * FROM tb_alergi WHERE id_jenis = 1");

        
        $results = array();
        $this->db->select('*');
        $this->db->from('tb_alergi');

        $query = $this->db->get();

        if($query->num_rows() > 0) {
            $results = $query->result_array();
        }
        return $results;
    }

    // fungsi mengambil nama alergi dengan kode alergi
    public function getNamaAlergi($kode_alergi)
    {
        $query = $this->db->query("SELECT nama_alergi FROM tb_alergi WHERE kode_alergi IN('$kode_alergi')");

        $nm_alergi = array();
        foreach ($query->result() as $row)
        {
            $nm_alergi[] = $row->nama_alergi;
        }
        return $nm_alergi;
    }

    // fungsi tambah Alergi 
    public function tambahAlergi($data)
    {
        //Cek apakah ada Alergi  dengan Kode sama
        $filter = $this->db->select('*')->from('tb_alergi')->where('kode_alergi', $data['kode_alergi'])->get()->num_rows();
        if ($filter < 1) {
            $insert = $this->db->insert('tb_alergi', $data);
        } else {
            // set flashdata
            $this->session->set_flashdata('gagal', 'Data Alergi gagal ditambahkan.');
            redirect(base_url('admin/alergi'), 'refresh');
        }
    }

    // fungsi edit Alergi 
    public function editAlergi($data)
    {
        $this->db->where('kode_alergi', $data['kode_alergi']);
        $update = $this->db->update('tb_alergi', $data);
    }

    // fungsi hapus Alergi 
    public function hapusAlergi($kode_alergi)
    {
        $this->db->delete('tb_alergi', ['kode_alergi' => $kode_alergi]);
    }

}

/* End of file Alergi_model.php */
