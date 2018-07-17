{extends file="parent:frontend/index/main-navigation.tpl"}

{block name='frontend_index_navigation_categories'}
  {$sMainCategories = $sMainMenu}
  {$smarty.block.parent}
{/block}
