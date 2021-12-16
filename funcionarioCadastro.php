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

$page_title = "Funcionário";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include("inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
$page_nav['cadastro']['sub']["funcionario"]["active"] = true;

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
                                <form class="smart-form client-form" id="formCliente" method="post" enctype="multipart/form-data">
                                    <div class="panel-group smart-accordion-default" id="accordion">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseCadastro" class="" id="accordion">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Cadastro De Funcionário
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


                                                            <section id="sessao" class="col col-2 hidden">
                                                                <label class="label">Ativo</label>
                                                                <label class="select">
                                                                    <select id="ativo" name="ativo" class="required">
                                                                        <option value="1" selected>Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-3 col-auto">
                                                                <label class="label" for="nome">Nome</label>
                                                                <label class="input">
                                                                    <input id="nome" type="text" class="required" maxlength="200" required autocomplete="off" placeholder=Nome>
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
                                                                <label class="label">Sexo</label>
                                                                <label class="select">
                                                                    <select id="sexo" name="sexo" class="required">
                                                                        <option selected></option>
                                                                        <?php
                                                                        $sql = "SELECT * FROM dbo.sexo WHERE ativo = 1";

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
                                                                        <option value="0"></option>
                                                                        <option value="5">Solteiro(a)</option>
                                                                        <option value="4">Casado(a)</option>
                                                                        <option value="3">Separado(a)</option>
                                                                        <option value="2">Divorciado(a)</option>
                                                                        <option value="1">Viúvo(a)</option>
                                                                    </select><i></i>

                                                                </label>
                                                            </section>

                                                            <section class="col col-">
                                                                <label class="label">Primeiro Emprego</label>
                                                                <label class="select">
                                                                    <select id="primeiroEmprego" name="primeiroEmprego" class="required">
                                                                        <option selected></option>
                                                                        <option value="1">Sim</option>
                                                                        <option value="0">Não</option>
                                                                    </select><i></i>
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="pispasep">Pispasep</label>
                                                                <label class="input">
                                                                    <input id="pispasep" type="text" maxlength="200" required autocomplete="off" class="required">
                                                                </label>
                                                            </section>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-group smart-accordion-default" id="accordion">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">

                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseContato" class="" id="accordion">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Contatos
                                                    </a>

                                                </h4>
                                            </div>
                                        </div>
                                        <div class="panel">
                                            <div id="collapseContato" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>

                                                        <input id="jsonTelefone" name="jsonTelefone" type="hidden" value="[]">
                                                        <div id="formTelefone" class="col-sm-6">
                                                            <input id="sequencialTelefone" name="sequencialTelefone" type="hidden" value="">
                                                            <input id="descricaoTelefonePrincipal" name="descricaoTelefonePrincipal" type="hidden" value="">
                                                            <input id="descricaoTelefoneWhatsapp" name="descricaoTelefoneWhatsapp" type="hidden" value="">

                                                            <div class="row">

                                                                <section class="col col-5">
                                                                    <label class="label" for="telefone">Telefone</label>
                                                                    <label class="input">
                                                                        <input id="telefone" name="telefone" class="required">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labeltelefonePrincipal" class="checkbox ">
                                                                        <input id="telefonePrincipal" name="telefonePrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labeltelefoneWhatsapp" class="checkbox ">
                                                                        <input id="telefoneWhatsapp" name="telefoneWhatsapp" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Whatsapp
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddTelefone" type="button" class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnRemoverTelefone" type="button" class="btn btn-danger">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>
                                                            </div>


                                                            <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableTelefone" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center">Telefone</th>
                                                                            <th class="text-center">Principal</th>
                                                                            <th class="text-center">WhatsApp</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <input id="jsonEmail" name="jsonEmail" type="hidden" value="[]">
                                                        <div id="formEmail" class="col-sm-6">
                                                            <input id="sequencialEmail" name="sequencialEmail" type="hidden" value="">
                                                            <input id="descricaoEmailPrincipal" name="descricaoEmailPrincipal" type="hidden" value="">


                                                            <div class="row">
                                                                <section class="col col-5">

                                                                    <label class="label" for="email">Email</label>
                                                                    <label class="input">
                                                                        <input id="email" name="email" class="">
                                                                    </label>
                                                                </section>
                                                                <section class="col col-md-2">
                                                                    <label class="label">&nbsp;</label>
                                                                    <label id="labelEmailPrincipal" class="checkbox ">
                                                                        <input id="emailPrincipal" name="emailPrincipal" type="checkbox" value="true" checked="checked"><i></i>
                                                                        Principal
                                                                    </label>
                                                                </section>

                                                                <section class="col col-md-3">
                                                                    <label class="label">&nbsp;</label>
                                                                    <button id="btnAddEmail" type="button" class="btn btn-primary ">
                                                                        <i class="fa fa-plus"></i>
                                                                    </button>
                                                                    <button id="btnRemoverEmail" type="button" class="btn btn-danger ">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </section>

                                                            </div>

                                                            <div class="table-responsive" style="min-height: 115px; width:95%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                                <table id="tableEmail" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                    <thead>
                                                                        <tr role="row">
                                                                            <th style="width: 2px"></th>
                                                                            <th class="text-center">Email</th>
                                                                            <th class="text-center">Principal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <button type="button" id='btnPdf' style="display:none" class='btn btn-danger pull-right' title="Relatório" aria-hidden="true">
                                                                <span class="fa fa-print"> </span>
                                                            </button>

                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-group smart-accordion-default" id="accordion">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">

                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseEndereço" class="" id="accordion">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Endereço
                                                    </a>

                                                </h4>
                                            </div>

                                        </div>
                                        <div class="panel">
                                            <div id="collapseEndereço" class="panel-collapse collapse">
                                                <div class="panel-body no-padding">
                                                    <fieldset>

                                                        <section class="col col-2 col-auto">
                                                            <label class="label" for="cep">CEP</label>
                                                            <label class="input">
                                                                <input id="cep" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="00000-000">
                                                            </label>
                                                        </section>

                                                        <section class="col col-3 col-auto">
                                                            <label class="label" for="logradouro">Rua</label>
                                                            <label class="input">
                                                                <input id="logradouro" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>

                                                        <section class="col col-2 col-auto">
                                                            <label class="label" for="bairro">Bairro</label>
                                                            <label class="input">
                                                                <input id="bairro" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>
                                                        
                                                        <section class="col col-2 col-auto">
                                                            <label class="label" for="cidade">Cidade</label>
                                                            <label class="input">
                                                                <input id="cidade" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>
                                                        
                                                        <section class="col col-2 col-auto">
                                                            <label class="label" for="uf">Estado</label>
                                                            <label class="input">
                                                                <input id="uf" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>
                                                        
                                                        <section class="col col-2 col-auto">
                                                            <label class="label" for="numero">Número</label>
                                                            <label class="input">
                                                                <input id="numero" type="text" class="required" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>
                                                        <section class="col col-3 col-auto">
                                                            <label class="label" for="complemento">Complemento</label>
                                                            <label class="input">
                                                                <input id="complemento" type="text" class="" maxlength="200" required autocomplete="off" placeholder="">
                                                            </label>
                                                        </section>


                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-group smart-accordion-default" id="accordion">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">

                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseDependente" class="" id="accordion">
                                                        <i class="fa fa-lg fa-angle-down pull-right"></i>
                                                        <i class="fa fa-lg fa-angle-up pull-right"></i>
                                                        Dependentes
                                                    </a>

                                                </h4>
                                            </div>
                                        </div>

                                        <div id="collapseDependente" class="panel-collapse collapse">
                                            <div class="panel-body no-padding">
                                                <fieldset>

                                                    <input id="jsonDependente" name="jsonDependente" type="hidden" value="[]">
                                                    <div id="formDependente" class="col-sm-11">
                                                        <input id="sequencialDependente" name="sequencialDependente" type="hidden" value="">
                                                        <input id="descricaoDependente" name="descricaoDependente" type="hidden" value="">
                                                        <div class="row">

                                                            <section class="col col-4 col-auto">
                                                                <label class="label" for="nomeDependente">Nome</label>
                                                                <label class="input">
                                                                    <input id="nomeDependente" name="nomeDependente" type="text" class="" maxlength="200" required autocomplete="off" placeholder="Nome">
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="cpfDependente">CPF</label>
                                                                <label class="input">
                                                                    <input id="cpfDependente" name="cpfDependente" type="text" class="" maxlength="200" required autocomplete="off" placeholder="000.000.000-00">
                                                                </label>
                                                            </section>

                                                            <section class="col col-2 col-auto">
                                                                <label class="label" for="dataNascimentoDependente">Data De Nascimento</label>
                                                                <label class="input">
                                                                    <input id="dataNascimentoDependente" name="dataNascimentoDependente" autocomplete="off" type="text" data-dateformat="dd/mm/yy" class="datepicker " style="text-align: center" value="" data-mask="99/99/9999" data-mask-placeholder="-" autocomplete="off" placeholder=00/00/0000>
                                                                </label>
                                                            </section>

                                                            <section id ="sessao"class="col col-2 col-auto">
                                                                <label class="label">Dependentes</label>
                                                                <label class="select">
                                                                    <select id="tipoDependente" name="tipoDependente" class="">
                                                                        <option selected></option>
                                                                        <?php
                                                                        $sql = "SELECT * FROM dbo.dependente WHERE ativo = 1";

                                                                        $reposit = new reposit();
                                                                        $result = $reposit->RunQuery($sql);

                                                                        foreach ($result as $row) {
                                                                            $id = (int) $row['codigo'];
                                                                            $ativo = +$row['ativo'];
                                                                            $descricao = $row['descricao'];
                                                                            echo '<option value=' . $id . '>' . $descricao . '</option>';
                                                                        }
                                                                        ?>

                                                                    </select><i></i>
                                                                </label>
                                                            </section>


                                                            <label class="label">&nbsp;</label>
                                                            <button id="btnAddDependente" type="button" class="btn btn-primary">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                            <button id="btnRemoverDependente" type="button" class="btn btn-danger">
                                                                <i class="fa fa-minus"></i>
                                                            </button>

                                                        </div>
                                                        <div class="table-responsive" style="min-height: 115px; width:109%; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
                                                            <table id="tableDependente" class="table table-bordered table-striped table-condensed table-hover dataTable">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th style="width: 2px"></th>
                                                                        <th class="text-center">Nome</th>
                                                                        <th class="text-center">CPF</th>
                                                                        <th class="text-center">Data De Nascimento</th>
                                                                        <th class="text-center">Depedente</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>


                                                </fieldset>
                                            </div>
                                        </div>

                                    </div>

                                    <footer>
                                        <button type="button" id="btnExcluir" class="btn btn-danger pull-left" aria-hidden="true" title="Excluir" style="display:<?php echo $esconderBtnExcluir ?>">
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
                                        <button type="button" id="btnNovo" class="btn btn-primary pull-left" aria-hidden="true" title="Novo" style="display:<?php echo $esconderBtnGravar ?>">
                                            <span class="fa fa-file"></span>
                                        </button>
                                        <button type="button" id="btnVoltar" class="btn btn-default pull-left" aria-hidden="true" title="Filtro">
                                            <span class="fa fa-search "></span>
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
        jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());
        jsonEmailArray = JSON.parse($("#jsonEmail").val());
        jsonDependenteArray = JSON.parse($("#jsonDependente").val());

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

        $("#cpf").mask("999.999.999-99");

        $("#cpfDependente").mask("999.999.999-99");

        $("#rg").mask("99.999.999-9");

        $("#cep").mask("99999-999");

        $("#telefone").mask("(99)99999-9999");

        $("#cpfDependente").on("change", function() {
            var cpf = $("#cpfDependente").val();

            if (!validarCPFDependente(cpf)) {

                smartAlert("Atenção", "CPF Invalido", "error")
                $('#cpfDependente').val("");
            }
        });

        $("#dataNascimento").on("change", function() {
            calcularIdade();
        });

        $("#dataNascimentoDependente").on("change", function() {
            calcularIdadeDependente();
        });

        $("#cep").on("change", function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $("#cep").val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#logradouro").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            smartAlert("Atenção", "CEP não encontrado.", "error");
                        }
                    });
                } //end if.
                else {
                    smartAlert("Atenção", "Formato de CEP inválido.", "error");
                }
            } //end if.
        });

        $("#primeiroEmprego").on("change", function() {
            validaPrimeiroEmprego()
        });

        $("a").click(function() {
            $("div").removeClass('in');
        });

        $("#cpf").on("change", function() {
            var cpf = $("#cpf").val();

            if (!validarCPF(cpf)) {

                smartAlert("Atenção", "CPF Invalido", "error")
                $('#cpf').val("");
            }
        });


        $('#btnPdf').on("click", function() {
            gerarPdf();
        });

        $("#btnGravar").on("click", function() {
            gravar()
        });

        $("#btnVoltar").on("click", function() {
            voltar();
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

        $("#btnAddDependente").on("click", function() {
            var tipoDependente = $("#tipoDependente").val();
            var nomeDependente = $("#nomeDependente").val();
            var cpfDependente = $("#cpfDependente").val();
            var dataNascimentoDependente = $("#dataNascimentoDependente").val();
            var existe = true;

            if (!tipoDependente) {
                smartAlert("Atenção", "Escolha um dependente", "error")
                return;
            }
            if (validaDependente()) {
                addDependente();
            }

        });

        $("#btnRemoverDependente").on("click", function() {
            excluirDependente();
        });

        $("#btnAddTelefone").on("click", function() {
            var telefone = $("#telefone").val();
            var existe = true;

            if (!telefone) {
                smartAlert("Atenção", "Escolha um telefone", "error")
                return;
            }
            if (validaTelefone()) {
                addTelefone();
            }

        });

        $("#btnRemoverTelefone").on("click", function() {
            excluirTelefone();
        });

        $("#btnAddEmail").on("click", function() {
            var email = $("#email").val();
            var existe = true;

            if (!email) {
                smartAlert("Atenção", "Escolha um email", "error")
                return;
            }
            if (validaEmail()) {
                addEmail();
            }

        });

        $("#btnRemoverEmail").on("click", function() {
            excluirEmail();
        });

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
                            var strArrayEmail = piece[2];
                            var strArrayTelefone = piece[3];
                            var strArrayDependente = piece[4];

                            piece = out.split("^");

                            // Atributos de vale transporte unitário que serão recuperados: 
                            var codigo = piece[0];
                            var ativo = piece[1];
                            var nome = piece[2];
                            var dataNascimento = piece[3];
                            var cpf = piece[4];
                            var rg = piece[5];
                            var sexo = piece[6];
                            var estadoCivil = piece[7];
                            var cep = piece[8];
                            var logradouro = piece[9];
                            var numero = piece[10];
                            var complemento = piece[11];
                            var uf = piece[12];
                            var bairro = piece[13];
                            var cidade = piece[14];
                            var primeiroEmprego = piece[15];
                            var pispasep = piece[16];



                            //Associa as varíaveis recuperadas pelo javascript com seus respectivos campos html.
                            $("#codigo").val(codigo);
                            $("#cpf").val(cpf);
                            $("#ativo").val(ativo);
                            $("#nome").val(nome);
                            $("#dataNascimento").val(dataNascimento);
                            $("#rg").val(rg);
                            $("#sexo").val(sexo);
                            $("#estadoCivil").val(estadoCivil);
                            $("#cep").val(cep);
                            $("#logradouro").val(logradouro);
                            $("#numero").val(numero);
                            $("#complemento").val(complemento);
                            $("#uf").val(uf);
                            $("#bairro").val(bairro);
                            $("#cidade").val(cidade);
                            $("#primeiroEmprego").val(primeiroEmprego);
                            $("#pispasep").val(pispasep);


                            $("#jsonEmail").val(strArrayEmail);
                            jsonEmailArray = JSON.parse($("#jsonEmail").val());

                            $("#jsonTelefone").val(strArrayTelefone);
                            jsonTelefoneArray = JSON.parse($("#jsonTelefone").val());

                            $("#jsonDependente").val(strArrayDependente);
                            jsonDependenteArray = JSON.parse($("#jsonDependente").val());

                            $("#sessao").removeClass("hidden");
                            $("#btnPdf").show();
                            validaPrimeiroEmprego()
                            fillTableDependente()
                            fillTableTelefone()
                            fillTableEmail()
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
        var estadoCivil = +$('#estadoCivil').val();
        var telefone = $('#telefone').val();
        var cep = $('#cep').val();
        var logradouro = $('#logradouro').val();
        var numero = $('#numero').val();
        var complemento = $('#complemento').val();
        var uf = $('#uf').val();
        var bairro = $('#bairro').val();
        var cidade = $('#cidade').val();
        var primeiroEmprego = $('#primeiroEmprego').val();
        var pispasep = $('#pispasep').val();

        var jsonTelefoneArray = $('#jsonTelefone').val();
        var jsonEmailArray = $('#jsonEmail').val();
        var jsonDependenteArray = $('#jsonDependente').val();


        // Mensagens de aviso caso o usuário deixe de digitar algum campo obrigatório:
        if (ativo = "") {
            smartAlert("Atenção", "Informe o Ativo", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
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
        if (!rg) {
            smartAlert("Atenção", "Informe Seu RG", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!dataNascimento) {
            smartAlert("Atenção", "Informe a Data de Nascimento", "error");
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
        if (!primeiroEmprego) {
            smartAlert("Atenção", "Informe Seu é seu Primeiro Emprego", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (jsonTelefoneArray == '[]') {
            smartAlert("Atenção", "Informe Seu Telefone", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!cep) {
            smartAlert("Atenção", "Informe Seu Cep", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!logradouro) {
            smartAlert("Atenção", "Informe Seu Logradouro", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!bairro) {
            smartAlert("Atenção", "Informe Seu Bairro", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!numero) {
            smartAlert("Atenção", "Informe Seu Numero", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!cidade) {
            smartAlert("Atenção", "Informe Seu  Cidade", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }
        if (!uf) {
            smartAlert("Atenção", "Informe Seu UF", "error");
            $("#btnGravar").prop('disabled', false);
            return;
        }


        //Chama a função de gravar do business de convênio de saúde.
        gravaFuncionario(id, ativo, nome, cpf, dataNascimento, rg, sexo, estadoCivil, cep, logradouro, numero, complemento, uf, bairro, cidade, primeiroEmprego, pispasep, jsonTelefoneArray, jsonEmailArray, jsonDependenteArray,
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

    function gerarPdf() {

        var id = $('#codigo').val();

        var parametrosUrl = '&id=' + id; // - > PASSAGEM DE PARAMETRO



        window.open("funcionarioFiltroPdfContato.php?'" + parametrosUrl); // - > ABRE O RELATÓRIO EM UMA NOVA GUIA

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
            smartAlert("Atenção", "Data Invalida!", "error");
            $('#idade').val('');
            $('#dataNascimento').val('');
            return;
        }
        if (moment(dataNascimento, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "Data não pode ser maior que hoje!", "error");
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

    function calcularIdadeDependente() {
        var dataNascimentoDependente = $('#dataNascimentoDependente').val();
        var y = (parseInt(dataNascimentoDependente.split('/')[2]));
        var m = (parseInt(dataNascimentoDependente.split('/')[1]));
        var d = (parseInt(dataNascimentoDependente.split('/')[0]));


        var dataHoje = moment().format('DD/MM/YYYY');
        var yH = (parseInt(dataHoje.split('/')[2]));
        var mH = (parseInt(dataHoje.split('/')[1]));
        var dH = (parseInt(dataHoje.split('/')[0]));



        var dataValida = moment(dataNascimentoDependente, 'DD/MM/YYYY').isValid();

        if (!dataValida) {
            smartAlert("Atenção", "Data Invalida!", "error");
            $('#idade').val('');
            $('#dataNascimentoDependente').val('');
            return;
        }
        if (moment(dataNascimentoDependente, 'DD/MM/YYYY').diff(moment()) > 0) {
            smartAlert("Atenção", "Data não pode ser maior que hoje!", "error");
            $('#idade').val('');
            $('#dataNascimentoDependente').val('');
            return;

        }
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
                        smartAlert("Atenção", "cpf já cadastrado no sistema!", "error");
                        $('#cpf').val("");


                    }
                }

            }
        );

    }

    function validarCPFDependente(cpf) {
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
            validarCpfCadastradoDependente();
            return true;
        }
    }

    function validarCpfCadastradoDependente() {

        var cpf = $("#cpfDependente").val();

        validaCpfExistenteDependente(cpf,
            function(data) {
                if (data.indexOf('failed') > -1) {
                    var piece = data.split("#");
                    var mensagem = piece[1];

                    if (mensagem !== "") {
                        smartAlert("Atenção", mensagem, "error");
                    } else {
                        smartAlert("Atenção", "cpf já cadastrado no sistema!", "error");
                        $('#cpf').val("");


                    }
                }

            }
        );

    }

    function validaPrimeiroEmprego() {
        var optionSelect = document.getElementById("primeiroEmprego").value;

        if (optionSelect == "0") {
            var i = document.getElementById("pispasep");
            i.classList.remove('readonly')
            i.disabled = false;
        } else {
            var i = document.getElementById("pispasep");
            i.classList.add('readonly')
            i.disabled = true;
            $('#pispasep').val("");

        }
    }

    // function btnPdfAtiva() {


    //     if (id == 0) {

    //     else(id == 0) {


    //     }
    // }


    //------------------------- Funcionário Telefone---------------------//



    function validaTelefone() {

        var existe = false;
        var achou = false;
        var telefone = $('#telefone').val();
        var sequencial = +$('#sequencialTelefone').val();
        var telefoneValido = false;
        var telefonePrincipalMarcado = 0;

        if ($("#telefonePrincipal").is(':checked') === true) {
            telefonePrincipalMarcado = 1;
        }
        if (telefone === '') {
            smartAlert("Erro", "Informe um telefone.", "error");
            return false;
        }

        for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
            if (telefonePrincipalMarcado === 1) {
                if ((jsonTelefoneArray[i].telefonePrincipal === 1) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achou = true;
                    break;
                }
                if ((jsonTelefoneArray[i].principal === 1) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                    achou = true;
                    break;
                }
            }
            if ((jsonTelefoneArray[i].telefone === telefone) && (jsonTelefoneArray[i].sequencialTelefone !== sequencial)) {
                existe = true;
                break;
            }
        }
        if (existe === true) {
            smartAlert("Erro", "telefone já cadastrado.", "error");
            return false;
        }
        if ((achou === true) && (telefonePrincipalMarcado === 1)) {
            smartAlert("Erro", "Já existe um telefone principal na lista.", "error");
            return false;
        }
        return true;
    }

    function addTelefone() {

        var item = $("#formTelefone").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataTelefone
        });

        if (item["sequencialTelefone"] === '') {
            if (jsonTelefoneArray.length === 0) {
                item["sequencialTelefone"] = 1;
            } else {
                item["sequencialTelefone"] = Math.max.apply(Math, jsonTelefoneArray.map(function(o) {
                    return o.sequencialTelefone;
                })) + 1;
            }
            item["telefoneId"] = 0;
        } else {
            item["sequencialTelefone"] = +item["sequencialTelefone"];
        }

        var index = -1;
        $.each(jsonTelefoneArray, function(i, obj) {
            if (+$('#sequencialTelefone').val() === obj.sequencialTelefone) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonTelefoneArray.splice(index, 1, item);
        else
            jsonTelefoneArray.push(item);
        $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
        fillTableTelefone();
        clearFormTelefone();

    }

    function clearFormTelefone() {
        $("#telefone").val('');
        $("#sequencialTelefone").val('');
        $("#telefonePrincipal").val('');
        $("#descricaoTelefonePrincipal").val('');
        $("#telefoneWhatsapp").val('');
        $("#descricaoTelefoneWhatsapp").val('');

    }

    function fillTableTelefone() {
        $("#tableTelefone tbody").empty();

        for (var i = 0; i < jsonTelefoneArray.length; i++) {

            var row = $('<tr />');
            $("#tableTelefone tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonTelefoneArray[i].sequencialTelefone + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaTelefone(' + jsonTelefoneArray[i].sequencialTelefone + ');">' + jsonTelefoneArray[i].telefone + '</td>'));
            row.append($('<td class="text-center">' + jsonTelefoneArray[i].descricaoTelefonePrincipal + '</td>'));
            row.append($('<td class="text-center">' + jsonTelefoneArray[i].descricaoTelefoneWhatsapp + '</td>'));

        }
    }

    function processDataTelefone(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';


        if (fieldName !== '' && (fieldId === "telefonePrincipal")) {
            var valorTelefonePrincipal = 0;
            if ($("#telefonePrincipal").is(':checked') === true) {
                valorTelefonePrincipal = 1;
            }
            return {
                name: fieldName,
                value: valorTelefonePrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "descricaoTelefonePrincipal")) {
            var valorDescricaoTelefonePrincipal = "Não";
            if ($("#telefonePrincipal").is(':checked') === true) {
                valorDescricaoTelefonePrincipal = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoTelefonePrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "telefoneWhatsapp")) {
            var valorTelefoneWhatsapp = 0;
            if ($("#telefoneWhatsapp").is(':checked') === true) {
                valorTelefoneWhatsapp = 1;
            }
            return {
                name: fieldName,
                value: valorTelefoneWhatsapp
            };
        }

        if (fieldName !== '' && (fieldId === "descricaoTelefoneWhatsapp")) {
            var valorDescricaoTelefoneWhatsapp = "Não";
            if ($("#telefoneWhatsapp").is(':checked') === true) {
                valorDescricaoTelefoneWhatsapp = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoTelefoneWhatsapp
            };
        }

        return false;
    }

    function carregaTelefone(sequencialTelefone) {
        var arr = jQuery.grep(jsonTelefoneArray, function(item, i) {
            return (item.sequencialTelefone === sequencialTelefone);
        });

        clearFormTelefone();

        if (arr.length > 0) {
            var item = arr[0];
            $("#telefone").val(item.telefone);
            $("#sequencialTelefone").val(item.sequencialTelefone);
            $("#telefonePrincipal").val(item.principal);

            if (item.principal == 1) {
                $("#telefonePrincipal").prop('checked',true)
                $("#descricaoTelefonePrincipal").val("Sim")
            }else{
                $("#telefonePrincipal").prop('checked',false)
                $("#descricaoTelefonePrincipal").val("Não")
            }
            $("#telefoneWhatsapp").val(item.whatsapp);

            if (item.whatsapp == 1) {
                $("#telefoneWhatsapp").prop('checked',true)
                $("#descricaoTelefoneWhatsapp").val("Sim") 
            }else{
                $("#telefoneWhatsapp").prop('checked',false)
                $("#descricaoTelefoneWhatsapp").val("Não")
            }

        }
    }

    function excluirTelefone() {
        var arrSequencial = [];
        $('#tableTelefone input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonTelefoneArray.length - 1; i >= 0; i--) {
                var obj = jsonTelefoneArray[i];
                if (jQuery.inArray(obj.sequencialTelefone, arrSequencial) > -1) {
                    jsonTelefoneArray.splice(i, 1);
                }
            }
            $("#jsonTelefone").val(JSON.stringify(jsonTelefoneArray));
            fillTableTelefone();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Telefone para excluir.", "error");
    }


    //------------------------- Funcionário Email---------------------//



    function validaEmail() {
        var existe = false;
        var achou = false;
        var email = $('#email').val();
        var sequencial = +$('#sequencialEmail').val();
        var emailValido = false;
        var emailPrincipalMarcado = 0;

        if ($("#emailPrincipal").is(':checked') === true) {
            emailPrincipalMarcado = 1;
        }
        if (email === '') {
            smartAlert("Erro", "Informe um email.", "error");
            return false;
        }

        for (i = jsonEmailArray.length - 1; i >= 0; i--) {
            if (emailPrincipalMarcado === 1) {
                if ((jsonEmailArray[i].emailPrincipal === 1) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                    achou = true;
                    break;
                }
            }
            if ((jsonEmailArray[i].email === email) && (jsonEmailArray[i].sequencialEmail !== sequencial)) {
                existe = true;
                break;
            }
        }
        if (existe === true) {
            smartAlert("Erro", "email já cadastrado.", "error");
            return false;
        }
        if ((achou === true) && (emailPrincipalMarcado === 1)) {
            smartAlert("Erro", "Já existe um email principal na lista.", "error");
            return false;
        }
        return true;
    }

    function addEmail() {

        var item = $("#formEmail").toObject({
            mode: 'combine',
            skipEmpty: false,
            nodeCallback: processDataEmail
        });

        if (item["sequencialEmail"] === '') {
            if (jsonEmailArray.length === 0) {
                item["sequencialEmail"] = 1;
            } else {
                item["sequencialEmail"] = Math.max.apply(Math, jsonEmailArray.map(function(o) {
                    return o.sequencialEmail;
                })) + 1;
            }
            item["emailId"] = 0;
        } else {
            item["sequencialEmail"] = +item["sequencialEmail"];
        }

        var index = -1;
        $.each(jsonEmailArray, function(i, obj) {
            if (+$('#sequencialEmail').val() === obj.sequencialEmail) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonEmailArray.splice(index, 1, item);
        else
            jsonEmailArray.push(item);
        console.log(jsonEmailArray)
        $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
        fillTableEmail();
        clearFormEmail();

    }

    function clearFormEmail() {
        $("#email").val('');
        $("#sequencialEmail").val('');
        $("#emailPrincipal").val('');
        $("#descricaoEmailPrincipal").val('');
        $("#emailWhatsapp").val('');


    }

    function fillTableEmail() {
        $("#tableEmail tbody").empty();

        for (var i = 0; i < jsonEmailArray.length; i++) {

            var row = $('<tr />');
            $("#tableEmail tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonEmailArray[i].sequencialEmail + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaEmail(' + jsonEmailArray[i].sequencialEmail + ');">' + jsonEmailArray[i].email + '</td>'));
            row.append($('<td class="text-center" >' + jsonEmailArray[i].descricaoEmailPrincipal + '</td>'));


        }
    }

    function processDataEmail(node) {
        var fieldId = node.getAttribute ? node.getAttribute('id') : '';
        var fieldName = node.getAttribute ? node.getAttribute('name') : '';


        if (fieldName !== '' && (fieldId === "emailPrincipal")) {
            var valorEmailPrincipal = 0;
            if ($("#emailPrincipal").is(':checked') === true) {
                valorEmailPrincipal = 1;
            }
            return {
                name: fieldName,
                value: valorEmailPrincipal
            };
        }

        if (fieldName !== '' && (fieldId === "descricaoEmailPrincipal")) {
            var valorDescricaoEmailPrincipal = "Não";
            if ($("#emailPrincipal").is(':checked') === true) {
                valorDescricaoEmailPrincipal = "Sim";
            }
            return {
                name: fieldName,
                value: valorDescricaoEmailPrincipal
            };
        }
        return false;
    }

    function carregaEmail(sequencialEmail) {
        var arr = jQuery.grep(jsonEmailArray, function(item, i) {
            return (item.sequencialEmail === sequencialEmail);
        });

        clearFormEmail();

        if (arr.length > 0) {
            var item = arr[0];
            $("#email").val(item.email);
            $("#sequencialEmail").val(item.sequencialEmail);
            $("#emailPrincipal").val(item.principal);
            if (item.principal == 1) {
                $("#emailPrincipal").prop('checked',true)
                $("#descricaoEmailPrincipal").val("Sim")
            }else{
                $("#emailPrincipal").prop('checked',false)
                $("#descricaoEmailPrincipal").val("Não")
            }


        }
    }

    function excluirEmail() {
        var arrSequencial = [];
        $('#tableEmail input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonEmailArray.length - 1; i >= 0; i--) {
                var obj = jsonEmailArray[i];
                if (jQuery.inArray(obj.sequencialEmail, arrSequencial) > -1) {
                    jsonEmailArray.splice(i, 1);
                }
            }
            $("#jsonEmail").val(JSON.stringify(jsonEmailArray));
            fillTableEmail();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Email para excluir.", "error");
    }


    //------------------------- Funcionário Dependente---------------------//



    function validaDependente() {

        var existe = false;
        var achou = false;
        var tipoDependente = $('#tipoDependente').val();
        var sequencial = +$('#sequencialDependente').val();
        var nomeDependente = $('#nomeDependente').val();
        var cpfDependente = $('#cpfDependente').val();
        var dataNascimentoDependente = $('#dataNascimentoDependente').val();
        var dependenteValido = false;

        if (tipoDependente === '') {
            smartAlert("Erro", "Informe um Dependente.", "error");
            return false;
        }

        for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
            if ((jsonDependenteArray[i].cpfDependente === cpfDependente) && (jsonDependenteArray[i].sequencialDependente !== sequencial)) {
                achou = true;
                break;
            }
        }
        if (achou === true) {
            smartAlert("Erro", "CPF já cadastrado.", "error");
            return false;
        }


        return true;
    }

    function addDependente() {

        var item = $("#formDependente").toObject({
            mode: 'combine',
            skipEmpty: false,
        });

        const descricaoDependente = $("#tipoDependente option:selected").text();


        if (item["sequencialDependente"] === '') {
            if (jsonDependenteArray.length === 0) {
                item["sequencialDependente"] = 1;
            } else {
                item["sequencialDependente"] = Math.max.apply(Math, jsonDependenteArray.map(function(o) {
                    return o.sequencialDependente;
                })) + 1;
            }
            item["dependenteId"] = 0;
        } else {
            item["sequencialDependente"] = +item["sequencialDependente"];
        }

        item["descricaoDependente"] = descricaoDependente;

        var index = -1;
        $.each(jsonDependenteArray, function(i, obj) {
            if (+$('#sequencialDependente').val() === obj.sequencialDependente) {
                index = i;
                return false;
            }
        });

        if (index >= 0)
            jsonDependenteArray.splice(index, 1, item);
        else
            jsonDependenteArray.push(item);
        $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));
        fillTableDependente();
        clearFormDependente();

    }

    function clearFormDependente() {
        $("#tipoDependente").val('');
        $("#sequencialDependente").val('');
        $("#nomeDependente").val('');
        $("#cpfDependente").val('');
        $("#dataNascimentoDependente").val('');
        $("#descricaoDependente").val('');


    }

    function fillTableDependente() {
        $("#tableDependente tbody").empty();

        for (var i = 0; i < jsonDependenteArray.length; i++) {

            var row = $('<tr />');
            var descricaoDependente = $("#tipoDependente option[value = '" + jsonDependenteArray[i].tipoDependente + "']").text();

            $("#tableDependente tbody").append(row);
            row.append($('<td><label class="checkbox"><input type="checkbox" name="checkbox" value="' + jsonDependenteArray[i].sequencialDependente + '"><i></i></label></td>'));
            row.append($('<td class="text-center" onclick="carregaDependente(' + jsonDependenteArray[i].sequencialDependente + ');">' + jsonDependenteArray[i].nomeDependente + '</td>'));
            row.append($('<td class="text-center" >' + jsonDependenteArray[i].cpfDependente + '</td>'));
            row.append($('<td class="text-center" >' + jsonDependenteArray[i].dataNascimentoDependente + '</td>'));
            row.append($('<td class="text-center" >' + descricaoDependente + '</td>'));

        }
    }

    function carregaDependente(sequencialDependente) {
        var arr = jQuery.grep(jsonDependenteArray, function(item, i) {
            return (item.sequencialDependente === sequencialDependente);
        });

        clearFormDependente();

        if (arr.length > 0) {
            var item = arr[0];
            $("#nomeDependente").val(item.nomeDependente);
            $("#sequencialDependente").val(item.sequencialDependente);
            $("#cpfDependente").val(item.cpfDependente);
            $("#dataNascimentoDependente").val(item.dataNascimentoDependente);
            $("#tipoDependente").val(item.tipoDependente);

        }
    }

    function excluirDependente() {
        var arrSequencial = [];
        $('#tableDependente input[type=checkbox]:checked').each(function() {
            arrSequencial.push(parseInt($(this).val()));
        });
        if (arrSequencial.length > 0) {
            for (i = jsonDependenteArray.length - 1; i >= 0; i--) {
                var obj = jsonDependenteArray[i];
                if (jQuery.inArray(obj.sequencialDependente, arrSequencial) > -1) {
                    jsonDependenteArray.splice(i, 1);
                }
            }
            $("#jsonDependente").val(JSON.stringify(jsonDependenteArray));
            fillTableDependente();
        } else
            smartAlert("Erro", "Selecione pelo menos 1 Dependente para excluir.", "error");
    }
</script>