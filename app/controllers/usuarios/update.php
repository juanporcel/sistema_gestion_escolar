<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 4/1/2024
 * Time: 20:39
 */

include ('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];
$nombres = $_POST['nombres'];
$rol_id = $_POST['rol_id'];
$email = $_POST['email'];

$password = $_POST['password'];
$password_repet = $_POST['password_repet'];

if($password == ""){

        $sentencia = $pdo->prepare("UPDATE usuarios 
        SET nombres=:nombres,
            rol_id=:rol_id,
            email=:email,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario ");

        $sentencia->bindParam(':nombres',$nombres);
        $sentencia->bindParam(':rol_id',$rol_id);
        $sentencia->bindParam(':email',$email);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);

        try{
            if($sentencia->execute()){
                session_start();
                $_SESSION['mensaje'] = "Se actualizó el usuario de manera correcta en la base de datos";
                $_SESSION['icono'] = "success";
                header('Location:'.APP_URL."/admin/usuarios");
            }else {
                session_start();
                $_SESSION['mensaje'] = "Error, no se pudo actualizar en la base datos, comuniquese con el administrador";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
            }
        }catch (Exception $exception){
            session_start();
            $_SESSION['mensaje'] = "El email de este usuario ya existe en la base de datos";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }


}else{

    if($password == $password_repet){
        //echo "las contraseñas son iguales";
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("UPDATE usuarios 
        SET nombres=:nombres,
            rol_id=:rol_id,
            email=:email,
            password=:password,
            fyh_actualizacion=:fyh_actualizacion
        WHERE id_usuario=:id_usuario ");

        $sentencia->bindParam(':nombres',$nombres);
        $sentencia->bindParam(':rol_id',$rol_id);
        $sentencia->bindParam(':email',$email);
        $sentencia->bindParam(':password',$password);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);

        try{
            if($sentencia->execute()){
                session_start();
                $_SESSION['mensaje'] = "Se registro el usuario de manera correcta en la base de datos";
                $_SESSION['icono'] = "success";
                header('Location:'.APP_URL."/admin/usuarios");
            }else {
                session_start();
                $_SESSION['mensaje'] = "Error, no se pudo registrar en la base datos, comuniquese con el administrador";
                $_SESSION['icono'] = "error";
                ?><script>window.history.back();</script><?php
            }
        }catch (Exception $exception){
            session_start();
            $_SESSION['mensaje'] = "El email de este usuario ya existe en la base de datos";
            $_SESSION['icono'] = "error";
            ?><script>window.history.back();</script><?php
        }
    }else{
        echo "las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas introducidas no son iguales";
        $_SESSION['icono'] = "error";
        ?><script>window.history.back();</script><?php
    }
}







