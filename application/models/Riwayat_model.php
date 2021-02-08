<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_model extends CI_Model {

    public function getRiwayat()
    {
        $query = $this->db->query("SELECT
                tb_riwayat.id_riwayat,
                tb_riwayat.id_user,
                users.nama,
                tb_riwayat.tanggal_konsul
                FROM
                tb_riwayat
                INNER JOIN users ON tb_riwayat.id_user = users.id_user
        ");

        return $query->result_array();
    }

    public function getDetailRiwayat($id_riwayat)
    {
        $query = $this->db->query("SELECT 
                tb_riwayat.*,
                users.nama 
                FROM 
                tb_riwayat 
                INNER JOIN users ON tb_riwayat.id_user = users.id_user 
                WHERE id_riwayat = '$id_riwayat'
        ");

        return $query->result_array();
    }

    public function getGejalaTerpilih($kode_gejala)
    {
        $kode = str_replace(",", "','", $kode_gejala);

        $query = $this->db->query("SELECT 
                tb_gejala.kode_gejala,
                tb_gejala.nama_gejala
                FROM
                tb_gejala
                WHERE 
                tb_gejala.kode_gejala IN ('$kode')
        ");

        return $query->result_array();
    }

    public function getAlergiTerpilih($kode_alergi)
    {
        $kode = str_replace(",", "','", $kode_alergi);

        $query = $this->db->query("SELECT 
                tb_alergi.kode_alergi,
                tb_alergi.nama_alergi,
                tb_alergi.ket,
                tb_alergi.solusi
                FROM
                tb_alergi
                WHERE 
                tb_alergi.kode_alergi IN ('$kode')
        ");

        return $query->result_array();
    }

}

/* End of file Riwayat_model.php */
