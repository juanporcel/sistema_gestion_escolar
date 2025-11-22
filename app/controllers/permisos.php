<?php
/**
 * Helper para verificar permisos de usuario
 * Asegúrate de que session_start() haya sido llamado antes de usar esto.
 */

function tiene_permiso($roles_permitidos) {
    // Verificar si existe el rol en la sesión
    if (!isset($_SESSION['nombre_rol'])) {
        return false; // No hay usuario logueado o no tiene rol
    }

    $rol_usuario = $_SESSION['nombre_rol'];

    // Si es ADMINISTRADOR, suele tener permiso total (opcional)
    if ($rol_usuario == 'ADMINISTRADOR') {
        return true;
    }

    // Si se pasa un array de roles permitidos
    if (is_array($roles_permitidos)) {
        return in_array($rol_usuario, $roles_permitidos);
    }

    // Si se pasa un solo rol como string
    return $rol_usuario == $roles_permitidos;
}

// EJEMPLO DE USO:
// include ('ruta/a/app/controllers/permisos.php');
// if (tiene_permiso(['ADMINISTRADOR', 'DOCENTE'])) {
//     // Mostrar contenido
// } else {
//     // Mostrar error o redirigir
// }
?>
