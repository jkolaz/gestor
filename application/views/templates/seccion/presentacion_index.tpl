<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Presentación <b>{$sede_nombre}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar Presentación
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objPresentacion|@count gt 0}
                            {section name=tipo loop=$objPresentacion}
                            <tr class="active">
                                <td>{$objPresentacion[tipo]->pre_descripcion}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objPresentacion[tipo]->pre_id}" icono="{$objPresentacion[tipo]->icon_estado}" id_presentacion="{$objPresentacion[tipo]->pre_id}">
                                        <i class="fa {$objPresentacion[tipo]->icon_estado}" id="icon_{$objPresentacion[tipo]->pre_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/presentacion/editar/{$objPresentacion[tipo]->pre_id}.html" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="3" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<!-- end: page -->