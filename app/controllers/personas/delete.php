<?php
// /app/controllers/personas/delete.php

include ('../../../app/config.php');
session_start();

$usuario_id = $_POST['usuario_id'];
$estado_inactivo = '0'; // Asumo que el estado de inactivo es '0'

try {
    $pdo->beginTransaction();

    // A. Desactivar en la tabla 'personas'
    $sentencia_per = $pdo->prepare('UPDATE personas 
        SET estado = :estado, fyh_eliminacion = :fyh_eliminacion
        WHERE usuario_id = :usuario_id');
    $sentencia_per->bindParam(':estado', $estado_inactivo);
    $sentencia_per->bindParam(':fyh_eliminacion', $fechaHora); // $fechaHora de config.php
    $sentencia_per->bindParam(':usuario_id', $usuario_id);
    $sentencia_per->execute();

    // B. Desactivar en la tabla 'usuarios'
    $sentencia_usu = $pdo->prepare('UPDATE usuarios 
        SET estado = :estado, fyh_eliminacion = :fyh_eliminacion
        WHERE id_usuario = :id_usuario');
    $sentencia_usu->bindParam(':estado', $estado_inactivo);
    $sentencia_usu->bindParam(':fyh_eliminacion', $fechaHora);
    $sentencia_usu->bindParam(':id_usuario', $usuario_id);
    $sentencia_usu->execute();

    $pdo->commit();
    
    $_SESSION['mensaje'] = "Persona eliminada (desactivada) correctamente.";
    header('Location:'.APP_URL."/admin/personas"); 

} catch (Exception $e) {
    $pdo->rollBack();
    $_SESSION['mensaje'] = "Error al intentar eliminar la persona: " . $e->getMessage();
    header('Location:'.APP_URL."/admin/personas"); 
}
?>