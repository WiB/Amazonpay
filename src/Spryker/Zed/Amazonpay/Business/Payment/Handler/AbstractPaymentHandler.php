<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler;

use Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterInterface;
use Spryker\Zed\Amazonpay\Business\Exception\NoMethodMapperException;
use Spryker\Zed\Amazonpay\Business\Exception\OrderGrandTotalException;
use Spryker\Zed\Amazonpay\AmazonpayConfig;

abstract class AbstractPaymentHandler
{

    /**
     * @var AmazonpayAdapterInterface
     */
    protected $executionAdapter;

    /**
     * @var ConverterInterface
     */
    protected $converter;

    /**
     * @var AmazonpayConfig
     */
    protected $config;

    /**
     * @var array
     */
    protected $methodMappers = [];

    /**
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface $executionAdapter
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterInterface $converter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        AmazonpayAdapterInterface $executionAdapter,
        ConverterInterface $converter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->converter = $converter;
        $this->config = $config;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\PayolutionConfig
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
     * @throws \Spryker\Zed\Payolution\Business\Exception\NoMethodMapperException
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
