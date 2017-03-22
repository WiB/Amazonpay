<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class HandleDeclinedOrderTransaction extends AbstractQuoteTransaction
{
    /**
     * @var GetOrderReferenceDetailsTransaction
     */
    protected $getOrderReferenceDetailsTransaction;

    /**
     * @var CancelOrderTransaction
     */
    protected $cancelOrderTransaction;

    /**
     * @param GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction
     * @param CancelOrderTransaction $cancelOrderTransaction
     */
    public function __construct(
        GetOrderReferenceDetailsTransaction $getOrderReferenceDetailsTransaction,
        CancelOrderTransaction $cancelOrderTransaction
    ) {
        $this->getOrderReferenceDetailsTransaction = $getOrderReferenceDetailsTransaction;
        $this->cancelOrderTransaction = $cancelOrderTransaction;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        if (!$quoteTransfer->getAmazonPayment()->getAuthorizationDetails()->getIsDeclined()) {
            return $quoteTransfer;
        }

        if ($quoteTransfer->getAmazonPayment()->getAuthorizationDetails()->getIsPaymentMethodInvalid()) {
            return $quoteTransfer;
        }

        $checkOrderStatus = $this->getOrderReferenceDetailsTransaction->execute($quoteTransfer);

        // if (false) {
            //@todo ask amazon if condition about ORO state == Open is neccessary
            $this->cancelOrderTransaction->execute($quoteTransfer);
        // }

        return $quoteTransfer;
    }
}
