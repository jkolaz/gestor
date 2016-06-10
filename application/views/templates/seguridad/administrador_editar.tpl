<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seguridad/administrador/editar/{$stdAdm->adm_id}.html" method="post" class="form-horizontal">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                {$message}
                <header class="panel-heading">
                    <h2 class="panel-title">Editar Administrador</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_adm_nombre" id="txt_adm_nombre" class="form-control" required value="{$stdAdm->adm_nombre}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Apellidos <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_adm_apellidos" id="txt_adm_apellidos" class="form-control" required autocomplete="off" value="{$stdAdm->adm_apellidos}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Correo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_adm_correo" id="txt_adm_correo" class="form-control email" required autocomplete="off" value="{$stdAdm->adm_correo}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nick <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_adm_nick" id="txt_adm_nick" class="form-control email" required autocomplete="off" value="{$stdAdm->adm_nick}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contraseña <span class="required">(para cambiar contraseña digite una)</span></label>
                        <div class="col-sm-9">
                            <input type="password" name="txt_adm_password" id="txt_adm_password" class="form-control email" autocomplete="off" value=""/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Sede</label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo id="txt_adm_sed_id" name="txt_adm_sed_id" class="form-control populate">
                                <option value="">Seleccionar sede</option>
                                <optgroup label="Sede">
                                    {if $objSede|@count gt 0}
                                        {section name=id loop=$objSede}
                                    <option value="{$objSede[id]->sed_id}" {$objSede[id]->selected}>{$objSede[id]->sed_nombre}</option>
                                        {/section}
                                    {/if}
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-default">Cancelar</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
</div>