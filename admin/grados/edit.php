<?php

$id_grado = $_GET['id'];
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/grados/datos_grados.php');
include ('../../app/controllers/niveles/listado_de_niveles.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Modificación del grado: <?=$curso;?></h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/grados/update.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nivel</label>
                                            <input type="text" name="id_grado" value="<?=$id_grado;?>" hidden>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele){
                                                    ?>
                                                    <option value="<?=$nivele['id_nivel'];?>"<?=$nivel_id==$nivele['id_nivel'] ? 'selected' : ''?>><?=$nivele['nivel']." - ".$nivele['turno'];?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Curso</label>
                                            <select name="curso" id="" class="form-control">
                                                <option value="INICIAL - 1"<?=$curso=='INICIAL - 1' ? 'selected' : ''?>>INICIAL - 1</option>
                                                <option value="INICIAL - 2"<?=$curso=='INICIAL - 2' ? 'selected' : ''?>>INICIAL - 2</option>
                                                <option value="PRIMARIA - 1"<?=$curso=='PRIMARIA - 1' ? 'selected' : ''?>>PRIMARIA - 1</option>
                                                <option value="PRIMARIA - 2"<?=$curso=='PRIMARIA - 2' ? 'selected' : ''?>>PRIMARIA - 2</option>
                                                <option value="PRIMARIA - 3"<?=$curso=='PRIMARIA - 3' ? 'selected' : ''?>>PRIMARIA - 3</option>
                                                <option value="PRIMARIA - 4"<?=$curso=='PRIMARIA - 4' ? 'selected' : ''?>>PRIMARIA - 4</option>
                                                <option value="PRIMARIA - 5"<?=$curso=='PRIMARIA - 5' ? 'selected' : ''?>>PRIMARIA - 5</option>
                                                <option value="PRIMARIA - 6"<?=$curso=='PRIMARIA - 6' ? 'selected' : ''?>>PRIMARIA - 6</option>
                                                <option value="SECUNDARIA - 1"<?=$curso=='SECUNDARIA - 1' ? 'selected' : ''?>>SECUNDARIA - 1</option>
                                                <option value="SECUNDARIA - 2"<?=$curso=='SECUNDARIA - 2' ? 'selected' : ''?>>SECUNDARIA - 2</option>
                                                <option value="SECUNDARIA - 3"<?=$curso=='SECUNDARIA - 3' ? 'selected' : ''?>>SECUNDARIA - 3</option>
                                                <option value="SECUNDARIA - 4"<?=$curso=='SECUNDARIA - 4' ? 'selected' : ''?>>SECUNDARIA - 4</option>
                                                <option value="SECUNDARIA - 5"<?=$curso=='SECUNDARIA - 5' ? 'selected' : ''?>>SECUNDARIA - 5</option>
                                                <option value="SECUNDARIA - 6"<?=$curso=='SECUNDARIA - 6' ? 'selected' : ''?>>SECUNDARIA - 6</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Turnos</label>
                                            <select name="paralelo" id="" class="form-control">
                                                <option value="A"<?=$paralelo=='A' ? 'selected' : ''?>>A</option>
                                                <option value="B"<?=$paralelo=='B' ? 'selected' : ''?>>B</option>
                                                <option value="C"<?=$paralelo=='C' ? 'selected' : ''?>>C</option>
                                                <option value="D"<?=$paralelo=='D' ? 'selected' : ''?>>D</option>
                                                <option value="E"<?=$paralelo=='E' ? 'selected' : ''?>>E</option>
                                                <option value="F"<?=$paralelo=='F' ? 'selected' : ''?>>F</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/grados" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');

?>
