<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

class ConfirmOrderReferenceAdapter extends AbstractQuoteAdapter
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\ConfirmOrderReferenceAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->confirmOrderReference([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'amount' => $this->getAmount($quoteTransfer),
        ]);

        return $this->converter->convert($result);
    }

}
