<?php

namespace TBNcaptchaGravityAddon\Controllers;

use LNCPikespeak\Controllers\PikeSpeakController;

class ConfirmationChanger
{
    public function __construct()
    {
        add_filter('gform_validation', [$this, 'validateTransaction'], 10, 2);
        add_filter('gform_validation_message', [$this, 'change_message'], 10, 2);
    }

    function change_message($message, $form)
    {
        if (isset($form['errorMessage'])) {
            $newMessage = sanitize_text_field($form['errorMessage']);
            return "<h2 class='gform_submission_error hide_summary'><span class='gform-icon gform-icon--close'></span>{$newMessage}</h2>";
        }
        return $message;
    }

    public function validateTransaction($validationResult)
    {
        $pikeSpeakController = new PikeSpeakController();
        $form = $validationResult['form'];
        $errorMessage = '';

        $transactionField = null;
        $nPayField = null;
        $shouldApplyValidation = false;
        foreach ($form['fields'] as &$field) {
            if ($field->type == 'nCaptcha_transaction') {
                $transactionField = $field;
            } elseif ($field->type == 'nCaptcha_field') {
                $nPayField = $field;
            }
            if ($transactionField && $nPayField) {
                $shouldApplyValidation = true;
                break;
            }
        }

        if ($shouldApplyValidation) {
            if (isset($_POST["input_{$transactionField->id}"])) {
                try {
                    $transactionData = $pikeSpeakController->getTransactionByHash($_POST["input_{$transactionField->id}"]);
                    $yoctoNears = json_decode($transactionData)[0]->transaction_graph->transaction->actions[0]->action->deposit;
                    $nearValue = $yoctoNears / 1000000000000000000000000;
                    $nPay = $nPayField->get_value_default() ? $nPayField->get_value_default() : 0.01;
                    if ((float)$nPay > (float)$nearValue) {
                        $errorMessage = 'Deposit payed does not match the required, please seek for help at LNC TG';
                    }
                } catch (\Throwable $e) {
                    $errorMessage = 'Your transaction is processing now, please try again in a few minutes';
                }

            } else {
                $errorMessage = 'Sorry but we can\'t find your transaction';
            }
        }
        if ($validationResult['is_valid']) {
            if ($errorMessage) {
                $validationResult['is_valid'] = false;
                $validationResult['message'] = $errorMessage;
                $validationResult['form']['errorMessage'] = $errorMessage;
            }
        }

        return $validationResult;
    }

}