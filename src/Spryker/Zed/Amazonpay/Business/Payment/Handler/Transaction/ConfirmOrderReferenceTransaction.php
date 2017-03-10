<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAdapter;

class ConfirmOrderReferenceTransaction extends AbstractQuoteTransaction
{
    /**
     * @param ConfirmOrderReferenceAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        ConfirmOrderReferenceAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

}
