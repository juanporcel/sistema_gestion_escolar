<?php
$sql_familia = "SELECT * FROM familias WHERE id_familia = :id_familia AND estado = '1'";
$query_familia = $pdo->prepare($sql_familia);
$query_familia->bindParam(':id_familia', $id_familia);
$query_familia->execute();
$familia = $query_familia->fetch(PDO::FETCH_ASSOC);

if(!$familia){
    header('Location:'.APP_URL."/admin/familias");
    exit;
}

$nombre_familia = $familia['nombre_familia'];
$fyh_creacion_familia = $familia['fyh_creacion'];

// Fetch Members
$sql_miembros = "SELECT fp.*, p.apellido_nombre, p.dni, r.nombre_rol 
                 FROM familias_personas fp 
                 INNER JOIN personas p ON fp.persona_id = p.id_persona 
                 INNER JOIN roles r ON fp.rol_id = r.id_rol 
                 WHERE fp.familia_id = :id_familia AND fp.estado = '1'";
$query_miembros = $pdo->prepare($sql_miembros);
$query_miembros->bindParam(':id_familia', $id_familia);
$query_miembros->execute();
$miembros = $query_miembros->fetchAll(PDO::FETCH_ASSOC);

// Fetch Payments
$sql_pagos = "SELECT * FROM pagos WHERE familia_id = :id_familia AND estado = '1' ORDER BY fecha_pago DESC";
$query_pagos = $pdo->prepare($sql_pagos);
$query_pagos->bindParam(':id_familia', $id_familia);
$query_pagos->execute();
$pagos = $query_pagos->fetchAll(PDO::FETCH_ASSOC);
?>
