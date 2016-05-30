<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/bienvenida/nuevo" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de Bienvenida</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Titulo <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_bie_titulo" id="txt_bie_titulo" class="form-control" required value="" maxlength="200" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 200.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_bie_contenido", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'></div>
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