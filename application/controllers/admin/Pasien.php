<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // proteksi halaman
        // $this->auth->cek_login();
        // load model
        $this->load->model('Pasien_model');
    }

    public function index()
    {

        $data = [
            'subtitle'  => "Data Pasien",
            'isi'   =>  "admin/pasien/list"
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}

/* End of file Pasien.php */
