<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

$condicaoAcessarOK = true;
$condicaoGravarOK = true;
$condicaoExcluirOK = true;

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}

$esconderBtnExcluir = "";
if ($condicaoExcluirOK === false) {
    $esconderBtnExcluir = "none";
}
$esconderBtnGravar = "";
if ($condicaoGravarOK === false) {
    $esconderBtnGravar = "none";
}

/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Grupo";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav['configuracao']['sub']["grupo"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Tabela Básica"] = "";
    include("inc/ribbon.php");
    ?>

    <!-- MAIN CONTENT -->
    <div id="content">
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable centerBox">
                    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"><i class="fa fa-cog"></i></span>
                            <h2>Grupo</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form class="smart-form client-form" id="formCliente" method="post" enctype="multipart/form-data">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordionCadastro">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Cadastro De Funcionario
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseCadastro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>

                                                        <div class="row">
                                                            <section class="col col-1 col-auto">
                                                                <label class="label">Código</label>
                                                                <label class="input">
                                                                    <input id="codigo" name="codigo" readonly class="readonly" value="" autocomplete="off">
                                                                </label>
                                                            </section>


                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Ativo</label>
                                                                <label class="select">
                                                                    <select id="ativo" name="ativo" class="required">
                                                                        <option value="1" selected>Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-3 col-auto">
                                                                <label class="label" for="nome">Nome Do Fucionario</label>
                                                                <label class="input">
                                                                    <input id="nome" type="text" class="required" maxlength="200" required autocomplete="off" placeholder=Nome>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Sexo</label>
                                                                <label class="select">
                                                                    <select id="sexo" name="sexo" class="required">
                                                                        <option selected></option>
                                                                        <?php
                                                                        $sql = "SELECT * FROM dbo.sexo WHERE (0 = 0)";

                                                                        $reposit = new reposit();
                                                                        $result = $reposit->RunQuery($sql);

                                                                        foreach ($result as $row) {
                                                                            $id = (int) $row['codigo'];
                                                                            $ativo = +$row['ativo'];
                                                                            $sexo = $row['sexo'];
                                                                            echo '<option value=' . $id . '>' . $sexo . '</option>';
                                                                        }
                                                                        ?>

                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Estado Civil</label>
                                                                <label class="select">
                                                                    <select id="estadoCivil" name="estadoCivil" class="required">
                                                                        <option ></option>
                                                                        <option >Solteiro(a)</option>
                                                                        <option >Casado(a)</option>
                                                                        <option >Separado(a)</option>
                                                                        <option >Divorciado(a)</option>
                                                                        <option >Viúvo(a)</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>
                                                            
                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="dataNascimento">Data De Nascimento</label>
                                                                <label class="input">
                                                                    <input id="dataNascimento" name="dataNascimento" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker required" style="text-align: center" value="" data-mask="99/99/9999" data-mask-placeholder="-" autocomplete="off" placeholder=00/00/0000>
                                                                </label>
                                                            </section>

                                                            <section class="col col-1 col-auto">
                                                                <label class="label" for="idade">Idade</label>
                                                                <label class="input">
                                                                    <input id="idade" name="idade" readonly class="readonly" value="" autocomplete="off">
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="cpf">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpf" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="000.000.000-00">
                                                                </label>
                                                            </section>


                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="cpf">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="00.000.000-0">
                                                                </label>
                                                            </section>

                                                            <section>
                                                            <button class="accordion">Contato</button>  
                                                            </section>

                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer>
                                        <button type="button" id="btnExcluir" class="btn btn-danger" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                        <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable" tabindex="-1" role="dialog" aria-describedby="dlgSimpleExcluir" aria-labelledby="ui-id-1" style="height: auto; width: 600px; top: 220px; left: 262px; display: none;">
                                            <div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
                                                <span id="ui-id-2" class="ui-dialog-title">
                                                </span>
                                            </div>
                                            <div id="dlgSimpleExcluir" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 0px; max-height: none; height: auto;">
                                                <p>CONFIRMA A EXCLUSÃO ? </p>
                                            </div>
                                            <div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">
                                                <div class="ui-dialog-buttonset">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="btnGravar" class="btn btn-success" aria-hidden="true" title="Gravar" style="display:<?php echo $esconderBtnGravar ?>">
                                            <span class="fa fa-floppy-o"></span>
                                        </button>
                                        <button type="button" id="btnNovo" class="btn btn-primary" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtnGravar ?>">
                                            <span class="fa fa-file-o"></span>
                                        </button>
                                        <button type="button" id="btnVoltar" class="btn btn-default" aria-hidden="true" title="Voltar">
                                            <span class="fa fa-backward "></span>
                                        </button>
                                    </footer>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
//include required scripts
include("inc/scripts.php");
?>

<script src="<?php echo ASSETS_URL; ?>/js/businessFuncionarioCadastro.js" type="text/javascript"></script>

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->
<!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<!-- Vector Maps Plugin: Vectormap engine, Vectormap language -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Full Calendar -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/moment/moment.min.js"></script>
<!--<script src="/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>-->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/fullcalendar.js"></script>
<!--<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>-->
<!-- Validador de CPF -->
<script src="js/plugin/cpfcnpj/jquery.cpfcnpj.js"></script>

<!-- Form to json -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/form2js.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/form-to-json/jquery.toObject.js"></script>

<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        $('#dlgSimpleExcluir').dialog({
            autoOpen: false,
            width: 400,
            resizable: false,
            modal: true,
            title: "Atenção",
            buttons: [{
                html: "Excluir registro",
                "class": "btn btn-success",
                click: function() {
                    $(this).dialog("close");
                    excluir();
                }
            }, {
                html: "<i class='fa fa-times'></i>&nbsp; Cancelar",
                "class": "btn btn-default",
                click: function() {
                    $(this).dialog("close");
                }
            }]
        });

        $("#btnExcluir").on("click", function() {
            var id = $("#codigo").val();

            if (id === 0) {
                smartAlert("Atenção", "Selecione um registro para excluir !", "error");
                $("#nome").focus();
                return;
            }

            if (id !== 0) {
                $('#dlgSimpleExcluir').dialog('open');
            }
        });

        $("#btnNovo").on("click", function() {
            novo();
        });

        $("#btnGravar").on("click", function() {
            gravar();
        });

        $("#btnVoltar").on("click", function() {
            voltar();
        });

        $("#dataNascimento").on("change", function() {
            calcularIdade();
        });

        $("#cpf").on("change", function() {
            var cpf = $('#cpf').val();

            if (!validarCPF(cpf)) {
                smartAlert("Atenção", "CPF invalido!", "error");
                $('#cpf').val("");

            }
        });

        $("#rg").on("change", function() {
            var cpf = $('#rg').val();

            if (!validarRG(rg)) {
            }
        });

        $("#cpf").mask("999.999.999-99");

        $("#rg").mask("99.999.999-9");

        carregaPagina();


    });

    function carregaPagina() {
        var urlx = window.document.URL.toString();
        var params = urlx.split("?");
        if (params.length === 2) {
            var id = params[1];
            var idx = id.split("=");
            var idd = idx[1];
            if (idd !== "") {
                recuperaFuncionario(idd,
                    function(data) {
                        if (data.indexOf('failed') > -1) {
                            return;
                        } else {
                            data = data.replace(/failed/g, '');
                            var piece = data.split("#");
                            var mensagem = piece[0];
                            var out = piece[1];
                            piece = out.split("^");

                            // Atributos de vale transporte unitário que serão recuperados: 
                            var codigo = piece[0];
                            var ativo = piece[1];
                            var nome = piece[2];
                            var dataNascimento = piece[3];
                            var cpf = piece[4];
                            var rg = piece[5];
                            var sexo = piece[6];
                            var estadoCivil = piece [7]    
                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(codigo);
                            $("#cpf").val(cpf);
                            $("#ativo").val(ativo);
                            $("#nome").val(nome);
                            $("#dataNascimento").val(dataNascimento);
                            $("#rg").val(rg);
                            $("#sexo").val(sexo);
                            $("#estadoCivil").val(estadoCivil);

                            calcularIdade()
                            return;

                        }
                    }
                );
            }
        }
        $("#descricao").focus();
    }

    function gravar() {
        //Botão que desabilita a gravação até que ocorra uma mensagem de erro ou sucesso.
        // $("#btnGravar").prop('disabled', true);
        // Variáveis que vão ser gravadas no banco:
        var id = +$('#codigo').val();
        var nome = $('#nome').val();
        var ativo = +$('#ativo').val();
        var cpf = $('#cpf').val();
        var dataNascimento = $('#dataNascimento').val();
        var rg = $('#rg').val();
        var sexo = $('#sexo').val();
        var estadoCivil = $('#estadoCivil').val();
        
        // Mensagens de aviso caso o usuário deixe de digitar algum campo obrigatório:
        if (!nome) {
            smartAlert("Atenção", "Informe Seu Nome", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!cpf) {
            smartAlert("Atenção", "Informe Seu CPF", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!dataNascimento) {
            smartAlert("Atenção", "Informe a Data de Nascimento", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!ativo) {
            smartAlert("Atenção", "Informe o Ativo", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!rg) {
            smartAlert("Atenção", "Informe Seu RG", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!sexo) {
            smartAlert("Atenção", "Informe Seu Sexo", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!estadoCivil) {
            smartAlert("Atenção", "Informe Seu Estado Civil", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }

        //Chama a função de gravar do business de convênio de saúde.
        gravaFuncionario(id, ativo, nome, cpf, dataNascimento, rg, sexo,estadoCivil,
            function(data) {
                if (data.indexOf('sucess') < 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];
                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                        $("#btnGravar").prop('disabled', false);
                    } else {
                        smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                        $("#btnGravar").prop('disabled', false);
                    }
                    return '';
                } else {
                    //Verifica se a função de recuperar os campos foi executada.
                    var verificaRecuperacao = +$("#verificaRecuperacao").val();
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");

                    if (verificaRecuperacao === 1) {
                        voltar();
                    } else {
                        novo();
                    }
                }
            }
        );
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }

    function voltar() {
        $(location).attr('href', 'funcionarioFiltro.php');
    }

    function excluir() {
        var id = $("#codigo").val();

        if (id === 0) {
            smartAlert("Atenção", "Selecione um registro para excluir!", "error");
            return;
        }

        excluirGrupo(id,
            function(data) {
                if (data.indexOf('failed') > 0) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "Operação não realizada - entre em contato com a GIR!", "error");
                    }
                    voltar();
                } else {
                    smartAlert("Sucesso", "Operação realizada com sucesso!", "success");
                    voltar();
                }
            }
        );
    }

    function calcularIdade() {
        var dataNascimento = $('#dataNascimento').val();
        var y = (parseInt(dataNascimento.split('/')[2]));
        var m = (parseInt(dataNascimento.split('/')[1]));
        var d = (parseInt(dataNascimento.split('/')[0]));


        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));



        var dataValida = moment(dataNascimento, 'DD/MM/YYYY').isValid();
        if (!dataValida) {
            smartAlert("Atenção", "DATA INVALIDA!", "error");
            $('#idade').val('');
            $('#dataNascimento').val('');
            return;
        }
        if (moment(dataNascimento, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "DATA NÃO PODE SER MAIOR QUE HOJE!", "error");
            $('#idade').val('');
            $('#dataNascimento').val('');
            return;

        }

        var idade = yH - y;

        if (mH < m) {
            idade--;
        }
        if (dH < d && mH == m) {
            idade--;
        }

        $('#idade').val(idade);
        return idade;
    }

    function validarCPF(cpf) {
        var cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf == '') return false;
        // Elimina CPFs invalidos conhecidos	
        if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
            return false;
        // Valida 1o digito	
        add = 0;
        for (i = 0; i < 9; i++)
            add += parseInt(cpf.charAt(i)) * (10 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(9)))
            return false;
        // Valida 2o digito	
        add = 0;
        for (i = 0; i < 10; i++)
            add += parseInt(cpf.charAt(i)) * (11 - i);
        rev = 11 - (add % 11);
        if (rev == 10 || rev == 11)
            rev = 0;
        if (rev != parseInt(cpf.charAt(10))) {
            return false;
        } else {
            validarCpfCadastrado();
            return true;
        }
    }

    function validarCpfCadastrado() {

        var cpf = $("#cpf").val();

        validaCpfExistente(cpf,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "CPF já cadastrado no sistema!", "error");
                        $('#cpf').val("");

                    }
                }
            }
        );
    }

    function validarRG() {

        var rg = $("#rg").val();

        validaRgExistente(rg,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "rg já cadastrado no sistema!", "error");
                        $('#rg').val("");

                    }
                    
                }
            }
        );
        
    }
</script>