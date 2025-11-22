<?php
// /app/controllers/personas/update_persona.php

include ('../../../app/config.php');
session_start();

// Solo actualiza la tabla `personas` — no toca `usuarios`, roles ni contraseñas.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['mensaje'] = "Acceso inválido.";
    $_SESSION['icono'] = 'warning';
    header('Location:'.APP_URL."/admin/personas");
    exit;
}

$usuario_id = isset($_POST['usuario_id']) ? (int) $_POST['usuario_id'] : 0;
$apellido_nombre = isset($_POST['apellido_nombre']) ? trim($_POST['apellido_nombre']) : '';
$dni = isset($_POST['dni']) ? trim($_POST['dni']) : null;
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) && $_POST['fecha_nacimiento'] !== '' ? $_POST['fecha_nacimiento'] : null;
$profesion = isset($_POST['profesion']) ? trim($_POST['profesion']) : null;
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : null;
$celular = isset($_POST['celular']) ? trim($_POST['celular']) : null;
$estado = isset($_POST['estado']) ? (int) $_POST['estado'] : 1;

try {
    $sentencia = $pdo->prepare(
        'UPDATE personas SET
            apellido_nombre = :apellido_nombre,
            dni = :dni,
            fecha_nacimiento = :fecha_nacimiento,
            profesion = :profesion,
            direccion = :direccion,
            celular = :celular,
            estado = :estado,
            fyh_actualizacion = :fyh_actualizacion
         WHERE usuario_id = :usuario_id'
    );

    $sentencia->bindParam(':apellido_nombre', $apellido_nombre);
    $sentencia->bindParam(':dni', $dni);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':profesion', $profesion);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':celular', $celular);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':usuario_id', $usuario_id);

    $sentencia->execute();

    // Mensaje corto y claro para la interfaz
    $_SESSION['mensaje'] = "Actualizado correctamente.";
    $_SESSION['icono'] = 'success';
    header('Location:'.APP_URL."/admin/personas");
    exit;

} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al actualizar la persona: " . $e->getMessage();
    $_SESSION['icono'] = 'error';
    header('Location:'.APP_URL."/admin/personas/edit.php?id=".$usuario_id);
    exit;
}

?>
