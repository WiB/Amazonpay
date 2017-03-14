<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class ConfirmPurchaseTransactionCollection extends AbstractQuoteTransaction
{
    /**
     * @var SetOrderReferenceDetailsTransaction
     */
    protected $setOrderReferenceDetailsTransaction;

    /**
     * @var ConfirmOrderReferenceTransaction
     */
    protected $confirmOrderReferenceTransaction;

    /**
     * @var GetOrderReferenceDetailsTransaction
     */
    protected $getOrderReferenceDetailsTransaction;

    /**
     * @var AuthorizeOrderTransaction
     */
    protected $authorizeOrderTransaction;

    /**
     * @param SetOrderReferenceDetailsTransaction $setOrderReferenceDetailsTransaction
     * @param ConfirmOrderReferenceTransaction $confirmOrderReferenceTransaction
     * @param GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction
     */
    public function __construct(
        SetOrderReferenceDetailsTransaction $setOrderReferenceDetailsTransaction,
        ConfirmOrderReferenceTransaction $confirmOrderReferenceTransaction,
        GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction,
        AuthorizeOrderTransaction $authorizeOrderTransaction
    ) {
        $this->setOrderReferenceDetailsTransaction = $setOrderReferenceDetailsTransaction;
        $this->confirmOrderReferenceTransaction = $confirmOrderReferenceTransaction;
        $this->getOrderReferenceDetailsTransaction = $getOrderReferenceDetailsTransaction;
        $this->authorizeOrderTransaction = $authorizeOrderTransaction;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $response = $this->setOrderReferenceDetailsTransaction->execute($quoteTransfer);

        if (!$response->getHeader()->getIsSuccess()) {
            $quoteTransfer->getAmazonPayment()->setResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->confirmOrderReferenceTransaction->execute($quoteTransfer);

        if (!$response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setAmazonResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->getOrderReferenceDetailsTransaction->execute($quoteTransfer);
        $quoteTransfer->getAmazonPayment()->setResponseHeader($response->getHeader());

        if ($response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($response->getShippingAddress());

            if ($response->getBillingAddress()) {
                $quoteTransfer->setBillingAddress($response->getBillingAddress());
            } else {
                $quoteTransfer->setBillingAddress($response->getShippingAddress());
                $quoteTransfer->setBillingSameAsShipping(true);
            }

            $quoteTransfer->setOrderReference($quoteTransfer->getAmazonPayment()->getOrderReferenceId());
        } else {
            return $quoteTransfer;
        }

        $response = $this->authorizeOrderTransaction->execute($quoteTransfer);
        $quoteTransfer->getAmazonPayment()->setResponseHeader($response->getHeader());

        if ($response->getHeader()->getIsSuccess()) {
            // @todo set info from auth call
        }

        return $quoteTransfer;
    }
}