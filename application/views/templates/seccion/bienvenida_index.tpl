<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    <header class="panel-heading">

        <h2 class="panel-title">Bienvenidas</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar nueva bienvenida
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objBienvenida|@count gt 0}
                            {section name=tipo loop=$objBienvenida}
                            <tr class="active">
                                <td>{$objBienvenida[tipo]->bie_titulo}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objBienvenida[tipo]->bie_id}" icono="{$objBienvenida[tipo]->icon_estado}" id_bienvenida="{$objBienvenida[tipo]->bie_id}">
                                        <i class="fa {$objBienvenida[tipo]->icon_estado}" id="icon_{$objBienvenida[tipo]->bie_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/bienvenida/editar/{$objBienvenida[tipo]->bie_id}.html" title="Editar {$objBienvenida[tipo]->bie_titulo}">
                                        <i class="fa fa-pencil"></i>
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