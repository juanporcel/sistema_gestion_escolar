<?php



session_start();


include ('../../../app/config.php');

// Verificar que el usuario esté logueado
$usuario_id = $_SESSION['id_usuario'] ?? null;
if (!$usuario_id) {
    die("Error: usuario no autenticado.");
}

// Datos del formulario
$apellido_nombre  = $_POST['apellido_nombre'] ?? '';
$dni              = $_POST['dni'] ?? '';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
$profesion        = $_POST['profesion'] ?? '';
$direccion        = $_POST['direccion'] ?? '';
$celular          = $_POST['celular'] ?? '';
$email            = $_POST['email'] ?? '';

$fyh_creacion = date('Y-m-d H:i:s');
$estado = 1;

// Verificar si el DNI ya existe
$sentencia = $pdo->prepare("SELECT * FROM personas WHERE dni = :dni");
$sentencia->bindParam(':dni', $dni);
$sentencia->execute();
$persona = $sentencia->fetch(PDO::FETCH_ASSOC);

if ($persona) {
    $_SESSION['mensaje'] = "Este DNI ya se encuentra registrado.";
    $_SESSION['icono'] = "error";
    header('Location:'.APP_URL."/admin/personas/create.php");
    exit;
}


try {
    $pdo->beginTransaction();

    $sentencia = $pdo->prepare('
        INSERT INTO personas 
        (apellido_nombre, dni, fecha_nacimiento, profesion, direccion, celular, email, fyh_creacion, estado, usuario_id)
        VALUES (:apellido_nombre, :dni, :fecha_nacimiento, :profesion, :direccion, :celular, :email, :fyh_creacion, :estado, :usuario_id)
    ');

    $sentencia->bindParam(':apellido_nombre', $apellido_nombre);
    $sentencia->bindParam(':dni', $dni);
    $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $sentencia->bindParam(':profesion', $profesion);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':celular', $celular);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':fyh_creacion', $fyh_creacion);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':usuario_id', $usuario_id);

    $sentencia->execute();
    $pdo->commit();

    $_SESSION['mensaje'] = "Persona registrada correctamente.";
    header('Location:'.APP_URL."/admin/personas");
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    $_SESSION['mensaje'] = "Error al registrar la persona: " . $e->getMessage();
    header('Location:'.APP_URL."/admin/personas/create.php");
    exit;
}

