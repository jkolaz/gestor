<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Directorio <b>{$sede_nombre}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar Directorio
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Directorio</th>
                                <th>Encargado</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objDirectorio|@count gt 0}
                            {section name=tipo loop=$objDirectorio}
                            <tr class="active">
                                <td>{$objDirectorio[tipo]->dir_nombre}</td>
                                <td>{$objDirectorio[tipo]->dir_encargado}</td>
                                <td>{$objDirectorio[tipo]->dir_telefono}</td>
                                <td>{$objDirectorio[tipo]->dir_correo}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objDirectorio[tipo]->dir_id}" icono="{$objDirectorio[tipo]->icon_estado}" id_directorio="{$objDirectorio[tipo]->dir_id}">
                                        <i class="fa {$objDirectorio[tipo]->icon_estado}" id="icon_{$objDirectorio[tipo]->dir_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/directorio/editar/{$objDirectorio[tipo]->dir_id}.html" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="6" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<!-- end: page -->