<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-4">
        <h5 class="text-semibold text-dark text-uppercase mb-md mt-lg">Menú</h5>
        {if $objMenu|@count gt 0}
                {section name=id loop=$objMenu}
        <section class="hidden-md panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
                <div class="widget-summary widget-summary-md">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-primary">
                            <i class="fa fa-life-ring"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title">{$objMenu[id]->men_nombre}</h4>
                            <!--<div class="info">
                                <strong class="amount">1281</strong>
                                <span class="text-primary">(14 unread)</span>
                            </div>-->
                        </div>
                        <!--<div class="summary-footer">
                            <a class="text-muted text-uppercase">(view all)</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </section>
            {/section}
        {/if}
    </div>					
</div>