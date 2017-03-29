<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler;

use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Business\Exception\NoMethodMapperException;

abstract class AbstractPaymentHandler
{

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter
     */
    protected $executionAdapter;

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfig
     */
    protected $config;

    /**
     * @var array
     */
    protected $methodMappers = [];

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter $executionAdapter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\AmazonpayConfig
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay
     *
     * @return void
     */
    public function registerMethodMapper($mapper)
    {
        $this->methodMappers[$mapper->getMethodName()] = $mapper;
    }

    /**
     * @param string $methodName
     *
     * @throws \Spryker\Zed\Amazonpay\Business\Exception\NoMethodMapperException
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Method\Amazonpay
     */
    protected function getMethodMapper($methodName)
    {
        if (isset($this->methodMappers[$methodName]) === false) {
            throw new NoMethodMapperException('The method mapper is not registered.');
        }

        return $this->methodMappers[$methodName];
    }

}
