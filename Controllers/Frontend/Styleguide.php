<?php

use Shopware\Components\Model\ModelManager;
use Styleguide\Service\StyleguideService;
use Styleguide\Service\ThemeConfigService;
use Doctrine\Common\Cache\Cache;

/**
 * Styleguide controller
 *
 * @author Ben Zörb <ben.zoerb@interlutions.de>
 */
class Shopware_Controllers_Frontend_Styleguide extends Enlight_Controller_Action
{
    /**
     * index action
     * @throws Exception
     */
    public function indexAction()
    {
        $request = $this->Request();
        if ($request->getParam('flush-cache')) {
            $this->flushCache();
        }
        $category = $request->getParam('category');
        $file = $request->getParam('file');
        $view = $this->View();
        $components = $this->getStyleguideService()->getComponents();
        $sMainMenu = $this->getStyleguideService()->getMainCategories($components);
        $view->assign('sMainMenu', $sMainMenu);

        if ($category || $file) {
            $components = array_filter($components, function($component) use ($category, $file) {
                return $component->getGroup() == $category && (!$file || strtolower($file) == strtolower($component->getName()));
            });
        }

        $view->assign('category', $category);
        $view->assign('components', $components);
        $themeConfig = $this->getThemeConfigService();
        $view->assign('themeConfig', $themeConfig->getConfig());
        $view->assign('themeInheritance', $themeConfig->getInheritancePath());
        $view->assign('colors', $themeConfig->getColors());
        $view->assign('fonts', $themeConfig->getFonts());
    }

    /**
     * @return ModelManager
     * @throws Exception
     */
    protected function getEntityManager()
    {
        return $this->container->get('shopware.model_manager');
    }

    /**
     * @return ThemeConfigService
     * @throws Exception
     */
    protected function getThemeConfigService()
    {
        return $this->container->get('styleguide.service.config.theme');
    }

    /**
     * @return StyleguideService
     * @throws Exception
     */
    protected function getStyleguideService()
    {
        return $this->container->get('styleguide.service.styleguide');
    }

    protected function flushCache()
    {
        /** @var Cache $cache */
        $cache = $this->container->get('models_metadata_cache');
        return $cache->deleteAll();
    }
}
