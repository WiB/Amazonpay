<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Adapter;

use Spryker\Zed\Amazonpay\AmazonpayConfigInterface;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk\AmazonpaySdkAdapterFactory;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\Sdk\AmazonpaySdkAdapterFactoryInterface;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface;
use PayWithAmazon\IpnHandler;

class AdapterFactory implements AdapterFactoryInterface
{

    /**
     * @var \Spryker\Zed\Amazonpay\AmazonpayConfigInterface
     */
    protected $config;

    /**
     * @var \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory
     */
    protected $converterFactory;

    /**
     * @var \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface
     */
    protected $moneyFacade;

    /**
     * @param \Spryker\Zed\Amazonpay\AmazonpayConfigInterface $config
     * @param \Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterFactory $converterFactory
     * @param \Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToMoneyInterface $moneyFacade
     */
    public function __construct(
        AmazonpayConfigInterface $config,
        ConverterFactory $converterFactory,
        AmazonpayToMoneyInterface $moneyFacade
    ) {
        $this->config = $config;
        $this->converterFactory = $converterFactory;
        $this->moneyFacade = $moneyFacade;
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createObtainProfileInformationAdapter()
    {
        return new ObtainProfileInformationAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createObtainProfileInformationConverter()
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createSetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new SetOrderReferenceDetailsAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createSetOrderReferenceDetailsConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createConfirmOrderReferenceAmazonpayAdapter()
    {
        return new ConfirmOrderReferenceAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createConfirmOrderReferenceConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createGetOrderReferenceDetailsAmazonpayAdapter()
    {
        return new GetOrderReferenceDetailsAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createGetOrderReferenceDetailsConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createAuthorizeOrderAdapter()
    {
        return new AuthorizeOrderQuoteAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createAuthorizeOrderConverter(),
            $this->moneyFacade,
            $this->config
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createCaptureOrderAdapter()
    {
        return new CaptureOrderAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createCaptureOrderConverter(),
            $this->moneyFacade,
            $this->config
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createCloseOrderAdapter()
    {
        return new CloseOrderAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createCloseOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface
     */
    public function createCancelOrderAdapter()
    {
        return new CancelOrderAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createCancelOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\OrderAdapterInterface
     */
    public function createRefundOrderAdapter()
    {
        return new RefundOrderAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayClient($this->config),
            $this->converterFactory->createRefundOrderConverter(),
            $this->moneyFacade
        );
    }

    /**
     * @return AmazonpaySdkAdapterFactoryInterface
     */
    protected function createSdkAdapterFactory()
    {
        return new AmazonpaySdkAdapterFactory();
    }

    /**
     * @param array $headers
     * @param string $body
     *
     * @return \Spryker\Zed\Amazonpay\Business\Api\Adapter\IpnRequestAdapterInterface
     */
    public function createIpnRequestAdapter(array $headers, $body)
    {
        return new IpnRequestAdapter(
            $this->createSdkAdapterFactory()->createAmazonpayIpnHandler($headers, $body),
            $this->converterFactory->createIpnArrayConverter()
        );
    }

}
