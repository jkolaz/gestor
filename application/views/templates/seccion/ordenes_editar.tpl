<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/ordenes/editar/{$id}" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Ordenes Hospitalarias  - <b>{$sede_nombre}</b></h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_fun_nombre" id="txt_fun_nombre" class="form-control" required value="{$stdOrdenes->ord_nombre}" maxlength="50" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo Presentación <span class="required">*</span></label>
                        <div class="col-sm-5">
                            <select data-plugin-selectTwo id="txt_adm_sed_id" name="txt_adm_sed_id" class="form-control populate">
                                <option value="">Seleccionar sede</option>
                                <optgroup label="Sede">
                                    {if $objTC|@count gt 0}
                                        {section name=id loop=$objTC}
                                    <option value="{$objTC[id]->tc_id}">{$objTC[id]->tc_descripcion}</option>
                                        {/section}
                                    {/if}
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ord_descripcion", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'>{$stdOrdenes->ord_descripcion}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Datos de interes <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ord_descripcion_2", "height": 100, "codemirror": { "theme": "ambiance" } }{/literal}'>{$stdOrdenes->ord_descripcion_2}</div>
                        </div>
                    </div>
                    {if $stdOrdenes->ord_imagen neq ""}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen <b>Actual</b></label>
                        <div class="col-sm-1">
                            <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$stdOrdenes->ord_imagen}">
                                <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$stdOrdenes->ord_imagen}">
                            </a>
                        </div>
                    </div>
                    {/if}
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen <b>(.jpeg, .jpg, .gif, .png)</b> <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileupload-exists">Cambiar</span>
                                        <span class="fileupload-new">Seleccionar Archivo</span>
                                        <input type="file" name="txt_ord_imagen" id="txt_ord_imagen"/>
                                    </span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-3">
                            <button class="btn btn-primary" id="guardar">Guardar</button>
                            <button type="button" class="btn btn-default" id="cancelar">Cancelar</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
</div>