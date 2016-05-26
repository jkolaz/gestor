<!doctype html>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title>{$pg_title}</title>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Web Fonts  -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="{$DIR_PRINCIPAL}assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <!-- start: page -->
        <section class="body-sign">
            <div class="center-sign">
                <a href="/" class="logo pull-left">
                    <img src="{$DIR_PRINCIPAL}assets/images/logo.png" height="54" alt="{$pg_title}" />
                </a>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                    </div>
                    <div class="panel-body">
                        <form action="{$SERVER_ADMIN}seguridad/seguridad/ingresar_sistema.html" method="post">
                            {if $error eq 1}
                            <div class="alert alert-danger">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                Algo va mal. 
                                <strong>Usuario y/o contraseña</strong> incorrecto, intente nuevamente.
                            </div>
                            {/if}
                            {if $error eq 2}
                            <div class="alert alert-warning">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                Ingrese su <strong>Usuario y/o contraseña</strong> para poder acceder al sistema.
                            </div>
                            {/if}
                            <div class="form-group mb-lg">
                                <label>Usuario</label>
                                <div class="input-group input-group-icon">
                                    <input name="username" id="username" type="text" class="form-control input-lg" autocomplete="off" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-lg">
                                <div class="clearfix">
                                    <label class="pull-left">Contraseña</label>
                                    <a href="{$SERVER_ADMIN}seguridad/administrador/recordarClave" class="pull-right">¿Olvidaste tu contraseña?</a>
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="pwd" id="pwd" type="password" class="form-control input-lg" />
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <!--<div class="checkbox-custom checkbox-default">
                                        <input id="RememberMe" name="rememberme" type="checkbox"/>
                                        <label for="RememberMe">Recuérdame</label>
                                    </div>-->
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button type="submit" class="btn btn-primary hidden-xs">Ingresar</button>
                                    <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Ingresar</button>
                                </div>
                            </div>

                            <!--
                            <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                                <span>or</span>
                            </span>

                            <div class="mb-xs text-center">
                                <a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
                                <a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
                            </div>
                            -->
                            
                            <!--<p class="text-center">¿No tienes una cuenta todavía? <a href="pages-signup.html">¡Regístrate!</a></p>-->

                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2014. All Rights Reserved.</p>
            </div>
        </section>
        <!-- end: page -->

        <!-- Vendor -->
        <script src="{$DIR_PRINCIPAL}assets/vendor/jquery/jquery.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/magnific-popup/magnific-popup.js"></script>
        <script src="{$DIR_PRINCIPAL}assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="{$DIR_PRINCIPAL}assets/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="{$DIR_PRINCIPAL}assets/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="{$DIR_PRINCIPAL}assets/javascripts/theme.init.js"></script>

    </body>
    
</html>