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
                        Registrar novedad
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
                                <th>Sub-Titulo</th>
                                <th>Destacado</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objNovedad|@count gt 0}
                            {section name=tipo loop=$objNovedad}
                            <tr class="active">
                                <td>{$objNovedad[tipo]->nov_titulo}</td>
                                <td>{$objNovedad[tipo]->nov_subtitulo}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="destacado" id="iDes_{$objNovedad[tipo]->nov_id}" icono="{$objNovedad[tipo]->icon_destacado}" id_novedad="{$objNovedad[tipo]->nov_id}">
                                        <i class="fa {$objNovedad[tipo]->icon_destacado}" id="icond_{$objNovedad[tipo]->nov_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objNovedad[tipo]->nov_id}" icono="{$objNovedad[tipo]->icon_estado}" id_novedad="{$objNovedad[tipo]->nov_id}">
                                        <i class="fa {$objNovedad[tipo]->icon_estado}" id="icon_{$objNovedad[tipo]->nov_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/novedad/editar/{$objNovedad[tipo]->nov_id}.html" title="Editar {$objNovedad[tipo]->nov_titulo}">
                                        <i class="fa fa-pencil"></i>
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