<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

//colocar o tratamento de permissão sempre abaixo de require_once("inc/config.ui.php");
$condicaoAcessarOK = (in_array('USUARIO_ACESSAR', $arrayPermissao, true));
$condicaoGravarOK = (in_array('USUARIO_GRAVAR', $arrayPermissao, true));
$condicaoAcessarOK = true;
$condicaoGravarOK = true;
$condicaoExcluirOK = true;

if ($condicaoAcessarOK == false) {
    unset($_SESSION['login']);
    header("Location:login.php");
}



/* ---------------- PHP Custom Scripts ---------

  YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
  E.G. $page_title = "Custom Title" */

$page_title = "Funcionário";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav["cadastro"]["sub"]["funcionario"]["active"] = true;

include("inc/nav.php");
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
    <?php
    //configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
    //$breadcrumbs["New Crumb"] => "http://url.com"
    $breadcrumbs["Cadastro"] = "";
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
                            <h2>Funcionário</h2>
                        </header>
                        <div>
                            <div class="widget-body no-padding">
                                <form action="javascript:gravar()" class="smart-form client-form" id="formUsuarioFiltro" method="post">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFiltro" class="">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Filtro De Funcionário
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFiltro" class="panel-collapse collapse in">
                                                <div class="panel-body no-padding">
                                                    <fieldset>
                                                        <div class="row">

                                                            <section class=" col col-1 col-auto">
                                                                <label class="label">Ativo</label>
                                                                <label class="select">
                                                                    <select id="ativo" name="ativo">
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-4">
                                                                <label class="label">Nome</label>
                                                                <label class="input"><i class="icon-prepend fa fa-user"></i>
                                                                    <input id="nome" maxlength="50" name="nome" type="text" value="" placeholder=Nome>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data de nascimento</label>
                                                                <label class="input">
                                                                    <input id="dataNascimento" name="dataNascimento" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker" style="text-align: center" value="" data-mask="99/99/9999" data-mask-placeholder="-" autocomplete="off" placeholder=00/00/0000>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Sexo</label>
                                                                <label class="select">
                                                                    <select id="sexo" name="sexo">
                                                                        <option selected></option>
                                                                        <?php
                                                                        $sql = "SELECT codigo, sexo FROM dbo.sexo WHERE ativo = 1";

                                                                        $reposit = new reposit();
                                                                        $result = $reposit->RunQuery($sql);

                                                                        foreach ($result as $row) {
                                                                            $id = (int) $row['codigo'];
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

                                                                    <select id="estadoCivil" name="estadoCivil" class="">
                                                                        <option></option>
                                                                        <option value="5">Solteiro(a)</option>
                                                                        <option value="4">Casado(a)</option>
                                                                        <option value="3">Separado(a)</option>
                                                                        <option value="2">Divorciado(a)</option>
                                                                        <option value="1">Viúvo(a)</option>
                                                                    </select><i></i>

                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data Inicio</label>
                                                                <label class="input">
                                                                    <input id="dataInicio" name="dataInicio" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker" style="text-align: center" value="" data-mask="99/99/9999" data-mask-placeholder="-" autocomplete="off" placeholder=00/00/0000>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">Data Fim</label>
                                                                <label class="input">
                                                                    <input id="dataFim" name="dataFim" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker" style="text-align: center" value="" data-mask="99/99/9999" data-mask-placeholder="-" autocomplete="off" placeholder=00/00/0000>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpf" maxlength="100" placeholder="000.000.000-00">
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label">RG</label>
                                                                <label class="input">
                                                                    <input id="rg" type="text" maxlength="200" required autocomplete="off" placeholder="00.000.000-0">
                                                                </label>
                                                            </section>
                                                        </div>


                                                    </fieldset>
                                                </div>

                                                <footer>

                                                    <button id="btnSearch" type="button" class="btn btn-default pull-right" title="Buscar">
                                                        <span class="fa fa-search"></span>
                                                    </button>

                                                    <button id="btnNovo" type="button" class="btn btn-primary pull-left" title="Novo">
                                                        <span class="fa fa-file"></span>
                                                    </button>
                                                    
                                                    <button type="button" id="btnPdf" class="btn btn-danger pull-left"title="Imprimir" aria-hidden="true">
                                                    <span class="fa fa-print"></span>
                                                    </button>

                                                </footer>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="resultadoBusca"></div>

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
<!--script src="<?php echo ASSETS_URL; ?>/js/businessTabelaBasica.js" type="text/javascript"></script-->
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
<script src="<?php echo ASSETS_URL; ?>/js/plugin/fullcalendar/locale-all.js"></script>


<script>
    $(document).ready(function() {
        $('#btnSearch').on("click", function() {
            listarFiltro();
        });

        $('#btnNovo').on("click", function() {
            novo();
        });
        $('#btnPdf').on("click", function() {
            geraPdf();
        });

        $("#cpf").mask("999.999.999-99");

        $("#rg").mask("99.999.999-9");

        $("#dataFim").on("change", function() {
            validaDataFim();
        });
        $("#dataInicio").on("change", function() {
            validaDataInicio();
        });
    });

    function listarFiltro() {
        var nome = $('#nome').val();
        var cpf = $('#cpf').val();
        var dataNascimento = $('#dataNascimento').val();
        var ativo = $('#ativo').val();
        var rg = $('#rg').val();
        var sexo = $('#sexo').val();
        var dataInicio = $('#dataInicio').val();
        var dataFim = $('#dataFim').val();
        var estadoCivil = $('#estadoCivil').val();


        $('#resultadoBusca').load('funcionarioFiltroListagem.php?', {
            nome: nome,
            cpf: cpf,
            dataNascimento: dataNascimento,
            ativo: ativo,
            rg: rg,
            sexo: sexo,
            dataInicio: dataInicio,
            dataFim: dataFim,
            estadoCivil: estadoCivil,

        });
    }

    function novo() {
        $(location).attr('href', 'funcionarioCadastro.php');
    }

    function validaDataFim() {
        var dataFim = $('#dataFim').val();
        var y = (parseInt(dataFim.split('/')[2]));
        var m = (parseInt(dataFim.split('/')[1]));
        var d = (parseInt(dataFim.split('/')[0]));


        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));



        var dataValida = moment(dataFim, 'DD/MM/YYYY').isValid();

        if (!dataValida) {
            smartAlert("Atenção", "Data Invalida!", "error");
            $('#idade').val('');
            $('#dataFim').val('');
            return;
        }
        if (moment(dataFim, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "Data não pode ser maior que hoje!", "error");
            $('#idade').val('');
            $('#dataFim').val('');
            return;

        }
    }

    function geraPdf() {

        var sexo = $('#sexo').val();

        var parametrosUrl = '&sexo=' + sexo; // - > PASSAGEM DE PARAMETRO

        window.open("funcionarioFiltroPdf.php?'" + parametrosUrl); // - > ABRE O RELATÓRIO EM UMA NOVA GUIA

    }

    function validaDataInicio() {
        var dataInicio = $('#dataInicio').val();
        var y = (parseInt(dataInicio.split('/')[2]));
        var m = (parseInt(dataInicio.split('/')[1]));
        var d = (parseInt(dataInicio.split('/')[0]));


        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));



        var dataValida = moment(dataInicio, 'DD/MM/YYYY').isValid();

        if (!dataValida) {
            smartAlert("Atenção", "Data Invalida!", "error");
            $('#idade').val('');
            $('#dataInicio').val('');
            return;
        }
        if (moment(dataInicio, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "Data não pode ser maior que hoje!", "error");
            $('#idade').val('');
            $('#dataInicio').val('');
            return;

        }
    }
</script>