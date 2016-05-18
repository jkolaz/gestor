<!-- start: page -->
<div class="alert alert-info">
    Resize the browser to see the responsiveness in action.
</div>

<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
        </div>

        <h2 class="panel-title">Bootstrap Responsive</h2>
    </header>
    <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-default" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                <thead>
                    <tr>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">Nombres</th>
                        <th class="text-center">D.N.I</th>
                        <th class="text-center">Fecha de Nacimiento</th>
                        <th class="text-center">Ver</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Dar de baja</th>
                    </tr>
                </thead>
                <tbody>
                    {if $cantprof gt 0}
                        {section name=i loop=$profesor}
                    <tr>
                        <td class="text-justify">{$profesor[i]->PER_Paterno} {$profesor[i]->PER_Materno}</td>
                        <td class="text-justify">{$profesor[i]->PER_Nombre}</td>
                        <td class="text-justify">{$profesor[i]->PER_DNI}</td>
                        <td class="text-center">{$profesor[i]->PER_FechaNac}</td>
                        <td class="text-center actions">
                            <a href="{$SERVER_ADMIN}seguridad/usuario/verProfesor/{$profesor[i]->PERS_Codigo}.html">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td class="text-center actions">
                            <a href="{$SERVER_ADMIN}seguridad/usuario/editProfesor/{$profesor[i]->PERS_Codigo}.html">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td class="text-center actions">
                            <a href="" class="delete-row on-default"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                        {/section}
                    {/if}
                </tbody>
            </table>
    </div>
</section>
<!-- end: page -->