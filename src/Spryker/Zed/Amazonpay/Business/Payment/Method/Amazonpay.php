<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Method;

use Spryker\Shared\Amazonpay\AmazonpayConstants;

class Amazonpay
{
    /**
     * @return string
     */
    public function getMethodName()
    {
        return AmazonpayConstants::PAYMENT_METHOD;
    }

}