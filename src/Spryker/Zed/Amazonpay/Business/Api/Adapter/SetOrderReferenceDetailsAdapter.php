<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;

class SetOrderReferenceDetailsAdapter extends AbstractQuoteAdapter
{

    const SELLER_ORDER_ID = 'seller_order_id';
    const PLATFORM_ID = 'platform_id';

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AmazonpaySetOrderReferenceDetailsResponseTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->setOrderReferenceDetails([
            static::AMAZON_ORDER_REFERENCE_ID => $quoteTransfer->getAmazonpayPayment()->getOrderReferenceId(),
            static::AMAZON_ADDRESS_CONSENT_TOKEN => $quoteTransfer->getAmazonpayPayment()->getAddressConsentToken(),
            static::AMAZON_AMOUNT => $this->getAmount($quoteTransfer),
            static::SELLER_ORDER_ID => $quoteTransfer->getAmazonpayPayment()->getSellerOrderId(),
        ]);

        return $this->converter->convert($result);
    }

}
