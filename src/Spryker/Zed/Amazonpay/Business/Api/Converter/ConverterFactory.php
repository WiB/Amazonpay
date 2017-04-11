<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn\IpnArrayConverter;
use Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn\IpnConverterFactory;

class ConverterFactory
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createCloseOrderConverter()
    {
        return new CloseOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface
     */
    public function createObtainProfileInformationConverter()
    {
        return new ObtainProfileInformationConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createSetOrderReferenceDetailsConverter()
    {
        return new SetOrderReferenceDetailsConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createConfirmOrderReferenceConverter()
    {
        return new ConfirmOrderReferenceConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createGetOrderReferenceDetailsConverter()
    {
        return new GetOrderReferenceDetailsConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createAuthorizeOrderConverter()
    {
        return new AuthorizeOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createCaptureOrderConverter()
    {
        return new CaptureOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createCancelOrderConverter()
    {
        return new CancelOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ResponseParserConverterInterface
     */
    public function createRefundOrderConverter()
    {
        return new RefundOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\Ipn\IpnConverterFactoryInterface
     */
    public function createIpnConverterFactory()
    {
        return new IpnConverterFactory();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ArrayConverterInterface
     */
    public function createIpnArrayConverter()
    {
        return new IpnArrayConverter(
            $this->createIpnConverterFactory()
        );
    }

}
