<?php
class service extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model');
    }
    public function index() {
        show_404();
    }
    public function sidebar() {
        if ($this->session->userdata('sidebar') == "show") {
            $this->session->set_userdata('sidebar', "hide");
        } else {
            $this->session->set_userdata('sidebar', "show");
        }
    }
    public function ruang($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("ruang", array("id_ruang" => $id));
            $this->load->view("text",array('text'=>json_encode($data)));
        }else{
            show_404();
        }
    }
    public function kelas($id) {
        if (isset($id)) {
            $kelas = $this->model->get_data("kelas", array("id_matkul" => $id));
            $data['text']="";
            foreach ($kelas->result_array() as $v) {
                $data['text'].="<option value='$v[id_kelas]'>$v[kelas]</option>";                
            }
            $this->load->view("text",$data);
        }else{
            show_404();
        }
    }
    public function mahasiswa($id) {
        if (isset($id)) {
            $kelas = $this->model->get_data("v_peserta", array("id_kelas" => $id));
            $data['text']="";
            foreach ($kelas->result_array() as $v) {
                $data['text'].="<tr><td>$v[nim]</td><td>$v[nama]</td></tr>";
            }
            $this->load->view("text",$data);
        }else{
            show_404();
        }
    }
}
?>
