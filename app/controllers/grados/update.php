<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 10/1/2024
 * Time: 08:52
 */

include ('../../../app/config.php');

$id_grado = $_POST['id_grado'];
$nivel_id = $_POST['nivel_id'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];

$sentencia = $pdo->prepare('UPDATE grados
SET nivel_id=:nivel_id,
    curso=:curso,
    paralelo=:paralelo,
    fyh_actualizacion=:fyh_actualizacion
WHERE id_grado=:id_grado');

$sentencia->bindParam(':nivel_id',$nivel_id);
$sentencia->bindParam(':curso',$curso);
$sentencia->bindParam(':paralelo',$paralelo);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_grado',$id_grado);

if($sentencia->execute()){
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el grado de la manera correcta en la base de datos";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/grados");
//header('Location:' .$URL.'/');
}else{
    echo 'error al registrar a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base datos, comuniquese con el administrador";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}