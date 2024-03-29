<?php

namespace LNCNcaptchaGravityAddon\Model\Fields;

class NearTransactionField extends \GF_Field_Hidden
{
    public $type = 'nCaptcha_transaction';

    function get_form_editor_field_settings(): array
    {
        return [...parent::get_form_editor_field_settings(), 'rules_setting'];
    }

    public function sanitize_settings(): void
    {
        parent::sanitize_settings();
        $this->label = 'nCaptcha Transaction';
        $this->adminLabel = 'nCaptcha Transaction';
    }

    public function get_form_editor_field_title(): string
    {
        return esc_attr__('nCaptcha Transaction', 'lnc-ncaptcha-gravity-addon');
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
        add_filter('gform_validation_message', function ($message, $form) {
            if (gf_upgrade()->get_submissions_block()) {
                return $message;
            }

            foreach ($form['fields'] as $field) {
                if ($field->type == 'nCaptcha_transaction' && $field->failed_validation) {
                    return "<h2 class='gform_submission_error hide_summary'><span class='gform-icon gform-icon--close'></span>Verification with nCaptcha is failed, please try again.</h2>";
                }
            }

            return $message;
        }, 10, 2);
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

        $input = sprintf("<input class='nCaptcha-transaction-field' name='input_%d' id='%s' type='$field_type' {$class_attribute} {$required_attribute} {$invalid_attribute} value='%s' %s/>", $id, $field_id, esc_attr($value), $disabled_text);

        return sprintf("<div class='ginput_container ginput_container_text'>%s</div>", $input);
    }
}