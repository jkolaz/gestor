<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/ordenes/nuevo" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Ordenes Hospitalarias - <b>{$sede_nombre}</b></h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_ord_nombre" id="txt_ord_nombre" class="form-control" required value="" maxlength="100" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 100.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo Presentación <span class="required">*</span></label>
                        <div class="col-sm-5">
                            <select data-plugin-selectTwo id="txt_ord_tc_id" name="txt_ord_tc_id" class="form-control populate" required="">
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
                        <label class="col-sm-3 control-label">1° Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ord_descripcion", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">2° Contenido</label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ord_descripcion_2", "height": 100, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen <span class="required">*</span></label>
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