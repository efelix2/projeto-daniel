<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index() {
        $acesso['acesso'] = $this->M_home->carrega_acesso();
        $this->load->view('includes/header');
        $this->load->view('includes/submenu',$acesso);
        $this->load->view('int_ANC/home');
        $this->load->view('includes/footer');
    }
    
    // public function requi_materiais() {
    //     //echo __FUNCTION__;
    //     $acesso['acesso'] = $this->M_home->carrega_acesso();
    //     $this->load->view('includes/header');
    //     $this->load->view('includes/submenu',$acesso);
    //     $this->load->view('int_almoxarifado/requi_materiais');
    //     $this->load->view('includes/footer');
    // }
}