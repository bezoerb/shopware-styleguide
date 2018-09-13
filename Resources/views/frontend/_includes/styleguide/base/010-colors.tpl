{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {s name="headline" namespace="frontend/styleguide/base/color"}Colors{/s}
{/block}

{block name="frontend_styleguide_section_description"}
  {s name="copy" namespace="frontend/styleguide/base/color"}{/s}
{/block}

{block name="frontend_styleguide_section_content"}
  <div class="sg-layout sg-flex sg-flex--align-start sg-flex--justify-center">
    {foreach $colors as $color => $name}
      <div class="sg-layout__item" style="width: 130px; flex: 0 0 130px">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <rect x="0" y="0" width="100" height="100" stroke="#979797" fill="{$color}"/>
        </svg>
        <p style="text-align: center">{$color}<br>
          <small><nobr>@{$name}</nobr></small>
        </p>
      </div>
    {/foreach}
  </div>
{/block}
