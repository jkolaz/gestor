<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/home/nuevo" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de evento</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Titulo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_hom_titulo" id="txt_hom_titulo" class="form-control" required value="" maxlength="200" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 200.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Visible</label>
                        <div class="col-sm-6">
                            <div class="switch switch-sm switch-primary menu_web">
                                <input type="checkbox" name="txt_hom_visible" id="txt_hom_visible" data-plugin-ios-switch value="1"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código de video</label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_hom_cod_video" id="txt_hom_cod_video" class="form-control" value="" maxlength="45" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 45.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">URL</label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_hom_url" id="txt_hom_url" class="form-control" value="" maxlength="45" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 45.</p>
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
                                        <input type="file" name="txt_hom_imagen" id="txt_hom_imagen" required/>
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