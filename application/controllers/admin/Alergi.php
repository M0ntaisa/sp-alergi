<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alergi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        // $this->auth->cek_login();
        // load model
        $this->load->model('Alergi_model');
    }

    public function index()
    {
        $data_hp = $this->Alergi_model->getAlergi();

        // echo "<pre>";
        // print_r($alergi);
        // print_r($hama);die;

        $data = [
            'subtitle'  => "Data Alergi",
            'data_hp' => $data_hp,
            'isi'   =>  "admin/alergi/list"
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    public function tambah_alergi()
    {
        if ($this->input->post('nama_alergi') == null) {
            $this->session->set_flashdata('gagal', 'Nama alergi tidak boleh kosong.');
            redirect(base_url('admin/alergi'), 'refresh');
        } else {
            $data = [
                'kode_alergi' => $this->input->post('kode_alergi'),
                'nama_alergi' => $this->input->post('nama_alergi'),
                'ket' => $this->input->post('ket'),
                'solusi' => $this->input->post('solusi')
            ];

            $this->Alergi_model->tambahAlergi($data);

            // set flashdata
            $this->session->set_flashdata('sukses', 'Data Alergi telah ditambahkan.');
            redirect(base_url('admin/alergi'), 'refresh');
        }
    }

    public function edit_alergi()
    {
        if ($this->input->post('nama_alergi') == null) {
            $this->session->set_flashdata('gagal', 'Nama alergi tidak boleh kosong.');
            redirect(base_url('admin/alergi'), 'refresh');
        } else {
            $data = [
                'kode_alergi' => $this->input->post('kode_alergi'),
                'nama_alergi' => $this->input->post('nama_alergi'),
                'ket' => $this->input->post('ket'),
                'solusi' => $this->input->post('solusi')
            ];

            $this->Alergi_model->editAlergi($data);

            // set flashdata
            $this->session->set_flashdata('sukses', 'Data Alergi telah diedit.');
            redirect(base_url('admin/alergi'), 'refresh');
        }
    }

    public function hapus_alergi($kode_alergi)
    {
        // proses hapus Alergi 
        $this->Alergi_model->hapusAlergi($kode_alergi);
        $this->session->set_flashdata('sukses', 'Data Alergi  Telah Dihapus');
        redirect(base_url('admin/alergi'), 'refresh');
    }

}

/* End of file Alergi.php */
