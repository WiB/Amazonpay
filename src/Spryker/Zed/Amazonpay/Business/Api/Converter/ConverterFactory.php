<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

class ConverterFactory
{

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\CloseOrderConverter
     */
    public function createCloseOrderConverter()
    {
        return new CloseOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ObtainProfileInformationConverter
     */
    public function createObtainProfileInformationConverter()
    {
        return new ObtainProfileInformationConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\SetOrderReferenceDetailsConverter
     */
    public function createSetOrderReferenceDetailsConverter()
    {
        return new SetOrderReferenceDetailsConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\ConfirmOrderReferenceConverter
     */
    public function createConfirmOrderReferenceConverter()
    {
        return new ConfirmOrderReferenceConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\GetOrderReferenceDetailsConverter
     */
    public function createGetOrderReferenceDetailsConverter()
    {
        return new GetOrderReferenceDetailsConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\AuthorizeOrderConverter
     */
    public function createAuthorizeOrderConverter()
    {
        return new AuthorizeOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\CancelOrderConverter
     */
    public function createCancelOrderConverter()
    {
        return new CancelOrderConverter();
    }

    /**
     * @return \Spryker\Zed\Amazonpay\Business\Api\Converter\RefundOrderConverter
     */
    public function createRefundOrderConverter()
    {
        return new RefundOrderConverter();
    }

}
