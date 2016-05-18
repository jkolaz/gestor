<!-- start: page -->
<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
        </div>

        <h2 class="panel-title">Registro de actividades</h2>
    </header>
    <div class="panel-body">
            <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Administrador</th>
                                <th>Mensaje</th>
                                <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $log|@count gt 0}
                            {section name=adm loop=$log}
                            <tr>
                                <td>{$log[adm]->fecha}</td>
                                <td>{$log[adm]->admin}</td>
                                <td>{$log[adm]->mensaje}</td>
                                <td>--</td>
                            </tr>
                            {/section}
                        {else}
                            <tr>
                                <td colspan="4" class="text-center"><b>No se encontraron registros</b></td>
                            </tr>
                        {/if}
                        </tbody>
                    </table>
            </div>
    </div>
</section>
<!-- end: page -->