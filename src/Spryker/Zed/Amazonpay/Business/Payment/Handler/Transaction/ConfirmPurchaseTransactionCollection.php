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
     * @param SetOrderReferenceDetailsTransaction $setOrderReferenceDetailsTransaction
     * @param ConfirmOrderReferenceTransaction $confirmOrderReferenceTransaction
     * @param GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction
     */
    public function __construct(
        SetOrderReferenceDetailsTransaction $setOrderReferenceDetailsTransaction,
        ConfirmOrderReferenceTransaction $confirmOrderReferenceTransaction,
        GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction
    ) {
        $this->setOrderReferenceDetailsTransaction = $setOrderReferenceDetailsTransaction;
        $this->confirmOrderReferenceTransaction = $confirmOrderReferenceTransaction;
        $this->getOrderReferenceDetailsTransaction = $getOrderReferenceDetailsTransaction;
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
            $quoteTransfer->setAmazonResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->confirmOrderReferenceTransaction->execute($quoteTransfer);

        if (!$response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setAmazonResponseHeader($response->getHeader());
            return $quoteTransfer;
        }

        $response = $this->getOrderReferenceDetailsTransaction->execute($quoteTransfer);
        $quoteTransfer->setAmazonResponseHeader($response->getHeader());

        if ($response->getHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($response->getAddress());
            $quoteTransfer->setBillingAddress($response->getAddress());
            $quoteTransfer->setBillingSameAsShipping(true);
            $quoteTransfer->setOrderReference($quoteTransfer->getAmazonOrderReferenceId());
        }

        return $quoteTransfer;
    }
}