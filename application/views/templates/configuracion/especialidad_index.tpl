<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Especialidades</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar especialidad
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objEspecialidad|@count gt 0}
                            {section name=tipo loop=$objEspecialidad}
                            <tr class="active">
                                <td>{$objEspecialidad[tipo]->esp_nombre}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objEspecialidad[tipo]->esp_id}" icono="{$objEspecialidad[tipo]->icon_estado}" id_especialidad="{$objEspecialidad[tipo]->esp_id}">
                                        <i class="fa {$objEspecialidad[tipo]->icon_estado}" id="icon_{$objEspecialidad[tipo]->esp_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/especialidad/editar/{$objEspecialidad[tipo]->esp_id}.html" title="Editar {$objEspecialidad[tipo]->esp_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="mb-xs mt-xs mr-xs modal-sizes boton_eliminar" item="{$objEspecialidad[tipo]->esp_id}" href="#modalSM">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="7" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<div id="modalSM" class="modal-block modal-block-sm mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">¿Estás seguro?</h2>
        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-text">
                    <p>¿Estás seguro de eliminar esta especialidad?</p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary modal-confirm" id="btn_eliminar" item="">Confirmar</button>
                    <button class="btn btn-default modal-dismiss">Cancelar</button>
                </div>
            </div>
        </footer>
    </section>
</div>
<!-- end: page -->