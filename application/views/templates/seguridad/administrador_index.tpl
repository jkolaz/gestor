<!-- start: page -->
<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>
{if $objTipoAdmin|@count gt 1}
    {section name=tipo loop=$objTipoAdmin}
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
        </div>

        <h2 class="panel-title">{$objTipoAdmin[tipo]->ta_nombre}</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Nick</th>
                                <th>Sede</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objTipoAdmin[tipo]->Administradores|@count gt 0}
                            {section name=adm loop=$objTipoAdmin[tipo]->Administradores}
                            <tr>
                                <td>{$objTipoAdmin[tipo]->Administradores[adm]->adm_nombre}</td>
                                <td>{$objTipoAdmin[tipo]->Administradores[adm]->adm_apellidos}</td>
                                <td>{$objTipoAdmin[tipo]->Administradores[adm]->adm_correo}</td>
                                <td>{$objTipoAdmin[tipo]->Administradores[adm]->adm_nick}</td>
                                <td>{$objTipoAdmin[tipo]->Administradores[adm]->sed_nombre}</td>
                                <td>-</td>
                                <td>--</td>
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