<?php

namespace Ognistyi\WayForPay;

use yii\base\BaseObject;

class WayForPayComponent extends BaseObject
{
    public $merchantAccount;
    public $merchantSecretKey;

    public function make()
    {
        return new WayForPay($this->merchantAccount, $this->merchantSecretKey);
    }
}