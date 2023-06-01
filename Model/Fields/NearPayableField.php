<?php

namespace LNCNcaptchaGravityAddon\Model\Fields;

use LNCNcaptchaGravityAddon\Model\Constructor\Constructor;

class NearPayableField extends \GF_Field_Hidden
{
    public $type = 'nCaptcha_field';

    public function get_form_editor_field_settings(): array
    {
        $settings = parent::get_form_editor_field_settings();

        $settings[] = [
            'nCaptchaOwner' => [
                'type' => 'text',
                'label' => esc_html__('nCaptcha Owner', 'lnc-ncaptcha-gravity-addon'),
                'name' => 'nCaptchaOwner',
                'tooltip' => esc_html__('Specify the owner of the nCaptcha field.', 'lnc-ncaptcha-gravity-addon'),
            ],
        ];

        return $settings;
    }

    public function sanitize_settings(): void
    {
        parent::sanitize_settings();
        $this->label = 'nCaptcha';
        $this->adminLabel = 'nCaptcha';
    }

    public function get_form_editor_field_title(): string
    {
        return esc_attr__('nCaptcha', 'lnc-ncaptcha-gravity-addon');
    }

    public function get_form_editor_button(): array
    {
        return [
            'group' => 'advanced_fields',
            'text' => $this->get_form_editor_field_title()
        ];
    }

    public function __construct($data = array())
    {
        parent::__construct($data);
    }

    public function get_field_input($form, $value = '', $entry = null): string
    {
        $form_id = esc_html($form['id']);
        $is_entry_detail = $this->is_entry_detail();
        $is_form_editor = $this->is_form_editor();

        $id = (int)$this->id;
        $field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";

        $disabled_text = $is_form_editor ? 'disabled="disabled"' : '';

        $field_type = $is_entry_detail || $is_form_editor ? 'text' : 'hidden';
        $class_attribute = $is_entry_detail || $is_form_editor ? '' : "class='gform_hidden'";
        $required_attribute = $this->isRequired ? 'aria-required="true"' : '';
        $invalid_attribute = $this->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';

        $configOptions = Constructor::$options;
        $nCaptchaOwner = $configOptions['nCaptcha_owner'] ?? 'partners.learnclub.near';
        $nCaptcha = "<div id='nCaptcha-verification' data-account='{$nCaptchaOwner}' data-price='{$value}'></div>";

        $toShow = $nCaptcha;
        if (is_plugin_active('near-login/index.php') && !get_current_user_id()) {
            $nLogin = do_shortcode('[login_near_link]');
            $toShow =  $nLogin;
        }

        $input = sprintf("<input class='nCaptcha-input-field' name='input_%d' id='%s' type='$field_type' {$class_attribute} {$required_attribute} {$invalid_attribute} value='%s' %s/>", $id, $field_id, esc_attr($value), $disabled_text);
        if (is_admin()) {
            return sprintf("<div class='ginput_container ginput_container_text'>
            %s
            </div>", $input);
        }
        return "<div class='ginput_container ginput_container_text'>
                        {$toShow}
                        {$input}
                </div>";
    }

}