<div class="container-fluid">
    <h1 style="text-align: center; margin-top:70px;">RETRABALHO</h1>
    <!-- //////////////////////////////////////////////////////////////// -->
    <!-- ///////// Objetivo: TABELA PRINCIPAL                    //////// -->
    <!-- ///////// Criação: 18/10/2022                           //////// -->
    <!-- ///////// Autor: DANIEL                                 //////// -->
    <!-- ///////// Revisado:                                     //////// -->
    <!-- //////////////////////////////////////////////////////////////// -->
    <table id="tbl_Retrabalho" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-url="<?php echo base_url('/INT_ANC/AprovacaoRet/retornoRetrabalhos'); ?>">
        <thead>
            <tr>
                <th data-halign="center" data-align="center" data-field="dtmov" class="text-uppercase" data-sortable="true" data-formatter="dtRet">DATA DA BAIXA</th>
                <th data-halign="center" data-align="center" data-field="tpdoc" class="text-uppercase" data-formatter="tpdocFormt">TIPO DE DOCUMENTO</th>
                <th data-halign="center" data-align="center" data-field="nrodoc" class="text-uppercase">N° DOC</th>
                <th data-halign="center" data-align="center" data-field="produto" class="text-uppercase">PRODUTO</th>
                <th data-halign="center" data-align="center" data-field="ret_saldo" class="text-uppercase" data-formatter="editQtde">QUANTIDADE</th>
                <th data-halign="center" data-align="center" class="text-uppercase" data-field="nrodoc" data-formatter="obsfun">OPÕES</th>
            </tr>
        </thead>
    </table>
</div>

<!-- //////////////////////////////////////////////////////////////////// -->
<!-- ///////// Objetivo: MODAL PARA CADASTRO E EDIÇÃO DE DEFEITOS /////// -->
<!-- ///////// Criação: 21/02/2022                                /////// -->
<!-- ///////// Autor: DANIEL                                      /////// -->
<!-- ///////// Revisado:                                          /////// -->
<!-- //////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="cad_RetornaRet" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="htexto">CONTROLE DE SAÍDA DE RETRABALHO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmConRef">
                    <div class="row">
                        <div class="form-group col-3">
                            <label>DATA:</label>
                            <input type="text" class="form-control" id="txtDataLan" name="txtDataLan" placeholder="Ex: DD/MM/AAAA" data-date-format="DD/MM/YYYY" />
                        </div>
                        <div class="form-group col-9">
                            <label>ALMOXARIFADO DE SAIDA:</label>
                            <select class="form-control selectpicker" data-style="btn-dark" name="slNumeroAlmox" id="slNumeroAlmox">
                                <option value="">SELECIONE UM ALMOXARIFADO</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-8">
                            <label>TIPO DE DOC:</label>
                            <select class="form-control selectpicker" data-style="btn-dark" name="sltipodoc" id="sltipodoc" onchange="tipodoc(value)">
                                <option value="">SELECIONE</option>
                                <option value="RR">RR - RELATÓRIO DE REFUGO</option>
                                <option value="RET">RET - RETRABALHO</option>
                                <option value="DC">DC - DESVIO DE CONCESSÃO</option>
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>NÚMERO DO DOCUMENTO:</label>
                            <input type="number" class="form-control" id="txtNumeroDoc" name="txtNumeroDoc" onblur="validaNroDoc(value)" min="0" step="0" value="0" oninput="validity.valid||(value='');">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label>PRODUTO:</label>
                            <input type="text" class="form-control text-uppercase" id="txtProd" name="txtProd" onblur="buscaNProduto(value)">
                        </div>
                        <div class="form-group col-5">
                            <label>NOME DO PRODUTO:</label>
                            <input type="text" class="form-control" id="txtNomeProd" name="txtNomeProd" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>UNID. MED.:</label>
                            <input type="text" class="form-control text-uppercase" id="txtUniMed" name="txtUniMed" readonly>
                        </div>
                        <div class="form-group col-2">
                            <label>N° OP.:</label>
                            <input type="number" class="form-control" id="NumOS" name="NumOS" min="0" step="0" value="0" oninput="validity.valid||(value='');">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-3">
                            <label>OPERAÇÃO:</label>
                            <input type="text" class="form-control text-uppercase" id="txtOperacao" name="txtOperacao" maxlength="5">
                        </div>

                        <div class="form-group col-3">
                            <label>LOCAL:</label>
                            <select class="form-control text-uppercase selectpicker" data-style="btn-dark" name="txtSecao" id="txtSecao" onchange="slLocalRef(value)">
                                <option value="">SELECIONE</option>
                                <?php
                                foreach ($secao as $linha) {
                                ?>
                                    <option value="<?= $linha['local']; ?>"><?= $linha['local']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label>CÓDIGO DE NÃO CONFORMIDADE:</label>
                            <div>
                                <select class="form-control text-uppercase selectpicker" data-style="btn-dark text-uppercase" id="slCodrefugo" name="slCodrefugo">
                                    <option value="">SELECIONE</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-2">
                            <label>N° MAQUINA:</label>
                            <input type="number" class="form-control text-uppercase" id="txtNMaquina" name="txtNMaquina" min="0" step="0" oninput="validity.valid||(value='');">
                        </div>
                        <div class="form-group col-3">
                            <label>CHAPA DO RESPONSÁVEL:</label>
                            <input type="number" class="form-control" id="txtChapaOp" name="txtChapaOp" onblur="buscaNChapa(value);" min="0" step="0" oninput="validity.valid||(value='');">
                        </div>
                        <div class="form-group col-5">
                            <label>CENTRO CUSTO:</label>
                            <select id="txtCeCus" name="txtCeCus" data-width="100%" class="form-control text-uppercase selectpicker" data-style="btn-dark">
                                <option value="">SELECIONE</option>
                                <?php
                                foreach ($depto as $linha) {
                                ?>
                                    <option value="<?= $linha['depto']; ?>"><?= $linha['depto'] ?> - <?= $linha['cecus_descricao'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <label>QTDE:</label>
                            <input type="number" class="form-control text-uppercase" id="numQtde" name="numQtde" oninput="validity.valid||(value='');">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label>OBSERVAÇÃO:</label>
                            <textarea type="text" class="form-control text-uppercase" id="txtobservacao" name="txtobservacao" maxlength="255" onkeypress="blockEvent(event, this)"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label>SERVIÇO EXECUTADO:</label>
                            <textarea type="text" class="form-control text-uppercase" id="txtServExecute" name="txtServExecute" maxlength="255" onkeypress="blockEvent(event, this)"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label>QUANTIDADE A LIBERAR:</label>
                            <input type="text" class="form-control text-uppercase" id="QtdeLib" min="0" name="QtdeLib" onkeypress="return /[0-9]/i.test(event.key)" onkeyup="qtdeLibValida(value)" >
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer bg-dark text-white pb-1" id="btnCadastrar">
                <div class="form-group col-md-12">
                    <button type="button" class="btn btn-success btn-block" onclick="liberaSaldoRetrabalho()">LIBERAR SALDO</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function qtdeLibValida(value) {
        if (parseInt(value) > parseInt($('#numQtde').val())) {
            sweetAlert("Oops...", "O valor de QUANTIDADE A LIBERAR não pode ser maior que QTDE!", "info");
            $('#QtdeLib').val('');
        }
    }
    //////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: CARREGA ITENS ASSIM QUE A TELA É INICIADA  ////////////////             
    //////// Criação: 04/02/2022                              //////////////////// 
    //////// Autor: DANIEL                                    ////////////////////        
    //////// Revisado:                                        ////////////////////        
    //////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        CarregaItens()
    });

    //////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: CARREGA ITENS NA MODAL                 ////////////////////             
    //////// Criação: 04/02/2022                              //////////////////// 
    //////// Autor: DANIEL                                    ////////////////////        
    //////// Revisado:                                        ////////////////////        
    //////////////////////////////////////////////////////////////////////////////
    function CarregaItens() {
        $.ajax({
            url: base_url + "INT_ANC/ANC/BuscaAlmoxOrig",
            type: "POST",
            dataType: 'json',
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
            },
            success: function(result) {
                swal({
                    timer: 1,
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
                $('#txtSecao').attr('disabled', false);

                $('#slCodrefugo').prop('disabled', true);
                $('#slCodrefugo').selectpicker('refresh');

                $('#slNumeroAlmox').selectpicker('refresh');
                $('#slNumeroAlmox').html('');
                $('#slNumeroAlmox').append('<option value=""> SELECIONE </option>');

                $.each(result, function(index, value) {
                    $('#slNumeroAlmox').append('<option class="text-uppercase" value="' + value['almorig'] + '">' + value['almorig'] + ' - ' + value['descricao'] + '</option>').selectpicker('refresh');
                });
            },
        });
    }

    function tpdocFormt(value) {
        return 'RET - RETRABALHO';
    }

    function obsfun(nrodoc, row) {
        return '<button type="button" class="btn btn-outline-success" onclick="psqNConforme(\'' + nrodoc + '\',\'' + row.produto + '\',\'' + row.tpdoc + '\',\'' + row.ret_saldo + '\')">LIBERAR SALDO</button>';
    }
    //////////////////////////////////////////////////////////////////////////////
    ///////////////                EDITA DATA                       //////////////
    //////////////////////////////////////////////////////////////////////////////
    function dtRet(value) {
        return moment(value).format('L');
    }

    //////////////////////////////////////////////////////////////////////////////
    ///////////////          EDITA QUANTIDADE(TIRA O ".000")        //////////////
    //////////////////////////////////////////////////////////////////////////////
    function editQtde(value) {
        return parseInt(value);
    }

    //////////////////////////////////////////////////////////////////////////////////////////////
    ///////// VALIDA NÚMERO DO DOCUMENTO                             /////////////////////////////
    ///////// CRIADO POR DANIEL                                      /////////////////////////////
    ///////// 18/10/2022                                             /////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////
    function validaNroDoc(value) {
        $.ajax({
            url: base_url + "INT_ANC/ANC/validaNroDoc",
            type: "POST",
            dataType: 'json',
            data: {
                value: value
            },
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Validando...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
            },
            success: function(result) {

            },
        });
    }

    function psqNConforme(nrodoc, produto, tpdoc, ret_saldo) {
        limpar();
        $.ajax({
            url: base_url + "INT_ANC/ANC/psqNConforme",
            type: "POST",
            dataType: 'json',
            data: {
                nrodoc: nrodoc,
                produto: produto,
                tpdoc: tpdoc
            },
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
            },
            success: function(result) {
                console.log(result);
                //// ------------------------------------------------------------------------
                //// ISNERI OS VALORES NOS CAMPOS  QUANDO O USUARIO CLICAR NA LUPA DE EDIÇÃO. 
                $('#txtProd').val(result[0]['produto']);
                buscaNProduto(result[0]['produto']);
                var data = moment(result[0]['dtcria']).format('L');
                $('#txtDataLan').val(data);
                $('#txtNumeroDoc').val(result[0]['nrodoc']);
                $('#NumOS').val(result[0]['nroosu']);
                $('#txtOperacao').val(result[0]['codoperacao']);
                $('#txtNMaquina').val(result[0]['codmaqui']);
                $('#txtChapaOp').val(result[0]['operador']);
                $('#txtobservacao').val(result[0]['motivo']);
                $('#numQtde').val(parseFloat(ret_saldo).toFixed(0));

                // -------------------------------------------------------------
                //  RETIRA O BOTÃO SALVAR E COLOCAR O ALTERAR NO LUGAR 
                // -------------------------------------------------------------
                var tipoNumDocumento = result[0]['almorig'];

                $('#slNumeroAlmox').val(tipoNumDocumento);
                var tipoDocumento = result[0]['tpdoc'];
                $('#slNumeroAlmox').selectpicker('refresh');

                $('#sltipodoc').val(tipoDocumento);
                $('#sltipodoc').selectpicker('refresh');

                $('#txtCeCus').selectpicker('val', result[0]['codcc']);
                $('#txtCeCus').selectpicker('refresh');

                $('#slNumeroAlmox').selectpicker('refresh');
                $('#sltipodoc').selectpicker('refresh');
                $('#txtCeCus').selectpicker('refresh');
                // -------------------------------------------------------------
                if (result[0]['coddefeito'] == 0) {

                    $('#txtSecao').prop('disabled', true);
                    $('#txtSecao').selectpicker('refresh');

                    $('#slCodrefugo').prop('disabled', true);
                    $('#slCodrefugo').selectpicker('refresh');

                    $('#cad_RetornaRet').modal('show');

                } else {
                    $.ajax({
                        url: base_url + "INT_ANC/ANC/BuscLocalCod",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            value: result[0]['coddefeito']
                        },
                        beforeSend: function() {
                            swal({
                                title: "Aguarde!",
                                text: "Buscando dados...",
                                imageUrl: base_url + "../img/loading.gif",
                                showConfirmButton: false
                            });
                        },
                        error: function(data_error) {
                            sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
                        },
                        success: function(data) {
                            console.log(data);
                            $('#txtSecao').val(data[0]['local']);
                            $('#txtSecao').selectpicker('refresh');

                            slLocalRef(data[0]['local'], data[0]['id_defeitos']);

                            $('#numQtde').prop('disabled', true);

                            swal({
                                title: "Aguarde!",
                                text: "Buscando dados...",
                                imageUrl: base_url + "../img/loading.gif",
                                showConfirmButton: false
                            });
                            $('#cad_RetornaRet').modal('show');
                        },
                    });
                }

                $('#txtDataLan').prop('readonly', true);

                $('#txtNumeroDoc').prop('readonly', true);
                $('#txtProd').prop('readonly', true);
                $('#NumOS').prop('disabled', true);
                $('#numQtde').prop('disabled', true);

                $('#txtOperacao').prop('disabled', true);
                $('#txtNMaquina').prop('disabled', true);
                $('#txtChapaOp').prop('disabled', true);
                $('#txtobservacao').prop('disabled', true);

                $('#txtCeCus').prop('disabled', true);
                $('#txtCeCus').selectpicker('refresh');

                $('#slNumeroAlmox').prop('disabled', true);
                $('#slNumeroAlmox').selectpicker('refresh');

                $('#sltipodoc').prop('disabled', true);
                $('#sltipodoc').selectpicker('refresh');

            },
        });
    }

    //////////////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: BUSCA O NOME DO PRODUTO             ///////////////////////////////                 
    //////// Criação: 24/02/2022                           ///////////////////////////////             
    //////// Autor: DANIEL                                 ///////////////////////////////             
    //////// Revisado:                                     ///////////////////////////////             
    //////////////////////////////////////////////////////////////////////////////////////
    function buscaNProduto(value) {
        if (value == '') {
            sweetAlert("Atenção", "Campo do produto em branco!", "info");
        } else {
            $.ajax({
                url: base_url + "INT_ANC/ANC/buscaNProduto",
                type: "POST",
                dataType: 'json',
                data: {
                    value: value.replace(/-/g, "")
                },
                beforeSend: function() {
                    swal({
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });
                },
                error: function(data_error) {
                    sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
                },
                success: function(result) {
                    if (result == 0) {
                        sweetAlert("Atenção", "Produto não encontrado!", "info");
                    } else {
                        swal({
                            timer: 1,
                            title: "Aguarde!",
                            text: "Buscando dados...",
                            imageUrl: base_url + "../img/loading.gif",
                            showConfirmButton: false
                        });
                        $('#txtUniMed').val(result[0].prod_codunime);
                        $('#txtNomeProd').val(result[0].prod_descricao);
                    }
                },
            });
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: PARAMETRO SOLICITADO É A SEÇÃO, A FUNÇÃO DEVOLVE TODOS OS CÓDIGOS DE REFUGO ////                        
    //////// Criação: 24/02/2022                                                          /////////////
    //////// Autor: DANIEL                                                                /////////////
    //////// Revisado:                                                                    /////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    function slLocalRef(value, cod) {
        $.ajax({
            url: base_url + "INT_ANC/ANC/slLocalRef",
            type: "POST",
            dataType: 'json',
            data: {
                value: value
            },
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
            },
            success: function(result) {

                $('#slCodrefugo').prop('disabled', false);
                $('#slCodrefugo').selectpicker('refresh');
                $('#slCodrefugo').html('');
                $('#slCodrefugo').append('<option value=""> SELECIONE </option>');

                $.each(result, function(index, value) {
                    $('#slCodrefugo').append('<option class="text-uppercase" value="' + value.id_defeitos + '">' + value.cod_defeito + ' - ' + value.descricao + '</option>').selectpicker('refresh');
                })
                swal({
                    timer: 1000,
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });

                if (cod != '' || typeof(cod) != 'undefined') {
                    $('#slCodrefugo').val(cod);
                    $('#slCodrefugo').selectpicker('refresh');
                }
                $('#txtSecao').prop('disabled', true);
                $('#txtSecao').selectpicker('refresh');

                $('#slCodrefugo').prop('disabled', true);
                $('#slCodrefugo').selectpicker('refresh');
            },
        });
    }

    function limpar() {
        $('#frmConRef')[0].reset();
        $('#txtSecao').selectpicker('refresh');
        $('#slNumeroAlmox').selectpicker('refresh');
        $('#slCodrefugo').prop('disabled', true);
        $('#slCodrefugo').selectpicker('refresh');
        $('#slCodrefugo').html('');
        $('#slCodrefugo').append('<option value=""> SELECIONE </option>');
        $('#slNumeroAlmox').selectpicker('refresh');
        $('#sltipodoc').selectpicker('refresh');
        $('#txtmotivorefugo').val('');
        $("#txtCeCus").selectpicker('refresh');

        $('#txtSecao').prop('disabled', false);
        $('#txtSecao').selectpicker('refresh');

        $('#slCodrefugo').prop('disabled', false);
        $('#slCodrefugo').selectpicker('refresh');

        $('#slNumeroAlmox').prop('disabled', false);
        $('#slNumeroAlmox').selectpicker('refresh');

        $('#txtCeCus').prop('disabled', false);
        $('#txtCeCus').selectpicker('refresh');

        $('#NumOS').prop('disabled', false);
        $('#txtNMaquina').prop('disabled', false);
        $('#txtChapaOp').prop('disabled', false);
        $('#txtCeCus').prop('disabled', false);
        $('#numQtde').prop('disabled', false);
        $('#txtOperacao').prop('disabled', false);
    }

    function blockEvent(e) {
        if (e.which == 13) {
            e.preventDefault();
        }
    }

    function liberaSaldoRetrabalho() {
        if ($('#txtServExecute').val() == '') {
            sweetAlert("Atenção", "Valor invalido no campo 'SERVIÇO EXECUTADO'!", "info");
        } else if ($('#QtdeLib').val() == '' || $('#QtdeLib').val() == 0) {
            sweetAlert("Atenção", "Valor invalido no campo 'QUANTIDADE A LIBERAR'!", "info");
        } else {

            $('#txtSecao').prop('disabled', false);
            $('#txtSecao').selectpicker('refresh');

            $('#slCodrefugo').prop('disabled', false);
            $('#slCodrefugo').selectpicker('refresh');

            $('#slNumeroAlmox').prop('disabled', false);
            $('#slNumeroAlmox').selectpicker('refresh');

            $('#txtCeCus').prop('disabled', false);
            $('#txtCeCus').selectpicker('refresh');

            $('#sltipodoc').prop('disabled', false);
            $('#sltipodoc').selectpicker('refresh');

            $('#NumOS').prop('disabled', false);
            $('#txtNMaquina').prop('disabled', false);
            $('#txtChapaOp').prop('disabled', false);
            $('#txtCeCus').prop('disabled', false);
            $('#numQtde').prop('disabled', false);
            $('#txtOperacao').prop('disabled', false);

            $('#txtNumeroDoc').prop('readonly', false);
            $('#txtProd').prop('readonly', false);
            $('#txtobservacao').prop('disabled', false);

            $.ajax({
                url: base_url + "INT_ANC/AprovacaoRet/liberaSaldoRetrabalho",
                type: "POST",
                dataType: 'json',
                data: $('#frmConRef').serialize(),
                beforeSend: function() {
                    swal({
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });
                },
                error: function(data_error) {
                    sweetAlert("Atenção...", "Aguarde...!", "info");
                    camposOrig();
                },
                success: function(result) {
                    camposOrig()
                    console.log(result);

                    if (result.cod == 1) {
                        $("#tbl_Retrabalho").bootstrapTable('refresh');
                        sweetAlert('OK!', '' + result.mensagens + '', 'success');
                        $('#cad_RetornaRet').modal('hide');
                    } else if (result.cod == 2) {
                        sweetAlert('Oops...!', '' + result.mensagens + '', 'info');
                    }
                    camposOrig();
                },
            });
        }
    }

    function camposOrig() {
        $('#txtSecao').prop('disabled', true);
        $('#txtSecao').selectpicker('refresh');

        $('#slCodrefugo').prop('disabled', true);
        $('#slCodrefugo').selectpicker('refresh');

        $('#slNumeroAlmox').prop('disabled', true);
        $('#slNumeroAlmox').selectpicker('refresh');

        $('#txtCeCus').prop('disabled', true);
        $('#txtCeCus').selectpicker('refresh');

        $('#sltipodoc').prop('disabled', true);
        $('#sltipodoc').selectpicker('refresh');

        $('#NumOS').prop('disabled', true);
        $('#txtNMaquina').prop('disabled', true);
        $('#txtChapaOp').prop('disabled', true);
        $('#txtCeCus').prop('disabled', true);
        $('#numQtde').prop('disabled', true);
        $('#txtOperacao').prop('disabled', true);

        $('#txtNumeroDoc').prop('readonly', true);
        $('#txtProd').prop('readonly', true);
        $('#txtobservacao').prop('disabled', true);
    }
</script>