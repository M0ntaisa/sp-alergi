<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Gejala_model');
        $this->load->model('Alergi_model');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $gejala = $this->Gejala_model->getGejala();
        $alergi = $this->Alergi_model->getOnlyAlergi();
        
        $data = [
            'subtitle'  => "Dashboard",
            'gejala' => $gejala,
            'alergi' => $alergi,
            'isi'   =>  "admin/dashboard/list"
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

}

/* End of file Dashboard.php */
