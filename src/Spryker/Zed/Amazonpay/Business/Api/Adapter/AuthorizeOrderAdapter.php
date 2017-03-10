<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\OrderTransfer;
use PayWithAmazon\ResponseParser;

class AuthorizeOrderAdapter extends AbstractOrderAdapter
{
    /**
     * @param OrderTransfer $quoteTransfer
     *
     * @return ResponseParser
     */
    public function call(OrderTransfer $quoteTransfer)
    {
    }

}
