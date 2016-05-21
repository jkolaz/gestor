<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Sede</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar nueva sede
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
                                <th>Secciones web</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objSede|@count gt 0}
                            {section name=tipo loop=$objSede}
                            <tr class="active">
                                <td>{$objSede[tipo]->sed_nombre}</td>
                                <td>{$objSede[tipo]->sed_estado}</td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/sede/seccionWeb/{$objSede[tipo]->sed_id}.html" title="Editar {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-key"></i>
                                        <span>Secciones web</span>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/sede/editar/{$objSede[tipo]->sed_id}.html" title="Editar {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <a class="delete-row" href="javascript:;" onclick="eliminar({$objSede[tipo]->sed_id})" title="Eliminar {$objSede[tipo]->sed_nombre}">
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
<!-- end: page -->