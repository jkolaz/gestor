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
        
        {if $datatable gt 0}
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/select2/select2.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
        {/if}
        {if $wizard gt 0}
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/pnotify/pnotify.custom.css" />
        {/if}
        {if $fileupload gt 0}
        <!-- Specific Page Vendor CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
        {/if}
        {if $formulario gt 0}
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/dropzone/css/basic.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/dropzone/css/dropzone.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />    
        {/if}
        {if $form gt 0}
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/vendor/select2/select2.css" />
        {/if}

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="{$DIR_PRINCIPAL}assets/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="{$DIR_PRINCIPAL}assets/vendor/modernizr/modernizr.js"></script>

</head>