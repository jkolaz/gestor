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
                        Home
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
                                <th>Visible</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objHome|@count gt 0}
                            {section name=tipo loop=$objHome}
                            <tr class="active">
                                <td>{$objHome[tipo]->hom_titulo}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="visible" id="lVis_{$objHome[tipo]->hom_id}" icono="{$objHome[tipo]->icon_visible}" id_home="{$objHome[tipo]->hom_id}">
                                        <i class="fa {$objHome[tipo]->icon_visible}" id="vis_{$objHome[tipo]->hom_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objHome[tipo]->hom_id}" icono="{$objHome[tipo]->icon_estado}" id_home="{$objHome[tipo]->hom_id}">
                                        <i class="fa {$objHome[tipo]->icon_estado}" id="icon_{$objHome[tipo]->hom_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/home/editar/{$objHome[tipo]->hom_id}.html" title="Editar {$objHome[tipo]->hom_titulo}">
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