<?php
include "js/repositorio.php";
?>
<div class="table-container">
    <div class="table-responsive" style="min-height: 115px; border: 1px solid #ddd; margin-bottom: 13px; overflow-x: auto;">
        <table id="tableSearchResult" class="table table-bordered table-striped table-condensed table-hover dataTable">
            <thead>
                <tr role="row">
                    <th class="text-left" style="min-width:30px;">Nome</th>
                    <th class="text-left" style="min-width:30px;">CPF</th>
                    <th class="text-left" style="min-width:30px;">Data de Nascimento</th>
                    <th class="text-left" style="min-width:35px;">Ativo</th>
                    <th class="text-left" style="min-width:35px;">RG</th>
                    <th class="text-left" style="min-width:35px;">Sexo</th>
                    <th class="text-left" style="min-width:35px;">Estado Civil</th>
                    <th class="text-left" style="min-width:35px;">Relatório</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $where = "WHERE (0 = 0)";

                $ativo = "";
                $ativo = $_POST["ativo"];

                if ($ativo != '') {
                    $where = $where . " AND F.ativo = $ativo";
                }

                $nome = "";
                $nome = $_POST["nome"];

                if ($nome != '') {
                    $where = $where . " AND (F.nome like '%' + " . "replace('" . $nome . "',' ','%') + " . "'%')";
                }

                $cpf = "";
                $cpf = $_POST["cpf"];

                if ($cpf != '') {
                    $where = $where . " AND (F.cpf like '%' + " . "replace('" . $cpf . "',' ','%') + " . "'%')";
                }

                $rg = "";
                $rg = $_POST["rg"];

                if ($rg != '') {
                    $where = $where . " AND (F.rg like '%' + " . "replace('" . $rg . "',' ','%') + " . "'%')";
                }

                $estadoCivil = "";
                $estadoCivil = $_POST["estadoCivil"];

                if ($estadoCivil != '') {
                    $where = $where . " AND F.estadoCivil = $estadoCivil";
                }

                $sexo = "";
                $sexo = $_POST["sexo"];

                if ($sexo != '') {
                    $where = $where . " AND F.sexo = $sexo";
                }

                $dataInicio = "";
                $dataInicio = $_POST["dataInicio"];

                if ($dataInicio != '') {
                    $dataInicio = explode(" ", $dataInicio);
                    $dataInicio = explode("/", $dataInicio[0]);
                    $dataInicio = $dataInicio[2] . "-" . $dataInicio[1] . "-" . $dataInicio[0];

                    $where = $where .  "AND F.dataNascimento  $dataNascimento > = '" . $dataInicio . "'";
                }

                $dataFim = "";
                $dataFim = $_POST["dataFim"];

                if ($dataFim != '') {
                    $dataFim = explode(" ", $dataFim);
                    $dataFim = explode("/", $dataFim[0]);
                    $dataFim = $dataFim[2] . "-" . $dataFim[1] . "-" . $dataFim[0];
                    $where = $where .  "AND F.dataNascimento  $dataNascimento < = '" . $dataFim . "'";
                }

                $dataNascimento = "";
                $dataNascimento = $_POST["dataNascimento"];

                if ($dataNascimento != '') {
                    $dataNascimento = explode(" ", $dataNascimento);
                    $dataNascimento = explode("/", $dataNascimento[0]);
                    $dataNascimento = "'" . $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0] . "'";
                    $where = $where . " AND dataNascimento = $dataNascimento ";
                }

                $sql = " SELECT  
                F.codigo
                ,F.ativo
                ,F.nome
                ,F.dataNascimento
                ,F.cpf
                ,F.rg
				,S.sexo
                ,F.estadoCivil

                FROM  [dbo].[funcionario] F
                LEFT JOIN [dbo].[sexo] S
                ON S.codigo = F.sexo ";

                $sql = $sql . $where;
                $reposit = new reposit();
                $result = $reposit->RunQuery($sql);

                foreach ($result as $row) {
                    $id = (int) $row['codigo'];
                    $ativo = $row['ativo'];
                    $nome = $row['nome'];
                    $dataNascimento = $row['dataNascimento'];
                    $cpf = $row['cpf'];
                    $rg = $row['rg'];
                    $sexo = $row['sexo'];
                    $estadoCivil = +$row['estadoCivil'];

                    $estadosCivil = "";
                    if ($estadoCivil == 1) {
                        $estadosCivil = "Viúvo(a)";
                    } 
                    if ($estadoCivil == 2) {
                        $estadosCivil = "Divorciado(a)";
                    } 
                    if ($estadoCivil == 3) {
                        $estadosCivil = "Separado(a)";
                    } 
                    if ($estadoCivil == 4) {
                        $estadosCivil = "Casado(a)";
                    } 
                    if ($estadoCivil == 5) {
                        $estadosCivil = "Solteiro(a)";
                    } 


                    $descricaoAtivo = "";
                    if ($ativo == 1) {
                        $descricaoAtivo = "Sim";
                    } else {
                        $descricaoAtivo = "Não";
                    }

                    $dataNascimento = explode(" ", $dataNascimento);
                    $dataNascimento = explode("-", $dataNascimento[0]);
                    $dataNascimento = $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];

                    echo '<tr >';
                    echo '<td class="text-center"><a href="funcionarioCadastro.php?id=' . $id . '">' . $nome . '</a></td>';
                    echo '<td class="text-center">' . $cpf . '</td>';
                    echo '<td class="text-center">' . $dataNascimento . '</td>';
                    echo '<td class="text-center">' . $descricaoAtivo . '</td>';
                    echo '<td class="text-center">' . $rg . '</td>';
                    echo '<td class="text-center">' . $sexo . '</td>';
                    echo '<td class="text-center">' . $estadosCivil . '</td>';
                    echo "<td class='text-center'><a class='btn btn-xs btn-default fa fa-search' href='contratacao_captacaoRecursos.php" . "'></a></td>";
                    echo '</tr >';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };



        /* TABLETOOLS */
        $('#tableSearchResult').dataTable({
            // Tabletools options: 
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>',
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sLengthMenu": "_MENU_ Resultados por página",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            "oTableTools": {
                "aButtons": ["copy", "csv", "xls", {
                        "sExtends": "pdf",
                        "sTitle": "SmartAdmin_PDF",
                        "sPdfMessage": "SmartAdmin PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#tableSearchResult'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }

        });

    });
</script>