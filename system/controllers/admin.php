<?php

class admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        if ($this->session->userdata('user_level')!='admin') {
            redirect(base_url());
        }
    }

    public function index() {
        $this->page("home");
    }

    public function matkul($id) {
        if ($this->input->get_post('nama')) {
            $input = array('kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'sks' => $this->input->post('sks'));
            $update=$this->input->get_post('id_matkul')?array('id_matkul'=>$this->input->post('id_matkul')):null;
            $data['status'] = $this->model->update('matkul', $input, $update);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('matkul', array("id_matkul" => $id));
        }
        $data['title'] = "Data Matakuliah";
        $data['data'] = $this->model->get_data("matkul");
        $this->page('matkul', $data, array("master","matkul"));
    }

    public function addmatkul($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("matkul", array("id_matkul" => $id));
            $data['title'] = "Update Data Matakuliah";
        }else{
            $data['title'] = "Entry Data Matakuliah";            
        }
        $this->page("addmatkul", $data, array("master","matkul"));
    }

    public function peserta($id) {
        if ($this->input->get_post('kelas')) {        
            $data['id_kelas']=$this->input->post('kelas');
            if($this->input->get_post('hapus')){
                $data['id_mahasiswa']=$this->input->post('hapus');
                $data['status'] = $this->model->hapus('kelas_mahasiswa', $data);
            }else if($this->input->get_post('peserta')){
                $data['status'] = $this->model->tambah_peserta($data['id_kelas'],$this->input->post('peserta'));
            }
            $data['mahasiswa'] = $this->model->bukan_peserta($data['id_kelas']);
            $data['data'] = $this->model->get_data("v_peserta",array('id_kelas'=>$data['id_kelas']));
        }
        $data['title'] = "Peserta Kelas";
        $data['kelas'] = $this->model->get_data("v_kelas");
        $this->page('peserta', $data, array("kls","peserta"));
    }

    public function kelas($id) {
        if ($this->input->get_post('kelas')) {
            $data['status'] = $this->model->simpan_kelas(array('id_kelas' => $this->input->post('id_kelas'),
                'kelas' => $this->input->post('kelas'),
                'id_matkul' => $this->input->post('id_matkul'),
                'dosen' => $this->input->post('dosen')));
        } elseif (isset($id)) {
            $this->model->hapus('kelas_dosen', array("id_kelas" => $id));
            $data['status'] = $this->model->hapus('kelas', array("id_kelas" => $id));
        }
        $data['title'] = "Data Kelas";
        $data['data'] = $this->model->get_data("v_kelas");
        $this->page('kelas', $data, array("kls","datakelas"));
    }

    public function addkelas($mk,$id) {
        if(!isset($mk)){
            redirect(base_url());
        }
        if (isset($id)) {
            $data = $this->model->get_detail("kelas", array("id_kelas" => $id));
            $dosen = $this->model->get_data("kelas_dosen",array("id_kelas" => $id));
            $data['id_dosen']=array();
            foreach ($dosen->result_array() as $v) {
                $data['id_dosen'][]=$v['id_dosen'];
            }
            $data['title'] = "Update Data Kelas";
        }else{
            $data['title'] = "Entry Data Kelas";            
        }
        $data['id_matkul'] = $mk;
        $data['mk'] = $this->model->get_detail("matkul", array("id_matkul" => $mk));
        $data['dosen'] = $this->model->get_data("dosen");
        $this->page("addkelas", $data, array("kls","datakelas"));
    }
    
    public function kuliah($id) {
        if ($this->input->get_post('id_kelas')) {
            $input = array('id_kelas' => $this->input->post('id_kelas'),
                'mulai' => $this->input->post('mulai'),
                'selesai' => $this->input->post('selesai'),
                'id_hari' => $this->input->post('id_hari'),
                'id_ruang' => $this->input->post('id_ruang'));
            $data['status'] = $this->model->update('kuliah', $input);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('kuliah', array("id_kuliah" => $id));
        }
        $data['title'] = "Jadwal Perkuliahan";
        $data['data'] = $this->model->get_data("v_kuliah");
        $this->page('kuliah', $data, array("jadwal","kuliah"));
    }

    public function addkuliah() {
        $data['title'] = "Entry Jadwal Perkuliahan";            
        $data['hari'] = $this->model->get_data("hari",array(),array("order_by"=>array('id_hari','asc')));   
        $data['matkul'] = $this->model->get_data("matkul");
        $data['ruang'] = $this->model->get_data("ruang");
        $this->page("addkuliah", $data, array("jadwal","kuliah"));
    }
    
    public function uts($id) {
        if ($this->input->get_post('id_kelas')) {
            $input = array('id_kelas' => $this->input->post('id_kelas'),
                'jam' => $this->input->post('jam'),
                'status' => 0,
                'tgl' => $this->input->post('tgl'),
                'id_ruang' => $this->input->post('id_ruang'));
            $data['status'] = $this->model->update('ujian', $input);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('ujian', array("id_ujian" => $id));
        }
        $data['title'] = "Jadwal UTS";
        $data['data'] = $this->model->get_data("v_ujian",array('status'=>0));
        $this->page('uts', $data, array("jadwal","uts"));
    }
    
    public function uas($id) {
        if ($this->input->get_post('id_kelas')) {
            $input = array('id_kelas' => $this->input->post('id_kelas'),
                'jam' => $this->input->post('jam'),
                'status' => 1,
                'tgl' => $this->input->post('tgl'),
                'id_ruang' => $this->input->post('id_ruang'));
            $data['status'] = $this->model->update('ujian', $input);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('ujian', array("id_ujian" => $id));
        }
        $data['title'] = "Jadwal UAS";
        $data['data'] = $this->model->get_data("v_ujian",array('status'=>1));
        $this->page('uas', $data, array("jadwal","uas"));
    }

    public function addujian($status) {
        $data['status'] = $status;
        $data['title'] = "Entry Jadwal ".strtoupper($status);            
        $data['matkul'] = $this->model->get_data("matkul");
        $data['ruang'] = $this->model->get_data("ruang");
        $this->page("addujian", $data, array("jadwal",$status));
    }

    public function dosen($id) {
        if ($this->input->get_post('nama')) {
            $input = array('nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'tgllahir' => $this->input->post('tgllahir'));
            $update=$this->input->get_post('id_dosen')?array('id_dosen'=>$this->input->post('id_dosen')):null;
            $data['status'] = $this->model->update('dosen', $input, $update);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('dosen', array("id_dosen" => $id));
        }
        $data['title'] = "Data Dosen";
        $data['data'] = $this->model->get_data("dosen");
        $this->page('dosen', $data, array("master","dosen"));
    }

    public function addmahasiswa($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("mahasiswa", array("id_mahasiswa" => $id));
            $data['title'] = "Update Data Mahasiswa";
        }else{
            $data['title'] = "Entry Data Mahasiswa";            
        }
        $this->page("addmahasiswa", $data, array("master","mahasiswa"));
    }

    public function mahasiswa($id) {
        if ($this->input->get_post('nama')) {
            $input = array('nim' => $this->input->post('nim'),
                'nama' => $this->input->post('nama'),
                'tgllahir' => $this->input->post('tgllahir'));
            $update=$this->input->get_post('id_mahasiswa')?array('id_mahasiswa'=>$this->input->post('id_mahasiswa')):null;
            $data['status'] = $this->model->update('mahasiswa', $input, $update);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('mahasiswa', array("id_mahasiswa" => $id));
        }
        $data['title'] = "Data Mahasiswa";
        $data['data'] = $this->model->get_data("mahasiswa");
        $this->page('mahasiswa', $data, array("master","mahasiswa"));
    }

    public function adddosen($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("dosen", array("id_dosen" => $id));
            $data['title'] = "Update Data Dosen";
        }else{
            $data['title'] = "Entry Data Dosen";            
        }
        $this->page("adddosen", $data, array("master","dosen"));
    }

    public function ruang($id) {
        if ($this->input->get_post('ruang')) {
            $input = array('ruang' => $this->input->post('ruang'));
            $update=$this->input->get_post('id_ruang')?array('id_ruang'=>$this->input->post('id_ruang')):null;
            $data['status'] = $this->model->update('ruang', $input, $update);
        } elseif (isset($id)) {
            $data['status'] = $this->model->hapus('ruang', array("id_ruang" => $id));
        }
        $data['title'] = "Data Ruangan";
        $data['data'] = $this->model->get_data("ruang");
        $this->page('ruang', $data, array("master","ruang"));
    }

    public function settings() {
        $data = $this->model->get_detail("user", array("id_user" => $this->session->userdata('user_id')));
        $data['title'] = "Account Settings";
        $this->page("settings", $data, array("user"));
    }

    private function page($content, $input, $menu) {
        $data['level'] = 'admin';
        $data['content_name'] = $content;
        $data['content_data'] = $input;
        $data['content_data']['level'] = $data['level'];
        $data['title'] = $input['title'];
        foreach ($menu as $m) {
            $data['menu'][$m] = "active";
        }
        $this->load->view('template', $data);
    }
    
    public function user() {
        if ($this->input->get_post('realname')) {
            $input = array('username' => $this->input->post('username'),
                'realname' => $this->input->post('realname'));
            if ((md5($this->input->post('password')) == $this->session->userdata('user_pass')) &&
                    ($this->input->post('password1') == $this->input->post('password2'))) {
                if ($this->input->get_post('password1')) {
                    $input['password'] = md5($this->input->post('password1'));
                    $password=$input['password'];
                }else{
                    $password=$this->session->userdata('user_pass');
                }
                $status = $this->model->update('user', $input,array('id_user' => $this->session->userdata('user_id')));
                if ($status) {
                    $this->model->cek_login($this->input->post('username'), $password);
                }
            } else {
                $status = 0;
            }
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/settings?status=$status");
    }

}

?>
