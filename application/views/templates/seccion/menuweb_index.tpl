<!-- start: page -->
{if $objMenu|@count gt 1}
    {section name=tipo loop=$objMenu}
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
        </div>

        <h2 class="panel-title">{$objMenu[tipo]->men_nombre}</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <input type="hidden" name="txt_sed_id" id="txt_sed_id" value="{$id}" />
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>URL</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objMenu[tipo]->men_submenu|@count gt 0}
                            {section name=adm loop=$objMenu[tipo]->men_submenu}
                            <tr>
                                <td>{$objMenu[tipo]->men_submenu[adm]->men_nombre}</td>
                                <td>http://www.sanjuandedios.com/<b style="color:#0088cc">{$objMenu[tipo]->men_submenu[adm]->men_ruta}</b>.html</td>
                                <td class="actions">
                                    <div class="switch switch-sm switch-primary menu_web" id_menu="{$objMenu[tipo]->men_submenu[adm]->men_id}">
                                        <input type="checkbox" name="txt_men_id[]" id="txt_men_id_{$objMenu[tipo]->men_submenu[adm]->men_id}" data-plugin-ios-switch value="{$objMenu[tipo]->men_submenu[adm]->men_id}" {$objMenu[tipo]->men_submenu[adm]->checked} />
                                    </div>
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
    {/section}
{/if}
<!-- end: page -->