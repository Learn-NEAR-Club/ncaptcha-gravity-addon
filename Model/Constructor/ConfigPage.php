<?php

namespace LNCNcaptchaGravityAddon\Model\Constructor;

use LNCNcaptchaGravityAddon\Model\Abstractions\AdminPages;
use LNCNcaptchaGravityAddon\Helper\View;
use LNCNcaptchaGravityAddon\Model\Config;

/**
 * Class ConfigPage
 * @package LNCNcaptchaGravityAddon\Model\Constructor
 */
class ConfigPage extends AdminPages
{
    const OPTIONS_GROUP = 'lnc-n-captcha-config';
    const FILE_EXTENSION = 'php';

    private Config $config;

    public string $optionsGroup;

    public function __construct($config)
    {
        parent::__construct();
        $this->config = $config;
        $this->optionsGroup = $this->getOptionsGroup();
        $this->setUp();
    }

    public function addAdminPage(): void
    {
        add_menu_page(
            'nCaptcha config',
            'nCaptcha config',
            'manage_options',
            'n_captcha_config',
            [$this, 'displaySettingsPage']
        );
    }

    public function setUp(): void
    {
        add_filter('getLNCNCaptchaOptions', [$this, 'getOptions']);
        add_action('admin_init', [$this, 'registerSettings']);
    }

    public function getOptionsGroup(): string
    {
        return self::OPTIONS_GROUP;
    }

    public function registerSettings(): void
    {
        register_setting(
            $this->optionsGroup,
            $this->optionsGroup,
            [$this, 'validateFields']
        );
    }

    public function displaySettingsPage(): void
    {
        $path = $this->config->getTemplatesPath(). '/' . self::OPTIONS_GROUP . '.' . self::FILE_EXTENSION;
        View::view($path, $this);
    }

    public function getOptions()
    {
        return get_option($this->optionsGroup);
    }

    public function validateFields($fields): array
    {
        $validatedFields = [];

        foreach ($fields as $key => $value) {
            if ($key === 'site_owner') {
                if (!preg_match('/^.+\.near$/', $value)) {
                    add_settings_error(
                        $key,
                        'incorrect_site_owner',
                        __('Site owner should be a valid named near wallet like any.near')
                    );
                } else {
                    $validatedFields[$key] = $value;
                }
            } else {
                $validatedFields[$key] = $value;
            }
        }
        return $validatedFields;
    }
}
