<?php

namespace LNCNcaptchaGravityAddon\Controllers;

use LNCNcaptchaGravityAddon\Model\Fields\NearPayableField;
use LNCNcaptchaGravityAddon\Model\Fields\NearTransactionField;
class FieldsController
{
    public function __construct()
    {
        $this->createFields();
    }
    public function createFields()
    {
        \GF_Fields::register(new NearPayableField());
        \GF_Fields::register(new NearTransactionField());
    }
}
