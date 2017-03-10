<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderTransactionInterface
{
    /**
     * @param OrderTransfer $quoteTransfer
     *
     * @return OrderTransfer
     */
    public function execute(OrderTransfer $quoteTransfer);
}