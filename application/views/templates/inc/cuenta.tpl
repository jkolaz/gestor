<!-- start: search & user box -->
<div class="header-right">
			
			
    <span class="separator"></span>
			
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{$DIR_PRINCIPAL}assets/images/!logged-user.jpg" alt="{$usuario.usuario}" class="img-circle" data-lock-picture="{$DIR_PRINCIPAL}assets/images/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="{$usuario.usuario}" data-lock-email="{$usuario.correo}">
                    <span class="name">{$usuario.usuario}</span>
                    <span class="role">{$tipo_adm}{$sede}</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{$SERVER_ADMIN}seguridad/usuario{$sufix}"><i class="fa fa-user"></i> Mi Perfil</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                    </li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="{$SERVER_ADMIN}{$logout}{$sufix}"><i class="fa fa-power-off"></i> Salir</a>
                    </li>
                </ul>
            </div>
        </div>
</div>
<!-- end: search & user box -->