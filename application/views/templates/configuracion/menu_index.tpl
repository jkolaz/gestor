<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Menú - {$detalle_menu}</h2>
    </header>
    <div class="panel-body">
        {if $rol eq $idTA}
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo" padre="{$padre}">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar nuevo menú
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        {/if}
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                {if $padre eq 0}
                                <th>URL</th>
                                <th>Sub menús</th>
                                {else}
                                <th>URL</th>
                                {/if}
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objmenu|@count gt 0}
                            {section name=tipo loop=$objmenu}
                            <tr class="active">
                                <td>{$objmenu[tipo]->men_nombre}</td>
                                {if $padre eq 0}
                                <td>
                                    <i class="fa fa-chain"></i> <span>{$objmenu[tipo]->men_ruta}</span>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/menu/submenu/{$objmenu[tipo]->men_id}.html" title="Editar {$objmenu[tipo]->men_nombre}">
                                        <i class="fa fa-book"></i>
                                        <span>Sub menus</span>
                                    </a>
                                </td>
                                {else}
                                <td>
                                    <i class="fa fa-chain"></i> <span>{$objmenu[tipo]->men_ruta}</span>
                                </td>
                                {/if}
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objmenu[tipo]->men_id}" icono="{$objmenu[tipo]->icon_estado}" id_menu="{$objmenu[tipo]->men_id}">
                                        <i class="fa {$objmenu[tipo]->icon_estado}" id="icon_{$objmenu[tipo]->men_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/menu/editar/{$objmenu[tipo]->men_id}.html" title="Editar {$objmenu[tipo]->men_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    {if $rol eq $idTA}
                                    <!--<a class="delete-row" href="javascript:;" onclick="eliminar({$objmenu[tipo]->men_id})" title="Eliminar {$objmenu[tipo]->men_nombre}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>-->
                                    {/if}
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