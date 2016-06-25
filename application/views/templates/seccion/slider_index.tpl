<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Slider <b>{$sede_nombre}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar Slider
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objSlider|@count gt 0}
                            {section name=tipo loop=$objSlider}
                            <tr class="active">
                                <td>
                                    {if $objSlider[tipo]->sli_imagen neq ""}
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objSlider[tipo]->sli_imagen}">
                                        <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$objSlider[tipo]->sli_imagen}">
                                    </a>
                                    {/if}
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objSlider[tipo]->sli_id}" icono="{$objSlider[tipo]->icon_estado}" id_slider="{$objSlider[tipo]->sli_id}">
                                        <i class="fa {$objSlider[tipo]->icon_estado}" id="icon_{$objSlider[tipo]->sli_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/slider/editar/{$objSlider[tipo]->sli_id}.html" title="Editar {$objSlider[tipo]->sli_imagen}">
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