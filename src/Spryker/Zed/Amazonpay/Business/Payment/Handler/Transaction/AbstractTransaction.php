<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

class AbstractTransaction extends AbstractPaymentHandler
{
    /**
     * @var AbstractTransfer
     */
    protected $apiResponse;

    /**
     * @param AbstractAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

}
