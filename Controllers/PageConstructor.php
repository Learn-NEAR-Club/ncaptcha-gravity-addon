<?php

namespace TBNcaptchaGravityAddon\Controllers;

use TBNcaptchaGravityAddon\Model\Constructor\ConfigPage;

/**
 * Class PageConstructor
 * @package TBNcaptchaGravityAddon
 */
class PageConstructor
{
    /**
     * pages pool
     *
     * @var array
     */
    protected array $pages = [];

    /**
     * PageConstructor constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->pageCreator($config);
    }

    /**
     * @param $config
     */
    protected function pageCreator($config): void
    {
        $this->pages['config'] = new ConfigPage($config);
    }
}
