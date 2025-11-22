<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 9/1/2024
 * Time: 15:08
 */
$sql_gestiones = "SELECT * FROM gestiones WHERE id_gestion = '$id_gestion' ";
$query_gestiones = $pdo->prepare($sql_gestiones);
$query_gestiones->execute();
$gestiones = $query_gestiones->fetchAll(PDO::FETCH_ASSOC);

foreach ($gestiones as $gestione){
    $gestion= $gestione['gestion'];
    $fyh_creacion = $gestione['fyh_creacion'];
    $estado = $gestione['estado'];
}