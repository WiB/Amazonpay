<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;


class ConverterFactory
{
    /**
     * @return CloseOrderConverter
     */
    public function createCloseOrderConverter()
    {
        return new CloseOrderConverter();
    }

    /**
     * @return ObtainProfileInformationConverter
     */
    public function createObtainProfileInformationConverter()
    {
        return new ObtainProfileInformationConverter();
    }

    /**
     * @return SetOrderReferenceDetailsConverter
     */
    public function createSetOrderReferenceDetailsConverter()
    {
        return new SetOrderReferenceDetailsConverter();
    }

    /**
     * @return ConfirmOrderReferenceConverter
     */
    public function createConfirmOrderReferenceConverter()
    {
        return new ConfirmOrderReferenceConverter();
    }

    /**
     * @return GetOrderReferenceDetailsConverter
     */
    public function createGetOrderReferenceDetailsConverter()
    {
        return new GetOrderReferenceDetailsConverter();
    }

    /**
     * @return AuthorizeOrderConverter
     */
    public function createAuthorizeOrderConverter()
    {
        return new AuthorizeOrderConverter();
    }

    /**
     * @return CancelOrderConverter
     */
    public function createCancelOrderConverter()
    {
        return new CancelOrderConverter();
    }

    /**
     * @return RefundOrderConverter
     */
    public function createRefundOrderConverter()
    {
        return new RefundOrderConverter();
    }

}