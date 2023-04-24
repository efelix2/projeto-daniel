<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ANC extends CI_Controller
{
    //Caminho via navegador
    // http://localhost/git/index.php/int_anc/anc
    public function index()
    {
        $this->load->model('int_ANC/M_retorno');
        // $acesso['acesso'] = $this->M_home->carrega_acesso_bs4();
        // $this->load->view('includes/bs4/header');
        // $this->load->view('includes/bs4/submenu', $acesso);
        ////////////////////////////////////////////////////////////////////////////////////////
        ////// RETORNAR TODOS CENTRO DE CUSTO, CRIADO POR DANIEL, 31/03/2022  /////
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['depto'] = $this->M_retorno->ret_depto(0);
        ////////////////////////////////////////////////////////////////////////////////////////
        ////// RETORNAR TODOS OS NÚMEROS DOS ALMOXARIFADOS, CRIADO POR DANIEL, 23/03/2022  /////
        ////////////////////////////////////////////////////////////////////////////////////////
        $retorno['secao'] = $this->M_retorno->BuscaNomeSecao();
        ////////////////////////////////////////////////////////////////////////////////////////
        // RETORNAR LISTA DOS ALMOXARIFADOS QUE JÁ FIZERAM RR, CRIADO POR DANIEL, 23/03/2022 ///
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['almoxOrig'] = $this->M_retorno->BuscaAlmoxOrig();
        ////////////////////////////////////////////////////////////////////////////////////////
        /////// RETORNAR TODOS OS TIPOS DE DOCUMENTOS, CRIADO POR DANIEL, 24/02/2022     ///////
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['tipodoc'] = $this->M_retorno->tipodoc();
        // $this->load->view('int_ANC/v_registroANC', $retorno);
        $this->load->view('int_ANC/v_registroANC', $retorno);
        // $this->load->view('includes/bs4/footer');
    }


    
    ///////////////////////////////////////////////////////////////////////////////////////////
    /////// RETORNAR ALMOXARIFADO          ////////////////////////////////////////////////////
    /////// CRIADO POR DANIEL              ////////////////////////////////////////////////////
    /////// 21/03/2022                     ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function BuscaAlmoxOrig()
    {
        $this->load->model('int_ANC/M_retorno');
        $retorno = $this->M_retorno->BuscaAlmoxOrig();
        echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    /////// RETORNAR O TABELA PRINCIPAL    ////////////////////////////////////////////////////
    /////// CRIADO POR DANIEL              ////////////////////////////////////////////////////
    /////// 21/03/2022                     ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function retornoRegistroRefugo()
    {
        $this->load->model('int_ANC/M_retorno');
        $retorno = $this->M_retorno->retornoRegistroRefugo();
        echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    /////// RETORNAR O TABELA DE DESVIO DE CONCESSÃO //////////////////////////////////////////
    /////// CRIADO POR DANIEL              ////////////////////////////////////////////////////
    /////// 21/03/2022                     ////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function BuscDesvioConc()
    {
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->BuscDesvioConc();
        // echo json_encode($retorno);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O NOME DO DOCUMENTO     ///////////////////////////////////////////////////
    ///// CRIADO POR DANIEL                ///////////////////////////////////////////////////
    ///// 24/02/2022                       ///////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function BuscTpDoc()
    {
        // $tpdoc = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->BuscTpDoc($tpdoc);
        // echo json_encode($retorno);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O NOME DO PRODUTO E A UNIDADE MEDIA////////////////////////////////////////
    ///// CRIADO POR DANIEL                           ////////////////////////////////////////
    ///// 24/02/2022                                  ////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function buscaNProduto()
    {
        $value = $this->input->post('value');
        $this->load->model('int_ANC/M_retorno');
        $retorno = $this->M_retorno->buscaNProduto($value);
        echo json_encode($retorno);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR CHAPA                              ////////////////////////////////////////
    ///// CRIADO POR DANIEL                           ////////////////////////////////////////
    ///// 24/02/2022                                  ////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function buscaNChapa()
    {
        // $value = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->buscaNChapa($value);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O NOME DO PRODUTO E A UNIDADE MEDIA ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 24/02/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function slLocalRef()
    {
        $value = $this->input->post('value');
        $this->load->model('int_ANC/M_retorno');
        $retorno = $this->M_retorno->slLocalRef($value);
        echo json_encode($retorno);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////// VALIDA NÚMERO DO DOCUMENTO                             /////////////////////////////
    ///////// CRIADO POR DANIEL                                      /////////////////////////////
    ///////// 05/09/2022                                             /////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    public function ValidaNroDoc()
    {
        // $tpdoc = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->ValidaNroDoc($tpdoc);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////            PROJETO DE NÃO CONFORMIDADE               //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////
    /////// Objetivo: LANÇA RETRABALHO   ///////////////////////////////////////////////////////
    /////// Criação: 19/09/2022          ///////////////////////////////////////////////////////
    /////// Autor: DANIEL                ///////////////////////////////////////////////////////
    /////// Revisado:                    ///////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    public function cadastraRetrabalho()
    {
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('txtDataLan', 'DATA LANÇAMENTO', 'required');
        // $this->form_validation->set_rules('slNumeroAlmox', 'ALMOXARIFADO', 'required');
        // $this->form_validation->set_rules('sltipodoc', 'TIPO DE DOC.', 'required');
        // $this->form_validation->set_rules('txtProd', 'PRODUTO', 'required');
        // $this->form_validation->set_rules('NumOS', 'N° OP', 'required');
        // $this->form_validation->set_rules('txtOperacao', 'OPERAÇÃO', 'required');
        // $this->form_validation->set_rules('txtNMaquina', 'N° MAQUINA', 'required');
        // $this->form_validation->set_rules('txtChapaOp', 'CHAPA OPERADOR', 'required');
        // $this->form_validation->set_rules('txtCeCus', 'CENTRO CUSTO:', 'required');
        // $this->form_validation->set_rules('numQtde', 'QTDE', 'required');
        // if ($this->form_validation->run() == FALSE) {
        //     $erros = array(
        //         'mensagens' => validation_errors(),
        //         'cod' => 2
        //     );
        //     echo json_encode($erros);
        // } else {
        //     $input = $this->input->post();
        //     $this->load->model('int_ANC/M_insert');
        //     $retorno = $this->M_insert->cadastraRetrabalho($input);
        //     echo json_encode($retorno);
        // }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    /////// Objetivo:  BAIXA NO PRODUTO REFUGADO      //////////////////////////////////////////
    /////// Criação: 22/03/2022                       //////////////////////////////////////////
    /////// Autor: DANIEL                             //////////////////////////////////////////
    /////// Revisado:                                 //////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    public function cadastrarRefugo()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtDataLan', 'DATA LANÇAMENTO', 'required');
        $this->form_validation->set_rules('slNumeroAlmox', 'ALMOXARIFADO', 'required');
        $this->form_validation->set_rules('sltipodoc', 'TIPO DE DOC.', 'required');
        $this->form_validation->set_rules('txtProd', 'PRODUTO', 'required');
        $this->form_validation->set_rules('NumOS', 'N° OP', 'required');
        $this->form_validation->set_rules('txtOperacao', 'OPERAÇÃO', 'required');
        $this->form_validation->set_rules('txtSecao', 'SEÇÃO', 'required');
        $this->form_validation->set_rules('slCodrefugo', 'CÓDIGO DE REFUGO', 'required');
        $this->form_validation->set_rules('txtNMaquina', 'N° MAQUINA', 'required');
        $this->form_validation->set_rules('txtChapaOp', 'CHAPA OPERADOR', 'required');
        $this->form_validation->set_rules('txtCeCus', 'CENTRO CUSTO:', 'required');
        $this->form_validation->set_rules('numQtde', 'QTDE', 'required');
        if ($this->form_validation->run() == FALSE) {
            $erros = array(
                'mensagens' => validation_errors(),
                'cod' => 2
            );
            echo json_encode($erros);
        } else {
            $input = $this->input->post();
            $this->load->model('int_ANC/M_insert');
            $retorno = $this->M_insert->cadastrarRefugo($input);
            echo json_encode($retorno);
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR OS DETALHES DO LANÇAMENTO//////////////////////////////////////////////////
    ///// CRIADO POR DANIEL                ///////////////////////////////////////////////////
    ///// 29/09/2022                       ///////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function psqNConforme()
    {
        // $nrodoc = $this->input->post('nrodoc');
        // $produto = $this->input->post('produto');
        // $tpdoc = $this->input->post('tpdoc');

        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->psqNConforme($nrodoc, $produto, $tpdoc);
        // echo json_encode($retorno);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O TIPO DE CODIGO COM O NOME DO CODIGO//////////////////////////////////////
    ///// CRIADO POR DANIEL                ///////////////////////////////////////////////////
    ///// 03/10/2022                       ///////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function BuscLocalCod()
    {
        // $nro = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->BuscLocalCod($nro);
        // echo json_encode($retorno);
    }

    public function alterarSaidaDefeito()
    {
        // $nro = $this->input->post();

        // if ($nro['sltipodoc'] == 'RR') {

        //     $this->load->library('form_validation');
        //     $this->form_validation->set_rules('txtDataLan', 'DATA LANÇAMENTO', 'required');
        //     $this->form_validation->set_rules('slNumeroAlmox', 'ALMOXARIFADO', 'required');
        //     $this->form_validation->set_rules('sltipodoc', 'TIPO DE DOC.', 'required');
        //     $this->form_validation->set_rules('txtProd', 'PRODUTO', 'required');
        //     $this->form_validation->set_rules('NumOS', 'N° OP', 'required');
        //     $this->form_validation->set_rules('txtOperacao', 'OPERAÇÃO', 'required');
        //     $this->form_validation->set_rules('txtSecao', 'SEÇÃO', 'required');
        //     $this->form_validation->set_rules('slCodrefugo', 'CÓDIGO DE REFUGO', 'required');
        //     $this->form_validation->set_rules('txtNMaquina', 'N° MAQUINA', 'required');
        //     $this->form_validation->set_rules('txtChapaOp', 'CHAPA OPERADOR', 'required');
        //     $this->form_validation->set_rules('txtCeCus', 'CENTRO CUSTO:', 'required');
        //     $this->form_validation->set_rules('numQtde', 'QTDE', 'required');
        //     if ($this->form_validation->run() == FALSE) {
        //         $erros = array(
        //             'mensagens' => validation_errors(),
        //             'cod' => 4
        //         );
        //         echo json_encode($erros);
        //     } else {
        //         $this->load->model('int_ANC/M_update');
        //         $retorno = $this->M_update->alterarSaidaDefeito($nro);
        //         echo json_encode($retorno);
        //     }
        // } else {

        //     $this->load->library('form_validation');
        //     $this->form_validation->set_rules('txtDataLan', 'DATA LANÇAMENTO', 'required');
        //     $this->form_validation->set_rules('slNumeroAlmox', 'ALMOXARIFADO', 'required');
        //     $this->form_validation->set_rules('sltipodoc', 'TIPO DE DOC.', 'required');
        //     $this->form_validation->set_rules('txtProd', 'PRODUTO', 'required');
        //     $this->form_validation->set_rules('NumOS', 'N° OP', 'required');
        //     $this->form_validation->set_rules('txtOperacao', 'OPERAÇÃO', 'required');
        //     $this->form_validation->set_rules('txtNMaquina', 'N° MAQUINA', 'required');
        //     $this->form_validation->set_rules('txtChapaOp', 'CHAPA OPERADOR', 'required');
        //     $this->form_validation->set_rules('txtCeCus', 'CENTRO CUSTO:', 'required');
        //     $this->form_validation->set_rules('numQtde', 'QTDE', 'required');
        //     if ($this->form_validation->run() == FALSE) {
        //         $erros = array(
        //             'mensagens' => validation_errors(),
        //             'cod' => 4
        //         );
        //         echo json_encode($erros);
        //     } else {
        //         $this->load->model('int_ANC/M_update');
        //         $retorno = $this->M_update->alterarSaidaDefeito($nro);
        //         echo json_encode($retorno);
        //     }
        // }
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    /////// Objetivo: LANÇAMENTO DE NÃO CONFORMIDADE  //////////////////////////////////////////
    /////// Criação: 06/10/2022                       //////////////////////////////////////////
    /////// Autor: DANIEL                             //////////////////////////////////////////
    /////// Revisado:                                 //////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    public function cadastrarDesvioConc()
    {
        // $this->load->library('form_validation');
        // $this->form_validation->set_rules('txtDataLan', 'DATA LANÇAMENTO', 'required');
        // $this->form_validation->set_rules('sltipodoc', 'TIPO DE DOC.', 'required');
        // $this->form_validation->set_rules('txtProd', 'PRODUTO', 'required');
        // $this->form_validation->set_rules('txtobservacao', 'OBSERVAÇÃO', 'required');
        // if ($this->form_validation->run() == FALSE) {
        //     $erros = array(
        //         'mensagens' => validation_errors(),
        //         'cod' => 7
        //     );
        //     echo json_encode($erros);
        // } else {
        //     $input = $this->input->post();
        //     $this->load->model('int_ANC/M_insert');
        //     $retorno = $this->M_insert->cadastrarDesvioConc($input);
        //     echo json_encode($retorno);
        // }
    }
}
