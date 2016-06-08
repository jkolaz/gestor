<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Banner - <b>{$tipo}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo" tipo="{$id}">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar banner - {$tipo}
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
                        {if $objBanner|@count gt 0}
                            {section name=tipo loop=$objBanner}
                            <tr class="active">
                                <td>{$objBanner[tipo]->ban_img}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objBanner[tipo]->ban_id}" icono="{$objBanner[tipo]->icon_estado}" id_banner="{$objBanner[tipo]->ban_id}">
                                        <i class="fa {$objBanner[tipo]->icon_estado}" id="icon_{$objBanner[tipo]->ban_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/banner/editar/{$objBanner[tipo]->ban_id}.html" title="Editar {$objBanner[tipo]->ban_img}">
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