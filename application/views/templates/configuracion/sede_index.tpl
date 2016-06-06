<!-- start: page -->
<!--<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>-->
<section class="panel">
    {$message}
    <header class="panel-heading">
        <h2 class="panel-title">Sede</h2>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-md" id="nuevo">
                    <button id="addToTable" class="btn btn-primary">
                        Registrar nueva sede
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
                                <th>Secciones web</th>
                                <th>Menú web</th>
                                <th>Especialidades</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        {if $objSede|@count gt 0}
                            {section name=tipo loop=$objSede}
                            <tr class="active">
                                <td>{$objSede[tipo]->sed_nombre}</td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/sede/seccionWeb/{$objSede[tipo]->sed_id}.html" title="Editar {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-key"></i>
                                        <span>Secciones web</span>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/menuweb/index/{$objSede[tipo]->sed_id}.html" title="Editar menú web - {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-tags"></i>
                                        <span>Menú perminitidos</span>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}seccion/sedeEspecialidad/permiso/{$objSede[tipo]->sed_id}.html" title="Administrar especialidades - {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-stethoscope"></i>
                                        <span>Especialidades</span>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="javascript:;" class="icono" id="lIcono_{$objSede[tipo]->sed_id}" icono="{$objSede[tipo]->icon_estado}" id_sede="{$objSede[tipo]->sed_id}">
                                        <i class="fa {$objSede[tipo]->icon_estado}" id="icon_{$objSede[tipo]->sed_id}"></i>
                                    </a>
                                </td>
                                <td class="actions">
                                    <a href="{$SERVER_ADMIN}configuracion/sede/editar/{$objSede[tipo]->sed_id}.html" title="Editar {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <a class="delete-row" href="javascript:;" onclick="eliminar({$objSede[tipo]->sed_id})" title="Eliminar {$objSede[tipo]->sed_nombre}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
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