<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayAuthorizationStatusTransfer;
use Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class AuthorizeOrderConverter extends AbstractResponseParserConverter
{

    const AUTH_STATUS_DECLINED = 'Declined';
    const PAYMENT_METHOD_INVALID = 'InvalidPaymentMethod';

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'AuthorizeResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonAuthorizationDetailsTransfer
     */
    protected function extractAuthorizationDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['AuthorizationDetails'];

        $authorizationDetails = new AmazonAuthorizationDetailsTransfer();
        $authorizationDetails->setAuthorizationId($result['AmazonAuthorizationId']);
        $authorizationDetails->setAuthorizationReference($result['AuthorizationReferenceId']);

        if (!empty($result['AuthorizationAmount'])) {
            $authorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['AuthorizationAmount']));
        }

        if (!empty($result['CapturedAmount'])) {
            $authorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['CapturedAmount']));
        }

        if (!empty($result['AuthorizationFee'])) {
            $authorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['AuthorizationFee']));
        }

        if (!empty($result['AuthorizationStatus'])) {
            $authStatus = new AmazonpayAuthorizationStatusTransfer();
            $authStatus->setLastUpdateTimestamp($result['AuthorizationStatus']['LastUpdateTimestamp']);
            $authStatus->setState($result['AuthorizationStatus']['State']);
            $authorizationDetails->setAuthorizationStatus($authStatus);

            $authorizationDetails->setIsDeclined(
                $result['AuthorizationStatus']['State'] === self::AUTH_STATUS_DECLINED
            );

            $authorizationDetails->setIsPaymentMethodInvalid(
                $result['AuthorizationStatus']['ReasonCode'] === self::PAYMENT_METHOD_INVALID
            );
        }

        if (!empty($result['ExpirationTimestamp'])) {
            $authorizationDetails->setExpirationTimestamp($result['ExpirationTimestamp']);
        }

        if (!empty($result['IdList'])) {
            $authorizationDetails->setIdList(array_values($result['IdList'])[0]);
        }

        if (!empty($result['SoftDecline'])) {
            $authorizationDetails->setSoftDecline($result['SoftDecline']);
        }

        if (!empty($result['CaptureNow'])) {
            $authorizationDetails->setCaptureNow($result['CaptureNow']);
        }

        if (!empty($result['SellerAuthorizationNote'])) {
            $authorizationDetails->setSellerAuthorizationNote($result['CaptureNow']);
        }

        if (!empty($result['CreationTimestamp'])) {
            $authorizationDetails->setCreationTimestamp($result['CreationTimestamp']);
        }

        return $authorizationDetails;
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AuthorizeOrderAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAuthorizationDetails($this->extractAuthorizationDetails($responseParser));

        return $responseTransfer;
    }

}
