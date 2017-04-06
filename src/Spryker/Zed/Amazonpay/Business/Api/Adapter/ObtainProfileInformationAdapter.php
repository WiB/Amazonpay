<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Generated\Shared\Transfer\QuoteTransfer;
use PayWithAmazon\Client;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class ObtainProfileInformationAdapter extends AbstractAdapter implements QuoteAdapterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter
     */
    protected $converter;

    /**
     * @param Client $client
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $converter
     */
    public function __construct(
        Client $client,
        ArrayConverterInterface $converter
    ) {
        parent::__construct($client);

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
