<?php
// /admin/personas/edit.php
$usuario_id = $_GET['id'];

include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/personas/datos_de_la_persona.php'); // Obtiene $persona_data, $rol_data
include ('../../app/controllers/roles/listado_de_roles.php'); 

// Asumiendo que $persona_data tiene toda la información (incluyendo email y nombre_rol)
$nombres = $persona_data['nombres'];
$apellidos = $persona_data['apellidos'];
$email = $persona_data['email'];
$nombre_rol_actual = $persona_data['nombre_rol']; // Para preseleccionar el rol
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Modificar Persona: <?=$nombres . ' ' . $apellidos;?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualizar datos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?=APP_URL;?>/app/controllers/personas/update.php" method="post">
                                <input type="text" name="usuario_id" value="<?=$usuario_id;?>" hidden>
                                
                                <h2>Datos de Cuenta (Usuario)</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" class="form-control" required>
                                                    <?php foreach ($roles as $role){ ?>
                                                        <option value="<?=$role['id_rol'];?>" 
                                                            <?php if($nombre_rol_actual == $role['nombre_rol']){ echo "selected"; } ?> >
                                                            <?=$role['nombre_rol'];?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <a href="<?=APP_URL;?>/admin/roles/create.php" style="margin-left: 5px" class="btn btn-primary"><i class="bi bi-file-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Email <span style="color: red">*</span></label>
                                            <input type="email" name="email" value="<?=$email;?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Contraseña (Dejar vacío para no cambiar)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Repetir contraseña</label>
                                            <input type="password" name="password_repet" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <h2>Datos Personales</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres <span style="color: red">*</span></label>
                                            <input type="text" name="nombres" value="<?=$persona_data['nombres'];?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos <span style="color: red">*</span></label>
                                            <input type="text" name="apellidos" value="<?=$persona_data['apellidos'];?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CI/DNI <span style="color: red">*</span></label>
                                            <input type="text" name="ci" value="<?=$persona_data['ci'];?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="<?=$persona_data['fecha_nacimiento'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Profesión/Ocupación</label>
                                            <input type="text" name="profesion" value="<?=$persona_data['profesion'];?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Celular</label>
                                            <input type="text" name="celular" value="<?=$persona_data['celular'];?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" value="<?=$persona_data['direccion'];?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Actualizar Persona</button>
                                            <a href="<?=APP_URL;?>/admin/personas" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div></div>
    </div>
<?php
include ('../../../admin/layout/parte2.php');
include ('../../../layout/mensajes.php');
?>