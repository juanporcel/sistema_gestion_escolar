<?php
// /app/controllers/personas/listado.php

// ⚠️ RUTA CORREGIDA: Sube dos niveles para llegar a la carpeta principal (sge/)
include ('../../config.php'); 

if (!isset($pdo)) {
    // Esto es un control de error. Si la conexión falla, se detiene aquí.
    echo "ERROR: La variable \$pdo no está definida. Revisa la ruta de config.php.";
    die();
}

// Sentencia SQL para obtener personas, uniendo con usuarios y roles 
// para obtener el email y el nombre del rol, que son necesarios en la vista.
$sql_personas = "
   SELECT 
        p.apellido_nombre, 
        p.dni,
        p.fecha_nacimiento, 
        p.profesion, 
        p.direccion, 
        p.celular,
        p.email,
        p.estado
    FROM personas p
    ORDER BY p.id_persona ASC
";

$query_personas = $pdo->prepare($sql_personas);
$query_personas->execute();


$personas = $query_personas->fetchAll(PDO::FETCH_ASSOC);

// 🛑 DIAGNÓSTICO RETIRADO: Ya no se detiene la ejecución.
//var_dump($personas); 
//die();