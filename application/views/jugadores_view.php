<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= NOMBRE_SISTEMA ?></title>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="<?= base_url() ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">      

        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>

        <style type="text/css">
            .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
                background-color: #fff;
                opacity: 1;
            }
            .shadow-gris{

                box-shadow: 1px 1px 6px #333;
            }

        </style>
    </head>
    <body>
        <?php $this->load->view('partes/menu'); ?>
        <div class="container-fluid">      
            <div class="panel panel-default shadow-gris">
                <div class="panel-heading"> <span class="glyphicon glyphicon-check"></span> <?= $TITULO_PAGINA ?>  </div>
                <div class="panel-body">
                    <form action="<?= site_url() ?>/campeonatos/jugadores" method="post">
                        <table>
                            <tr>
                                <td>Seleccione el Campeonato: &nbsp;</td>
                                <td>
                                    <select class="form-control input-sm"
                                            id="id_campeonato"
                                            name="id_campeonato"
                                            required="required">
                                        <option value="" selected hidden>Seleccione...</option>
                                        <?php
                                        foreach ($CAMPEONATOS as $value) {
                                            $cadena="";
                                            if ($ID_SELECCIONADO == $value->ID_CAMPEONATO){
                                                $cadena = "selected";
                                            }
                                                ?>
                                            <option  value="<?= $value->ID_CAMPEONATO ?>" <?= $cadena ?> >[<?= $value->FECHA_INICIO ?>] - <?= $value->NOMBRE_CAMPEONATO ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    &nbsp;
                                    <button class="btn btn-primary">
                                        <span class="glyphicon glyphicon-ok"></span>
                                        Seleccionar
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>    

                    <?php
                    if ($MOSTRAR == "SI") {
                        echo "<br/>";
                        echo $output;
                    }
                    ?>

                </div>
            </div>
        </div>
        <br/>

        <script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>

        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
    </body>
</html>