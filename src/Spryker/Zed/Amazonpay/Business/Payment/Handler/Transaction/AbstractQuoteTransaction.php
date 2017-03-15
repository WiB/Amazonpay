<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

abstract class AbstractQuoteTransaction extends AbstractPaymentHandler implements QuoteTransactionInterface
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

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);
        $quoteTransfer->getAmazonPayment()->setResponseHeader($this->apiResponse->getHeader());

        return $quoteTransfer;
    }

}