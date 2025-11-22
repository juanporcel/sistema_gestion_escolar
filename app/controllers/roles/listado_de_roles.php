<?php
/**
 * Created by PhpStorm.
 * User: HILARIWEB
 * Date: 3/1/2024
 * Time: 16:28
 */
$sql_roles = "SELECT * FROM roles where estado = '1' ";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);