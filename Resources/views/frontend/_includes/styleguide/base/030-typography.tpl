{extends file="frontend/styleguide/section.tpl"}

{block name="frontend_styleguide_section_title"}
  {s name="headline" namespace="frontend/styleguide/base/typography"}Typography{/s}
{/block}

{block name="frontend_styleguide_section_description"}
  {s name="copy" namespace="frontend/styleguide/base/typography"}{/s}
{/block}

{block name="frontend_styleguide_section_content"}
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
  <div class="sg-layout sg-mt">
    <div class="sg-layout__item sg-1/1 sg-1/3@md">
      <h2>Regular</h2>
      <p>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams, he found
        himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head
        a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</p>
    </div>
    <div class="sg-layout__item sg-1/1 sg-1/3@md">
      <h2><strong>Bold</strong></h2>
      <p><strong>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams,
          he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he
          lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff
          sections.</strong></p>
    </div>
    <div class="sg-layout__item sg-1/1 sg-1/3@md">
      <h2><em>Italic</em></h2>
      <p><em>The quick brown fox jumps over the lazy dog. One morning, when Gregor Samsa woke from troubled dreams, he
          found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted
          his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</em>
      </p>
    </div>
  </div>
{/block}

