<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Servicios</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar servicio
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
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objServicio|@count gt 0}
                            {section name=tipo loop=$objServicio}
                            <tr class="active">
                                <td>{$objServicio[tipo]->ser_nombre}</td>
                                <td>
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objServicio[tipo]->ser_imagen}">
                                        <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$objServicio[tipo]->ser_imagen}">
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objServicio[tipo]->ser_id}" icono="{$objServicio[tipo]->icon_estado}" id_servicio="{$objServicio[tipo]->ser_id}">
                                        <i class="fa {$objServicio[tipo]->icon_estado}" id="icon_{$objServicio[tipo]->ser_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/banner/editar/{$objServicio[tipo]->ser_id}.html" title="Editar {$objServicio[tipo]->ser_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="4" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<!-- end: page -->