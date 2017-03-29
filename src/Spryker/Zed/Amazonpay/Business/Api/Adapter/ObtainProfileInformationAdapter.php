<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;

class ObtainProfileInformationAdapter extends AbstractAdapter implements QuoteAdapterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter
     */
    protected $converter;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter $converter
     */
    public function __construct(
        AmazonpayConfig $config,
        AbstractArrayConverter $converter
    ) {
        parent::__construct($config);

        $this->converter = $converter;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function call(QuoteTransfer $quoteTransfer)
    {
        $result = $this->client->getUserInfo($quoteTransfer->getAmazonpayPayment()->getAddressConsentToken());

        return $this->converter->convert($result);
    }

}
