<?php
// /app/controllers/personas/datos_de_la_persona.php

// ⚠️ $id_persona debe venir del script que incluye este archivo (i.e., show.php)
// Se asume que $id_persona ya ha sido definido.

// Consulta SQL para obtener todos los datos de la persona, incluyendo su usuario y rol asociado.
$sql_persona = "
    SELECT 
        per.*, 
        usu.id_usuario AS id_usuario, 
        usu.email, 
        usu.fyh_creacion,
        usu.estado AS estado, 
        rol.nombre_rol 
    FROM personas AS per 
    -- Se hace JOIN a usuarios usando la clave foránea en la tabla personas (per.usuario_id)
    INNER JOIN usuarios AS usu ON usu.id_usuario = per.usuario_id 
    INNER JOIN roles AS rol ON rol.id_rol = usu.rol_id 
    -- Filtramos por el ID de la persona, que es el que viene de la URL
    WHERE per.id_persona = :id_persona AND per.estado = '1'
";

$query_persona = $pdo->prepare($sql_persona);
// Enlazar el parámetro con el ID de la persona
$query_persona->bindParam(':id_persona', $id_persona); 
$query_persona->execute();

$persona_data = $query_persona->fetch(PDO::FETCH_ASSOC);

if (!$persona_data) {
    // Si la persona no existe o está inactiva, redirigir con un mensaje de error.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['mensaje'] = "Error: Persona no encontrada o inactiva.";
    header('Location:'.APP_URL."/admin/personas"); 
    exit;
}