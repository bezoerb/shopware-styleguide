{block name="frontend_styleguide_base_messages"}
    <div class="c-styleguide__section">
        <h2 id="sg-base-messages">{s name="headline" namespace="frontend/styleguide/base/messages"}Messages{/s}</h2>
        <p>{s name="copy" namespace="frontend/styleguide/base/messages"}{/s}</p>
        {include file='frontend/_includes/messages.tpl' content='Info message' type='info'}
        {include file='frontend/_includes/messages.tpl' content='Success message' type='success'}
        {include file='frontend/_includes/messages.tpl' content='Warning message' type='warning'}
        {include file='frontend/_includes/messages.tpl' content='Error message' type='error'}

        {styleguide_include file='frontend/_includes/messages.tpl' content='Warning message' type='warning' styleguide-preview=false}
    </div>
{/block}