<?php


$id_persona = $_GET['id'];

include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/personas/datos_de_la_persona.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Persona: <?=$persona_data['apellido_nombre'];?></h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados</h3>
                        </div>
                        <div class="card-body">

                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellido y Nombre</label>
                                            <p><?=$persona_data['apellido_nombre'];?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Profesión</label>
                                            <p><?=$persona_data['profesion'];?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">DNI</label>
                                            <p><?=$persona_data['dni'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <p><?php echo !empty($persona_data['fecha_nacimiento']) ? date('d/m/Y', strtotime($persona_data['fecha_nacimiento'])) : ''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <p><?=$persona_data['celular'];?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <p><?=htmlentities($persona_data['direccion']);?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <p><?=htmlentities($persona_data['email']);?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha de creación</label>
                                            <p><?php echo !empty($persona_data['fyh_creacion']) ? htmlentities(date('d/m/Y H:i', strtotime($persona_data['fyh_creacion']))) : ''; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fecha de actualización</label>
                                            <p><?php echo !empty($persona_data['fyh_actualizacion']) ? htmlentities(date('d/m/Y H:i', strtotime($persona_data['fyh_actualizacion']))) : ''; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">

                                            <a href="<?=APP_URL;?>/admin/personas" class="btn btn-secondary">Volver</a>
                                        </div>
                                    </div>
                                </div>

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