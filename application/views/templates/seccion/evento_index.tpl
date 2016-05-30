<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Novedades</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar evento
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
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objEvento|@count gt 0}
                            {section name=tipo loop=$objEvento}
                            <tr class="active">
                                <td>{$objEvento[tipo]->eve_nombre}</td>
                                <td>{$objEvento[tipo]->eve_fecha}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objEvento[tipo]->eve_id}" icono="{$objEvento[tipo]->icon_estado}" id_evento="{$objEvento[tipo]->eve_id}">
                                        <i class="fa {$objEvento[tipo]->icon_estado}" id="icon_{$objEvento[tipo]->eve_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/evento/editar/{$objEvento[tipo]->eve_id}.html" title="Editar {$objEvento[tipo]->eve_nombre}">
                                        <i class="fa fa-pencil"></i>
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
<!-- end: page -->