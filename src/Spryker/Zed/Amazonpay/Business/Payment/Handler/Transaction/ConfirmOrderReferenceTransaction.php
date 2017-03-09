<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\ConfirmOrderReferenceAmazonpayAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

class ConfirmOrderReferenceTransaction extends AbstractPaymentHandler
{
    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface $executionAdapter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        ConfirmOrderReferenceAmazonpayAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

}
