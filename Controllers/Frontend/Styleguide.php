<?php

use Shopware\Components\Theme\Service;
use Shopware\Models\Shop\Shop;
use Shopware\Models\Shop\Template;
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
     */
    public function indexAction()
    {
        $this->View()->assign('components', $this->getComponents());

        /** @var Service $themeService */
        $themeService = $this->container->get('theme_service');

        $template = $this->getTemplate();

        $configs = $themeService->getConfig($template);
        $colors = [];
        $fonts = [];

        foreach ($configs as $config) {
            if (preg_match('/^#[\dA-F]{3,6}/i', $config['defaultValue']) && empty($colors[$config['defaultValue']])) {
                $colors[$config['defaultValue']] = $config['fieldLabel'];
            }

            if ($config['name'] == 'font-base-stack') {
                $fonts[$config['defaultValue']] = $config['fieldLabel'];
            }
        }

        $this->View()->assign('colors', $colors);
        $this->View()->assign('fonts', $fonts);

        // check theme responsive inheritance
        /** @var \Enlight_Template_Manager $template */
        $template = $this->container->get('template');
        $extendsResponsive = count(array_filter($template->getTemplateDir(), function($dir) {
            return strpos($dir, 'themes/Frontend/Responsive/') !== false;
        })) != 0;

        $this->View()->assign('extendsResponsive', $extendsResponsive);
    }

    /**
     * @return array
     */
    protected function getComponents()
    {
        $components = [];

        /** @var \Enlight_Template_Manager $template */
        $template = $this->container->get('template');

        $directories = $template->getTemplateDir();
        $directories[] = __DIR__.'/../../Resources/views/';

        // loop from plugin over parent themes to active theme
        foreach (array_reverse($directories) as $base) {
            $basePath = $base.'frontend/_includes/styleguide';
            if (!file_exists($basePath)) {
                continue;
            }

            $dirIterator = new RecursiveDirectoryIterator($basePath);
            $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

            /** @var SplFileInfo $file */
            foreach ($iterator as $file) {
                if (!$file->isFile() || $file->getExtension() != 'tpl') {
                    continue;
                }

                $path = preg_replace('#^.*/Resources/views/frontend#', 'frontend', $file->getPath());

                $component = new Component();
                $component->setName(preg_replace('/^\d+\-/','', $file->getBasename('.tpl')));
                $component->setFile(sprintf('%s/%s', $path, $file->getBasename()));

                $components[$file->getBasename()] = $component;
            }
        }

        ksort($components);
        return $components;
    }

    /**
     * @return Template
     * @throws Exception
     */
    protected function getTemplate()
    {
        $modelManager = $this->container->get('shopware.model_manager');
        $repo = $modelManager->getRepository('Shopware\Models\Shop\Shop');

        /** @var \Doctrine\ORM\QueryBuilder $builder */
        $builder    = $repo->createQueryBuilder('s');
        $builder->leftJoin('s.template', 't');
        $builder->where('s.default = 1');

        /** @var Shop[] $data */
        $shops = $builder->getQuery()->execute();

        if (!count($shops)) {
            throw new \Exception('No default shop found');
        }

        /** @var Shop $shop */
        $shop = array_shift($shops);
        return $shop->getTemplate();
    }
}