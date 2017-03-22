<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class HandleDeclinedOrderTransaction extends AbstractQuoteTransaction
{
    const ORDER_REFERENCE_STATUS_OPEN = 'Open';

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

        if ($checkOrderStatus->getAmazonPayment()->getOrderReferenceStatus() == self::ORDER_REFERENCE_STATUS_OPEN)
        {
            $this->cancelOrderTransaction->execute($quoteTransfer);
        }

        return $quoteTransfer;
    }
}
