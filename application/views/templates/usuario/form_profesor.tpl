<div class="row">
    <div class="col-lg-12">
        <section class="panel form-wizard" id="w4">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <a href="#" class="fa fa-times"></a>
                </div>
                <h2 class="panel-title">Nuevo de profesor</h2>
            </header>
            <div class="panel-body">
                <div class="wizard-progress wizard-progress-lg">
                    <div class="steps-progress">
                        <div class="progress-indicator"></div>
                    </div>
                    <ul class="wizard-steps">
                        <li class="active">
                            <a href="#w4-account" data-toggle="tab"><span>1</span>Datos Generales</a>
                        </li>
                        <li>
                            <a href="#w4-profile" data-toggle="tab"><span>2</span>Cuenta</a>
                        </li>
                        <li>
                            <a href="#w4-confirm" data-toggle="tab"><span>3</span>Confirmación</a>
                        </li>
                    </ul>
                </div>
                <form class="form-horizontal" id="frmProfesor" method="POST" action="{$SERVER_ADMIN}seguridad/usuario/registrarProfesor" enctype="multipart/form-data">
                    <div class="tab-content">
                        <div id="w4-account" class="tab-pane active">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_nombre">Nombre</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="txt_nombre" id="txt_nombre" required placeholder="Nombre.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_nombre">Apellidos</label>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="txt_paterno" name="txt_paterno" value="" required placeholder="Apellido Paterno.">
                                        </div>
                                        <div class="visible-xs mb-md"></div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="txt_materno" name="txt_materno" value="" required placeholder="Apellido Materno.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="txt_dni">DNI</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control number" maxlength="8" minlength="8" id="txt_dni" name="txt_dni" value="" required placeholder="D.N.I.">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Foto<span class="required">*</span></label>
                                <div class="col-sm-6">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fa fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileupload-exists">Change</span>
                                                <span class="fileupload-new">Select file</span>
                                                <input type="file" name="txt_foto" id="txt_foto" required />
                                            </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                    <label class="error" for="txt_foto"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="txt_nac">Fecha de Nacimiento</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control date" id="txt_nac" placeholder="____-__-__" data-input-mask="9999-99-99" data-plugin-datepicker data-plugin-masked-input readonly required name="txt_nac" value="">
                                    </div>
                                    <label class="error" for="txt_nac"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Sexo</label>
                                <div class="col-sm-9">
                                    <div class="radio-custom radio-primary">
                                        <input id="txt_sexo_M" type="radio" required name="txt_sexo" value="M">
                                        <label for="txt_sexo_M">Hombre</label>
                                    </div>
                                    <div class="radio-custom radio-primary">
                                        <input id="txt_sexo_F" type="radio" required name="txt_sexo" value="F">
                                        <label for="txt_sexo_F">Mujer</label>
                                    </div>
                                    <label class="error" for="txt_sexo"></label>
                                </div>
                            </div>
                        </div>
                        <div id="w4-profile" class="tab-pane">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_usuario">Usuario<span class="required">*</span></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" name="txt_usuario" id="txt_usuario" class="form-control" maxlength="6" minlength="6" placeholder="Nick." required/>
                                    </div>
                                    <label class="error" for="txt_usuario"></label>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_password">Contraseña<span class="required">*</span></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="password" name="txt_password" id="txt_password" class="form-control" maxlength="6" minlength="6" placeholder="******" required/>
                                    </div>
                                    <label class="error" for="txt_password"></label>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_password_conf">Confirma contraseña<span class="required">*</span></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-key"></i>
                                        </span>
                                        <input type="password" name="txt_password_conf" id="txt_password_conf" equalTo="#txt_password" class="form-control" maxlength="6" minlength="6" placeholder="******" required/>
                                    </div>
                                    <label class="error" for="txt_password_conf"></label>
                                </div>
                                <div class="col-sm-94">

                                </div>
                            </div>
                        </div>
                        <div id="w4-confirm" class="tab-pane">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="txt_email">Correo Electronico</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" class="form-control" name="txt_email" id="txt_email" required>
                                    </div>
                                    <label class="error" for="txt_email"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-4">
                                    <div class="checkbox-custom">
                                        <input type="checkbox" name="terms" id="w4-terms" required>
                                        <label for="w4-terms">Estoy de acuerdo con los términos de servicio.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <ul class="pager">
                    <li class="previous disabled">
                        <a><i class="fa fa-angle-left"></i> Previous</a>
                    </li>
                    <li class="finish hidden pull-right">
                        <a>Finish</a>
                    </li>
                    <li class="next">
                        <a>Next <i class="fa fa-angle-right"></i></a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>
