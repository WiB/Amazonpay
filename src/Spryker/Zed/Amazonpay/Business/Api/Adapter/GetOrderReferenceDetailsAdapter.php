<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

class GetOrderReferenceDetailsAdapter extends AbstractQuoteAdapter
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getOrderReferenceDetails([
            'amazon_order_reference_id' => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            'address_consent_token' => $quoteTransfer->getAmazonpayPayment()->getAddressConsentToken(),
        ]);

        return $this->converter->convert($result);
    }

}
