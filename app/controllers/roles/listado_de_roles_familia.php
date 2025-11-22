<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 3/1/2024
 * Time: 16:28
 */
$sql_roles = "SELECT * FROM roles WHERE estado = '1' AND nombre_rol IN ('PADRE/MADRE/TUTOR', 'ALUMNO/A')";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_familia = $query_roles->fetchAll(PDO::FETCH_ASSOC);
