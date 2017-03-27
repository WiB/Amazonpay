<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\Logger\TransactionLogger;

class AbstractTransaction extends AbstractPaymentHandler
{
    /**
     * @var AbstractTransfer
     */
    protected $apiResponse;

    /**
     * @var TransactionLogger
     */
    protected $transactionsLogger;

    /**
     * @param AbstractAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config,
        TransactionLogger $transactionLogger
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
        $this->transactionsLogger = $transactionLogger;
    }

}
