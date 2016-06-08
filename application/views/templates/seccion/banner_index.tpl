<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Banner</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Tipo de banner</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objBanner|@count gt 0}
                            {section name=tipo loop=$objBanner}
                            <tr class="active">
                                <td>{$objBanner[tipo]->tb_nombre}</td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/banner/listar/{$objBanner[tipo]->tb_id}.html" title="Agregar banner - {$objBanner[tipo]->tb_nombre}">
                                        <i class="fa fa-file-image-o"></i>&nbsp;&nbsp;Agregar Banner
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