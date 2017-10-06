{namespace name="frontend/styleguide"}

{* COLORS *}
{* Uses colors from theme.php configuration. *}
{block name="frontend_styleguide_base_color"}
    <div class="sg-styleguide__section">
        <h2 id="sg-base-color">{s name="headline" namespace="frontend/styleguide/base/color"}Colors{/s}</h2>
        <p>{s name="copy" namespace="frontend/styleguide/base/color"}{/s}</p>
        <div class="sg-layout">
            {foreach $colors as $color => $name}
                <div class="sg-layout__item u-1/12  u-1/4@mobile">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <path id="a" d="M0 0h100v100H0z"/>
                        </defs>
                        <g fill="none" fill-rule="evenodd">
                            <use fill="{$color}" xlink:href="#a"/>
                            <path stroke="#979797" d="M.5.5h99v99H.5z"/>
                        </g>
                    </svg>
                    <p style="text-align: center">{$color}<br>
                        <small>{$name}</small>
                    </p>
                </div>
            {/foreach}
        </div>
    </div>
{/block}

{* FONTS *}
{block name="frontend_styleguide_base_font"}
    <div class="sg-styleguide__section">
        <h2 id="sg-base-font">{s name="headline" namespace="frontend/styleguide/base/font"}Fonts{/s}</h2>
        <p>{s name="copy" namespace="frontend/styleguide/base/font"}{/s}</p>
    {foreach $fonts as $font => $name}
        <div style="font-family: {$font|replace:'"':'\''}">
            <div class="sg-flag  sg-flag--fixed">
                <div class="sg-flag__img u-1/12 u-1/1@mobile">
                    <div style="font-size: 100px">Aa</div>
                </div>
                <div class="sg-flag__body">
                    <div>{$name}: {$font}</div>
                    <hr>
                    <div>{s name="preview" namespace="frontend/styleguide/base/font"}a b c d e f g h i j k l m n o p q r s t u v w x y z<br/>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z<br/>1 2 3 4 5 6 7 8 9 0{/s}</div>
                </div>
            </div>
            <div class="sg-flag sg-flag--fixed">
                <div class="sg-flag__img u-1/12 u-1/1@mobile">
                    <div style="font-size: 100px"><strong>Aa</strong></div>
                </div>
                <div class="sg-flag__body">
                    <div><strong>{$name}: {$font} bold</strong></div>
                    <hr>
                    <div><strong>{s name="preview" namespace="frontend/styleguide/base/font"}a b c d e f g h i j k l m n o p q r s t u v w x y z<br/>A B C D E F G H I J K L M N O P Q R S T U V W X Y Z<br/>1 2 3 4 5 6 7 8 9 0{/s}</strong></div>
                </div>
            </div>
            <div class="sg-flag sg-flag--fixed">
                <div class="sg-flag__img u-1/12 u-1/1@mobile">
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
    </div>
{/block}

{* TYPOGRAPHY *}
{block name="frontend_styleguide_base_typography"}
    <div class="sg-styleguide__section">
        <h2 id="sg-base-typography">{s name="headline" namespace="frontend/styleguide/base/typography"}Typography{/s}</h2>
        <p>{s name="copy" namespace="frontend/styleguide/base/typography"}{/s}</p>
        {foreach ['h1','h2','h3','h4','h5','h6'] as $h}
        <div class="sg-flag sg-flag--divided sg-flag--fixed">
            <div class="sg-flag__img">
                <{$h}>&lt;{$h}&gt;</{$h}>
            </div>
            <div class="sg-flag__body">
                <{$h}>The quick brown fox jumps over the lazy dog</{$h}>
            </div>
        </div>
        {/foreach}
        <div class="sg-layout">
            <div class="sg-layout__item u-1/3 u-1/1@mobile">
                <h2>Regular</h2>
                <p>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</p>
            </div>
            <div class="sg-layout__item u-1/3 u-1/1@mobile">
                <h2><strong>Bold</strong></h2>
                <p><strong>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</strong></p>
            </div>
            <div class="sg-layout__item u-1/3 u-1/1@mobile">
                <h2><em>Italic</em></h2>
                <p><em>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</em></p>
            </div>
        </div>

    </div>
{/block}

{* ANIMATIONS *}
{block name="frontend_styleguide_base_animations"}
    <div class="sg-styleguide__section">
        <h2 id="sg-base-animations">{s name="headline" namespace="frontend/styleguide/base/animations"}Animations{/s}</h2>
        <p>{s name="copy" namespace="frontend/styleguide/base/animations"}{/s}</p>
    </div>
{/block}