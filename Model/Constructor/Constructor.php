<?php

namespace LNCNcaptchaGravityAddon\Model\Constructor;

use LNCNcaptchaGravityAddon\Controllers\FieldsController;
use LNCNcaptchaGravityAddon\Controllers\PageConstructor;
use LNCNcaptchaGravityAddon\Model\Config;

/**
 * Init all main functionality
 *
 * Class Constructor
 * @package LNCNcaptchaGravityAddon\Model\Constructor
 */
class Constructor
{
    /**
     * Self Constructor object.
     * @var $instance
     */
    private static Constructor $instance;

    /**
     * Plugin options
     *
     * @var mixed
     */
    public static mixed $options;


    /**
     * @var Config
     */
    private Config $config;

    /**
     * protect singleton  clone
     */
    private function __clone()
    {

    }

    /**
     * Method to use native functions as methods
     *
     * @param $name
     * @param $arguments
     * @return bool|mixed
     */
    public function __call($name, $arguments)
    {
        if (function_exists($name)) {
            return call_user_func_array($name, $arguments);
        }
        return false;
    }

    /**
     * protect singleton __wakeup
     */
    public function __wakeup()
    {

    }

    private function __construct()
    {
        $this->config = new Config();
        new PageConstructor($this->config);
        self::$options = apply_filters('getLNCNCaptchaOptions', 'options');

        $this->setUpActions();
    }
    public function addFrontendStuffs(): void
    {
        $this->initFrontendControllers();
    }

    /**
     * Method to register plugin scripts
     */
    public function addScripts(): void
    {
        wp_enqueue_script(
            'lnc-n-captcha-gravity-addon',
            $this->config->getScriptsPath() . 'index.js',
            ['jquery'],
            time(),
            true
        );
    }

    protected function initFrontendControllers(): void
    {
        new FieldsController();
    }

    /**
     * Method to set up WP actions.
     */
    private function setUpActions(): void
    {
        add_action('wp_head', [&$this, 'provideExtraScripts']);
        add_action('init', [&$this, 'addFrontendStuffs']);

        if (is_admin()) {
            add_filter('gform_field_content', [$this, 'modifyTransactionView'], 10, 5);
            add_filter('gform_entries_field_value', [$this, 'modifyTransactionViewValue'], 10, 5);
        }

        if (!is_admin()) {
            add_action('init', [$this, 'addScripts']);
        }
    }

    public function provideExtraScripts(): void
    {
        ?>
        <script src="https://ncaptcha.xyz/n-captcha/n-captcha@stable.js"></script>
        <script>

        </script>
        <?php
    }

    public function modifyTransactionView($content, $field, $value, $leadID, $formID)
    {
        if ($field->type == 'nCaptcha_transaction') {
            $content = '
                        <tr>
                            <td colspan="2" class="entry-view-field-name">nCaptcha Transaction</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="entry-view-field-value lastrow"><a href="https://explorer.mainnet.near.org/transactions/' . $value . '">' . $value . '</a></td>
                        </tr>';
        }

        return $content;
    }

    public function modifyTransactionViewValue($value, $formID, $fieldID, $entry)
    {
        $form = \GFAPI::get_form($formID);
        $field = \GFFormsModel::get_field($form, $fieldID);

        if ($field->type == 'nCaptcha_transaction') {
            $value = "<a href='https://explorer.mainnet.near.org/transactions/{$value}'>{$value}</a>";
        }

        return $value;
    }

    /**
     * Get self object
     *
     * @return Constructor object
     */
    public static function getInstance(): Constructor
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
