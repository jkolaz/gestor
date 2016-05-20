<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">
				
    <div class="sidebar-header">
        <div class="sidebar-title">
                Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>
				
    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li>
                        <a href="{$SERVER_ADMIN}seguridad/panel/principal.html">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Panel</span>
                        </a>
                    </li>
                    {if $menu|@count gt 0}
                        {section name=id loop=$menu}
                    <li class="nav-parent">
                        <a>
                            <i class="fa {$menu[id]->mod_icon}" aria-hidden="true"></i>
                            <span>{$menu[id]->mod_nombre}</span>
                        </a>
                        {if $menu[id]->mod_paginas|@count gt 0}
                        <ul class="nav nav-children">
                            {section name=sub_menu loop=$menu[id]->mod_paginas}
                            <li>
                                <a href="{$SERVER_ADMIN}{$menu[id]->mod_url}/{$menu[id]->mod_paginas[sub_menu]->pag_url}.html">
                                    <i class="fa {$menu[id]->mod_paginas[sub_menu]->pag_icon}" aria-hidden="true"></i>
                                    <span>{$menu[id]->mod_paginas[sub_menu]->pag_nombre}</span>
                                </a>
                            </li>
                            {/section}
                        </ul>
                        {/if}
                    </li>        
                        {/section}
                    {/if}
                </ul>
            </nav>
				
            <hr class="separator" />
        </div>
				
    </div>
				
</aside>
<!-- end: sidebar -->