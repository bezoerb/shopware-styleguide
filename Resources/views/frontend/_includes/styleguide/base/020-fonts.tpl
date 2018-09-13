{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {s name="headline" namespace="frontend/styleguide/base/font"}Fonts{/s}
{/block}


{block name="frontend_styleguide_section_description"}
  {block name="frontend_styleguide_base_fonts_init"}
    {if !$fonts || !$fonts|@count}
      {$fonts = ['demo' => "'Open Sans', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif"]}
      {s name="usage" namespace="frontend/styleguide/base/font"}
        We could not auto-detect a font definition in your theme settings.<br/>
        To show your fonts instead of the current fallback you can simply extend this template and assign them like this:<br/><br/>
        <b>File: frontend/_includes/styleguide/base/020-fonts.tpl</b><br/>
        <pre><code class="language-smarty">{literal}{extends file="frontend/_includes/styleguide/base/020-fonts.tpl"}

            {block name="frontend_styleguide_base_fonts_init"}
              {$fonts = [primary => "'Open Sans', 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif"]}
            {/block}{/literal}</code></pre>
      {/s}
    {/if}
  {/block}
  {block name="frontend_styleguide_base_fonts_copy"}
    {s name="copy" namespace="frontend/styleguide/base/font"}{/s}
  {/block}
{/block}

{block name="frontend_styleguide_section_content"}
  {block name="frontend_styleguide_base_fonts_content"}

    {foreach $fonts as $font => $name}
      <div style="font-family: {$font|replace:'"':'\''}">
        <div class="sg-flag  sg-flag--fixed">
          <div class="sg-flag__img sg-1/1 sg-1/12@md">
            <div style="font-size: 100px">Aa</div>
          </div>
          <div class="sg-flag__body">
            <div>{$name}: {$font}</div>
            <hr>
            <div>{s name="preview" namespace="frontend/styleguide/base/font"}a b c d e f g h i j k l m n o p q r s t u v w x y z<br/>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z<br/>1 2 3 4 5 6 7 8 9 0{/s}</div>
          </div>
        </div>
        <div class="sg-flag sg-flag--fixed">
          <div class="sg-flag__img sg-1/1 sg-1/12@md">
            <div style="font-size: 100px"><strong>Aa</strong></div>
          </div>
          <div class="sg-flag__body">
            <div><strong>{$name}: {$font} bold</strong></div>
            <hr>
            <div><strong>{s name="preview" namespace="frontend/styleguide/base/font"}a b c d e f g h i j k l m n o p q r s t u v w x y z<br/>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z<br/>1 2 3 4 5 6 7 8 9 0{/s}</strong></div>
          </div>
        </div>
        <div class="sg-flag sg-flag--fixed">
          <div class="sg-flag__img sg-1/1 sg-1/12@md">
            <div style="font-size: 100px"><em>Aa</em></div>
          </div>
          <div class="sg-flag__body">
            <div><em>{$name}: {$font} italic</em></div>
            <hr>
            <div><em>{s name="preview" namespace="frontend/styleguide/base/font"}a b c d e f g h i j k l m n o p q r s t u v w x y z<br/>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z<br/>1 2 3 4 5 6 7 8 9 0{/s}</em></div>
          </div>
        </div>
      </div>
      {if not $name@last}
        <hr>
      {/if}
    {/foreach}
  {/block}
{/block}
