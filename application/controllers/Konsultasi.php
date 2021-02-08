<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // proteksi halaman
        // $this->auth->cek_login();

        // load model
        $this->load->model('Alergi_model');
        $this->load->model('Gejala_model');
        $this->load->model('Konsultasi_model');
    }

    public function index()
    {
        $this->session->unset_userdata('gagal');
        
        $gejala = $this->Gejala_model->getGejala();
        $alergi = $this->Alergi_model->getAlergi();

        $data = [
            'title' =>  "Konsultasi",
            'gejala'    =>  $gejala,
            'alergi'  =>  $alergi,
            'isi'   =>  "user/konsultasi"
        ];

        $this->load->view('layout/wrapper', $data, FALSE);
        

    }

    public function Proses()
    {
        // $gejala = $this->input->post('gejala[]');
        // var_dump($gejala);
        // echo count($gejala);

        if(isset($_POST['gejala'])){
            
            $this->Konsultasi_model->rank();
            // $data_ds = $this->Konsultasi_model->cloneProsesDs();
            $data_cf = $this->Konsultasi_model->cloneProsesCf();

            // $rank_nilai = max($data_ds['hasil']['nilai'], $data_cf['hasil']['nilai']);
            // $rank_alergi = $data_cf['hasil']['alergi_ds'];

            for ($i=0; $i < count($data_cf['hasilakhir_cf']); $i++) { 
                        
                $penyakit = $data_cf['hasilakhir_cf'][$i]['ph'];
                $nilai = $data_cf['hasilakhir_cf'][$i]['nilai'];
                
                $rank_penyakit[] = [
                
                    "penyakit" => $penyakit,
                    "nilai" => $nilai,
                    // 'user'  =>  $user,
                    "ket"  => $data_cf['hasilakhir_cf'][$i]['solusi']['ket'],
                    "solusi"  => $data_cf['hasilakhir_cf'][$i]['solusi']['solusi']
                ];
            }

            // echo "<pre>";
            // print_r($data_cf);
            // print_r($rank_penyakit);die;
            
            $data = [
                'title' =>  "Hasil Konsultasi",
                // 'data_ds' => $data_ds,
                'data_cf' => $data_cf,
                'rank_penyakit' => $rank_penyakit,
                // 'rank_nilai' => $rank_nilai,
                // 'rank_alergi' => $rank_alergi,
                'isi'   =>  "user/hasil_konsultasi"
            ];

            $this->load->view('layout/wrapper', $data, FALSE);

        } else {
            $this->session->set_flashdata('warning', 'Anda Belum Memilih Gejalah');
            redirect(base_url('konsultasi'), 'refresh');
        }
        
    }

    public function cetak()
    {
        $id_user = $_GET['id'];
        $data_konsult = $this->Konsultasi_model->getKonsulAkhirUser($id_user);
        $prob_al = implode(',',json_decode($data_konsult[0]['prob_alergi']));
        $kode_prob_al = str_replace(",", "','", $prob_al);
        $kode_gejala = str_replace(",", "','", $data_konsult[0]['kode_gejala']);
        $pilihanGejala = $this->Konsultasi_model->getNamaGejalaByKode($kode_gejala);
        $prob_al = $this->Konsultasi_model->getNamaAlergi($kode_prob_al);
        $rank_cf = $this->Konsultasi_model->getRankAlergi($data_konsult[0]['kode_alergi']);
        // echo "<pre>";
        // print_r($pilihanGejala);
        // print_r($prob_ds);
        // print_r($prob_al);
        // print_r($rank_ds);die;
        // print_r($rank_cf);
        // print_r($data_konsult);

        $data = [
            "title"             => "CETAK LAPORAN",
            "data_konsul"       => $data_konsult,
            "pilihan_gejala"    => $pilihanGejala,
            "prob_al"           => $prob_al,
            "rank_cf"           => $rank_cf
        ];

        $this->load->view('user/cetak_hasil/cetak', $data, FALSE);
        
    }

}

/* End of file Konsultasi.php */
