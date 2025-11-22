<?php
// /admin/personas/index.php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');
include ('../../app/controllers/personas/listado.php'); // Obtiene $personas
?>

<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Personas</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Personas registradas</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Registrar nueva Persona</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>N°</center></th>
                                    <th><center>Apellido y nombre</center></th>
                                    <th><center>DNI</center></th>
                                    <th><center>Fecha de nacimiento</center></th>
                                    <th><center>Profesión</center></th>
                                    <th><center>Dirección</center></th>
                                    <th><center>Celular</center></th>
                                    <th><center>Email</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador = 0;
                                foreach ($personas as $persona){
                                    $usuario_id = $persona['usuario_id'];
                                    $contador = $contador +1; ?>
                                    <tr>
                                        <td style="text-align: center"><?=$contador;?></td>
                                        <td><?=$persona['apellido_nombre'];?></td>
                                        <td><?=$persona['dni'];?></td>
                                        <td><?=$persona['fecha_nacimiento'];?></td>
                                        <td><?=$persona['profesion'];?></td>
                                        <td><?=$persona['direccion'];?></td>
                                        <td><?=$persona['celular'];?></td>
                                        <td><?=$persona['email'];?></td>
                                        <td><?=$persona['estado'];?></td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Acciones">
                                                <a href="show.php?id=<?=$usuario_id;?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$usuario_id;?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                
                                                <form action="<?=APP_URL;?>/app/controllers/personas/delete.php" onclick="preguntar<?=$usuario_id;?>(event)" method="post" id="miFormulario<?=$usuario_id;?>">
                                                    <input type="text" name="usuario_id" value="<?=$usuario_id;?>" hidden>
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar<?=$usuario_id;?>(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Eliminar Persona',
                                                            text: '¿Desea eliminar la persona (desactivar usuario)?',
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#a5161d',
                                                            denyButtonColor: '#270a0a',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = document.getElementById('miFormulario<?=$usuario_id;?>');
                                                                form.submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div></div>
    </div>
<?php
include ('../layout/parte2.php');
include ('../../layout/mensajes.php');
?>
<script>
    (function waitForjQueryAndDataTables() {
        if (window.jQuery && jQuery.fn && jQuery.fn.DataTable) {
            jQuery(function () {
                var table = jQuery("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false
                });
                if (table && typeof table.buttons === 'function') {
                    try { table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'); } catch(e){}
                }
            });
        } else {
            setTimeout(waitForjQueryAndDataTables, 50);
        }
    })();
</script>
