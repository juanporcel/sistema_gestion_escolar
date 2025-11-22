<?php
include ('../../config.php');
session_start();

$familia_id = $_POST['id_familia'];
$mes_pagado = $_POST['mes_pagado'];
$tipo_pago = $_POST['tipo_pago'];
$monto = $_POST['monto'];
$fecha_pago = $_POST['fecha_pago'];
$observacion = $_POST['observacion'];
$fyh_creacion = date('Y-m-d H:i:s');

$comprobante = "";
if (isset($_FILES['comprobante']) && $_FILES['comprobante']['name'] != "") {
    $nombre_archivo = date('Ymd_His') . "_" . $_FILES['comprobante']['name'];
    $ruta_archivo = __DIR__ . "/../../../public/images/comprobantes/" . $nombre_archivo;
    if (move_uploaded_file($_FILES['comprobante']['tmp_name'], $ruta_archivo)) {
        $comprobante = $nombre_archivo;
    }
}

try {
    $sentencia = $pdo->prepare("INSERT INTO pagos (familia_id, mes_pagado, tipo_pago, monto, fecha_pago, observacion, comprobante, fyh_creacion, estado) VALUES (:familia_id, :mes_pagado, :tipo_pago, :monto, :fecha_pago, :observacion, :comprobante, :fyh_creacion, '1')");
    $sentencia->bindParam(':familia_id', $familia_id);
    $sentencia->bindParam(':mes_pagado', $mes_pagado);
    $sentencia->bindParam(':tipo_pago', $tipo_pago);
    $sentencia->bindParam(':monto', $monto);
    $sentencia->bindParam(':fecha_pago', $fecha_pago);
    $sentencia->bindParam(':observacion', $observacion);
    $sentencia->bindParam(':comprobante', $comprobante);
    $sentencia->bindParam(':fyh_creacion', $fyh_creacion);
    $sentencia->execute();
    $_SESSION['mensaje'] = "Pago registrado correctamente";
    $_SESSION['icono'] = "success";
} catch (Exception $e) {
    $_SESSION['mensaje'] = "Error al registrar el pago: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

header('Location:'.APP_URL."/admin/familias/show.php?id=".$familia_id);
?>
