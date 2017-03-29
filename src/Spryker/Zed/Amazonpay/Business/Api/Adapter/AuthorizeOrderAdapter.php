<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

class AuthorizeOrderAdapter extends AbstractQuoteAdapter
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->authorize([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'authorization_amount' => $this->getAmount($quoteTransfer),
            'authorization_reference_id' => $quoteTransfer->getAmazonpayPayment()->getAuthorizationReferenceId(),
            'transaction_timeout' => 0,
            'capture_now' => true,
        ]);

        return $this->converter->convert($result);
    }

}
