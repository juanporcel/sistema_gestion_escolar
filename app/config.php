<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 28/12/2023
 * Time: 19:18
 */
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','juan1234');
define('BD','u550339737_sisgestionesco');

define('APP_NAME','SISTEMA DE GESTIÓN ESCOLAR');
/*define('APP_URL','https://colegiosantamariadelvallegrande.com/sge'); HOSTINGER*/

define('APP_URL','http://localhost/sge/'); 
define('KEY_API_MAPS','');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "conexión existosa a la base de datos";
}catch (PDOException $e){
    print_r($e);
    echo "error no se pudo conectar a la base de datos";
}

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date('Y-m-d H:i:s');

$fecha_actual = date('Y-m-d');
$dia_actual = date('d');
$mes_actual = date('m');
$ano_actual = date('Y');

$estado_de_registro = '1';



