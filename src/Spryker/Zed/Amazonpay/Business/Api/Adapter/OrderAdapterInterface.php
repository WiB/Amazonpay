<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;

interface OrderAdapterInterface
{
    /**
     * @param OrderTransfer $quoteTransfer
     */
    public function call(OrderTransfer $quoteTransfer);

}