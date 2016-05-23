<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Tipo de Administradores</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar tipo de administrador
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
                                <th>Permisos</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objTA|@count gt 0}
                            {section name=tipo loop=$objTA}
                            <tr class="active">
                                <td>{$objTA[tipo]->ta_nombre}</td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seguridad/permiso/index/{$objTA[tipo]->ta_id}.html" class="text-primary">
                                        <i class="fa fa-key"></i> <span>Permisos</span>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objTA[tipo]->ta_id}" icono="{$objTA[tipo]->icon_estado}" id_ta="{$objTA[tipo]->ta_id}">
                                        <i class="fa {$objTA[tipo]->icon_estado}" id="icon_{$objTA[tipo]->ta_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seguridad/tipoAdmin/editar/{$objTA[tipo]->ta_id}.html" title="Editar {$objTA[tipo]->ta_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="delete-row" href="javascript:;" onclick="eliminar({$objTA[tipo]->ta_id})" title="Eliminar {$objTA[tipo]->ta_nombre}">
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