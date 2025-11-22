<?php
include ('../../config.php');
session_start();

$id_familia_persona = $_POST['id_familia_persona'];
$id_familia = $_POST['id_familia'];

$sentencia = $pdo->prepare("UPDATE familias_personas SET estado = '0' WHERE id_familia_persona = :id_familia_persona");
$sentencia->bindParam(':id_familia_persona', $id_familia_persona);

if($sentencia->execute()){
    $_SESSION['mensaje'] = "Integrante eliminado correctamente";
    $_SESSION['icono'] = "success";
}else{
    $_SESSION['mensaje'] = "Error al eliminar integrante";
    $_SESSION['icono'] = "error";
}

header('Location:'.APP_URL."/admin/familias/show.php?id=".$id_familia);
?>
