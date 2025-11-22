<?php
$sql_familias = "SELECT * FROM familias WHERE estado = '1'";
$query_familias = $pdo->prepare($sql_familias);
$query_familias->execute();
$familias = $query_familias->fetchAll(PDO::FETCH_ASSOC);
?>
