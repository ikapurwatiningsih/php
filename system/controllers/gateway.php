<?php
class gateway extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        if ($this->input->get_post('name') && $this->input->get_post('pass')) {
            $this->load->model('model');
            $data['status']=$this->model->login($this->input->post('name'), $this->input->post('pass'));
        }
        if($this->session->userdata('login')){
            redirect(base_url().$this->session->userdata("user_level"));
        }else{
            $this->load->view('login',$data);
        }        
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>
