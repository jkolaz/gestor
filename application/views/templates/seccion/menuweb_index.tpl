<!-- start: page -->
{if $objMenu|@count gt 1}
    {section name=tipo loop=$objMenu}
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down">s</a>
        </div>

        <h2 class="panel-title">{$objMenu[tipo]->men_nombre}</h2>
    </header>
    <div class="panel-body">
        <!--<div class="row">
            <div class="col-sm-6">
                <div class="mb-md configuracion" sede="{$id}" menu="{$objMenu[tipo]->men_id}">
                    <button id="addToTable" class="btn btn-primary">
                        Configurar menú
                        <i class="fa fa-cogs"></i>
                    </button>
                </div>
            </div>
            {if $objMenu[tipo]->imagen neq ""}
            <div class="col-sm-4">
                <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objMenu[tipo]->imagen}">
                    <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$objMenu[tipo]->imagen}">
                </a>
            </div>
            {/if}
        </div>-->
            <div class="table-responsive">
                    <input type="hidden" name="txt_sed_id" id="txt_sed_id" value="{$id}" />
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>URL</th>
                                <th>Imagen</th>
                                <th>Configuración</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objMenu[tipo]->men_submenu|@count gt 0}
                            {section name=adm loop=$objMenu[tipo]->men_submenu}
                            <tr>
                                <td>{$objMenu[tipo]->men_submenu[adm]->men_nombre}</td>
                                <td>http://www.sanjuandedios.com/seccion/{$nombre_url}/{$objMenu[tipo]->men_ruta}/<b style="color:#0088cc">{$objMenu[tipo]->men_submenu[adm]->men_ruta}</b></td>
                                <td>
                                    {if $objMenu[tipo]->men_submenu[adm]->imagen neq ""}
                                    <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$objMenu[tipo]->men_submenu[adm]->imagen}">
                                        <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$objMenu[tipo]->men_submenu[adm]->imagen}">
                                    </a>
                                    {/if}
                                </td>
                                <td>
                                    <a href="{$SERVER_ADMIN}seccion/menuweb/configuracion/{$id}/{$objMenu[tipo]->men_submenu[adm]->men_id}.html" title="Configurar {$objMenu[tipo]->men_nombre}">
                                        <i class="fa fa-cogs"></i>Configuración
                                    </a>
                                </td>
                                <td class="actions">
                                    <div class="switch switch-sm switch-primary menu_web" id_menu="{$objMenu[tipo]->men_submenu[adm]->men_id}">
                                        <input type="checkbox" name="txt_men_id[]" id="txt_men_id_{$objMenu[tipo]->men_submenu[adm]->men_id}" data-plugin-ios-switch value="{$objMenu[tipo]->men_submenu[adm]->men_id}" {$objMenu[tipo]->men_submenu[adm]->checked} />
                                    </div>
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
    {/section}
{/if}
<!-- end: page -->