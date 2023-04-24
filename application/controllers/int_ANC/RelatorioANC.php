<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RelatorioANC extends CI_Controller
{
    public function index()
    {
        $this->load->model('int_ANC/M_retorno');
        $acesso['acesso'] = $this->M_home->carrega_acesso_bs4();
        ////////////////////////////////////////////////////////////////////////////////////////
        ////// RETORNAR TODOS CENTRO DE CUSTO, CRIADO POR DANIEL, 31/03/2022     ///////////////
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['depto'] = $this->M_retorno->ret_depto(1);
        ////////////////////////////////////////////////////////////////////////////////////////
        // RETORNAR LISTA DOS ALMOXARIFADOS QUE JÁ FIZERAM RR, CRIADO POR DANIEL, 04/03/2022 ///
        ////////////////////////////////////////////////////////////////////////////////////////
        // $retorno['almoxOrig'] = $this->M_retorno->BuscaAlmoxOrig();
        // $this->load->view('includes/bs4/header');
        // $this->load->view('includes/bs4/submenu',  $acesso);
        // $this->load->view('int_ANC/v_relatorioANC', $retorno);
        $this->load->view('int_ANC/v_relatorioANC');
        // $this->load->view('includes/bs4/footer');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O NOME DO PRODUTO E A UNIDADE MEDIA ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 24/02/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function slLocalRef()
    {
        // $value = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->slLocalRef($value);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR O NOME DO PRODUTO E A UNIDADE MEDIA ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 24/02/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function slLocalRef2()
    {
        // $value = $this->input->post('value');
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->slLocalRef2($value);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR TABELA PRINCIPAL                    ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 24/02/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function ret_consulta()
    {
        // $input = $this->input->post();
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->ret_consulta($input);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// RETORNAR TABELA NA MODAL                     ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 10/10/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function retCons()
    {
        // $input = $this->input->post();
        // $this->load->model('int_ANC/M_retorno');
        // $retorno = $this->M_retorno->retCons($input);
        // echo json_encode($retorno);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// EXPORTA O EXCEL                              ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 14/04/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function exportExcel()
    {
        set_time_limit(99999999);
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 99999999);

        $tabela = json_decode($this->input->post('dados'));

        $this->load->library('PHPExcel');
        $inputFileName = './application/views/int_ANC/planilhas/RelatorioRefugo.xlsx';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($inputFileName);
        $linha = 7;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T2', 'DATA : ' . dataServ())->getStyle('H2')->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T5',  'HORA : ' . horaServ())->getStyle('H5')->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(21);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(36);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(22);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(43);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(14);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(30);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(22);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(52);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(15);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(53);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(23);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(18);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth(17);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth(17);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('S')->setWidth(17);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('T')->setWidth(57);

        foreach ($tabela as $campo) {

            if ($campo->ecdal_codalm < 100) {
                $planta = 'MATRIZ';
            } else if ($campo->ecdal_codalm > 100 && $campo->ecdal_codalm < 199) {
                $planta = "FILIAL 2";
            } else {
                $planta = "FILIAL 3";
            }

            $centrocusto = explode("-", $campo->descricaocusto);

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $linha, formatarData($campo->dtmov));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $linha, $campo->produto);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $linha, $campo->prod_descricao);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $linha, $campo->prod_codunime);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $linha, $campo->nrodoc);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $linha, $campo->ecdal_codalm);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $linha, $campo->ecdal_descricao);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $linha, $planta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $linha, $campo->local);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $linha, $centrocusto[0]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . $linha, $centrocusto[1]);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $linha, $campo->cod_defeito);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . $linha, $campo->descricao);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . $linha, $campo->operador);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P' . $linha, $campo->codoperacao);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q' . $linha, $campo->codmaqui);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R' . $linha, $campo->nroosu);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S' . $linha, $campo->qtde);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T' . $linha, mb_strtoupper($campo->motivo));

            $linha++;

            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                ),
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'name' => 'Tahoma'
            );
            $center = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );
            $left = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );
            $right = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                )
            );

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B6:T' . ($linha - 1))->applyFromArray($styleArray);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('C' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('E' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('F' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('G' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('H' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('I' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('J' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('K' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('L' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('M' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('N' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('O' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('P' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('Q' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('R' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('S' . ($linha - 1))->applyFromArray($right);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('T' . ($linha - 1))->applyFromArray($left);
        }

        $docname = "RelatorioDeNaoConformidade - " . date('d') . '-' . date('M') . '-' . date('Y') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $docname . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///// EXPORTA O EXCEL DE LANÇAMENTO DE CONCESSÃO   ////////////////////////////////////////
    ///// CRIADO POR DANIEL                            ////////////////////////////////////////
    ///// 14/04/2022                                   ////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function ExcelDesvioConC()
    {
        set_time_limit(99999999);
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 99999999);

        $tabela = json_decode($this->input->post('dados'));
  
        $this->load->library('PHPExcel');
        $inputFileName = './application/views/int_ANC/planilhas/Relatorio_DesvioConcessao.xlsx';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($inputFileName);
        $linha = 7;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', 'DATA : ' . dataServ())->getStyle('H2')->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J5',  'HORA : ' . horaServ())->getStyle('H5')->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(21);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(16);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(36);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setWidth(22);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(60);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(14);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(14);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setWidth(15);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setWidth(65);

        foreach ($tabela as $campo) {

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $linha, formatarData($campo->dtmov));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $linha, $campo->produto);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $linha, $campo->prod_descricao);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $linha, $campo->prod_codunime);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $linha, $campo->funcionario);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $linha, $campo->seq);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $linha, $campo->numos);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $linha, $campo->qtde);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $linha, mb_strtoupper($campo->motivo));

            $linha++;

            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                ),
                'alignment' => array(
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ),
                'name' => 'Tahoma'
            );
            $center = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );
            $left = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                )
            );
            $right = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
                )
            );

            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B6:J' . ($linha - 1))->applyFromArray($styleArray);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('C' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('E' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('F' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('G' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('H' . ($linha - 1))->applyFromArray($center);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('I' . ($linha - 1))->applyFromArray($left);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('J' . ($linha - 1))->applyFromArray($left);
        }

        $docname = "Relatorio_DesvioConcessao - " . date('d') . '-' . date('M') . '-' . date('Y') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $docname . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}
