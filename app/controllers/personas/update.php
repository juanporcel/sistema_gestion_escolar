<?php
// /app/controllers/personas/update.php

include ('../../../app/config.php');
session_start();

// 1. ID y Datos de USUARIOS
$usuario_id = $_POST['usuario_id'];
$rol_id = $_POST['rol_id'];
$email = trim($_POST['email']);
$password = $_POST['password'];
$password_repet = $_POST['password_repet'];

// 2. Datos de PERSONAS
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$ci = $_POST['ci'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$profesion = $_POST['profesion'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];

// Lógica de actualización de contraseña
$set_password = "";
if (!empty($password)) {
    if ($password != $password_repet) {
        $_SESSION['mensaje'] = "Error: Las contraseñas no coinciden.";
        header('Location:'.APP_URL."/admin/personas/edit.php?id=".$usuario_id);
        exit();
    }
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $set_password = ", password = :password";
}

try {
    $pdo->beginTransaction();

    // A. ACTUALIZAR TABLA 'usuarios'
    $sql_usu = 'UPDATE usuarios SET rol_id = :rol_id, email = :email' . $set_password . ', fyh_actualizacion = :fyh_actualizacion
                WHERE id_usuario = :id_usuario';
    
    $sentencia_usu = $pdo->prepare($sql_usu);
    $sentencia_usu->bindParam(':rol_id', $rol_id);
    $sentencia_usu->bindParam(':email', $email);
    $sentencia_usu->bindParam(':fyh_actualizacion', $fechaHora); // $fechaHora de config.php
    $sentencia_usu->bindParam(':id_usuario', $usuario_id);
    if (!empty($password)) {
        $sentencia_usu->bindParam(':password', $password_hash);
    }
    $sentencia_usu->execute();

    // B. ACTUALIZAR TABLA 'personas'
    $sentencia_per = $pdo->prepare('UPDATE personas SET 
        nombres = :nombres, apellidos = :apellidos, ci = :ci, fecha_nacimiento = :fecha_nacimiento, 
        profesion = :profesion, direccion = :direccion, celular = :celular, fyh_actualizacion = :fyh_actualizacion
        WHERE usuario_id = :usuario_id');
    
    $sentencia_per->bindParam(':nombres', $nombres);
    $sentencia_per->bindParam(':apellidos', $apellidos);
    $sentencia_per->bindParam(':ci', $ci);
    $sentencia_per->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia_per->bindParam(':profesion', $profesion);
    $sentencia_per->bindParam(':direccion', $direccion);
    $sentencia_per->bindParam(':celular', $celular);
    $sentencia_per->bindParam(':fyh_actualizacion', $fechaHora); 
    $sentencia_per->bindParam(':usuario_id', $usuario_id); 
    $sentencia_per->execute();

    $pdo->commit(); 
    
    $_SESSION['mensaje'] = "Persona actualizada correctamente.";
    header('Location:'.APP_URL."/admin/personas"); 

} catch (Exception $e) {
    $pdo->rollBack(); 
    
    if ($e->getCode() == 23000) { 
        $_SESSION['mensaje'] = "Error: El email o CI ya existe en el sistema (intenta con otro).";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la persona: " . $e->getMessage();
    }
    header('Location:'.APP_URL."/admin/personas/edit.php?id=".$usuario_id); 
}
?>