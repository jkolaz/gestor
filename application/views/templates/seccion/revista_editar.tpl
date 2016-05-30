<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/revista/editar/{$id}.html" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de evento</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_rev_nombre" id="txt_rev_nombre" class="form-control" required value="{$stdRevista->rev_nombre}" maxlength="200" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 200.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Código ISSUU</label>
                        <div class="col-sm-5">
                            <input type="text" name="txt_rev_issuu" id="txt_rev_issuu" class="form-control"  value="{$stdRevista->rev_issuu}" maxlength="45" data-plugin-maxlength="" />
                            <p><code>Máximo</code> 45.</p>
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