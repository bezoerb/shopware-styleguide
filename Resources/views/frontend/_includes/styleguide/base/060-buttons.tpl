{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {block name="frontend_styleguide_base_buttons_title"}
    {s name="headline" namespace="frontend/styleguide/base/buttons"}Buttons{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_copy"}
  {block name="frontend_styleguide_base_buttons_copy"}
    {s name="copy" namespace="frontend/styleguide/base/buttons"}{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_content"}
  {block name="frontend_styleguide_base_buttons_content"}
    {styleguide_html}
      <button class="btn">Default</button>
      <button class="btn is--small">Small</button>
      <button class="btn is--medium">Medium</button>
      <button class="btn is--large">Large</button>
      <button class="btn is--primary">Primary</button>
      <button class="btn is--secondary">Secondary</button>
      <button class="btn is--link">Link</button>
    {/styleguide_html}
  {/block}
{/block}

