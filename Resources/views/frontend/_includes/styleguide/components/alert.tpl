{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {block name="frontend_styleguide_component_alert_title"}
    {s name="headline" namespace="frontend/styleguide/components/alerts"}Alerts{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_copy"}
  {block name="frontend_styleguide_component_alert_copy"}
    {s name="copy" namespace="frontend/styleguide/components/alerts"}{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_content"}
  {block name="frontend_styleguide_component_alert_content"}
    {styleguide_include file='frontend/_includes/messages.tpl' arguments=[
      [content => 'Info message', type => 'info'],
      [content => 'Success message', type => 'success'],
      [content => 'Warning message', type => 'warning'],
      [content => 'Error message', type => 'error']
    ]}
  {/block}
{/block}

