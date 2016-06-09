<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/banner/nuevo/{$tipo_id}" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de Banner - {$tipo}</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">URL <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_ban_url" id="txt_ban_url" class="form-control" required value="" maxlength="200" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 200.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="radio-custom">
                                <input type="radio" name="txt_ban_view" id="txt_ban_view_1" class="form-control" required value="1" checked=""/>
                                <label for="txt_ban_view_1">Imagen</label>
                            </div>
                            <div class="radio-custom">
                                <input type="radio" name="txt_ban_view" id="txt_ban_view_0" class="form-control" required value="1"/>
                                <label for="txt_ban_view_0">Youtube</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen<b>(.jpeg, .jpg, .gif, .png)</b></label>
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
                                        <input type="file" name="txt_ban_img" id="txt_ban_img" />
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