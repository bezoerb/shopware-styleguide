{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {block name="frontend_styleguide_base_images_copy"}
    {s name="headline" namespace="frontend/styleguide/base/images"}Images{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_copy"}
  {block name="frontend_styleguide_base_images_copy"}
    {s name="copy" namespace="frontend/styleguide/base/images"}{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_content"}
  {block name="frontend_styleguide_base_images_content"}
    {styleguide_html}
      <figure>
        <img src="https://via.placeholder.com/320x240" alt="Placeholder image">
        <figcaption>Placeholder image</figcaption>
      </figure>
    {/styleguide_html}
  {/block}
{/block}

