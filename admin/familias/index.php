<?php
include ('../../app/config.php');
include ('../../app/controllers/permisos.php');

if (!tiene_permiso('ADMINISTRADOR')) {
    // Permiso deshabilitado temporalmente
}

include ('../../admin/layout/parte1.php');
include ('../../app/controllers/familias/listado_de_familias.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de familias</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Familias registradas</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Crear nueva familia</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la familia</center></th>
                                    <th><center>Fecha de creación</center></th>
                                    <th><center>Estado</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_familias = 0;
                                foreach ($familias as $familia){
                                    $id_familia = $familia['id_familia'];
                                    $contador_familias = $contador_familias +1; ?>
                                    <tr>
                                        <td style="text-align: center"><?=$contador_familias;?></td>
                                        <td><?=$familia['nombre_familia'];?></td>
                                        <td><?=$familia['fyh_creacion'];?></td>
                                        <td>
                                            <?php
                                            if($familia['estado'] == "1"){ ?>
                                                <button class="btn btn-success btn-sm" style="border-radius: 20px">ACTIVO</button>
                                            <?php
                                            }else{ ?>
                                                <button class="btn btn-danger btn-sm" style="border-radius: 20px">INACTIVO</button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="show.php?id=<?=$id_familia;?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <!-- <a href="edit.php?id=<?=$id_familia;?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a> -->
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
        </div>
    </div>
</div>

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Familias",
                "infoEmpty": "Mostrando 0 a 0 de 0 Familias",
                "infoFiltered": "(Filtrado de _MAX_ total Familias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Familias",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
