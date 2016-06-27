<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
        </div>

        <h2 class="panel-title">Especialidades</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <input type="hidden" name="txt_sed_id" id="txt_sed_id" value="{$id}" />
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objSE|@count gt 1}
                            {section name=tipo loop=$objSE}
                            <tr>
                                <td>{$objSE[tipo]->esp_nombre}</td>
                                <td class="actions">
                                    <div class="switch switch-sm switch-primary especialidad" id_especialidad="{$objSE[tipo]->esp_id}">
                                        <input type="checkbox" name="txt_esp_id[]" id="txt_esp_id_{$objSE[tipo]->esp_id}" data-plugin-ios-switch value="{$objSE[tipo]->esp_id}" {$objSE[tipo]->checked} />
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