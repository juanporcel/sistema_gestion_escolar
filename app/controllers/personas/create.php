<?php
// /app/controllers/personas/create.php

include ('../../../app/config.php');
session_start();

// 1. Datos de PERSONAS

$apellido_nombre = $_POST['apellido_nombre'];
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$profesion = $_POST['profesion'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];
$email = $_POST['email'];

$fyh_creacion = date('Y-m-d H:i:s');
$estado = 1;

try {
    $pdo->beginTransaction();

   $sentencia_perusu = $pdo->prepare('INSERT INTO personas 
    (apellido_nombre, dni, fecha_nacimiento, profesion, direccion, celular, email) 
    VALUES (:apellido_nombre, :dni, :fecha_nacimiento, :profesion, :direccion, :celular, :email)');

$sentencia_perusu->bindParam(':apellido_nombre', $apellido_nombre);
$sentencia_perusu->bindParam(':dni', $dni);
$sentencia_perusu->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$sentencia_perusu->bindParam(':profesion', $profesion);
$sentencia_perusu->bindParam(':direccion', $direccion);
$sentencia_perusu->bindParam(':celular', $celular);
$sentencia_perusu->bindParam(':email', $email);

$sentencia_perusu->execute();


    $pdo->commit(); 
    
    $_SESSION['mensaje'] = "Persona y Usuario registrados correctamente.";
    /*header('Location:'.APP_URL."/admin/personas");*/
    echo "<pre>";
print_r($_POST);
echo $e->getMessage(); // si estás dentro del catch
exit; 

} catch (Exception $e) {
    $pdo->rollBack(); 
    
    if ($e->getCode() == 23000) { 
    $_SESSION['mensaje'] = "Error: El DNI ya existe en el sistema.";
}

    header('Location:'.APP_URL."/admin/personas/create.php"); 
}
?>