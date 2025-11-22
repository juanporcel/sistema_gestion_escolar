<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 28/12/2023
 * Time: 19:57
 */
include ('../app/config.php');

session_start();

if(isset($_SESSION['sesion_email'])){
    session_destroy();
    header('Location: '.APP_URL.'/login');
}