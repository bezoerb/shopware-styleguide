<?php

namespace Styleguide\Traits;

use Styleguide\Service\StyleguideService;

trait StyleguideServiceTrait
{
    /**
     * Styleguide service
     *
     * @var StyleguideService
     */
    private $styleguideService;

    /**
     * Set Styleguide service
     *
     * @param StyleguideService $articleMapper
     */
    public function setStyleguideService(StyleguideService $styleguideService)
    {
        $this->styleguideService = $styleguideService;
    }

    /**
     * Get Styleguide service
     *
     * @return StyleguideService
     * @throws \Exception
     */
    protected function getStyleguideService()
    {
        if (!$this->styleguideService instanceof StyleguideService) {
            throw new \Exception('StyleguideService not injected', get_class($this));
        }

        return $this->styleguideService;
    }
}
