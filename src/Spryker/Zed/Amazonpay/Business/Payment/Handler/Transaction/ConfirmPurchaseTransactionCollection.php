<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;

class ConfirmPurchaseTransactionCollection extends AbstractQuoteTransaction
{
    /**
     * @var AbstractQuoteTransaction[]
     */
    protected $transactionHandlers;

    /**
     * @param AbstractQuoteTransaction[] $transactionHandlers
     */
    public function __construct(
        array $transactionHandlers
    ) {
        $this->transactionHandlers = $transactionHandlers;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        foreach ($this->transactionHandlers as $transactionHandler) {
            $quoteTransfer = $transactionHandler->execute($quoteTransfer);

            if (!$quoteTransfer->getAmazonpayPayment()->getResponseHeader()->getIsSuccess()) {
                return $quoteTransfer;
            }
        }

        return $quoteTransfer;
    }
}