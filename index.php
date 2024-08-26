<?php
/**
 * Plugin Name: LNC nCaptcha Add-on for Gravity Forms
 * Description: LNC nCaptcha Add-on for Gravity Forms provides nCaptcha for gravity form
 * Version: 0.0.2
 * Author: LNC
 * Author URI: http://learnnear.club/
 */

use LNCNcaptchaGravityAddon\Model\Constructor\Constructor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

try {
    $composerLoader = __DIR__ . '/vendor/autoload.php';
    if (file_exists($composerLoader)) {
        require_once $composerLoader;
    } else {
        throw new Exception(__('Install the composer for current work', 'lnc-ncaptcha-gravity-addon'));
    }
    if (!is_plugin_active('gravityforms/gravityforms.php')) {
        throw new Exception(__('Gravity forms plugin must be enabled'));
    }
    Constructor::getInstance();
} catch (Exception $exception) {
    deactivate_plugins('lnc-ncaptcha-gravity-addon/index.php');
    add_action('admin_notices', function () use ($exception) {
        echo '<div class="error"><p>' . esc_html($exception->getMessage()) . '</p></div>';
    });
}

$constructor = Constructor::getInstance();
