<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger\IpnRequestLogger;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

class IpnFactory implements IpnFactoryInterface
{

    /**
     * @var AmazonpayQueryContainerInterface
     */
    protected $amazonpayQueryContainer;

    /**
     * @var AmazonpayToOmsInterface
     */
    protected $omsFacade;

    /**
     * @param AmazonpayToOmsInterface $omsFacade
     * @param AmazonpayQueryContainerInterface $amazonpayQueryContainer
     */
    public function __construct(
        AmazonpayToOmsInterface $omsFacade,
        AmazonpayQueryContainerInterface $amazonpayQueryContainer
    ) {
        $this->omsFacade = $omsFacade;
        $this->amazonpayQueryContainer = $amazonpayQueryContainer;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger\IpnRequestLogger
     */
    public function createIpnRequestLogger()
    {
        return new IpnRequestLogger();
    }

    /**
     * @return IpnRequestFactoryInterface
     */
    public function createIpnRequestFactory()
    {
        return new IpnRequestFactory(
            $this->omsFacade,
            $this->amazonpayQueryContainer,
            $this->createIpnRequestLogger()
        );
    }

}
