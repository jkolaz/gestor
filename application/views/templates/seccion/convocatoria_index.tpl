<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Convocatorias</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar Convocatoria
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
                        {if $objConvocatoria|@count gt 0}
                            {section name=tipo loop=$objConvocatoria}
                            <tr class="active">
                                <td>{$objConvocatoria[tipo]->con_nombre}</td>
                                <td>
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objConvocatoria[tipo]->con_imagen}">
                                        <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$objConvocatoria[tipo]->con_imagen}">
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objConvocatoria[tipo]->con_id}" icono="{$objConvocatoria[tipo]->icon_estado}" id_convocatoria="{$objConvocatoria[tipo]->con_id}">
                                        <i class="fa {$objConvocatoria[tipo]->icon_estado}" id="icon_{$objConvocatoria[tipo]->con_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/convocatoria/editar/{$objConvocatoria[tipo]->con_id}.html" title="Editar {$objConvocatoria[tipo]->con_nombre}">
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