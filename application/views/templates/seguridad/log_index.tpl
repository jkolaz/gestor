<div class="row">
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seguridad/log/index" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="buscar">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Registro de novedad</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Fecha</label>
                        <div class="col-sm-2">
                            <input type="text" name="txt_fecha" id="txt_fecha" class="form-control"  required="" readonly="" value="" data-plugin-datepicker="" />
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-3">
                            <button class="btn btn-primary" id="guardar">Buscar</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                </footer>
            </section>
        </form>
    </div>
</div>