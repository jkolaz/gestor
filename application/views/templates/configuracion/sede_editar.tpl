<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}configuracion/sede/editar/{$ID}" method="post" class="form-horizontal">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                {$message}
                <header class="panel-heading">
                    <h2 class="panel-title">Editar sede</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_sed_nombre" id="txt_sed_nombre" class="form-control" placeholder="ej.: Lima" required value="{$stdSede->sed_nombre}"/>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Visita Hospitalización <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_sed_visita" id="txt_sed_visita" maxlength="250" data-plugin-maxlength="" required rows="3">{$stdSede->sed_visita}</textarea>
                            <p><code>Máximo</code> 250.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consulta Externa <b>(Lunes - Viernes)</b> <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_sed_consulta_lv" id="txt_sed_consulta_lv" maxlength="50" data-plugin-maxlength="" required rows="2">{$stdSede->sed_consulta_lv}</textarea>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Consulta Externa <b>(Sábados)</b> <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_sed_consulta_s" id="txt_sed_consulta_s" maxlength="50" data-plugin-maxlength="" required rows="2">{$stdSede->sed_consulta_s}</textarea>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Farmacia <b>(Lunes - Viernes)</b> <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_sed_farmacia_lv" id="txt_sed_farmacia_lv" maxlength="50" data-plugin-maxlength="" required rows="2">{$stdSede->sed_farmacia_lv}</textarea>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Farmacia <b>(Sábados)</b> <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_sed_farmacia_s" id="txt_sed_farmacia_s" maxlength="50" data-plugin-maxlength="" required rows="2">{$stdSede->sed_farmacia_s}</textarea>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Sede <span class="required">*</span></label>
                        <div class="col-sm-5">
                            <select data-plugin-selectTwo id="txt_sed_reg_id" name="txt_sed_reg_id" class="form-control populate" required>
                                <option value="">Seleccionar región</option>
                                <optgroup label="Región">
                                    {if $objRegion|@count gt 0}
                                        {section name=id loop=$objRegion}
                                    <option value="{$objRegion[id]->reg_id}" {$objRegion[id]->selected}>{$objRegion[id]->reg_nombre}</option>
                                        {/section}
                                    {/if}
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Central Telefónica <span class="required">*</span></label>
                        <div class="col-sm-5">
                            <input type="text" id="txt_st_num" name="txt_st_num" class="form-control populate" required="" value="{if isset($sedeTelefono[0]->st_num)}{$sedeTelefono[0]->st_num}{/if}"/>
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