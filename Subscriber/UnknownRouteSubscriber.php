<?php

namespace Styleguide\Subscriber;

use Enlight\Event\SubscriberInterface;
use Styleguide\Service\StyleguideService;

class UnknownRouteSubscriber implements SubscriberInterface
{

    /**
     * @var StyleguideService
     */
    protected $styleguide;

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Router_Route' => ['onUnknownRoute'],
        ];
    }


    public function onUnknownRoute(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Request_RequestHttp $request */
        $request = $args->get('request');
        $path = $request->getPathInfo();

        if (preg_match('/^\/?styleguide\/(?:([^\/]*)\/?)(?:([^\/]*)\/?)?/', $path, $matches)) {
            $index = $matches[1];
            $fileIndex = $matches[2];
            $categories = $this->styleguide->getMainCategories();

            $params = [];
            $category = null;
            if (array_key_exists($index, $categories)) {
                $params['category'] = $index;
            }

            if ($fileIndex) {
                $params['file'] = $fileIndex;
            }


            return array_merge([
                'module' => 'frontend',
                'controller' => 'styleguide',
                'action' => 'index'
            ], $params);
        }



        return null;
    }

    /**
     * @param StyleguideService $svc
     */
    public function setStyleguideService(StyleguideService $svc)
    {
        $this->styleguide = $svc;
    }
}
