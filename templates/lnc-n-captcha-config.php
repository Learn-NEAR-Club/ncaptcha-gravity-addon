<?php

use LNCNcaptchaGravityAddon\Model\Constructor\Constructor;

ob_start();
?>
<?php if (isset($args) && isset($args->optionsGroup)): ?>
    <?php
    $options = Constructor::$options;
    $nCaptchaOwner = $options['nCaptcha_owner'] ?? '';
    $result = get_settings_errors();
    $noticeClass = 'notice-error';
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('LNC Near comments configurations', 'lnc-n-comments'); ?></h1>
        <?php if (isset($result[0]['message']) && isset($result[0]['code'])): ?>
            <?php if ($result[0]['code'] === 'settings_updated') {
                $noticeClass = 'notice-success';
            }
            ?>
            <div class="notice <?php echo esc_html($noticeClass); ?>">
                <p><?php echo esc_html($result[0]['message']); ?></p>
            </div>
        <?php endif; ?>
        <form method="post" action="options.php" class="settings-form">
            <?php settings_fields($args->optionsGroup); ?>
            <div class="form-table">
                <div class="form-group">
                    <label for="site-owner"><?php _e('nCaptcha owner'); ?></label>
                    <input type="text" id="nCaptcha-owner" name="<?php echo esc_html("$args->optionsGroup[nCaptcha_owner]"); ?>"
                           value="<?php echo esc_html($nCaptchaOwner); ?>" class="regular-text"/>
                </div>
            </div>
            <div class="form-table">
                <div class="form-group">
                    <button type="submit" class="button button-primary button-large"><?php _e('Save', 'lnc-ncaptcha-gravity-addon'); ?></button>
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<?php return ob_get_clean(); ?>
