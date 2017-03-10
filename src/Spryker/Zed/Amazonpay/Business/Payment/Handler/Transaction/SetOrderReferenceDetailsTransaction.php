<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\SetOrderReferenceDetailsAdapter;

class SetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{
    /**
     * @param SetOrderReferenceDetailsAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        SetOrderReferenceDetailsAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }
}