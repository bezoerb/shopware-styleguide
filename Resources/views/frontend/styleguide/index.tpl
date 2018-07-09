{extends file="parent:frontend/index/index.tpl"}
{namespace name="frontend/styleguide"}

{block name='frontend_index_content_main'}
    <section class="content-main container block-group">
        <div class="content-main--inner">
            <div class="content--wrapper">
                <div class="content content--styleguide">
                    <div class="sg-styleguide">
                        <h1 class="sg-h1">{s name="headline"}Styleguide{/s}</h1>
                        <p class="sg-p">{s name="copy"}{/s}</p>
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
