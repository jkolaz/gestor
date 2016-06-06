{if $permitido_message eq 1}
<div class="alert alert-success">
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    {$message}
</div>
{/if}
{if $permitido_message eq 2}
<div class="alert alert-danger">
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    {$message}
</div>
{/if}
{if $permitido_message eq 3}
<div class="alert alert-warning">
    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
    {$message}
</div>
{/if}