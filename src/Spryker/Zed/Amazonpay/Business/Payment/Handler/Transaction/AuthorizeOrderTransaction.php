<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class AuthorizeOrderTransaction extends AbstractQuoteTransaction
{
    /**
     * @var AuthorizeOrderAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    protected function generateAuthorizationReferenceIdForQuote(QuoteTransfer $quoteTransfer)
    {
        return md5 (__CLASS__ . $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId() . time());
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer->getAmazonpayPayment()->setAuthorizationReferenceId(
            $this->generateAuthorizationReferenceIdForQuote($quoteTransfer)
        );

        $quoteTransfer = parent::execute($quoteTransfer);

        if ($quoteTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
            $quoteTransfer->getAmazonpayPayment()->setAuthorizationDetails(
                $this->apiResponse->getAuthorizationDetails()
            );
        }

        return $quoteTransfer;
    }

}
