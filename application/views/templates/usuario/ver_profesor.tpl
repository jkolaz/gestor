<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                    <!--<a href="#" class="fa fa-times"></a>-->
                </div>

                <h2 class="panel-title">Datos Generales</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" method="post">
                    <div class="form-group has-success">
                        <div class="thumb-info mb-md">
                            <label class="col-md-3 control-label" for="txt_nombre">Foto</label>
                            <div class="col-md-3">
                                <img class="rounded img-responsive" alt="John Doe" src="{$DIR_PRINCIPAL}assets/images/!logged-user.jpg" >
                                <div class="thumb-info-title">
                                    <span class="thumb-info-inner">{$profesor[0]->PER_Paterno} {$profesor[0]->PER_Materno}</span>
                                    <span class="thumb-info-type">{$profesor[0]->PER_Nombre}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" for="txt_nombre">Nombre</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="txt_nombre" name="txt_nombre" disabled="" value="{$profesor[0]->PER_Nombre}">
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" for="txt_paterno">Apellidos</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txt_paterno" name="txt_paterno" disabled="" value="{$profesor[0]->PER_Paterno}">
                                </div>
                                <div class="visible-xs mb-md"></div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="txt_materno" name="txt_materno" disabled="" value="{$profesor[0]->PER_Materno}">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" for="txt_dni">DNI</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="txt_dni" name="txt_dni" disabled="" value="{$profesor[0]->PER_DNI}">
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" for="txt_nac">Fecha de Nacimiento</label>
                        <div class="col-md-2">
                            <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" id="txt_nac" name="txt_nac" disabled="" value="{$profesor[0]->PER_FechaNac}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" for="txt_edad">Edad</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="txt_edad" name="txt_edad" disabled="" value="">
                        </div>
                    </div>
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label" >Sexo</label>
                        <div class="col-sm-8">
                            <div class="radio-custom  radio-success">
                                <input id="txt_sexo" type="radio" name="txt_sexo" disabled>
                                <label for="txt_sexo">Hombre</label>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="radio-custom  radio-success">
                                <input id="txt_sexo" type="radio" name="txt_sexo" disabled >
                                <label for="txt_sexo">Mujer</label>
                            </div>
                        </div>
                    </div>	
                </form>
            </div>
        </section>
						
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="fa fa-caret-down"></a>
                </div>

                <h2 class="panel-title">Datos de Usuario</h2>
            </header>
            <div class="panel-body">
                <form class="form-horizontal form-bordered" method="get">
                    
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Iconic</label>
                        <div class="col-md-6">
                            <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Usuario" disabled="" value="{if $profesor[0]->is_usuario gt 0}{$profesor[0]->usuario[0]->USU_Nombre}{/if}">
                            </div>
                            <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Contraseña" disabled="" value="{if $profesor[0]->is_usuario gt 0}************{/if}">
                            </div>
                            <div class="input-group mb-md">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Correo Electronico" disabled="" value="{if $profesor[0]->is_usuario gt 0}{$profesor[0]->usuario[0]->USU_correo}{/if}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
						
    </div>
</div>					
<!-- end: page -->