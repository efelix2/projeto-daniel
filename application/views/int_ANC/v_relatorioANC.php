<!--/////////////////////////////////////////////////-->
<!--//// FOLHA DE ESTILO               //////////////-->
<!--//// CRIADO POR DANIEL             //////////////-->
<!--//// DATA: 06/04/2022              //////////////-->
<!--/////////////////////////////////////////////////-->
<style>
    th {
        font-size: 13px;
    }

    td {
        font-size: 11px;
    }

    body {
        overflow-x: scroll;
    }
</style>

<!--/////////////////////////////////////////////////////////////-->
<!--//// TABELA DE REQUISIÇÃO DE PESSOAL                    /////-->
<!--//// CRIADO POR MAURICIO RIBEIRO E MARCIO SILVA         /////-->
<!--//// 04/04/2022                                         /////-->
<!--/////////////////////////////////////////////////////////////-->
<div class="container-fluid pt-2 p-1">
    <div class="card mb-2">
        <div class="card-header bg-dark text-white">RELATÓRIO DE NÃO CONFORMIDADE</div>
        <div class="card-body pb-0">
            <form id="RelatorioRefugo">
                <div class="form-group row">
                    <div class="form-group col-3">
                        <label>ALMOXARIFADO:</label>
                        <select class="form-control selectpicker" data-style="btn-dark text-uppercase" name="slNumeroAlmox[]" id="slNumeroAlmox" multiple data-actions-box="true">
                            <option disabled="disabled" value="">SELECIONE UM ALMOXARIFADO</option>
                            <?php
                            foreach ($almoxOrig as $linha) {
                            ?>
                                <option value="<?= $linha['almorig']; ?>"><?= $linha['almorig'] . ' - ' . $linha['descricao']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label>LOCAL:</label>
                        <select class="form-control selectpicker" data-style="btn-dark text-uppercase" name="slLocal[]" id="slLocal" multiple data-actions-box="true" onchange="slLocalRef(value)">
                            <option value="FORJARIA">FORJARIA</option>
                            <option value="FUNDIÇÃO">FUNDIÇÃO</option>
                            <option value="TRATAMENTO TÉRMICO">TRATAMENTO TÉRMICO</option>
                            <option value="USINAGEM GERAL">USINAGEM GERAL</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label>CÓDIGO DE REFUGO:</label>
                        <select class="form-control text-uppercase selectpicker" data-style="btn-dark text-uppercase" multiple data-actions-box="true" id="slCodrefugo" name="slCodrefugo[]">
                            <option value="">SELECIONE</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label>TIPO DE DOC:</label>
                        <select class="form-control selectpicker" data-style="btn-dark text-uppercase" name="sltipodoc[]" id="sltipodoc" multiple data-actions-box="true">
                            <option value="RR">RR - RELATÓRIO DE REFUGO</option>
                            <option value="RET">RET - RETRABALHO</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-4">
                        <label>PRODUTO:</label>
                        <input type="text" class="form-control text-uppercase" id="txtProd" name="txtProd">
                    </div>
                    <div class="form-group col-3">
                        <label>O.S.:</label>
                        <input type="number" class="form-control" id="txtOS" name="txtOS" min="0" step="0">
                    </div>
                    <div class="form-group col-3">
                        <label>OPERAÇÃO:</label>
                        <input type="text" class="form-control" id="txtOperacao" name="txtOperacao" min="0" step="0">
                    </div>
                    <div class="form-group col-2">
                        <label>Nº DOCUMENTO:</label>
                        <input type="number" class="form-control" id="txtNDocumento" name="txtNDocumento" min="0" step="0">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-2 pt-1">
                        <label>DATA INICIAL</label>
                        <input type="text" class="form-control text-center" id="txtdatainicial" name="txtdatainicial" value="<?= date('d/m/Y') ?>">
                    </div>
                    <div class="form-group col-2 pt-1">
                        <label>DATA FINAL</label>
                        <input type="text" class="form-control text-center" id="txtdatafinal" name="txtdatafinal" value="<?= date('d/m/Y') ?>">
                    </div>
                    <div class="form-group col-2 pt-1">
                        <label>CH. OPERADOR</label>
                        <input type="text" class="form-control" id="txtchapaOperador" name="txtchapaOperador">
                    </div>
                    <div class="form-group col-2 pt-1">
                        <label>CENTRO CUSTO:</label>
                        <select id="slCeCus" name="slCeCus[]" data-width="100%" class="form-control text-uppercase selectpicker" multiple data-actions-box="true" data-style="btn-dark text-uppercase">
                            <?php
                            foreach ($depto as $linha) {
                            ?>
                                <option value="<?= $linha['depto']; ?>"><?= $linha['depto'] ?> - <?= $linha['cecus_descricao'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Nº MÁQUINA:</label>
                        <input type="number" class="form-control" id="txtNMquina" name="txtNMquina" min="0" step="0">
                    </div>

                    <div class="form-group col-2 mt-4">
                        <button type="button" class="btn btn-block btn-dark p-2 m-1" onclick="ret_consulta()">BUSCAR</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane show active" role="tabpanel" aria-labelledby="home-tab">
            <div class="col-12 p-0">
                <div id="toolbar">
                    <button class="btn btn-success" onclick="exportExcel()"><i class="fas fa-file-excel "></i> EXPORTAR EXCEL</button>
                    <button class="btn btn-warning" data-toggle="modal" onclick="modalBuscaDesvio()">DESVIO DE CONCESSÃO</button>
                </div>
                <!-- //////////////////////////////////////////////////////////////// -->
                <!-- ///////// Objetivo: TABELA PRINCIPAL                    //////// -->
                <!-- ///////// Criação: 04/04/2022                           //////// -->
                <!-- ///////// Autor: DANIEL                                 //////// -->
                <!-- ///////// Revisado:                                     //////// -->
                <!-- //////////////////////////////////////////////////////////////// -->
                <table id="tbl_registroRef" data-toggle="table" data-toolbar="#toolbar" data-show-fullscreen="true" data-search="true" data-show-columns-toggle-all="true" data-show-export="true" data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <th class="col-1" data-halign="center" data-align="center" data-field="dtmov" class="text-uppercase" data-formatter="mes" data-sortable="true">DATA DA BAIXA</th>
                        <th class="col-1" data-halign="center" data-align="center" data-field="produto" class="text-uppercase" data-sortable="true">PROD.</th>
                        <th class="col-1" data-halign="center" data-align="center" data-field="prod_descricao" class="text-uppercase" data-sortable="true">PROD. DESC.</th>
                        <th class="col-1" data-halign="center" data-align="center" data-field="prod_codunime" class="text-uppercase" data-sortable="true">UNI. MED.</th>
                        <th class="col-1" data-halign="center" data-align="right" data-field="nrodoc" class="text-uppercase" data-sortable="true">Nº DOC.</th>
                        <th data-halign="center" data-align="center" data-field="tpdoc" class="text-uppercase" data-formatter="nomeTipoDoc">TIPO DE DOC.</th>
                        <th class="col-2" data-halign="center" data-align="left" data-field="ecdal_codalm" class="text-uppercase" data-formatter="Alm" data-sortable="true">ALMOXARIFADO</th>
                        <th class="col-1" data-halign="center" data-align="center" data-field="ecdal_codalm" class="text-uppercase" data-formatter="Planta" data-sortable="true">PLANTA</th>
                        <th class="col-1" data-halign="center" data-align="left" data-field="local" class="text-uppercase" data-sortable="true">LOCAL</th>
                        <th class="col-2" data-halign="center" data-align="left" data-field="descricaocusto" class="text-uppercase" data-sortable="true">CENTRO DE CUSTO</th>
                        <th class="col-1" data-halign="center" data-align="center" data-field="cod_defeito" class="text-uppercase" data-sortable="true">CÓD.</th>
                        <th class="col-1" data-halign="center" data-align="left" data-field="descricao" class="text-uppercase" data-sortable="true">DESC. DEFEITO</th>
                        <th class="col-1" data-halign="center" data-align="left" data-field="operador" class="text-uppercase" data-sortable="true">CHAPA OP.</th>
                        <th class="col-1" data-halign="center" data-align="right" data-field="codoperacao" class="text-uppercase" data-sortable="true">OPERAÇÃO</th>
                        <th class="col-1" data-halign="center" data-align="right" data-field="codmaqui" class="text-uppercase" data-sortable="true">MÁQ.</th>
                        <th class="col-1" data-halign="center" data-align="right" data-field="nroosu" class="text-uppercase" data-sortable="true">O.S.</th>
                        <th class="col-1 d-none" data-halign="center" data-align="right" data-field="motivo" class="text-uppercase" data-sortable="true">MOTIVO</th>
                        <th class="col-1" data-halign="center" data-align="right" data-field="qtde" class="text-uppercase" data-formatter="editQtde" data-sortable="true">QTDE.</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal de desvio de concessão -->
<div class="modal fade bd-example-modal-xl" id="Busc_DesConc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">LANÇAMENTOS DE DESVIO DE CONCESSÃO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="ModalDesvConc">
                    <div class="row">
                        <div class="form-group col-2 pt-1">
                            <label>DATA INICIAL:</label>
                            <input type="text" class="form-control text-center" id="txtdatainicial" name="txtdatainicial" value="<?= date('d/m/Y') ?>">
                        </div>
                        <div class="form-group col-2 pt-1">
                            <label>DATA FINAL:</label>
                            <input type="text" class="form-control text-center" id="txtdatafinal" name="txtdatafinal" value="<?= date('d/m/Y') ?>">
                        </div>
                        <div class="form-group col-2 pt-1">
                            <label>NÚM. DOC.:</label>
                            <input type="number" class="form-control" id="txtNumDoc" name="txtNumDoc" min="0" step="0">
                        </div>
                        <div class="form-group col-4 pt-1">
                            <label>PRODUTO:</label>
                            <input type="text" class="form-control  text-uppercase" id="txtPRodDC" name="txtPRodDC">
                        </div>
                        <div class="form-group col-2 pt-1">
                            <label>OP:</label>
                            <input type="number" class="form-control" id="txtOrdemProd" name="txtOrdemProd" min="0" step="0">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-6 pt-1">
                            <button type="button" class="btn btn-outline-danger btn-block p-2 m-1" onclick="retLimp()">LIMPAR</button>
                        </div>
                        <div class="form-group col-6 pt-1">
                            <button type="button" class="btn btn-outline-success btn-block p-2 m-1" onclick="retCons()">BUSCAR</button>
                        </div>
                    </div>
                </form>

                <div id="toolbar1">
                    <button class="btn btn-success" onclick="ExcelDesvioConC()"><i class="fas fa-file-excel "></i> EXPORTAR EXCEL</button>
                </div>
                <table id="DesvioConces" data-toggle="table" data-toolbar="#toolbar1" data-show-export="true" class="table" data-show-columns-toggle-all="true" data-pagination="true" data-search="true">
                    <thead>
                        <tr>
                            <th class="caixa_alta m-2 " data-halign="center" data-align="center" data-field="produto">PRODUTO</th>
                            <th class="caixa_alta text-uppercase" data-align="light" data-halign="center" data-field="dtmov" data-formatter="dtDesvConc">DATA</th>
                            <th class="caixa_alta" data-align="center" data-halign="center" data-field="tpdoc" data-formatter="tipoDC">TIPO DE DOCUMENTO</th>
                            <th class="caixa_alta" data-halign="center" data-align="center" data-field="nrodoc">CHAPA</th>
                            <th class="caixa_alta" data-halign="center" data-align="center" data-field="qtde">QUANTIDADE</th>
                            <th class="caixa_alta" data-halign="center" data-align="center" data-field="numos">OP</th>
                            <th class="caixa_alta" data-align="center" data-halign="center" data-field="seq">N° DOC</th>
                            <th class="caixa_alta" data-halign="center" data-align="left" data-field="motivo" data-formatter="ObsMotiv">MOTIVO</th>
                            <th class="caixa_alta d-none" data-field="funcionario"></th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    function tipoDC(value) {
        return 'DC - DESVIO DE CONCESSÃO';
    }

    function ObsMotiv(value) {
        return value.toUpperCase();
    }

    function nomeTipoDoc(value) {
        if (value == 'RR') {
            return 'RELATÓRIO DE REFUGO';
        } else {
            return 'RETRABALHO';
        }
    }

    function dtDesvConc(value) {
        return moment(value).format('L');
    }

    function modalBuscaDesvio() {
        $('#Busc_DesConc').modal('show');
    }

    function retCons() {
        $.ajax({
            url: base_url + "INT_ANC/RelatorioANC/retCons",
            type: "POST",
            dataType: 'json',
            data: $('#ModalDesvConc').serialize(),
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Erro ao buscar os dados!", "error");
            },
            success: function(result) {
                if (result == 0) {
                    sweetAlert("Atenção", "Nada encontrado!", "info");
                } else {
                    swal({
                        timer: 1,
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });
                    $("#DesvioConces").bootstrapTable('removeAll');
                    $("#DesvioConces").bootstrapTable('append', result);
                }
            },
        });
    }

    function exportExcel() {
        var dados = {
            dados: JSON.stringify($('#tbl_registroRef').bootstrapTable('getData')),
        };

        if (dados['dados'].length > 2) {
            post(base_url + 'INT_ANC/RelatorioANC/exportExcel', dados);
            swal.close();
        } else {
            swal({
                title: "Atenção!",
                text: 'Tabela sem informações.',
                type: "info"
            });
        }
    }

    function ExcelDesvioConC() {
        var dados = {
            dados: JSON.stringify($('#DesvioConces').bootstrapTable('getData')),
        };

        if (dados['dados'].length > 2) {

            post(base_url + 'INT_ANC/RelatorioANC/ExcelDesvioConC', dados);
            swal.close();

        } else {
            swal({
                title: "Atenção!",
                text: 'Tabela sem informações.',
                type: "info"
            });
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    //////// EXIBI A PLANTA ONDE FOI FEITO O REFUGO, CRIADO POR DANIEL, 11/04/2022 /////////
    ////////////////////////////////////////////////////////////////////////////////////////
    function Planta(value) {
        if (value < 100) {
            return 'MATRIZ';
        } else if (value > 100 && value < 199) {
            return "FILIAL";
        } else {
            return "FILIAL 3";
        }
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    ////// RETIRA TODOS OS VALORES DEPOIS DA VIRGULA, CRIADO POR DANIEL, 06/04/2022 ////////
    ////////////////////////////////////////////////////////////////////////////////////////
    function editQtde(value) {
        return parseInt(value);
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    //////////// COLOCA NOME NO ALMOXARIFADO, CRIADO POR DANIEL, 06/04/2022 ////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    function Alm(value, row) {
        return value + ' - ' + row.ecdal_descricao;
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////// FORMATA MÊS, CRIADO POR DANIEL, 06/04/2022 ///////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    function mes(value) {
        return moment(value).format('L');
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////// ALTERA CAMPO PARA DATA, CRIADO POR DANIEL, 05/04/2022  //////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    jQuery('#txtdatainicial').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'pt-br',
        maxDate: new Date(),
        icons: {
            previous: 'fa fa-chevron-left text-info',
            next: 'fa fa-chevron-right text-info',
        }
    });

    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////// ALTERA CAMPO PARA DATA, CRIADO POR DANIEL, 05/04/2022  //////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    jQuery('#txtdatafinal').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'pt-br',
        maxDate: new Date(),
        icons: {
            previous: 'fa fa-chevron-left text-info',
            next: 'fa fa-chevron-right text-info',
        }
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: PARAMETRO SOLICITADO É A SEÇÃO, A FUNÇÃO DEVOLVE TODOS OS CÓDIGOS DE REFUGO ////
    //////// Criação: 04/04/2022                                                          /////////////
    //////// Autor: DANIEL                                                                /////////////
    //////// Revisado:                                                                    /////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    function slLocalRef(value) {

        if (value == '') {
            $('#slCodrefugo').prop('disabled', false);
            $('#slCodrefugo').selectpicker('refresh');
            $('#slCodrefugo').html('');
        }
        $.ajax({
            url: base_url + "INT_ANC/RelatorioANC/slLocalRef2",
            type: "POST",
            dataType: 'json',
            data: {
                value: $('#slLocal').val()
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
                sweetAlert("Oops...", "Erro ao buscar os dados!", "error");
            },
            success: function(result) {
                if (result == 0) {
                    $('#slCodrefugo').prop('disabled', false);
                    $('#slCodrefugo').selectpicker('refresh');
                    $('#slCodrefugo').html('');
                    swal({
                        timer: 1,
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });
                } else {
                    swal({
                        timer: 1,
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });
                    $('#slCodrefugo').prop('disabled', false);
                    $('#slCodrefugo').selectpicker('refresh');
                    $('#slCodrefugo').html('');
                    $('#slCodrefugo').append('<option value=""> SELECIONE </option>');

                    $.each(result, function(index, value) {
                        $('#slCodrefugo').append('<option class="text-uppercase" value="' + value.id_defeitos + '">' + value.cod_defeito + ' - ' + value.descricao + '</option>').selectpicker('refresh');
                    })
                }
            },
        });
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////
    //////// Objetivo: EFETUAR A CONSULTA PARA RELATÓRIO                                   /////////////
    //////// Criação: 05/04/2022                                                          /////////////
    //////// Autor: DANIEL                                                                /////////////
    //////// Revisado:                                                                    /////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    function ret_consulta() {
        $.ajax({
            url: base_url + "INT_ANC/RelatorioANC/ret_consulta",
            type: "POST",
            dataType: 'json',
            data: $('#RelatorioRefugo').serialize(),
            beforeSend: function() {
                swal({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: base_url + "../img/loading.gif",
                    showConfirmButton: false
                });
            },
            error: function(data_error) {
                sweetAlert("Oops...", "Erro ao buscar os dados!", "error");
            },
            success: function(result) {
                if (result == 0) {
                    sweetAlert("Atenção", "Nada encontrado!", "info");
                } else {
                    swal({
                        timer: 1000,
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: base_url + "../img/loading.gif",
                        showConfirmButton: false
                    });

                    $("#tbl_registroRef").bootstrapTable('removeAll');
                    $("#tbl_registroRef").bootstrapTable('append', result);
                }
            },
        });
    }
</script>