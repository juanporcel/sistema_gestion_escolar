<?php
include ('../../config.php');
include ('../../controllers/permisos.php');

// if (!tiene_permiso('ADMINISTRADOR')) {
//     // Permiso deshabilitado temporalmente
// }

$id_pago = $_POST['id_pago'];
$id_familia = $_POST['id_familia'];

$sentencia = $pdo->prepare("UPDATE pagos SET estado = '0' WHERE id_pago = :id_pago");
$sentencia->bindParam('id_pago', $id_pago);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Pago eliminado correctamente";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/familias/show.php?id=".$id_familia);
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar el pago";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/familias/show.php?id=".$id_familia);
}
