<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Secciones Web <b>({$nombre})</b></h2>
    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <input type="hidden" name="txt_sed_id" id="txt_sed_id" value="{$id}" />
            <table class="table mb-none">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Permiso</th>
                    </tr>
                </thead>
                <tbody>
                {if $objSeccion|@count gt 0}
                    {section name=tipo loop=$objSeccion}
                    <tr class="active">
                        <td>{$objSeccion[tipo]->sec_nombre}</td>
                        <td class="actions">
                            <div class="switch switch-sm switch-primary seccion_web" id_seccion="{$objSeccion[tipo]->sec_id}">
                                <input type="checkbox" name="txt_sec_id[]" id="txt_sec_id_{$objSeccion[tipo]->sec_id}" data-plugin-ios-switch value="{$objSeccion[tipo]->sec_id}"/>
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