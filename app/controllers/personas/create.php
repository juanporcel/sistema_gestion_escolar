<?php
// /app/controllers/personas/create.php

include ('../../../app/config.php');
session_start();

// 1. Datos de USUARIOS
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

// Validación de Contraseña
if ($password != $password_repet) {
    $_SESSION['mensaje'] = "Error: Las contraseñas no coinciden.";
    header('Location:'.APP_URL."/admin/personas/create.php");
    exit();
}
$password_hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();

    // A. INSERTAR EN TABLA 'usuarios'
    $sentencia_usu = $pdo->prepare('INSERT INTO usuarios 
        (rol_id, email, password, fyh_creacion, estado) 
        VALUES (:rol_id, :email, :password, :fyh_creacion, :estado)');
    
    $sentencia_usu->bindParam(':rol_id', $rol_id);
    $sentencia_usu->bindParam(':email', $email);
    $sentencia_usu->bindParam(':password', $password_hash);
    $sentencia_usu->bindParam(':fyh_creacion', $fechaHora); // $fechaHora de config.php
    $sentencia_usu->bindParam(':estado', $estado_de_registro); // $estado_de_registro de config.php
    $sentencia_usu->execute();
    
    $usuario_id = $pdo->lastInsertId();

    // B. INSERTAR EN TABLA 'personas'
    $sentencia_per = $pdo->prepare('INSERT INTO personas 
        (usuario_id, nombres, apellidos, ci, fecha_nacimiento, profesion, direccion, celular, fyh_creacion, estado) 
        VALUES (:usuario_id, :nombres, :apellidos, :ci, :fecha_nacimiento, :profesion, :direccion, :celular, :fyh_creacion, :estado)');
    
    $sentencia_per->bindParam(':usuario_id', $usuario_id);
    $sentencia_per->bindParam(':nombres', $nombres);
    $sentencia_per->bindParam(':apellidos', $apellidos);
    $sentencia_per->bindParam(':ci', $ci);
    $sentencia_per->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia_per->bindParam(':profesion', $profesion);
    $sentencia_per->bindParam(':direccion', $direccion);
    $sentencia_per->bindParam(':celular', $celular);
    $sentencia_per->bindParam(':fyh_creacion', $fechaHora); 
    $sentencia_per->bindParam(':estado', $estado_de_registro); 
    $sentencia_per->execute();

    $pdo->commit(); 
    
    $_SESSION['mensaje'] = "Persona y Usuario registrados correctamente.";
    header('Location:'.APP_URL."/admin/personas"); 

} catch (Exception $e) {
    $pdo->rollBack(); 
    
    if ($e->getCode() == 23000) { 
        $_SESSION['mensaje'] = "Error: El email o CI ya existe en el sistema.";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la persona: " . $e->getMessage();
    }
    header('Location:'.APP_URL."/admin/personas/create.php"); 
}
?>