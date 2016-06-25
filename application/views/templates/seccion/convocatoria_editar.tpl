<div class="row">
    {$message}
    <div class="col-md-12">
        <form id="form" action="{$SERVER_ADMIN}seccion/convocatoria/editar/{$id}" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input name="txt_action" id="txt_action" type="hidden" value="configurar">
            <section class="panel">
                <header class="panel-heading">

                    <h2 class="panel-title">Editar de Convocatoria</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="txt_con_nombre" id="txt_con_nombre" class="form-control" required value="{$stdConvocatoria->con_nombre}" maxlength="150" data-plugin-maxlength=""/>
                            <p><code>Máximo</code> 150.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">URL <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <select data-plugin-selectTwo id="txt_con_url" name="txt_con_url" class="form-control populate" required>
                                <option value="">-Seleccionar-</option>
                                {if $objMenu|@count gt 0}
                                    {section name=id loop=$objMenu}
                                        <optgroup label="{$objMenu[id]->men_nombre}">
                                            {if $objMenu[id]->sub_menu|@count gt 0}
                                                {section name=sm loop=$objMenu[id]->sub_menu}
                                                    <option value="{$objMenu[id]->sub_menu[sm]->men_ruta}" {$objMenu[id]->sub_menu[sm]->selected}>{$objMenu[id]->sub_menu[sm]->men_nombre}</option>
                                                {/section}
                                            {/if}
                                        </optgroup>
                                    {/section}
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Contenido <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="summernote" data-plugin-summernote data-plugin-options='{literal}{"id_textarea":"txt_con_descripcion", "height": 180, "codemirror": { "theme": "ambiance" } }{/literal}'>{$stdConvocatoria->con_descripcion}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen<b>(.jpeg, .jpg, .gif, .png)</b></label>
                        <div class="col-sm-1">
                            <a class="image-popup-no-margins" href="{$SERVER_GALLERY}{$stdConvocatoria->con_imagen}">
                                <img class="img-responsive" width="75" src="{$SERVER_GALLERY}{$stdConvocatoria->con_imagen}">
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
                                        <input type="file" name="txt_con_imagen" id="txt_con_imagen" />
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