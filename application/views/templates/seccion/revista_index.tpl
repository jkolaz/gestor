<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Revistas</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar revista
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objRevista|@count gt 0}
                            {section name=tipo loop=$objRevista}
                            <tr class="active">
                                <td>{$objRevista[tipo]->rev_nombre}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objRevista[tipo]->rev_id}" icono="{$objRevista[tipo]->icon_estado}" id_revista="{$objRevista[tipo]->rev_id}">
                                        <i class="fa {$objRevista[tipo]->icon_estado}" id="icon_{$objRevista[tipo]->rev_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/revista/editar/{$objRevista[tipo]->rev_id}.html" title="Editar {$objRevista[tipo]->rev_nombre}">
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