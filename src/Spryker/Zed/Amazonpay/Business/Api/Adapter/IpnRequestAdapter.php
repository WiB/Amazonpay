<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use PayWithAmazon\IpnHandler;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface;

class IpnRequestAdapter implements IpnRequestAdapterInterface
{

    /**
     * @var IpnHandler
     */
    protected $ipnHandler;

    /**
     * @var ArrayConverterInterface
     */
    protected $ipnArrayConverter;

    public function __construct(
        IpnHandler $ipnHandler,
        ArrayConverterInterface $ipnArrayConverter
    ) {
        $this->ipnHandler = $ipnHandler;
        $this->ipnArrayConverter = $ipnArrayConverter;
    }

    /**
     * @return AbstractTransfer
     */
    public function getIpnRequest()
    {
        return $this->ipnArrayConverter->convert(
            $this->ipnHandler->toArray()
        );
    }

}
