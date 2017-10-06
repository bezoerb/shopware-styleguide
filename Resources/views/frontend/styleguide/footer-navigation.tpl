{namespace name="frontend/styleguide/menu_footer"}

{* Service hotline *}
{block name="frontend_index_footer_column_service_hotline"}
    <div class="footer--column is--first block">
        <div class="column--headline">{s name="sFooterStyleguideNavi1"}{/s}</div>
    </div>
{/block}

{block name="frontend_index_footer_column_service_menu"}
    <div class="footer--column column--menu block">
        {block name="frontend_index_footer_column_service_menu_headline"}
            <div class="column--headline">{s name="sFooterStyleguideNavi2"}{/s}</div>
        {/block}

        {block name="frontend_index_footer_column_service_menu_content"}
            <nav class="column--navigation column--content">
                <ul class="navigation--list" role="menu">
                    {block name="frontend_index_footer_column_service_menu_before"}{/block}
                    {*{foreach $sMenu.gBottom as $item}*}

                        {*{block name="frontend_index_footer_column_service_menu_entry"}*}
                            {*<li class="navigation--entry" role="menuitem">*}
                                {*<a class="navigation--link" href="{if $item.link}{$item.link}{else}{url controller='custom' sCustom=$item.id title=$item.description}{/if}" title="{$item.description|escape}"{if $item.target} target="{$item.target}"{/if}>*}
                                    {*{$item.description}*}
                                {*</a>*}

                                {* Sub categories *}
                                {*{if $item.childrenCount > 0}*}
                                    {*<ul class="navigation--list is--level1" role="menu">*}
                                        {*{foreach $item.subPages as $subItem}*}
                                            {*<li class="navigation--entry" role="menuitem">*}
                                                {*<a class="navigation--link" href="{if $subItem.link}{$subItem.link}{else}{url controller='custom' sCustom=$subItem.id title=$subItem.description}{/if}" title="{$subItem.description|escape}"{if $subItem.target} target="{$subItem.target}"{/if}>*}
                                                    {*{$subItem.description}*}
                                                {*</a>*}
                                            {*</li>*}
                                        {*{/foreach}*}
                                    {*</ul>*}
                                {*{/if}*}
                            {*</li>*}
                        {*{/block}*}
                    {*{/foreach}*}

                    {block name="frontend_index_footer_column_service_menu_after"}{/block}
                </ul>
            </nav>
        {/block}
    </div>
{/block}

{block name="frontend_index_footer_column_information_menu"}
    <div class="footer--column column--menu block">
        {block name="frontend_index_footer_column_information_menu_headline"}
            <div class="column--headline">{s name="sFooterShopNavi3"}{/s}</div>
        {/block}

        {block name="frontend_index_footer_column_information_menu_content"}
            <nav class="column--navigation column--content">
                <ul class="navigation--list" role="menu">
                    {block name="frontend_index_footer_column_information_menu_before"}{/block}
                        {*{foreach $sMenu.gBottom2 as $item}*}

                            {*{block name="frontend_index_footer_column_information_menu_entry"}*}
                                {*<li class="navigation--entry" role="menuitem">*}
                                    {*<a class="navigation--link" href="{if $item.link}{$item.link}{else}{url controller='custom' sCustom=$item.id title=$item.description}{/if}" title="{$item.description|escape}"{if $item.target} target="{$item.target}"{/if}>*}
                                        {*{$item.description}*}
                                    {*</a>*}

                                    {* Sub categories *}
                                    {*{if $item.childrenCount > 0}*}
                                        {*<ul class="navigation--list is--level1" role="menu">*}
                                            {*{foreach $item.subPages as $subItem}*}
                                                {*<li class="navigation--entry" role="menuitem">*}
                                                    {*<a class="navigation--link" href="{if $subItem.link}{$subItem.link}{else}{url controller='custom' sCustom=$subItem.id title=$subItem.description}{/if}" title="{$subItem.description|escape}"{if $subItem.target} target="{$subItem.target}"{/if}>*}
                                                        {*{$subItem.description}*}
                                                    {*</a>*}
                                                {*</li>*}
                                            {*{/foreach}*}
                                        {*</ul>*}
                                    {*{/if}*}
                                {*</li>*}
                            {*{/block}*}
                        {*{/foreach}*}
                    {block name="frontend_index_footer_column_information_menu_after"}{/block}
                </ul>
            </nav>
        {/block}
    </div>
{/block}

{block name="frontend_index_footer_column_newsletter"}
    <div class="footer--column column--newsletter is--last block">
        {block name="frontend_index_footer_column_newsletter_headline"}
            <div class="column--headline">{s name="sFooterStyleguideNavi4"}{/s}</div>
        {/block}

    </div>
{/block}
