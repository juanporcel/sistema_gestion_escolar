<?php
include ('../app/config.php');

try {
    $sql = "ALTER TABLE pagos 
            ADD COLUMN tipo_pago VARCHAR(50) NOT NULL DEFAULT 'Cuota' AFTER mes_pagado,
            ADD COLUMN observacion TEXT NULL AFTER comprobante";
    
    $pdo->exec($sql);
    echo "Table 'pagos' updated successfully.";
} catch (PDOException $e) {
    echo "Error updating table: " . $e->getMessage();
}
