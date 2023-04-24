<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AprovacaoRet extends CI_Controller
{
    public function index()
    {
        $this->load->model('int_ANC/M_retorno');
        // $acesso['acesso'] = $this->M_home->carrega_acesso_bs4();
        // $this->load->view('includes/bs4/header');
        ////////////////////////////////////////////////////////////////////////////////////////
        ////// RETORNAR TODOS CENTRO DE CUSTO, CRIADO POR DANIEL, 31/03/2022  /////
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['depto'] = $this->M_retorno->ret_depto(1);
        ////// RETORNAR TODOS OS NÚMEROS DOS ALMOXARIFADOS, CRIADO POR DANIEL, 23/03/2022  /////
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['secao'] = $this->M_retorno->BuscaNomeSecao();

        // $this->load->view('includes/bs4/submenu', $acesso);
        // $this->load->view('int_ANC/v_AprovacaoRet', $retorno);
        $this->load->view('int_ANC/v_AprovacaoRet');
        // $this->load->view('includes/bs4/footer');
    }

    public function retornoRetrabalhos()
    {
      
        $this->load->model('int_ANC/M_retorno');
        $retorno = $this->M_retorno->retornoRetrabalhos();

        echo json_encode($retorno);
    }

    public function liberaSaldoRetrabalho()
    {
        $input = $this->input->post();
        $this->load->model('int_ANC/M_insert');
        $retorno = $this->M_insert->liberaSaldoRetrabalho($input);
        echo json_encode($retorno);
    }
}
