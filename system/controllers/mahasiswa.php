<?php

class mahasiswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        if ($this->session->userdata('user_level')!='mahasiswa') {
            redirect(base_url());
        }
    }

    public function index() {
        $data['title'] = "Daftar Mata Kuliah Ditempuh";
        $data['data'] = $this->model->kelas_mahasiswa();
        $this->page("v_kelas", $data);
    }

    public function kuliah() {
        $data['title'] = "Jadwal Perkuliahan";
        $data['data'] = $this->model->kuliah_mahasiswa();
        $this->page("v_kuliah", $data);
    }
    
    public function uts() {
        $data['title'] = "Jadwal UTS";
        $data['data'] = $this->model->ujian_mahasiswa(0);
        $this->page('v_uts', $data, array("jadwal","uts"));
    }
    
    public function uas() {
        $data['title'] = "Jadwal UAS";
        $data['data'] = $this->model->ujian_mahasiswa(1);
        $this->page('v_uas', $data, array("jadwal","uas"));
    }
    
    private function page($content, $input) {
        $data['level'] = 'mahasiswa';
        $data['content_name'] = $content;
        $data['content_data'] = $input;
        $data['content_data']['level'] = $data['level'];
        $data['title'] = $input['title'];
        $this->load->view('template', $data);
    }

}

?>
