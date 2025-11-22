<?php
include ('../../config.php');
include ('../../controllers/permisos.php');

// if (!tiene_permiso('ADMINISTRADOR')) {
//     // Permiso deshabilitado temporalmente
// }

$id_pago = $_POST['id_pago'];
$id_familia = $_POST['id_familia'];
$mes_pagado = $_POST['mes_pagado'];
$tipo_pago = $_POST['tipo_pago'];
$monto = $_POST['monto'];
$fecha_pago = $_POST['fecha_pago'];
$observacion = $_POST['observacion'];

// Handle file upload if a new file is provided
if ($_FILES['comprobante']['name'] != "") {
    $nombre_archivo = date('Y-m-d-H-i-s') . $_FILES['comprobante']['name'];
    $location = "../../../public/images/comprobantes/" . $nombre_archivo;
    move_uploaded_file($_FILES['comprobante']['tmp_name'], $location);
    
    $sentencia = $pdo->prepare("UPDATE pagos SET mes_pagado=:mes_pagado, tipo_pago=:tipo_pago, monto=:monto, fecha_pago=:fecha_pago, comprobante=:comprobante, observacion=:observacion WHERE id_pago=:id_pago");
    $sentencia->bindParam('comprobante', $nombre_archivo);
} else {
    $sentencia = $pdo->prepare("UPDATE pagos SET mes_pagado=:mes_pagado, tipo_pago=:tipo_pago, monto=:monto, fecha_pago=:fecha_pago, observacion=:observacion WHERE id_pago=:id_pago");
}

$sentencia->bindParam('mes_pagado', $mes_pagado);
$sentencia->bindParam('tipo_pago', $tipo_pago);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('fecha_pago', $fecha_pago);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('id_pago', $id_pago);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Pago actualizado correctamente";
    $_SESSION['icono'] = "success";
    header('Location:'.APP_URL."/admin/familias/show.php?id=".$id_familia);
}else{
    session_start();
    $_SESSION['mensaje'] = "Error al actualizar el pago";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/familias/show.php?id=".$id_familia);
}
