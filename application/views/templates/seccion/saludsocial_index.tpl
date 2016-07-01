<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Salud y Social - <b>{$sede_nombre}</b></h2>
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
                                <th>Presentación</th>
                                <th>Imagen</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objSS|@count gt 0}
                            {section name=tipo loop=$objSS}
                            <tr class="active">
                                <td>{$objSS[tipo]->ss_nombre}</td>
                                <td>{$objSS[tipo]->presentacion}</td>
                                <td>
                                    {if $objSS[tipo]->ss_imagen neq ""}
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objSS[tipo]->ss_imagen}">
                                        <img class="img-responsive" width="65" src="{$SERVER_GALLERY}{$objSS[tipo]->ss_imagen}">
                                    </a>
                                    {/if}
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objSS[tipo]->ss_id}" icono="{$objSS[tipo]->icon_estado}" id_ss="{$objSS[tipo]->ss_id}">
                                        <i class="fa {$objSS[tipo]->icon_estado}" id="icon_{$objSS[tipo]->ss_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/saludsocial/editar/{$objSS[tipo]->ss_id}.html" title="Editar">
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