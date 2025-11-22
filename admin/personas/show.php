<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

// 1. OBTENER EL ID DEL USUARIO DESDE LA URL (usando 'id')
if (!isset($_GET['id'])) {
    // Si no hay ID, redirigir al listado para evitar errores.
    header('Location:'.APP_URL."/admin/personas"); 
    exit;
}

// 🚨 CORRECCIÓN: Este ID es el ID de la tabla USUARIOS, lo nombramos apropiadamente.
$id_usuario_url = $_GET['id'];

// 2. INCLUIR EL CONTROLADOR PARA CARGAR LOS DATOS
// El controlador usará $id_usuario_url para buscar los datos y los cargará en $persona_data.
include ('../../app/controllers/personas/datos_de_la_persona.php');

// Verificamos si la búsqueda fue exitosa (aunque el controlador ya redirige en caso de fallo)
if (!isset($persona_data)) {
    // Redirección de emergencia si la variable no está definida
    header('Location:'.APP_URL."/admin/usuarios"); 
    exit;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container-fluid">
            <h1 class="mb-4">Detalle de Usuario y Persona</h1>
            
            <div class="row">
                <!-- Tarjeta de visualización de detalles -->
                <div class="col-md-8 offset-md-2">
                    <div class="card card-outline card-info shadow-lg">
                        <div class="card-header bg-info">
                            <h3 class="card-title text-white"><i class="bi bi-eye"></i> Visualizando: **<?=htmlentities($persona_data['nombres'] . ' ' . $persona_data['apellido']);?>**</h3>
                        </div>
                        <div class="card-body">
                            
                            <h5 class="text-info mb-3 border-bottom pb-2 font-weight-bold"><i class="bi bi-person-badge"></i> Información Personal</h5>
                            
                            <!-- Fila 1: Nombres y Apellido -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" class="form-control" value="<?=htmlentities($persona_data['nombres']);?>" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" class="form-control" value="<?=htmlentities($persona_data['apellido']);?>" disabled>
                                </div>
                            </div>
                            
                            <!-- Fila 2: DNI y Fecha de Nacimiento -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dni">DNI:</label>
                                    <input type="text" class="form-control" value="<?=htmlentities($persona_data['dni']);?>" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" value="<?=htmlentities($persona_data['fecha_nacimiento']);?>" disabled>
                                </div>
                            </div>

                            <h5 class="text-info mt-4 mb-3 border-bottom pb-2 font-weight-bold"><i class="bi bi-person-circle"></i> Datos de Acceso (Usuario)</h5>

                            <!-- Fila 3: Email y Rol -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email de Usuario:</label>
                                    <input type="email" class="form-control" value="<?=htmlentities($persona_data['email']);?>" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_rol">Rol Asignado:</label>
                                    <input type="text" class="form-control" value="<?=htmlentities($persona_data['nombre_rol']);?>" disabled>
                                </div>
                            </div>
                            
                            <!-- Fila 4: Creación y Estado -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fyh_creacion">Fecha de Creación:</label>
                                    <input type="text" class="form-control" value="<?=htmlentities($persona_data['fyh_creacion']);?>" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="estado">Estado de Cuenta:</label>
                                    <input type="text" class="form-control" 
                                           value="<?=$persona_data['estado'] == '1' ? 'ACTIVO' : 'INACTIVO';?>" 
                                           disabled>
                                </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <a href="<?=APP_URL;?>/admin/usuarios" class="btn btn-secondary shadow-sm">
                                    <i class="bi bi-arrow-left"></i> Volver al Listado
                                </a>
                                <a href="edit.php?id=<?=htmlentities($persona_data['id_usuario']);?>" class="btn btn-success shadow-sm">
                                    <i class="bi bi-pencil"></i> Editar Usuario
                                </a>
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
?>