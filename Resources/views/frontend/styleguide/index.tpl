{extends file="parent:frontend/index/index.tpl"}
{namespace name="frontend/styleguide"}

{block name='frontend_index_content_main'}
    <section class="content-main container block-group">
        <div class="content-main--inner">
            <div class="content--wrapper">
                <div class="content content--styleguide">
                    <div class="sg-styleguide">
                      {$themeName = $themeInheritance.0}
                      <h1 class="sg-h1">{s name="headline"}Styleguide{/s} <span class="sg-subline">{"based on the $themeName theme"|snippet:"subline-{$themeName|lower}":'frontend/styleguide'}</span></h1>
                        <p class="sg-p">{s name="copy"}This intro text is just som example as you most likely want to add something brand specific here for yourself. This paragraph and any other text on this page can be found in the text snippets editor in the shopware backend. You just need to check the <b>frontend/styleguide</b> namespace and change everything to your needs.
                          {/s}</p>
                        {foreach $components as $component}
                            {include file=$component}
                        {/foreach}
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}

{block name="frontend_index_footer_container"}
    {include file='frontend/styleguide/footer.tpl'}
{/block}

{block name="frontend_index_javascript_async_ready" append}
    <script> document.getElementById('main-script').addEventListener('load', function () {
        Prism.highlightAll();
      });</script>
    <script>window.addEventListener('load', function () {
        Prism.highlightAll();
      });</script>
{/block}
