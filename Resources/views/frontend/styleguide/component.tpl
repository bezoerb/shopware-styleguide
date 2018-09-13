{namespace name="frontend/styleguide"}
{if $grid && $grid|is_array}
  {$gridClass = "sg-{' sg-'|implode:$grid}"}
{elseif $grid}
  {$grid = ' '|explode:$grid}
  {$grid = $grid|array_filter}
  {$gridClass = "sg-{' sg-'|implode:$grid}"}
{/if}
<div class="sg-component">
  {$uid = 'sg-'|uniqid}
  {if $preview or $html or $source}
    <ul class="sg-tabs">
      {if $preview}
        <li aria-expanded="true" class="sg-active">
          <a href="#{$uid}-preview" class="js-sg-tab">{s name="preview"}Preview{/s}</a>
        </li>
      {/if}
      {if $source}
        <li{if !$preview} aria-expanded="true" class="sg-active"{else} aria-expanded="false"{/if}>
          <a href="#{$uid}-smarty" class="js-sg-tab">{s name="smarty"}Smarty{/s}</a>
        </li>
      {/if}
      {if $html}
        <li{if !$preview && !$source} aria-expanded="true" class="sg-active"{else} aria-expanded="false"{/if}>
          <a href="#{$uid}-markup" class="js-sg-tab">{s name="markup"}Markup{/s}</a>
        </li>
      {/if}
      {if $description}
        <li{if !$preview && !$source && !$html} aria-expanded="true" class="sg-active"{else} aria-expanded="false"{/if}>
          <a href="#{$uid}-doc" class="js-sg-tab">{s name="doc"}Documentation{/s}</a>
        </li>
      {/if}
    </ul>
    <ul class="sg-switch">
      {if $preview}
        <li class="sg-active" id="{$uid}-preview">
          {block name="frontend_styleguide_component_preview"}
            <div class="sg-preview {if $variation && $variation|is_array} sg-preview--{' sg-preview--'|implode:$variation}{elseif $variation} sg-preview--{$variation}{/if}{if $preview|is_array} sg-preview--stack{/if}">
              {if $grid}<div class="sg-layout sg-flex{if $align} sg-flex--align-{$align}{/if}{if $justify} sg-flex--justify-{$justify}{/if}">{/if}
              {if $preview|is_array}
                {foreach $preview as $p}{if $grid}<div class="sg-layout__item {$gridClass}">{/if}<div class="sg-preview__item">{$p}</div>{if $grid}</div>{/if}{/foreach}
              {else}
                {if $grid}<div class="sg-layout__item {$gridClass}">{/if}<div class="sg-preview__item">{$preview}</div>{if $grid}</div>{/if}
              {/if}
              {if $grid}</div>{/if}
            </div>
          {/block}
        </li>
      {/if}
      {if $source}
        <li{if !$preview} class="sg-active"{/if} id="{$uid}-smarty">
          <div class="sg-component__code-smarty">
            {*{if $grid}<div class="sg-layout">{/if}*}
            {if $source|is_array}
              {foreach $source as $s}
                <pre><code class="language-smarty">{$s}</code></pre>
                {*{if $grid}<div class="sg-layout__item {$gridClass}">{/if}<pre><code class="language-smarty">{$s}</code></pre>{if $grid}</div>{/if}*}
              {/foreach}
            {else}
              <pre><code class="language-smarty">{$source}</code></pre>
              {*{if $grid}<div class="sg-layout__item {$gridClass}">{/if}<pre><code class="language-smarty">{$source}</code></pre>{if $grid}</div>{/if}*}
            {/if}
            {*{if $grid}</div>{/if}*}
          </div>
        </li>
      {/if}
      {if $html}
      <li{if !$preview && !$source} class="sg-active"{/if} id="{$uid}-markup">
        <div class="sg-component__code-html">
          {*{if $grid}<div class="sg-layout">{/if}*}
          {if $html|is_array}
            {foreach $html as $h}
              <pre><code class="language-markup">{$h}</code></pre>
              {*{if $grid}<div class="sg-layout__item {$gridClass}">{/if}<pre><code class="language-markup">{$h}</code></pre>{if $grid}</div>{/if}*}
            {/foreach}
          {else}
            <pre><code class="language-markup">{$html}</code></pre>
            {*{if $grid}<div class="sg-layout__item {$gridClass}">{/if}<pre><code class="language-markup">{$html}</code></pre>{if $grid}</div>{/if}*}
          {/if}
          {*{if $grid}</div>{/if}*}
        </div>
      </li>
      {/if}
      {if $description}
      <li{if !$preview && !$source && !$html} class="sg-active"{/if} id="{$uid}-doc">
        <div class="sg-component__doc">{$description}</div>
      </li>
      {/if}
    </ul>
  {/if}
</div>
