<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Konsultasi_model extends CI_Model {

    public function proses()
    {
        $gejala=array();
                $query = $this->db->query("SELECT GROUP_CONCAT(b.kode_alergi), a.cf
                FROM tb_aturan a
                JOIN tb_alergi b ON a.id_alergi=b.id_alergi
                WHERE a.id_gejala IN(".implode(',',$_POST['gejala']).") 
                GROUP BY a.id_gejala");
                foreach ($query->result_array() as $row)
                {
                    $gejala[]=$row;
                }
                $jumlah_g = count($gejala);
                for ($i=0; $i < $jumlah_g ; $i++) { 
                    $gejala[$i] = array_values($gejala[$i]);
                }

                $query = $this->db->query("SELECT nama_gejala FROM tb_gejala WHERE id_gejala IN (".implode(',',$_POST['gejala']).") 
                GROUP BY id_gejala");
                // echo "<br>";
                // echo "<h4>Gejala yang dipilih :</h4><br>";
                // $no = 1;
                // foreach ($query->result_array() as $row)
                // {
                //     echo $no++.". ".$row['nama_gejala']."<br>";
                // }
                
                // echo "<pre>";
                // print_r($gejala);
                //-- masukkan kode perhitungannya di sini

                //--- menentukan environement
                $query = $this->db->query("SELECT GROUP_CONCAT(kode_alergi) FROM tb_alergi");
                $row = $query->result_array();
                $fod = array_values($row[0]);
                // echo "<pre>";
                // print_r($fod);exit;

                //--- menentukan nilai densitas
                $densitas_baru=array();
                $riwayat = array();
                $riwayat_x = array();
                $r = 0;
                $densi = 3;
                // echo "<hr>";
                while(!empty($gejala)){
                    $densitas1[0]=array_shift($gejala);
                    // print_r($densitas1);
                    $densitas1[1]=array($fod[0],1-$densitas1[0][1]);
                    // print_r($densitas1);exit;
                    $densitas2=array();
                    if(empty($densitas_baru)){
                        $densitas2[0]=array_shift($gejala);
                    }else{
                        foreach($densitas_baru as $k=>$r){
                            if($k!="&theta;"){
                                $densitas2[]=array($k,$r);
                            }
                        }
                    }
                    // print_r($densitas2);exit;
                    $theta=1;
                    foreach($densitas2 as $d) $theta-=$d[1];
                    $densitas2[]=array($fod[0],$theta);
                    // print_r($densitas2);exit;
                    $m=count($densitas2);
                    $densitas_baru=array();
                    $densi_x = $densi-2;
                    $densi_y = $densi-1;
                    // echo "Menentukan Nilai Densitas (m$densi) dari Densitas (m$densi_x) dan Densitas (m$densi_y)!"."<br>";
                    // echo "Menentukan Nilai Densitas (m) baru!"."<br>";
                    
                    for($y=0;$y<$m;$y++){
                        for($x=0;$x<2;$x++){
                          // echo "<hr>";
                            if(!($y==$m-1 && $x==1)){
                                // print_r($densitas1);exit;
                                $v=explode(',',$densitas1[$x][0]);
                                $w=explode(',',$densitas2[$y][0]);
                                sort($v);
                                sort($w);
                                $vw=array_intersect($v,$w);
                                
                                if(empty($vw)){
                                    $k="&theta;";
                                }else{
                                    $k=implode(',',$vw);
                                }
                                // print_r($densitas1);
                                // print_r($densitas2);
                                
                                if(!isset($densitas_baru[$k])){
                                    $densitas_baru[$k]=$densitas1[$x][1]*$densitas2[$y][1];
                                    // echo $densitas2[$y][0]."<br>";
                                    // echo $densitas1[$x][0]." x ".$densitas2[$y][0]." = ".$densitas1[$x][0].",".$densitas2[$y][0]."<br>";
                                    // echo $densitas1[$x][1]." x ".$densitas2[$y][1]." = ".$densitas_baru[$k]."<br>";
                                  }else{
                                    $densitas_baru[$k]+=$densitas1[$x][1]*$densitas2[$y][1];
                                    // echo $densitas1[$x][1]." x ".$densitas2[$y][1]." = ".$densitas_baru[$k]."<br>";
                                  }
                                  
                            }
                        } 
                    } 
                    
                    // echo "<br>-----------------------------<br>";
                    // echo "Proses densitas baru (m)"."<br>";
                    $densi = $densi + 2;
                    foreach($densitas_baru as $k=>$d){
                      
                        if($k!="&theta;"){
                            $densitas_baru[$k]=$d/(1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0));
                            
                            $k." = ".round($d,2)." / ".round((1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0)),2)." = ".round($densitas_baru[$k],2)."<br>";
                        }
                        
                        // print_r($densitas_baru);
                        $riwayat = $densitas_baru;
                        $r++;
                    }
                    
                    $riwayat_x[] = $riwayat;
                    // echo "<hr><br>";
                }
                
                // echo "<pre>";
                // print_r($riwayat_x);
                // echo "<hr><br>";
                //--- perangkingan
                unset($densitas_baru["&theta;"]);
                arsort($densitas_baru);
                // echo "<pre>";
                // print_r($densitas_baru);die;
                // echo "<br>=============================================================<br>";
                $kd_alergi = array();
                foreach ($densitas_baru as $key => $value) {
                  $kd_alergi[] = $key;
                }
                
                $kds_alergi = implode(',',$kd_alergi);
                $kds = str_replace(",", "','", $kds_alergi);

                // $query = $this->db->query("SELECT nama_alergi FROM tb_alergi WHERE kode_alergi IN ('$kds')");
                // echo "<br>";
                // echo "<h4>Kemungkinan Alergi  :</h4><br>";
                // $no = 1;
                // foreach ($query->result_array() as $row)
                // {
                //     echo $no++.". ".$row['nama_alergi']."<br>";
                // }
                

                $kode_alergi = array_keys($densitas_baru)[0];
                $kode = str_replace(",", "','", $kode_alergi);
                // echo $kode;die;
                $rank = $this->Alergi_model->getNamaAlergi($kode);
                // $kode = explode(' , ', $kode_alergi);
                // print_r($densitas_baru);die;
                // print_r($rank);
                // echo "<hr>";
                if (count($rank) > 1) {
                  // $hasil_bagi = array_values($densitas_baru)[0]/count($rank);
                  for ($i=0; $i < count($rank); $i++) { 
                    echo "<b>Nilai tertinggi dari perhitungan metode Dempster Shafer adalah <strong>".$rank[$i]."</strong>, dengan nilai = <strong>".round(array_values($densitas_baru)[0],2)."</strong></b><br>";
                  }
                } else {
                    echo "<b>Nilai tertinggi dari perhitungan metode Dempster Shafer adalah <strong>".$rank[0]."</strong>, dengan nilai = <strong>".round(array_values($densitas_baru)[0],2)."</strong></b>";
                }
                // echo "<hr>";
                // $query = $this->db->query("SELECT ket, solusi FROM tb_alergi WHERE kode_alergi = '$kode_alergi'");
                // echo "<br>";
                // foreach ($query->result_array() as $row)
                // {
                //     echo "<h4>Keterangan :</h4><br>";
                //     echo $row['ket']."<br>";
                    
                //     echo "<br><h4>Solusi :</h4><br>";
                //     echo $row['solusi']."<br>";
                // }
                
                return $codes = $kode_alergi;
                // $data = [
                //     'title' =>  "Hasil Konsultasi",
                //     'riwayat'    =>  $riwayat_x,
                //     'h_akhir'  =>  $densitas_baru,
                //     'isi'   =>  "user/hasil_konsultasi"
                // ];
    
                // $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function prosesCF()
    {
        // group kemungkinan terdapat alergi
        $groupKemungkinanAlergi = $this->Konsultasi_model->getGroupAturan(implode(",", $_POST['gejala']));
        // $gejalaYangDipilih = array();
        $kds_gejala = implode(",", $_POST['gejala']);
        $kds = str_replace(",", "','", $kds_gejala);
        $gejalaYangDipilih = $this->Konsultasi_model->getNamaGejala($kds);

        // for ($i=0; $i < count($_POST['gejala']); $i++) { 
        //   $gejalaYangDipilih[] = $this->Konsultasi_model->getNamaGejala($_POST['gejala'][$i]);
        // }
        // echo "<pre>";
        // print_r($gejalaYangDipilih);die;

        echo "<br>";
        echo "<h4>Gejala yang dipilih :</h4><br>";
        $no = 1;
        foreach ($gejalaYangDipilih as $row)
        {
            echo $no++.". ".$row['nama_gejala']."<br>";
        }

        // menampilkan kode gejala yang di pilih
        $sql = $_POST['gejala'];

        if (isset($sql)) {
          // mencari data alergi kemungkinan dari gejala
          for ($h=0; $h < count($sql); $h++) {
            $kemungkinanAlergi[] = $this->Konsultasi_model->getKemungkinanAlergi($sql[$h]);
            for ($x=0; $x < count($kemungkinanAlergi[$h]); $x++) {
              for ($i=0; $i < count($groupKemungkinanAlergi); $i++) {
                $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
                if ($kemungkinanAlergi[$h][$x]['nama_alergi'] == $namaAlergi) {
                  // list di kemungkinan dari gejala
                  $listIdKemungkinan[$namaAlergi][] = $kemungkinanAlergi[$h][$x]['id_aturan'];
                }
              }
            }
          }

          echo "<br>";
          echo "<h4>Kemungkinan Alergi  :</h4><br>";
          $no = 1;
          foreach ($groupKemungkinanAlergi as $row)
          {
              echo $no++.". ".$row['nama_alergi']."<br>";
          }

          $id_alergi_terbesar = '';
          $nama_alergi_terbesar = '';
          // list alergi kemungkinan
          for ($h=0; $h < count($groupKemungkinanAlergi); $h++) { 
            $namaAlergi = $groupKemungkinanAlergi[$h]['nama_alergi'];
            echo "<hr><br/><h4>Proses Alergi ".$namaAlergi."</h4>";
            echo "Jumlah Gejala = ".
                      count($listIdKemungkinan[$namaAlergi])."<br/>";
            // list alergi kemungkinan dari gejala
            for ($x=0; $x < count($listIdKemungkinan[$namaAlergi]); $x++) { 
              $daftarKemungkinanAlergi = $this->Konsultasi_model->getListAlergi($listIdKemungkinan[$namaAlergi][$x]);
              $proc = $x+1;
              
              echo "<br/>proses ".$proc."<br/>------------------------------------<br/>";
                      
              for ($i=0; $i < count($daftarKemungkinanAlergi); $i++) {
                  
                  if (count($listIdKemungkinan[$namaAlergi]) == 1) {
                    // echo "Jumlah Gejala = ".
                    //   count($listIdKemungkinan[$namaAlergi])."<br/>";
                        
                    // bila list kemungkinan terdapat 1
                    $mb = $daftarKemungkinanAlergi[$i]['mb'];
                    $md = $daftarKemungkinanAlergi[$i]['md'];
                    $cf = $mb - $md;
                    $daftar_cf[$namaAlergi][] = $cf;

                    echo "<br/>proses ".$proc."<br/>------------------------<br/>";
                    echo "mb = ".$mb."<br/>";
                    echo "md = ".$md."<br/>";
                    echo "cf = mb - md = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";
                    // end bila list kemungkinan terdapat 1
                  } else {
                    // list kemungkinanan lebih dari satu
                    if ($x == 0)
                    {
                      // echo "Jumlah Gejala = ".
                      // count($listIdKemungkinan[$namaAlergi])."<br/>";
                      // record md dan mb sebelumnya
                      $mblama = $daftarKemungkinanAlergi[$i]['mb'];
                      $mdlama = $daftarKemungkinanAlergi[$i]['md'];
                      // md yang di esekusi
                      $mb = $daftarKemungkinanAlergi[$i]['mb'];
                      $md = $daftarKemungkinanAlergi[$i]['md'];
                      echo "<br/>";
                      echo "mb baru = ".$mb."<br/>";
                      echo "md baru = ".$md."<br/>";
                      $cf = $mb - $md;
                      echo "cf = mb - md = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";

                      $daftar_cf[$namaAlergi][] = $cf;
                    } 
                    else
                    {
                      $mbbaru = $daftarKemungkinanAlergi[$i]['mb'];
                      $mdbaru = $daftarKemungkinanAlergi[$i]['md'];
                      echo "mb baru = ".$mbbaru."<br/>";
                      echo "md baru = ".$mdbaru."<br/>";
                      $mbsementara = $mblama + ($mbbaru * (1 - $mblama));
                      $mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));
                      echo "mb sementara = mb lama + (mb baru x (1 - mb lama)) = $mblama + ($mbbaru x (1 - $mblama)) = ".$mbsementara."<br/>";
                      echo "md sementara = md lama + (md baru x (1 - md lama)) = $mdlama + ($mdbaru x (1 - $mdlama)) = ".$mdsementara."<br/>";

                      $mb = $mbsementara;
                      $md = $mdsementara;
                      $cf = $mb - $md;
                      echo "cf = mb sementara - md sementara = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";
                      $daftar_cf[$namaAlergi][] = $cf;;
                    }
                    // end list kemungkinanan lebih dari satu
                  }
                }
              }  
            }
          }
          // echo "<br/>===================================================================<br/>";
        // echo "<hr>";
        // $this->Konsultasi_model->hasilCFTertinggi($daftar_cf,$groupKemungkinanAlergi);
        $this->Konsultasi_model->hasilAkhir($daftar_cf,$groupKemungkinanAlergi);
        

    }

    public function cloneProsesCf()
    {
      // group kemungkinan terdapat penyakit
      $groupKemungkinanPenyakit = $this->Konsultasi_model->getGroupAturan(implode(",", $_POST['gejala']));
      // $gejalaYangDipilih = array();
      $kds_gejala = implode(",", $_POST['gejala']);
      $kds = str_replace(",", "','", $kds_gejala);
      $gejalaYangDipilih = $this->Konsultasi_model->getNamaGejala($kds);

      // for ($i=0; $i < count($_POST['gejala']); $i++) { 
      //   $gejalaYangDipilih[] = $this->Konsultasi_model->getNamaGejala($_POST['gejala'][$i]);
      // }

      $no = 1;
      $pilihanGejala = array();
      foreach ($gejalaYangDipilih as $row)
      {
        $pilihanGejala[] = $row['nama_gejala'];
      }

      // menampilkan kode gejala yang di pilih
      $sql = $_POST['gejala'];

      if (isset($sql)) {
        // mencari data penyakit kemungkinan dari gejala
        for ($h=0; $h < count($sql); $h++) {
          $kemungkinanPenyakit[] = $this->Konsultasi_model->getKemungkinanPenyakit($sql[$h]);
          for ($x=0; $x < count($kemungkinanPenyakit[$h]); $x++) {
            for ($i=0; $i < count($groupKemungkinanPenyakit); $i++) {
              $namaPenyakit = $groupKemungkinanPenyakit[$i]['nama_alergi'];
              if ($kemungkinanPenyakit[$h][$x]['nama_alergi'] == $namaPenyakit) {
                // list di kemungkinan dari gejala
                $listIdKemungkinan[$namaPenyakit][] = $kemungkinanPenyakit[$h][$x]['id_aturan'];
              }
            }
          }
        }

        $listPenyakit = array();
        foreach ($groupKemungkinanPenyakit as $row)
        {
            $listPenyakit[] = $row['nama_alergi'];
        }

        

        $id_penyakit_terbesar = '';
        $nama_alergi_terbesar = '';
        // list penyakit kemungkinan
        for ($h=0; $h < count($groupKemungkinanPenyakit); $h++) { 
          $namaPenyakit = $groupKemungkinanPenyakit[$h]['nama_alergi'];
          // echo "<hr><br/>Proses Penyakit ".$h.".".$namaPenyakit."<br/>========================================================<br/>";
          // echo "Jumlah Gejala = ".
                    count($listIdKemungkinan[$namaPenyakit])."<br/>";
          // list penyakit kemungkinan dari gejala
          for ($x=0; $x < count($listIdKemungkinan[$namaPenyakit]); $x++) { 
            $daftarKemungkinanPenyakit = $this->Konsultasi_model->getListPenyakit($listIdKemungkinan[$namaPenyakit][$x]);
            $proc = $x+1;
            
            // echo "<br/>proses ".$proc."<br/>------------------------------------<br/>";
                    
            for ($i=0; $i < count($daftarKemungkinanPenyakit); $i++) {
                
                if (count($listIdKemungkinan[$namaPenyakit]) == 1) {
                  // echo "Jumlah Gejala = ".
                  //   count($listIdKemungkinan[$namaPenyakit])."<br/>";
                      
                  // bila list kemungkinan terdapat 1
                  $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                  $md = $daftarKemungkinanPenyakit[$i]['md'];
                  $cf = $mb - $md;
                  $daftar_cf[$namaPenyakit][] = $cf;

                  // echo "<br/>proses 1<br/>------------------------<br/>";
                  // echo "mb = ".$mb."<br/>";
                  // echo "md = ".$md."<br/>";
                  // echo "cf = mb - md = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";
                  // end bila list kemungkinan terdapat 1
                } else {
                  // list kemungkinanan lebih dari satu
                  if ($x == 0)
                  {
                    // echo "Jumlah Gejala = ".
                    // count($listIdKemungkinan[$namaPenyakit])."<br/>";
                    // record md dan mb sebelumnya
                    $mblama = $daftarKemungkinanPenyakit[$i]['mb'];
                    $mdlama = $daftarKemungkinanPenyakit[$i]['md'];
                    // md yang di esekusi
                    $mb = $daftarKemungkinanPenyakit[$i]['mb'];
                    $md = $daftarKemungkinanPenyakit[$i]['md'];
                    // echo "<br/>";
                    // echo "mb_baru = ".$mb."<br/>";
                    // echo "md_baru = ".$md."<br/>";
                    $cf = $mb - $md;
                    // echo "cf = mb - md = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";

                    $daftar_cf[$namaPenyakit][] = $cf;
                  } 
                  else
                  {
                    $mbbaru = $daftarKemungkinanPenyakit[$i]['mb'];
                    $mdbaru = $daftarKemungkinanPenyakit[$i]['md'];
                    // echo "mb_baru = ".$mbbaru."<br/>";
                    // echo "md_baru = ".$mdbaru."<br/>";
                    $mbsementara = $mblama + ($mbbaru * (1 - $mblama));
                    $mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));
                    // echo "mb_sementara = mb_lama + (mb_baru * (1 - mb_lama)) = $mblama + ($mbbaru * (1 - $mblama)) = ".$mbsementara."<br/>";
                    // echo "md_sementara = md_lama + (md_baru * (1 - md_lama)) = $mdlama + ($mdbaru * (1 - $mdlama)) = ".$mdsementara."<br/>";

                    $mb = $mbsementara;
                    $md = $mdsementara;
                    $cf = $mb - $md;
                    // echo "cf = mb_sementara - md_sementara = ".$mb." - ".$md." = ".$cf."<br/><br/><br/>";
                    $daftar_cf[$namaPenyakit][] = $cf;;
                  }
                  // end list kemungkinanan lebih dari satu
                }
              }
            }  
          }
        }
        // echo "<br/>===================================================================<br/>";
      // echo "<hr>";
      $hasilCF = $this->Konsultasi_model->cloneHasilAkhir($daftar_cf,$groupKemungkinanPenyakit);

      for ($i=0; $i < count($groupKemungkinanPenyakit); $i++) { 
        $namaPenyakit = $groupKemungkinanPenyakit[$i]['nama_alergi'];
        for ($x=0; $x < count($daftar_cf[$namaPenyakit]); $x++) {
          $merubahIndexCF[$i] = max($daftar_cf[$namaPenyakit]);
        }
      }

      $listKemungkinanPenyakit = array();
      for ($i=0; $i < count($listPenyakit) ; $i++) { 
        $listKemungkinanPenyakit[$i]['nama_alergi'] = $listPenyakit[$i];  
        $listKemungkinanPenyakit[$i]['nilai'] = $merubahIndexCF[$i];  
      }
      
      for ($i=0; $i < count($groupKemungkinanPenyakit); $i++) { 
        $hasilMax = max($merubahIndexCF);
        $namaPenyakit = $groupKemungkinanPenyakit[$i]['nama_alergi'];
        if ($merubahIndexCF[$i] === $hasilMax) {
          
          // echo "<h5>Nilai tertinggi dari perhitungan gejala adalah ".$namaPenyakit.", dengan nilai CF = ".$merubahIndexCF[$i]."</h5>";  
          
          // echo "<hr>";
          $query = $this->db->query("SELECT ket, solusi FROM tb_alergi WHERE nama_alergi = '$namaPenyakit'");
          $ket = array();
          foreach ($query->result_array() as $row)
          {
              // $ket[] = $row;
              $hasilakhir_cf[] = [
                "ph"  => $namaPenyakit,
                "nilai" => $merubahIndexCF[$i],
                "solusi" => $row
              ];
          }
        }
      }
      // print_r($listKemungkinanPenyakit);
      // echo "<pre>";
      // print_r($ket);die;
      // $this->Konsultasi_model->hasilCFTertinggi($daftar_cf,$groupKemungkinanPenyakit);
      // $this->Konsultasi_model->hasilAkhir($daftar_cf,$groupKemungkinanPenyakit);
      $data = [
        "gejala" => $pilihanGejala,
        "list_penyakit" => $listKemungkinanPenyakit,
        "hasilakhir_cf" => $hasilakhir_cf
      ];
      
      return $data;
      
    }

    public function getKemungkinanPenyakit($sql)
    {
      // p, g , pyt merupakan inisialisasi dari tabel yang dituju
      $query = $this->db->query("SELECT pyt.kode_alergi, pyt.nama_alergi, p.id_aturan FROM tb_aturan p
        JOIN tb_gejala g ON p.id_gejala = g.id_gejala
        JOIN tb_alergi pyt ON p.id_alergi = pyt.id_alergi
        WHERE g.id_gejala IN ($sql)");
      
      return $query->result_array();

    //   if (isset($result)) {
    //     // merubah data tabel menjadi array
    //     $row = [];
    //     while ($row = $result->fetch_assoc()) {
    //       $rows[] = $row;
    //     }

    //     return $rows;
    //   }

    }

    public function getListPenyakit($value)
    {
      // p, g , pyt merupakan inisialisasi dari tabel yang dituju
      $query = $this->db->query("SELECT * FROM tb_aturan p
        JOIN tb_gejala g ON p.id_gejala = g.id_gejala
        JOIN tb_alergi pyt ON p.id_alergi = pyt.id_alergi
        WHERE p.id_aturan IN ($value)");
      
      return $query->result_array();

    // if (isset($result)) {
    //     // merubah data tabel menjadi array
    //     $row = [];
    //     while ($row = $result->fetch_assoc()) {
    //     $rows[] = $row;
    //     }

    //     return $rows;
    // }
    }

    public function cloneProsesDs()
    {
      $gejala=array();
                $query = $this->db->query("SELECT GROUP_CONCAT(b.kode_alergi), a.cf
                FROM tb_aturan a
                JOIN tb_alergi b ON a.id_alergi=b.id_alergi
                WHERE a.id_gejala IN(".implode(',',$_POST['gejala']).") 
                GROUP BY a.id_gejala");
                foreach ($query->result_array() as $row)
                {
                    $gejala[]=$row;
                }
                $jumlah_g = count($gejala);
                for ($i=0; $i < $jumlah_g ; $i++) { 
                    $gejala[$i] = array_values($gejala[$i]);
                }

                $query = $this->db->query("SELECT nama_gejala FROM tb_gejala WHERE id_gejala IN (".implode(',',$_POST['gejala']).") 
                GROUP BY id_gejala");

                $pilihanGejala = array();
                foreach ($query->result_array() as $row)
                {
                    $pilihanGejala[] = $row['nama_gejala'];
                }

                // print_r($pilihanGejala);
                
                // echo "<pre>";
                // print_r($gejala);
                //-- masukkan kode perhitungannya di sini

                //--- menentukan environement
                $query = $this->db->query("SELECT GROUP_CONCAT(kode_alergi) FROM tb_alergi");
                $row = $query->result_array();
                $fod = array_values($row[0]);
                // echo "<pre>";
                // print_r($fod);exit;

                //--- menentukan nilai densitas
                $densitas_baru=array();
                $riwayat = array();
                $riwayat_x = array();
                $r = 0;
                $densi = 3;
                // echo "<hr>";
                while(!empty($gejala)){
                    $densitas1[0]=array_shift($gejala);
                    // print_r($densitas1);
                    $densitas1[1]=array($fod[0],1-$densitas1[0][1]);
                    // print_r($densitas1);exit;
                    $densitas2=array();
                    if(empty($densitas_baru)){
                        $densitas2[0]=array_shift($gejala);
                    }else{
                        foreach($densitas_baru as $k=>$r){
                            if($k!="&theta;"){
                                $densitas2[]=array($k,$r);
                            }
                        }
                    }
                    // print_r($densitas2);exit;
                    $theta=1;
                    foreach($densitas2 as $d) $theta-=$d[1];
                    $densitas2[]=array($fod[0],$theta);
                    // print_r($densitas2);exit;
                    $m=count($densitas2);
                    $densitas_baru=array();
                    $densi_x = $densi-2;
                    $densi_y = $densi-1;
                    // echo "Menentukan Nilai Densitas (m$densi) dari Densitas (m$densi_x) dan Densitas (m$densi_y)!"."<br>";
                    // echo "Menentukan Nilai Densitas (m) baru!"."<br>";
                    
                    for($y=0;$y<$m;$y++){
                        for($x=0;$x<2;$x++){
                          // echo "<hr>";
                            if(!($y==$m-1 && $x==1)){
                                // print_r($densitas1);exit;
                                $v=explode(',',$densitas1[$x][0]);
                                $w=explode(',',$densitas2[$y][0]);
                                sort($v);
                                sort($w);
                                $vw=array_intersect($v,$w);
                                
                                if(empty($vw)){
                                    $k="&theta;";
                                }else{
                                    $k=implode(',',$vw);
                                }
                                // print_r($densitas1);
                                // print_r($densitas2);
                                
                                if(!isset($densitas_baru[$k])){
                                    $densitas_baru[$k]=$densitas1[$x][1]*$densitas2[$y][1];
                                    // echo $densitas2[$y][0]."<br>";
                                    // echo $densitas1[$x][0]." x ".$densitas2[$y][0]." = ".$densitas1[$x][0].",".$densitas2[$y][0]."<br>";
                                    // echo $densitas1[$x][1]." x ".$densitas2[$y][1]." = ".$densitas_baru[$k]."<br>";
                                  }else{
                                    $densitas_baru[$k]+=$densitas1[$x][1]*$densitas2[$y][1];
                                    // echo $densitas1[$x][1]." x ".$densitas2[$y][1]." = ".$densitas_baru[$k]."<br>";
                                  }
                                  
                            }
                        } 
                    } 
                    
                    // echo "<br>-----------------------------<br>";
                    // echo "Proses densitas baru (m)"."<br>";
                    $densi = $densi + 2;
                    foreach($densitas_baru as $k=>$d){
                      
                        if($k!="&theta;"){
                            
                            $densitas_baru[$k] = $d / (1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0));

                            $k." = ".round($d,2)." / ".round((1-(isset($densitas_baru["&theta;"])?$densitas_baru["&theta;"]:0)),2)." = ".round($densitas_baru[$k],2)."<br>";
                        }
                        
                        // print_r($densitas_baru);
                        $riwayat = $densitas_baru;
                        $r++;
                    }
                    
                    $riwayat_x[] = $riwayat;
                    // echo "<hr><br>";
                }
                
                // echo "<pre>";
                // print_r($riwayat_x);
                // echo "<hr><br>";
                //--- perangkingan
                unset($densitas_baru["&theta;"]);
                arsort($densitas_baru);
                // echo "<pre>";
                // print_r($densitas_baru);
                // echo "<br>=============================================================<br>";
                $kd_alergi = array();
                foreach ($densitas_baru as $key => $value) {
                  $kd_alergi[] = $key;
                }
                
                $kds_alergi = implode(',',$kd_alergi);
                $kds = str_replace(",", "','", $kds_alergi);

                $query = $this->db->query("SELECT nama_alergi FROM tb_alergi WHERE kode_alergi IN ('$kds')");
               
                $listAlergi = array();
                $no=0;
                $densitas = array_values($densitas_baru);
                foreach ($query->result_array() as $row)
                {
                    $listAlergi[$no]['nama_alergi'] = $row['nama_alergi'];
                    $listAlergi[$no]['densitas'] = $densitas[$no];
                    $no++;
                }
                
                // print_r($listAlergi);

                $kode_alergi = array_keys($densitas_baru)[0];
                $kode = str_replace(",", "','", $kode_alergi);
                // echo $kode;die;
                $rank = $this->Alergi_model->getNamaAlergi($kode);
                // $kode = explode(' , ', $kode_alergi);
                // print_r($densitas_baru);die;
                // print_r($rank);
                // echo "<hr>";
                $hasil = [];
                if (count($rank) > 1) {
                  // $hasil_bagi = array_values($densitas_baru)[0]/count($rank);
                  for ($i=0; $i < count($rank); $i++) { 
                    // echo "<h5>Nilai tertinggi dari perhitungan gejala adalah ".$rank[$i].", dengan nilai DS = ".round(array_values($densitas_baru)[0],2)."</h5><br>";
                    $hasil = [
                      "alergi_ds" => $rank[i],
                      "nilai" => round(array_values($densitas_baru)[0],2)
                    ];
                  }
                } else {
                    // echo "<h5>Nilai tertinggi dari perhitungan gejala adalah ".$rank[0].", dengan nilai DS = ".round(array_values($densitas_baru)[0],2)."</h5>";
                    $alergi_ds = $rank[0];
                    $nilai = round(array_values($densitas_baru)[0],2);
                }
                
                $query = $this->db->query("SELECT ket, solusi FROM tb_alergi WHERE kode_alergi = '$kode_alergi'");
                $ket = array();
                foreach ($query->result_array() as $row)
                {
                    $ket[] = $row;
                }

                if (empty($hasil)) {
                  $data = [
                    "gejala" => $pilihanGejala,
                    "list_alergi" => $listAlergi,
                    "hasil" => [
                      "alergi_ds" => $alergi_ds,
                      "nilai" => $nilai
                    ],
                    "ket" => $ket
                  ];
                } else {
                  $data = [
                    "gejala" => $pilihanGejala,
                    "list_alergi" => $listAlergi,
                    "hasil" => $hasil,
                    "ket" => $ket
                  ];
                }
                
                return $data;
                // $data = [
                //     'title' =>  "Hasil Konsultasi",
                //     'riwayat'    =>  $riwayat_x,
                //     'h_akhir'  =>  $densitas_baru,
                //     'isi'   =>  "user/hasil_konsultasi"
                // ];
    
                // $this->load->view('layout/wrapper', $data, FALSE);
    }

    public function getKonsulAkhirUser($id_user)
    {
      $query = $this->db->query("SELECT * FROM tb_riwayat WHERE id_user = $id_user ORDER BY id_riwayat DESC LIMIT 1");

      return $query->result_array();
    }

    public function rank()
    {

            // cf
            // group kemungkinan terdapat alergi
            $groupKemungkinanAlergi = $this->Konsultasi_model->getGroupAturan(implode(",", $_POST['gejala']));

            // menampilkan kode gejala yang di pilih
            $sql = $_POST['gejala'];
            if (isset($sql)) {
              // mencari data alergi kemungkinan dari gejala
              for ($h=0; $h < count($sql); $h++) {
                $kemungkinanAlergi[] = $this->Konsultasi_model->getKemungkinanAlergi($sql[$h]);
                for ($x=0; $x < count($kemungkinanAlergi[$h]); $x++) {
                  for ($i=0; $i < count($groupKemungkinanAlergi); $i++) {
                    $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
                    // $kodes_p = $groupKemungkinanAlergi[$i]['nama_alergi'];
                    if ($kemungkinanAlergi[$h][$x]['nama_alergi'] == $namaAlergi) {
                      // list di kemungkinan dari gejala
                      $listIdKemungkinan[$namaAlergi][] = $kemungkinanAlergi[$h][$x]['id_aturan'];
                    }
                  }
                }
              }

              // echo "<pre>";
              // print_r($listIdKemungkinan);
              $nama_p = array();
              foreach ($listIdKemungkinan as $key => $value) {
                $nama_p[] = $key;
              }
              // print_r($nama_p);
              $kodes_p = array();
              for ($i=0; $i < count($nama_p); $i++) { 
                $kodes_p[] = $this->Konsultasi_model->getKodeAlergi($nama_p[$i]);
              }

              $kodes = array();
              for ($i=0; $i < count($kodes_p) ; $i++) { 
                $kodes[] = $kodes_p[$i]['kode_alergi'];
              }


              // echo $kodes_p = json_encode($kodes);

              // print_r($kodes);die;

              $id_alergi_terbesar = '';
              $nama_alergi_terbesar = '';
              // list alergi kemungkinan
              for ($h=0; $h < count($groupKemungkinanAlergi); $h++) { 
                $namaAlergi = $groupKemungkinanAlergi[$h]['nama_alergi'];
                // list alergi kemungkinan dari gejala
                for ($x=0; $x < count($listIdKemungkinan[$namaAlergi]); $x++) { 
                  $daftarKemungkinanAlergi = $this->Konsultasi_model->getListAlergi($listIdKemungkinan[$namaAlergi][$x]);
                  $proc = $x+1;
                          
                  for ($i=0; $i < count($daftarKemungkinanAlergi); $i++) {
                      
                      if (count($listIdKemungkinan[$namaAlergi]) == 1) {
                        // echo "Jumlah Gejala = ".
                        //   count($listIdKemungkinan[$namaAlergi])."<br/>";
                            
                        // bila list kemungkinan terdapat 1
                        $mb = $daftarKemungkinanAlergi[$i]['mb'];
                        $md = $daftarKemungkinanAlergi[$i]['md'];
                        $cf = $mb - $md;
                        $daftar_cf[$namaAlergi][] = $cf;
                        // end bila list kemungkinan terdapat 1
                      } else {
                        // list kemungkinanan lebih dari satu
                        if ($x == 0)
                        {
                          // echo "Jumlah Gejala = ".
                          // count($listIdKemungkinan[$namaAlergi])."<br/>";
                          // record md dan mb sebelumnya
                          $mblama = $daftarKemungkinanAlergi[$i]['mb'];
                          $mdlama = $daftarKemungkinanAlergi[$i]['md'];
                          // md yang di esekusi
                          $mb = $daftarKemungkinanAlergi[$i]['mb'];
                          $md = $daftarKemungkinanAlergi[$i]['md'];
                          $cf = $mb - $md;

                          $daftar_cf[$namaAlergi][] = $cf;
                        } 
                        else
                        {
                          $mbbaru = $daftarKemungkinanAlergi[$i]['mb'];
                          $mdbaru = $daftarKemungkinanAlergi[$i]['md'];

                          $mbsementara = $mblama + ($mbbaru * (1 - $mblama));
                          $mdsementara = $mdlama + ($mdbaru * (1 - $mdlama));

                          $mb = $mbsementara;
                          $md = $mdsementara;
                          $cf = $mb - $md;

                          $daftar_cf[$namaAlergi][] = $cf;;
                        }
                        // end list kemungkinanan lebih dari satu
                      }
                    }
                  }  
                }
              }
            // $this->Konsultasi_model->cloneHasilCFTertinggi($daftar_cf,$groupKemungkinanAlergi);
            // $this->Konsultasi_model->cloneHasilAkhir($daftar_cf,$groupKemungkinanAlergi);

            // for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
            //   $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
            //   for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
            //     $merubahIndexCF = max($daftar_cf[$namaAlergi]);
            //   }
            // }

            $merubahIndexCF = array();
            for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
              $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
              for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
                $merubahIndexCF[$i] = max($daftar_cf[$namaAlergi]);
              }
            }
            
            for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
              $hasilMax = max($merubahIndexCF);
              $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
              if ($merubahIndexCF[$i] === $hasilMax) {  
                
                $query = $this->db->query("SELECT kode_alergi
                      FROM tb_alergi
                      WHERE nama_alergi = '$namaAlergi'
                ");
      
                $kode_alergi =array();
                foreach ($query->result() as $row)
                {
                    $kode_alergi[] = $row->kode_alergi;
                }
              }
            }

            // echo $kodes = implode(',',$kode_p);die;
            $kode_cf = implode(',',$kode_alergi);
            
            $ids = implode(',',$_POST['gejala']);
            $kode_gejala = $this->Gejala_model->getKode($ids);
            $codes = implode(',',$kode_gejala);

            $data = [
                'id_user' => $this->session->userdata('id_user'),
                'kode_gejala' => $codes,
                'prob_alergi' => json_encode($kodes),
                'kode_alergi' => $kode_cf,
                'tanggal_konsul' => time()
            ];

            // print_r($data);die;

            $this->db->insert('tb_riwayat', $data);
    }

     /**
     * Gets the group tb_aturan.
     *
     * mengambil salah satu nama alergi bila terdapat nama alergi sama
     */
    public function getGroupAturan($value)
    {
      // p, g , pyt merupakan inisialisasi dari tabel yang dituju
      $query = $this->db->query("SELECT
            pyt.nama_alergi 
        FROM
            tb_aturan p
            JOIN tb_gejala g ON p.id_gejala = g.id_gejala
            JOIN tb_alergi pyt ON p.id_alergi = pyt.id_alergi 
        WHERE
            p.id_gejala IN ( $value ) 
        GROUP BY
            p.id_alergi 
        ORDER BY
            p.id_alergi");

      return $query->result_array();

    //   if (isset($result)) {
    //     // merubah data tabel menjadi array
    //     $row = [];
    //     while ($row = $result->fetch_assoc()) {
    //       $rows[] = $row;
    //     }

    //     return $rows;
    //   }

    }

    /**
     * Gets the kemungkinan alergi.
     *
     * mengambil data tb_aturan bila terdapat gejala
     */
    public function getKemungkinanAlergi($sql)
    {
      // p, g , pyt merupakan inisialisasi dari tabel yang dituju
      $query = $this->db->query("SELECT pyt.kode_alergi, pyt.nama_alergi, p.id_aturan FROM tb_aturan p
        JOIN tb_gejala g ON p.id_gejala = g.id_gejala
        JOIN tb_alergi pyt ON p.id_alergi = pyt.id_alergi
        WHERE g.id_gejala IN ($sql)");
      
      return $query->result_array();

    //   if (isset($result)) {
    //     // merubah data tabel menjadi array
    //     $row = [];
    //     while ($row = $result->fetch_assoc()) {
    //       $rows[] = $row;
    //     }

    //     return $rows;
    //   }

    }

    public function getListAlergi($value)
    {
      // p, g , pyt merupakan inisialisasi dari tabel yang dituju
      $query = $this->db->query("SELECT * FROM tb_aturan p
        JOIN tb_gejala g ON p.id_gejala = g.id_gejala
        JOIN tb_alergi pyt ON p.id_alergi = pyt.id_alergi
        WHERE p.id_aturan IN ($value)");
      
      return $query->result_array();

    // if (isset($result)) {
    //     // merubah data tabel menjadi array
    //     $row = [];
    //     while ($row = $result->fetch_assoc()) {
    //     $rows[] = $row;
    //     }

    //     return $rows;
    // }
    }

    public function getKodeAlergi($value)
    {
      $query = $this->db->query("SELECT kode_alergi FROM tb_alergi WHERE nama_alergi = '$value'");

      return $query->row_array();
    }

    public function getNamaAlergi($kode)
    {
      $query = $this->db->query("SELECT nama_alergi FROM tb_alergi WHERE kode_alergi IN ('$kode')");

      return $query->result_array();
    }

    public function getRankAlergi($kode)
    {
      $query = $this->db->query("SELECT nama_alergi, ket, solusi FROM tb_alergi WHERE kode_alergi = '$kode'");

      return $query->row_array();
    }

    public function getNamaGejala($value)
    {
      $query = $this->db->query("SELECT nama_gejala FROM tb_gejala
        WHERE id_gejala IN ('$value')");
      
      return $query->result_array();
    }

    public function getNamaGejalaByKode($value)
    {
      $query = $this->db->query("SELECT nama_gejala FROM tb_gejala
        WHERE kode_gejala IN ('$value')");
      
      return $query->result_array();
    }

    public function hasilCFTertinggi($daftar_cf,$groupKemungkinanAlergi)
    {
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        // echo "<br/>Nama Alergi = ".$namaAlergi."<br/>";
        for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
          $merubahIndexCF = max($daftar_cf[$namaAlergi]);
        }

        echo "Nilai CF Tertinggi Di Kandidat Alergi = ".$merubahIndexCF."<br>";
        // echo "<br/>-------------------------------------------------------------------------<br/>";
      }
    }

    public function hasilAkhir($daftar_cf,$groupKemungkinanAlergi)
    {
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
          $merubahIndexCF[$i] = max($daftar_cf[$namaAlergi]);
        }
      }
      
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $hasilMax = max($merubahIndexCF);
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        // if ($merubahIndexCF[$i] === $hasilMax) {
        //   echo "<b>Nilai tertinggi dari perhitungan metode Certainty Factor adalah <strong>".$namaAlergi."</strong>, dengan nilai = <strong>".$merubahIndexCF[$i]."</strong></b>";  
          
        //   echo "<hr>";
        //   $query = $this->db->query("SELECT ket, solusi FROM tb_alergi WHERE nama_alergi = '$namaAlergi'");
        //   echo "<br>";
        //   foreach ($query->result_array() as $row)
        //   {
        //       echo "<h4>Keterangan :</h4><br>";
        //       echo $row['ket']."<br>";
              
        //       echo "<br><h4>Solusi :</h4><br>";
        //       echo $row['solusi']."<br>";
        //   }
        // }
      }


    }

    public function cloneHasilCFTertinggi($daftar_cf,$groupKemungkinanAlergi)
    {
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
          $merubahIndexCF = max($daftar_cf[$namaAlergi]);
        }
      }
    }

    public function cloneHasilAkhir($daftar_cf,$groupKemungkinanAlergi)
    {
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        for ($x=0; $x < count($daftar_cf[$namaAlergi]); $x++) {
          $merubahIndexCF[$i] = max($daftar_cf[$namaAlergi]);
        }
      }
      
      for ($i=0; $i < count($groupKemungkinanAlergi); $i++) { 
        $hasilMax = max($merubahIndexCF);
        $namaAlergi = $groupKemungkinanAlergi[$i]['nama_alergi'];
        if ($merubahIndexCF[$i] === $hasilMax) {  
          $alergi_cf = $namaAlergi;
          $nilai = $merubahIndexCF[$i];
          
        }
      }

      return array(
        'alergi_cf' => $alergi_cf,
        'nilai' => $nilai,
    );

    }

}

/* End of file Konsultasi_model.php */
