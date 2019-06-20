<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use AmazonPay\Client;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class ObtainProfileInformationAdapter extends AbstractAdapter implements QuoteAdapterInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter
     */
    protected $converter;

    /**
     * @param \AmazonPay\Client $client
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface $converter
     */
    public function __construct(
        Client $client,
        ArrayConverterInterface $converter
    ) {
        $this->client = $client;
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
