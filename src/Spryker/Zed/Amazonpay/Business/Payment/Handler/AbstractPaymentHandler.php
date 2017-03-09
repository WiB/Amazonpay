<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction\QuoteTransactionInterface;
use Spryker\Zed\Amazonpay\Business\Exception\NoMethodMapperException;

abstract class AbstractPaymentHandler implements QuoteTransactionInterface
{

    /**
     * @var AmazonpayAdapterInterface
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
     * @param \Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface $executionAdapter
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterInterface $converter
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfig $config
     */
    public function __construct(
        AmazonpayAdapterInterface $executionAdapter,
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

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return AbstractTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        return $this->executionAdapter->call($quoteTransfer);
    }

}
