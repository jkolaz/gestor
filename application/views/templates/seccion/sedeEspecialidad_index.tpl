<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Especialidades <b>{$sede_nombre}</b></h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Configuración</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objEspecialidades|@count gt 0}
                            {section name=tipo loop=$objEspecialidades}
                            <tr class="active">
                                <td>{$objEspecialidades[tipo]->esp_nombre}</td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/sedeEspecialidad/configuracion/{$objEspecialidades[tipo]->se_id}.html" title="Configurar {$objEspecialidades[tipo]->esp_nombre}">
                                        <i class="fa fa-cogs"></i>Especialidades
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