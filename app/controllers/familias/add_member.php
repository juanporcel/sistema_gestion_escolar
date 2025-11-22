<?php
include ('../../config.php');
session_start();

$familia_id = $_POST['familia_id'];
$persona_id = $_POST['persona_id'];
$rol_id = $_POST['rol_id'];
$fyh_creacion = date('Y-m-d H:i:s');
$estado = '1';

// Validate if member already exists in this family
$sql_check = "SELECT * FROM familias_personas WHERE familia_id = :familia_id AND persona_id = :persona_id AND estado = '1'";
$query_check = $pdo->prepare($sql_check);
$query_check->bindParam(':familia_id', $familia_id);
$query_check->bindParam(':persona_id', $persona_id);
$query_check->execute();

if($query_check->rowCount() > 0){
    $_SESSION['mensaje'] = "Esta persona ya es miembro de la familia.";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/familias/show.php?id=".$familia_id);
    exit;
}

$sentencia = $pdo->prepare("INSERT INTO familias_personas (familia_id, persona_id, rol_id, fyh_creacion, estado) VALUES (:familia_id, :persona_id, :rol_id, :fyh_creacion, :estado)");
$sentencia->bindParam(':familia_id', $familia_id);
$sentencia->bindParam(':persona_id', $persona_id);
$sentencia->bindParam(':rol_id', $rol_id);
$sentencia->bindParam(':fyh_creacion', $fyh_creacion);
$sentencia->bindParam(':estado', $estado);

if($sentencia->execute()){
    $_SESSION['mensaje'] = "Integrante agregado correctamente";
    $_SESSION['icono'] = "success";
}else{
    $_SESSION['mensaje'] = "Error al agregar integrante";
    $_SESSION['icono'] = "error";
}

header('Location:'.APP_URL."/admin/familias/show.php?id=".$familia_id);
?>
