<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}configuracion/tipoAdmin/editar/{$ID}" method="post" class="form-horizontal">
            <input name="txt_action" id="txt_action" type="hidden" value="editar">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Editar tipo de administrador</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_ta_nombre" id="txt_ta_nombre" class="form-control" placeholder="ej.: Administrador" required autocomplete="off" value="{$TA->ta_nombre}"/>
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