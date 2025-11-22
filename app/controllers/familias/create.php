<?php
include ('../../config.php');
session_start();

$nombre_familia = $_POST['nombre_familia'];
$fyh_creacion = date('Y-m-d H:i:s');
$estado = '1';

$sentencia = $pdo->prepare("INSERT INTO familias (nombre_familia, fyh_creacion, estado) VALUES (:nombre_familia, :fyh_creacion, :estado)");
$sentencia->bindParam(':nombre_familia', $nombre_familia);
$sentencia->bindParam(':fyh_creacion', $fyh_creacion);
$sentencia->bindParam(':estado', $estado);

if($sentencia->execute()){
    $_SESSION['mensaje'] = "Familia registrada correctamente";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/familias");
}else{
    $_SESSION['mensaje'] = "Error al registrar la familia";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/familias/create.php");
}
?>
