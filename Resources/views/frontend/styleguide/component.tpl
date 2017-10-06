{namespace name="frontend/styleguide/component"}
<div class="sg-component">
    {if isset($description) && $description}<div class="sg-component__doc">{$description}</div>{/if}

    {if isset($preview) && $preview}
        <div class="sg-component__preview">{$preview}</div>
    {/if}
    {if (isset($description) and $description) or (isset($html) and $html) or (isset($source) and $source)}
    <div class="sg-component__details">

        {if isset($html) && $html}<div class="sg-component__code-html">
            <pre><code class="language-markup">{$html}</code></pre>
        </div>{/if}
        {if isset($source) && $source}<div class="sg-component__code-smarty">
            <pre><code class="language-smarty">{$source}</code></pre>
        </div>{/if}
    </div>
    {/if}
</div>