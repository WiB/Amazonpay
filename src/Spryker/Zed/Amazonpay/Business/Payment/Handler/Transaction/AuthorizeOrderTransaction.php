<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AuthorizeOrderAdapter;

class AuthorizeOrderTransaction extends AbstractQuoteTransaction
{
    /**
     * @param AuthorizeOrderAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        AuthorizeOrderAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

}
