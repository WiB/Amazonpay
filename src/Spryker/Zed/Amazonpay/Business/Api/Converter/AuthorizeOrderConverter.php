<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayStatusTransfer;
use Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer;
use PayWithAmazon\ResponseParser;

class AuthorizeOrderConverter extends AbstractResponseParserConverter
{

    const AUTH_STATUS_DECLINED = 'Declined';
    const AUTH_STATUS_PENDING = 'Pending';
    const AUTH_STATUS_OPEN = 'Open';
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
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizationDetailsTransfer
     */
    protected function extractAuthorizationDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['AuthorizationDetails'];

        $authorizationDetails = new AmazonpayAuthorizationDetailsTransfer();
        $authorizationDetails->setAmazonAuthorizationId($result['AmazonAuthorizationId']);
        $authorizationDetails->setAuthorizationReferenceId($result['AuthorizationReferenceId']);

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
            $authStatus = new AmazonpayStatusTransfer();
            $authStatus->setLastUpdateTimestamp($result['AuthorizationStatus']['LastUpdateTimestamp']);
            $authStatus->setState($result['AuthorizationStatus']['State']);
            $authorizationDetails->setAuthorizationStatus($authStatus);

            $authorizationDetails->setIsDeclined(
                $result['AuthorizationStatus']['State'] === self::AUTH_STATUS_DECLINED
            );

            $authorizationDetails->setIsPending(
                $result['AuthorizationStatus']['State'] === self::AUTH_STATUS_PENDING
            );

            $authorizationDetails->setIsOpen(
                $result['AuthorizationStatus']['State'] === self::AUTH_STATUS_OPEN
            );

            if (!empty($result['AuthorizationStatus']['ReasonCode'])) {
                $authorizationDetails->setIsPaymentMethodInvalid(
                    $result['AuthorizationStatus']['ReasonCode'] === self::PAYMENT_METHOD_INVALID
                );
            } else {
                $authorizationDetails->setIsPaymentMethodInvalid(false);
            }
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
     * @return \Generated\Shared\Transfer\AmazonpayAuthorizeOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayAuthorizeOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAuthorizationDetails($this->extractAuthorizationDetails($responseParser));

        return $responseTransfer;
    }

}
