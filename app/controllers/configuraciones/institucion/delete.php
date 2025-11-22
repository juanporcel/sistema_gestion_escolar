<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 8/1/2024
 * Time: 20:35
 */
include ('../../../../app/config.php');

$id_config_institucion = $_POST['id_config_institucion'];


$sentencia = $pdo->prepare("DELETE FROM configuracion_instituciones where id_config_institucion=:id_config_institucion ");

$sentencia->bindParam('id_config_institucion',$id_config_institucion);


if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se elimino los datos de la institución de la manera correcta en la base de datos";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/configuraciones/institucion");
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base datos, comuniquese con el administrador";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}

