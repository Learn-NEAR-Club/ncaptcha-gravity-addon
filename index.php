<?php
/**
 * Plugin Name: TB NCaptcha Gravity addon
 * Description: nCaptcha provider for gravity form
 * Version: 0.0.1
 * Author: Techbridge
 * Author URI: https://techbridge.ca/
 */

use TBNcaptchaGravityAddon\Model\Constructor\Constructor;

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

try {
    $composerLoader = __DIR__ . '/vendor/autoload.php';
    if (file_exists($composerLoader)) {
        require_once $composerLoader;
    } else {
        throw new Exception(__('Install the composer for current work', 'tb-ncaptcha-gravity-addon'));
    }
    if (!is_plugin_active('gravityforms/gravityforms.php')) {
        throw new Exception(__('Gravity forms plugin must be enabled'));
    }
    Constructor::getInstance();
} catch (Exception $exception) {
    deactivate_plugins('tb-ncaptcha-gravity-addon/index.php');
    add_action('admin_notices', function () use ($exception) {
        echo '<div class="error"><p>' . esc_html($exception->getMessage()) . '</p></div>';
    });
}


$constructor = Constructor::getInstance();
