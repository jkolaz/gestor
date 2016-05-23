<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Página - {$modulo}</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo" modulo="{$modulo_id}">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar nueva página
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
                        <th>URL</th>
                        <th>Icono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                {if $pagina|@count gt 0}
                    {section name=tipo loop=$pagina}
                    <tr class="active">
                        <td>{$pagina[tipo]->pag_nombre}</td>
                        <td>{$SERVER_ADMIN}{$folder}{$pagina[tipo]->pag_url}.html</td>
                        <td class="actions">
                            <a href="javascript:;" class="icono" id="lIcono_{$pagina[tipo]->pag_id}" icono="{$pagina[tipo]->icon_estado}" id_pagina="{$pagina[tipo]->pag_id}">
                                <i class="fa {$pagina[tipo]->icon_estado}" id="icon_{$pagina[tipo]->pag_id}"></i>
                            </a>
                        </td>
                        <td>{$pagina[tipo]->pag_icon}</td>
                        <td class="actions">
                            <a class="text-success" href="{$SERVER_ADMIN}seguridad/pagina/editar/{$pagina[tipo]->pag_id}.html" title="Editar {$pagina[tipo]->pag_nombre}">
                                <i class="fa fa-pencil"></i>
                            </a>&nbsp;&nbsp;&nbsp;
                            <a class="delete-row text-danger" href="javascript:;" onclick="eliminar({$pagina[tipo]->pag_id})" title="Eliminar {$pagina[tipo]->pag_nombre}">
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