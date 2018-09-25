{* BUTTONS *}
{block name="frontend_styleguide_section"}
  <div class="sg-styleguide__section">
    {capture assign="title"}
      {block name="frontend_styleguide_section_title"}{/block}
    {/capture}
    {if $title}
      {$href = $title|lower|regex_replace:'/[^\w\d]+/ ':''}
      <h2 id="{$href}" class="sg-h2"><a href="#{$href}">{$title|trim}</a></h2>
    {/if}
    {capture assign="copy"}
      {block name="frontend_styleguide_section_description"}{/block}
    {/capture}
    {if $copy}
      <div class="sg-p">{$copy}</div>
    {/if}

    {block name="frontend_styleguide_section_content"}{/block}
  </div>
{/block}
