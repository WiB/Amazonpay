<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn;

use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;

/**
 * Class IpnArrayConverter
 * Converts request taken from IpnHandler to the Transfer Object
 */
class IpnArrayConverter extends AbstractArrayConverter
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn\IpnConverterFactory
     */
    protected $ipnConverterFactory;

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn\IpnConverterFactory $ipnConverterFactory
     */
    public function __construct(IpnConverterFactory $ipnConverterFactory)
    {
        $this->ipnConverterFactory = $ipnConverterFactory;
    }

    /**
     * @param array $ipnRequest
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function convert(array $ipnRequest)
    {
        return $this->ipnConverterFactory->createIpnRequestConverter($ipnRequest)->convert($ipnRequest);
    }

}
