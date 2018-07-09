<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 09.04.18
 * Time: 05:34
 */

namespace Styleguide\Service;


use Doctrine\Common\Cache\Cache;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;
use Styleguide\Struct\Component;

class StyleguideService
{
    /**
     * @var \Enlight_Template_Manager
     */
    private $template;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(\Enlight_Template_Manager $template, Cache $cache)
    {
        $this->template = $template;
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public function getMainCategories($components = [])
    {
        if (!count($components)) {
            $components = $this->getComponents();
        }
        $categories = [];

        foreach ($components as $component) {
            if (!array_key_exists($component->getGroup(), $categories)) {
                $categories[$component->getGroup()] = [
                    'anchor' => '#'.$component->getGroup(),
                    'link' => '/styleguide/'.$component->getGroup(),
                    'name' => ucfirst($component->getGroup()),
                    'description' => ucfirst($component->getGroup()),
                    'sub' => [],
                ];
            }

            $categories[$component->getGroup()]['sub'][] = [
                'anchor' => '#'.$component->getGroup().'-'.$component->getName(),
                'link' => '/styleguide/'.$component->getGroup().'/'.$component->getName(),
                'name' => ucfirst($component->getName()),
                'description' => ucfirst($component->getName()),
            ];
        }

        return $categories;
    }

    /**
     * @return array
     */
    public function getComponents()
    {
        $components = [];

        $cacheKey = 'Styleguide/Components';
        $data = $this->cache->fetch($cacheKey);

        if (!empty($data)) {
            return $data;
        }

        $directories = $this->template->getTemplateDir();
        $directories[] = __DIR__.'/../Resources/views/';

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

                $group = basename($path);
                if ($group) {
                    $component->setGroup($group);
                }

                $components[$file->getBasename()] = $component;
            }
        }

        ksort($components);

        $this->cache->save($cacheKey, $components, 3600);
        return $components;
    }
}
