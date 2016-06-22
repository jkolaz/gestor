<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/servicio/editar/{$id}" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Editar de servicio</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_ser_nombre" id="txt_ser_nombre" class="form-control" required value="{$stdServicio->ser_nombre}" maxlength="50" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ser_descripcion", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'>{$stdServicio->ser_descripcion}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lista </label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_ser_listado", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'>{$stdServicio->ser_listado}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen<b>(.jpeg, .jpg, .gif, .png)</b></label>
                        <div class="col-sm-1">
                            <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$stdServicio->ser_imagen}">
                                <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$stdServicio->ser_imagen}">
                            </a>
                        </div>
                        <div class="col-sm-5">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="input-append">
                                    <div class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileupload-exists">Cambiar</span>
                                        <span class="fileupload-new">Seleccionar Archivo</span>
                                        <input type="file" name="txt_ser_imagen" id="txt_ser_imagen" />
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