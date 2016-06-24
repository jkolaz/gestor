<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/novedad/nuevo" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de novedad</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Titulo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_nov_titulo" id="txt_nov_titulo" class="form-control" required value="" maxlength="200" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 200.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Sub-Titulo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="txt_nov_subtitulo" id="txt_nov_subtitulo" maxlength="250" data-plugin-maxlength="" required rows="3"></textarea>
                            <p><code>Máximo</code> 250.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código Youtube</label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_nov_youtube" id="txt_men_youtube" class="form-control" value="" maxlength="45" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 45.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código ISSUU</label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_nov_issuu" id="txt_men_issuu" class="form-control" value="" maxlength="45" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 45.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_nov_contenido", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Listado</label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_nov_listado", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contáctenos</label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_nov_contactenos", "height": 100, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
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
                                        <input type="file" name="txt_nov_imagen" id="txt_nov_imagen" required/>
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