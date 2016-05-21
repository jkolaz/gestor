<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Módulos del sistema</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Páginas</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $modulo|@count gt 0}
                            {section name=tipo loop=$modulo}
                            <tr class="active">
                                <td>{$modulo[tipo]->mod_nombre}</td>
                                <td class="actions">
                                    <a class="text-primary" href="{$SERVER_ADMIN}seguridad/pagina/index/{$modulo[tipo]->mod_id}.html" >
                                        <i class="fa fa-file-o"></i>
                                        Páginas
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" onclick="estado({$modulo[tipo]->mod_id}, '{$modulo[tipo]->icon_estado}')">
                                        <i class="fa {$modulo[tipo]->icon_estado}" id="icon_{$modulo[tipo]->mod_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a class="text-success" href="{$SERVER_ADMIN}configuracion/seccion/editar/{$modulo[tipo]->mod_id}.html" title="Editar {$modulo[tipo]->mod_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <a class="delete-row text-danger" href="javascript:;" onclick="eliminar({$modulo[tipo]->mod_id})" title="Eliminar {$modulo[tipo]->mod_nombre}">
                                        <i class="fa fa-trash-o" ></i>
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