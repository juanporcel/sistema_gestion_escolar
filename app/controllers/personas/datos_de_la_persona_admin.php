<?php
// /app/controllers/personas/datos_de_la_persona_admin.php
// Obtiene los datos de una persona sin filtrar por per.estado (útil para edición desde admin)

// Se espera que $id_persona esté definido por el script que incluye este archivo
if (!isset($id_persona)) {
    // intentar recoger desde GET como fallback
    $id_persona = isset($_GET['id']) ? (int) $_GET['id'] : 0;
}

$sql_persona = "
    SELECT 
        per.*, 
        usu.id_usuario AS id_usuario, 
        usu.email, 
        usu.fyh_creacion AS usuario_fyh_creacion,
        usu.estado AS usuario_estado, 
        rol.nombre_rol 
    FROM personas AS per 
    LEFT JOIN usuarios AS usu ON usu.id_usuario = per.usuario_id 
    LEFT JOIN roles AS rol ON rol.id_rol = usu.rol_id 
    WHERE per.id_persona = :id_persona
";

$query_persona = $pdo->prepare($sql_persona);
$query_persona->bindParam(':id_persona', $id_persona);
$query_persona->execute();

$persona_data = $query_persona->fetch(PDO::FETCH_ASSOC);

if (!$persona_data) {
    if (session_status() == PHP_SESSION_NONE) session_start();
    $_SESSION['mensaje'] = "Error: Persona no encontrada.";
    $_SESSION['icono'] = 'warning';
    header('Location:'.APP_URL."/admin/personas");
    exit;
}

?>
