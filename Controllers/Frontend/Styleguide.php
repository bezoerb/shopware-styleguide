<?php

use Shopware\Bundle\StoreFrontBundle\Service\Core\ContextService;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Theme\Compiler;
use Shopware\Components\Theme\Inheritance;
use Shopware\Components\Theme\LessCompiler;
use Shopware\Components\Theme\Service;
use Shopware\Models\Shop\Shop;
use Shopware\Models\Shop\Template;
use Styleguide\Service\StyleguideService;
use Styleguide\Service\ThemeConfigService;
use Styleguide\Struct\Component;

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
}