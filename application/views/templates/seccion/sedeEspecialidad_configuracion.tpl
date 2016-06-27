<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Médicos - <b>{$especialidad_nombre}</b></h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo" esp="{$id}">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar medico
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objMedico|@count gt 0}
                            {section name=tipo loop=$objMedico}
                            <tr class="active">
                                <td>{$objMedico[tipo]->med_nombre}</td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objMedico[tipo]->med_id}" icono="{$objMedico[tipo]->icon_estado}" id_medico="{$objMedico[tipo]->med_id}">
                                        <i class="fa {$objMedico[tipo]->icon_estado}" id="icon_{$objMedico[tipo]->med_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/sedeEspecialidad/editarMedico/{$objMedico[tipo]->med_id}.html" title="Editar {$objMedico[tipo]->med_nombre}">
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