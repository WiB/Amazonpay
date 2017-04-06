<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
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
     * @var IpnConverterFactory
     */
    protected $ipnConverterFactory;

    /**
     * @param IpnConverterFactory $ipnConverterFactory
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
        $this->ipnConverterFactory->createIpnRequestConverter($ipnRequest)->convert($ipnRequest);
    }

}
