<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

class AbstractOrderTransaction extends AbstractPaymentHandler
{
    /**
     * @param OrderTransfer $quoteTransfer
     */
    public function execute(OrderTransfer $quoteTransfer)
    {
        return $this->executionAdapter->call($quoteTransfer);
    }

}
