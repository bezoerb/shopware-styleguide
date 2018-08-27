<?php

namespace Styleguide;

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Shopware\Components\Theme\LessDefinition;

/**
 * Styleguide plugin
 */
class Styleguide extends Plugin
{
    /**
     * Subscribe to events
     */
    public static function getSubscribedEvents()
    {
        // Autload extra dependencies
        if (file_exists(__DIR__ . '/vendor/autoload.php')) {
            require_once __DIR__ . '/vendor/autoload.php';
        }

        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onFrontendPostDispatch',
            'Theme_Inheritance_Smarty_Directories_Collected' => 'onSmartyDirectoriesCollected',
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles',
            'Theme_Compiler_Collect_Plugin_Javascript' => 'addJavascriptFiles',
        ];
    }

    /**
     * Plugin install
     *
     * @param InstallContext $context
     */
    public function install(InstallContext $context)
    {
        $context->getPlugin()->setVersion('0.1.0');

        parent::install($context);
    }

    /**
     * Plugin update
     *
     * @param UpdateContext $context
     */
    public function update(UpdateContext $context)
    {
        $this->doUpdate($context->getCurrentVersion(), $context->getPlugin()->getId());

        parent::update($context);
    }

    public function onFrontendPostDispatch(\Enlight_Controller_ActionEventArgs $args)
    {
        /** @var \Enlight_Controller_Action $controller */
        $controller = $args->get('subject');
        $view = $controller->View();

        $view->addTemplateDir($this->getPath() . '/Resources/views/');
    }


    /**
     * Perform the update path
     *
     * @param string $version Old Version. "0.1.0" for fresh install
     * @param int $pluginId
     */
    protected function doUpdate($version, $pluginId)
    {
        $eventManager = $this->container->get('events');
        $eventManager->notify('Styleguide_Plugin_Update', ['oldVersion' => $version]);
    }

    /**
     * Register additional path for smarty plugins
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onSmartyDirectoriesCollected(\Enlight_Event_EventArgs $args)
    {
        $ret = $args->getReturn();
        $ret[] = $this->getPath() . '/Resources/smarty/';
        $args->setReturn($ret);
    }

    /**
     * Provide the file collection for less
     *
     * @param \Enlight_Event_EventArgs $args
     * @return ArrayCollection
     */
    public function addLessFiles(\Enlight_Event_EventArgs $args)
    {
        $config = [];
        $files = [
            $this->getPath() . '/Resources/views/frontend/_public/src/less/prism.less',
            $this->getPath() . '/Resources/views/frontend/_public/src/less/flag.less',
            $this->getPath() . '/Resources/views/frontend/_public/src/less/grid.less',
            $this->getPath() . '/Resources/views/frontend/_public/src/less/styleguide.less',
        ];

        $less = new LessDefinition($config, $files, __DIR__);

        return new ArrayCollection([$less]);
    }


    /**
     * Provide the file collection for js files
     *
     * @param \Enlight_Event_EventArgs $args
     * @return ArrayCollection
     */
    public function addJavascriptFiles(\Enlight_Event_EventArgs $args)
    {
        return new ArrayCollection([
            $this->getPath() . '/Resources/views/frontend/_public/src/js/prism.js',
            $this->getPath() . '/Resources/views/frontend/_public/src/js/styleguide.js',
        ]);
    }
}
