<!-- start: page -->
{if $objTipoAdmin|@count gt 1}
    {section name=tipo loop=$objTipoAdmin}
<section class="panel">
    {$message}
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
        </div>

        <h2 class="panel-title">{$objTipoAdmin[tipo]->ta_nombre}</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md nuevo_adm" id="nuevo" id_ta="{$objTipoAdmin[tipo]->ta_id}">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar {$objTipoAdmin[tipo]->ta_nombre}
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
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
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objTipoAdmin[tipo]->Administradores[adm]->adm_id}" icono="{$objTipoAdmin[tipo]->Administradores[adm]->icon_estado}" id_adm="{$objTipoAdmin[tipo]->Administradores[adm]->adm_id}">
                                        <i class="fa {$objTipoAdmin[tipo]->Administradores[adm]->icon_estado}" id="icon_{$objTipoAdmin[tipo]->Administradores[adm]->adm_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    {if $rol eq 1}
                                    <a href="{$SERVER_ADMIN}seguridad/administrador/editar/{$objTipoAdmin[tipo]->Administradores[adm]->adm_id}.html">
                                        <i class="fa fa-pencil"></i>&nbsp;&nbsp;Editar
                                    </a>
                                    {else}
                                    --{$rol}
                                    {/if}
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