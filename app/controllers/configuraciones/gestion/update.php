<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 9/1/2024
 * Time: 15:17
 */
include ('../../../../app/config.php');

$id_gestion = $_POST['id_gestion'];
$gestion = $_POST['gestion'];
$estado = $_POST['estado'];

if($estado=="ACTIVO"){
    $estado = 1;
}else{
    $estado = 0;
}

$sentencia = $pdo->prepare('UPDATE gestiones
 SET gestion=:gestion,
     fyh_actualizacion=:fyh_actualizacion,
     estado=:estado
WHERE id_gestion=:id_gestion');

$sentencia->bindParam(':gestion',$gestion);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('estado',$estado);
$sentencia->bindParam('id_gestion',$id_gestion);

if($sentencia->execute()){
    //echo 'success';
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la gestión educativa de la manera correcta en la base de datos";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/configuraciones/gestion");
//header('Location:' .$URL.'/');
}else{
    echo 'error al registrar a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base datos, comuniquese con el administrador";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}