<?php

namespace TBNcaptchaGravityAddon\Controllers;

use TBNcaptchaGravityAddon\Model\Fields\NearPayableField;
use TBNcaptchaGravityAddon\Model\Fields\NearTransactionField;
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