<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Fundador <b>{$sede_nombre}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar
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
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objFundador|@count gt 0}
                            {section name=tipo loop=$objFundador}
                            <tr class="active">
                                <td>{$objFundador[tipo]->fun_nombre}</td>
                                <td>
                                    {if $objFundador[tipo]->fun_imagen neq ""}
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objFundador[tipo]->fun_imagen}">
                                        <img class="img-responsive" width="65" src="{$SERVER_GALLERY}{$objFundador[tipo]->fun_imagen}">
                                    </a>
                                    {/if}
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objFundador[tipo]->fun_id}" icono="{$objFundador[tipo]->icon_estado}" id_fundador="{$objFundador[tipo]->fun_id}">
                                        <i class="fa {$objFundador[tipo]->icon_estado}" id="icon_{$objFundador[tipo]->fun_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/fundador/editar/{$objFundador[tipo]->fun_id}.html" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="6" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<!-- end: page -->