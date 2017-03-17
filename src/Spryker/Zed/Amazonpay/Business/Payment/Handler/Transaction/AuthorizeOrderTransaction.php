<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
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

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    protected function generateAuthorizationReferenceIdForQuote(QuoteTransfer $quoteTransfer)
    {
        return md5 (__CLASS__ . $quoteTransfer->getAmazonPayment()->getOrderReference() . time());
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->getAmazonPayment()->setAuthorizationReferenceId(
            $this->generateAuthorizationReferenceIdForQuote($quoteTransfer)
        );

        return parent::execute($quoteTransfer);
    }

}
