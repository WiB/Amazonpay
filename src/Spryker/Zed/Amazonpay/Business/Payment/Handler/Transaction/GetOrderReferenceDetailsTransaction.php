<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter;

class GetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{
    /**
     * @param GetOrderReferenceDetailsAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        GetOrderReferenceDetailsAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

}