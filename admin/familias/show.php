<?php
$id_familia = $_GET['id'];
include ('../../app/config.php');
include ('../../app/controllers/permisos.php');

// if (!tiene_permiso('ADMINISTRADOR')) {
//     // Permiso deshabilitado temporalmente
// }

include ('../../app/controllers/familias/datos_familia.php');
include ('../../app/controllers/personas/listado.php'); // For the modal
include ('../../app/controllers/roles/listado_de_roles_familia.php'); // For the modal
include ('../../admin/layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Familia: <?=$nombre_familia;?></h1>
            </div>
            <br>
            <div class="row">
                <!-- Family Details & Members -->
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Integrantes de la familia</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-agregar-integrante">
                                    <i class="bi bi-person-plus"></i> Agregar Integrante
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>DNI</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($miembros as $miembro): ?>
                                    <tr>
                                        <td><?=$miembro['apellido_nombre'];?></td>
                                        <td><?=$miembro['dni'];?></td>
                                        <td><?=$miembro['nombre_rol'];?></td>
                                        <td>
                                            <form action="<?=APP_URL;?>/app/controllers/familias/delete_member.php" method="post" onsubmit="return confirm('¿Eliminar integrante?');">
                                                <input type="hidden" name="id_familia_persona" value="<?=$miembro['id_familia_persona'];?>">
                                                <input type="hidden" name="id_familia" value="<?=$id_familia;?>">
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Payments -->
                <div class="col-md-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pagos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-registrar-pago">
                                    <i class="bi bi-cash-coin"></i> Registrar Pago
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Mes/Año</th>
                                    <th>Tipo</th>
                                    <th>Monto</th>
                                    <th>Fecha Pago</th>
                                    <th>Observación</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_pagos = 0;
                                foreach ($pagos as $pago):
                                    $contador_pagos++;
                                ?>
                                    <tr>
                                        <td><?=$contador_pagos;?></td>
                                        <td><?=$pago['mes_pagado'];?></td>
                                        <td><?=$pago['tipo_pago'];?></td>
                                        <td>$<?=number_format($pago['monto'], 2);?></td>
                                        <td><?=date('d/m/Y', strtotime($pago['fecha_pago']));?></td>
                                        <td><?=$pago['observacion'];?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?php if($pago['comprobante']): ?>
                                                    <a href="<?=APP_URL;?>/public/images/comprobantes/<?=$pago['comprobante'];?>" target="_blank" class="btn btn-info btn-sm"><i class="bi bi-file-earmark-pdf"></i></a>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editar-pago-<?=$pago['id_pago'];?>">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="<?=APP_URL;?>/app/controllers/familias/delete_payment.php" method="post" onsubmit="return confirm('¿Eliminar este pago?');" style="display: inline;">
                                                    <input type="hidden" name="id_pago" value="<?=$pago['id_pago'];?>">
                                                    <input type="hidden" name="id_familia" value="<?=$id_familia;?>">
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Editar Pago -->
                                    <div class="modal fade" id="modal-editar-pago-<?=$pago['id_pago'];?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #28a745; color: white">
                                                    <h4 class="modal-title">Editar Pago</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?=APP_URL;?>/app/controllers/familias/update_payment.php" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_pago" value="<?=$pago['id_pago'];?>">
                                                        <input type="hidden" name="id_familia" value="<?=$id_familia;?>">
                                                        <div class="form-group">
                                                            <label for="">Mes/Año a Pagar</label>
                                                            <input type="month" name="mes_pagado" class="form-control" value="<?=$pago['mes_pagado'];?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Tipo de Pago</label>
                                                            <select name="tipo_pago" class="form-control" required>
                                                                <option value="Cuota" <?=$pago['tipo_pago'] == 'Cuota' ? 'selected' : '';?>>Cuota</option>
                                                                <option value="Matrícula" <?=$pago['tipo_pago'] == 'Matrícula' ? 'selected' : '';?>>Matrícula</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Monto</label>
                                                            <input type="number" name="monto" class="form-control" value="<?=$pago['monto'];?>" required step="0.01">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Fecha de Pago</label>
                                                            <input type="date" name="fecha_pago" class="form-control" value="<?=$pago['fecha_pago'];?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Observación</label>
                                                            <textarea name="observacion" class="form-control" rows="2"><?=$pago['observacion'];?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Comprobante (Dejar vacío para mantener el actual)</label>
                                                            <input type="file" name="comprobante" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-block">Actualizar Pago</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Integrante -->
<div class="modal fade" id="modal-agregar-integrante">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white">
                <h4 class="modal-title">Agregar Integrante</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=APP_URL;?>/app/controllers/familias/add_member.php" method="post">
                    <input type="hidden" name="familia_id" value="<?=$id_familia;?>">
                    <div class="form-group">
                        <label for="">Persona</label>
                        <select name="persona_id" class="form-control select2" style="width: 100%;" required>
                            <option value="">Seleccione una persona...</option>
                            <?php foreach ($personas as $persona): ?>
                                <option value="<?=$persona['id_persona'];?>"><?=$persona['apellido_nombre'];?> - <?=$persona['dni'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Rol Familiar</label>
                        <select name="rol_id" class="form-control" required>
                            <option value="">Seleccione un rol...</option>
                            <?php foreach ($roles_familia as $rol): ?>
                                <option value="<?=$rol['id_rol'];?>"><?=$rol['nombre_rol'];?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Pago -->
<div class="modal fade" id="modal-registrar-pago">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745; color: white">
                <h4 class="modal-title">Registrar Pago</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=APP_URL;?>/app/controllers/familias/add_payment.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_familia" value="<?=$id_familia;?>">
                    <div class="form-group">
                        <label for="">Mes/Año a Pagar</label>
                        <input type="month" name="mes_pagado" class="form-control" value="<?=date('Y-m');?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de Pago</label>
                        <select name="tipo_pago" class="form-control" required>
                            <option value="Cuota">Cuota</option>
                            <option value="Matrícula">Matrícula</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Monto</label>
                        <input type="number" name="monto" class="form-control" required step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="">Fecha de Pago</label>
                        <input type="date" name="fecha_pago" class="form-control" value="<?=date('Y-m-d');?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Observación</label>
                        <textarea name="observacion" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Comprobante</label>
                        <input type="file" name="comprobante" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar Pago</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<script>
    // Initialize Select2 if available (assuming AdminLTE has it)
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#modal-agregar-integrante'),
            placeholder: "Buscar integrante..."
        });
    });
</script>
