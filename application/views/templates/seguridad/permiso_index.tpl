<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Permisos de administradores <b>({$nombre})</b></h2>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <input type="hidden" name="txt_ta_id" id="txt_ta_id" value="{$id}" />
            <table class="table mb-none">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Página</th>
                        <th>URL</th>
                        <th>Permiso</th>
                    </tr>
                </thead>
                <tbody>
                {if $obPM|@count gt 0}
                    {section name=tipo loop=$obPM}
                    <tr class="active">
                        <td>
                            <i class="fa {$obPM[tipo]->mod_icon}"></i>
                            {$obPM[tipo]->mod_nombre}
                        </td>
                        <td>
                            <i class="fa {$obPM[tipo]->pag_icon}"></i>
                            {$obPM[tipo]->pag_nombre}
                        </td>
                        <td>
                            {$SERVER_ADMIN}{$obPM[tipo]->mod_url}/{$obPM[tipo]->pag_url}.html
                        </td>
                        <td class="actions">
                            <div class="switch switch-sm switch-primary permiso" id_pagina="{$obPM[tipo]->pag_id}">
                                <input type="checkbox" name="txt_pag_id[]" id="txt_pag_id_{$obPM[tipo]->pag_id}" data-plugin-ios-switch value="{$obPM[tipo]->pag_id}" {$obPM[tipo]->checked}/>
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
<!-- end: page -->