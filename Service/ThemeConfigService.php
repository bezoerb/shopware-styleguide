<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 08.04.18
 * Time: 00:13
 */

namespace Styleguide\Service;


use Doctrine\Common\Cache\Cache;
use Shopware\Bundle\StoreFrontBundle\Service\Core\ContextService;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Theme\Compiler;
use Shopware\Components\Theme\Configuration;
use Shopware\Models\Shop\Shop;

class ThemeConfigService
{
    /**
     * @var Compiler
     */
    private $temeCompiler;

    /**
     * @var \Less_Parser
     */
    private $lessParser;

    /**
     * @var ContextService
     */
    private $contextService;

    /**
     * @var ModelManager
     */
    private $modelManager;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Compiler $temeCompiler
     * @param \Less_Parser $lessParser
     * @param ContextService $contextService
     * @param ModelManager $modelManager
     */
    public function __construct(
        Compiler $temeCompiler,
        \Less_Parser $lessParser,
        ContextService $contextService,
        ModelManager $modelManager,
        Cache $cache
    )
    {
        $this->temeCompiler = $temeCompiler;
        $this->lessParser = $lessParser;
        $this->contextService = $contextService;
        $this->modelManager = $modelManager;
        $this->cache = $cache;
    }

    /**
     * @return string[]
     * @throws \Exception
     */
    public function getColors()
    {
        $themeConfig = $this->getThemeConfig();
        $colors = [];

        foreach ($themeConfig->getConfig() as $key => $config) {
            // check colors
            if (!is_string($config)) {
                continue;
            }

            if (preg_match('/^#[\da-fA-F]{3,6}/i', $config)) {
                $colors[$key] = $config;
                continue;
            }

            $keys = array_map(function($key) { return '@'.$key; }, array_keys($colors));
            $regexp = '/((?:'.implode(')|(?:', $keys).'))/';
            if (count($keys) && preg_match($regexp, $config, $matches)) {
                $colors[$key] = $this->parseLess($config, $themeConfig->getConfig());
            }
        }

        $colors = array_map('strtoupper', $colors);
        $hex = array_flip(array_values($colors));
        ksort($hex);



        return array_flip($colors);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getFonts()
    {
        $config = $this->getThemeConfig()->getConfig();
        $fonts = [];

        if (isset($config['font-base-stack']) && is_string($config['font-base-stack'])) {
            $font = $config['font-base-stack'];
            if (strpos($font, '@') !== false) {
                $font = $this->parseLess($font, $config);
            }

            $fonts[] = trim($font, ' \t\n\r\0\x0B;');
        }

        if (isset($config['font-headline-stack']) && is_string($config['font-headline-stack'])) {
            $font = $config['font-headline-stack'];
            if (strpos($font, '@') !== false) {
                $font = $this->parseLess($font, $config);
            }

            $fonts[] = trim($font, ' \t\n\r\0\x0B;');
        }

        return array_unique($fonts);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getConfig()
    {
        return $this->getThemeConfig()->getConfig();
    }


    /**
     * @return string[]
     * @throws \Exception
     */
    public function getInheritancePath()
    {
        return $this->getThemeConfig()->getInheritancePath();
    }

    /**
     * @param $str
     * @param $vars
     * @return string
     * @throws \Exception
     */
    protected function parseLess($str, $vars = [])
    {
        $cacheKey = 'Styleguide/Less/'.md5($str);
        $data = $this->cache->fetch($cacheKey);
        if ($data) {
            return $data;
        }

        $less = '.a{a:'.$str.';}';
        $this->lessParser->Reset();
        $this->lessParser->parse($less);

        if (count($vars)) {
            $this->lessParser->ModifyVars($vars);
        }
        $css = $this->lessParser->getCss();
        $result = preg_replace('/[\r\n]/','', $css);
        $result = preg_replace('/^.*a:/','', $result);
        $result = preg_replace('/;}$/','', $result);
        $result = trim($result);

        $this->cache->save($cacheKey, $result, 86400);

        return $result;
    }


    /**
     * @return Configuration
     * @throws \Exception
     */
    protected function getThemeConfig()
    {
        $shopId = $this->contextService->getShopContext()->getShop()->getId();
        $cacheKey = 'Styleguide/ThemeConfig/'.$shopId;
        $data = $this->cache->fetch($cacheKey);
        if ($data instanceof Configuration) {
            return $data;
        }

        $repo = $this->modelManager->getRepository(Shop::class);
        $shop = $repo->find($shopId);

        $config = $this->temeCompiler->getThemeConfiguration($shop);
        $this->cache->save($cacheKey, $config, 3600);

        return $config;
    }
}
