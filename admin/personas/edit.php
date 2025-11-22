<?php
// /admin/personas/edit.php
include ('../../app/config.php');

// Validar ID antes de enviar cualquier salida
if (!isset($_GET['id'])) {
    header('Location:'.APP_URL."/admin/personas");
    exit;
}

// Aceptamos el parámetro como ID de persona; lo exponemos también como usuario_id
$id_persona = (int) $_GET['id'];
$usuario_id = $id_persona;

// Incluir controladores antes de la plantilla (pueden redirigir)
// Usamos el loader admin que no filtra por per.estado para permitir editar el estado
include ('../../app/controllers/personas/datos_de_la_persona_admin.php'); // Obtiene $persona_data (y datos relacionados)

// Asumiendo que $persona_data tiene toda la información
if (empty($persona_data)) {
    header('Location:'.APP_URL."/admin/personas");
    exit;
}
$apellido_nombre = isset($persona_data['apellido_nombre']) ? $persona_data['apellido_nombre'] : '';

// Incluir plantilla de cabecera ahora que no habrá redirecciones posteriores
include ('../../admin/layout/parte1.php');
?>
<script>
    (function(){
        var form = document.querySelector('form');
        if(!form) return;
        form.addEventListener('submit', function(e){
            try{ console.log('Persona edit form submitting to:', form.action); }catch(err){}
        });
        var submitBtn = form.querySelector('button[type=submit]');
        if(submitBtn){
            submitBtn.addEventListener('click', function(){
                try{ console.log('Submit button clicked'); }catch(e){}
            });
        }
    })();
</script>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Modificar persona: <?=htmlentities($apellido_nombre);?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?=APP_URL;?>/app/controllers/personas/update_persona.php">
                                <input type="hidden" name="usuario_id" value="<?=$usuario_id;?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellido y Nombre <span style="color: red">*</span></label>
                                            <input type="text" name="apellido_nombre" value="<?=htmlentities(isset($persona_data['apellido_nombre']) ? $persona_data['apellido_nombre'] : '');?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">DNI <span style="color: red">*</span></label>
                                            <input type="text" name="dni" value="<?=htmlentities(isset($persona_data['dni']) ? $persona_data['dni'] : '');?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="<?=htmlentities(isset($persona_data['fecha_nacimiento']) ? $persona_data['fecha_nacimiento'] : '');?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Profesión/Ocupación</label>
                                            <input type="text" name="profesion" value="<?=htmlentities(isset($persona_data['profesion']) ? $persona_data['profesion'] : '');?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" name="celular" value="<?=htmlentities(isset($persona_data['celular']) ? $persona_data['celular'] : '');?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Estado</label>
                                            <select name="estado" class="form-control">
                                                <option value="1" <?php if(isset($persona_data['estado']) && $persona_data['estado']=='1') echo 'selected'; ?>>Alta</option>
                                                <option value="0" <?php if(isset($persona_data['estado']) && $persona_data['estado']=='0') echo 'selected'; ?>>Baja</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" value="<?=htmlentities(isset($persona_data['direccion']) ? $persona_data['direccion'] : '');?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <a href="<?=APP_URL;?>/admin/personas" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>