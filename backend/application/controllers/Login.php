<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Pengguna_model","pengguna");
        if($this->is_login())
            redirect(base_url("index.php/dashboard"));
    }

    public function index() {
        $this->load->view("frontend/login");
    }

    public function api_login() {
        $post = $this->input->post();
        $record = $this->pengguna->ambil_data($post["username"],$post["password"]);
        if($record) {
            $this->session->set_userdata($record);
            redirect(base_url("index.php/dashboard"));
        } else {
            redirect(base_url("index.php/login/index/error"));
        }
    }

    private function is_login() {
        $login = $this->session->userdata("idpengguna");
        return (isset($login));
    }

}