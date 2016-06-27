<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/directorio/nuevo" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="nuevo">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Directorio - <b>{$sede_nombre}</b></h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Área <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_dir_nombre" id="txt_dir_nombre" class="form-control" required value="" maxlength="50" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 50.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Encargado <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_dir_encargado" id="txt_dir_encargado" class="form-control" required value="" maxlength="100" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 100.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefono <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_dir_telefono" id="txt_dir_telefono" class="form-control" required value="" maxlength="100" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 100.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Correo <span class="required">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" name="txt_dir_correo" id="txt_dir_correo" class="form-control" required value="" maxlength="100" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 100.</p>
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