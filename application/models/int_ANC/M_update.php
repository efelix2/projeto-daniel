<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_update extends CI_Model
{
    ///////////////////////////////////////////////////////////////////////////////////////////
    ///////// Objetivo: EDITA A DESCRIÇÃO DO CÓDIGO DE DEFEITOS     ///////////////////////////
    ///////// Criação: 22/02/2022                                   ///////////////////////////
    ///////// Autor: DANIEL                                         ///////////////////////////
    ///////// Revisado:                                             ///////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function editarCodDef($input)
    {
        $descricao = strtoupper(utf8_decode($input['txtDescricao']));

        $db = $this->load->database(getAmbiente(), TRUE);
        $db->trans_begin();
        $sql = "UPDATE defeitos SET descricao = '$descricao' WHERE id_defeitos = '$input[ipt_id_alterar]'";

        $db->query($sql);

        if ($db->trans_status() === FALSE) {
            $db->trans_rollback();
            return array(
                "cod" => 2,
                "mensagens" => 'ERRO AO ALTERAR O DADOS',
            );
        } else {
            $db->trans_commit();
            return array(
                "cod" => 1,
                "mensagens" => 'DADOS ALTERADOS COM SUCESSO',
            );
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////
    ///////// Objetivo: EXCLUI CÓDIGO DE  DEFEITOS          ///////////////////////////////////
    ///////// Criação: 22/02/2022                           ///////////////////////////////////
    ///////// Autor: DANIEL                                 ///////////////////////////////////
    ///////// Revisado:                                     ///////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function excluirItem($codDefeitos)
    {
        $db = $this->load->database(getAmbiente(), TRUE);
        $db->trans_begin();
        $sql = "UPDATE defeitos SET estatus = 'D' WHERE id_defeitos = '$codDefeitos'";

        $db->query($sql);

        if ($db->trans_status() === FALSE) {
            $db->trans_rollback();
            return array(
                "cod" => 2,
                "mensagens" => 'ERRO AO DELETAR O DADOS',
            );
        } else {
            $db->trans_commit();
            return array(
                "cod" => 1,
                "mensagens" => 'DELETADO COM SUCESSO',
            );
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////
    ///////// Objetivo: EDITA ITENS DA CONTROLE DE SAIDE DE NÃO CONFORMIDADE  /////////////////
    ///////// Criação: 04/09/2022                                   ///////////////////////////
    ///////// Autor: DANIEL                                         ///////////////////////////
    ///////// Revisado:                                             ///////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    public function alterarSaidaDefeito($input)
    {
        if (isset($input['slCodrefugo']) == true && $input['slCodrefugo'] != '') {
            $input['slCodrefugo'] = $input['slCodrefugo'];
        } else {
            $input['slCodrefugo'] = 0;
        }

        $db = $this->load->database(getAmbiente(), TRUE);
        ////////////////////////////////////////////////////////////////////////////////////////////
        ///////// Busca data do fechamento do almoxarifado, para não permitir data anterior. ///////
        ////////////////////////////////////////////////////////////////////////////////////////////
        $sqlFecha = "SELECT ECDAL_CODALM,ECDAL_DTFECHMTO FROM ECDAL WHERE ECDAL_CODALM = '$input[slNumeroAlmox]'";
        $retSqlFecha = $db->query($sqlFecha);

        $txtData = $input['txtDataLan'];
        $dataLan = str_replace('-', '', dataInvertida($txtData));

        if ($dataLan < $retSqlFecha->row()->ecdal_dtfechmto) {
            return array(
                "cod" => 3,
                "mensagens" => "Atenção, Data invalida, almoxarifado fechado."
            );
        } else {

            $db->trans_begin();

            $sql = "UPDATE MOVFABR
                       SET CODOPERACAO = $input[txtOperacao],
                           CODDEFEITO = $input[slCodrefugo],
                           CODMAQUI = $input[txtNMaquina],
                           OPERADOR = $input[txtChapaOp],
                           CODCC = $input[txtCeCus]
                     WHERE PRODUTO = '$input[txtProd]'
                       AND ALMORIG = $input[slNumeroAlmox]
                       AND NRODOC = $input[txtNumeroDoc]
                       AND TPDOC = '$input[sltipodoc]'
                       AND DTMOV = '$input[txtDataLan]'";

            $db->query($sql);

            if ($db->trans_status() === FALSE) {
                $db->trans_rollback();
                return array(
                    "cod" => 2,
                    "mensagens" => 'ERRO AO ALTERAR O DADOS',
                );
            } else {

                // $input['txtobservacao'] = utf8_decode( str_replace("'", 'ü', $input['txtobservacao']);
                $input['txtobservacao'] = utf8_decode($input['txtobservacao']);
                $sql1 = "UPDATE ESTMOT
                           SET MOTIVO = '$input[txtobservacao]'
                         WHERE PRODUTO = '$input[txtProd]'
                           AND NRODOC = $input[txtNumeroDoc]
                           AND TPDOC = '$input[sltipodoc]'
                           AND DTMOV = '$input[txtDataLan]'";

                $db->query($sql1);

                if ($db->trans_status() === FALSE) {
                    $db->trans_rollback();
                    return array(
                        "cod" => 2,
                        "mensagens" => 'ERRO AO ALTERAR O DADOS',
                    );
                } else {
                    $db->trans_commit();
                    return array(
                        "cod" => 1,
                        "mensagens" => 'DADOS ALTERADOS COM SUCESSO',
                    );
                }
            }
        }
    }
}
