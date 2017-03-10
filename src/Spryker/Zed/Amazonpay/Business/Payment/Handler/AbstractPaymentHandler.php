<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler;

use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Exception\NoMethodMapperException;

abstract class AbstractPaymentHandler
{

    /**
     * @var AbstractAdapter
     */
    protected $executionAdapter;

    /**
     * @var AmazonpayConfig
     */
    protected $config;

    /**
     * @var array
     */
    protected $methodMappers = [];

    /**
     * @param AbstractAdapter $executionAdapter
     * @param AmazonpayConfig $config
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
