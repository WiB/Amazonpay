<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonAuthorizationDetailsTransfer;
use Generated\Shared\Transfer\AmazonStatusTransfer;
use Generated\Shared\Transfer\AuthorizeOrderAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class AuthorizeOrderConverter extends AbstractResponseParserConverter
{
    const AUTH_STATUS_DECLINED = 'Declined';

    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractResult(ResponseParser $responseParser)
    {
        return $responseParser->toArray()['AuthorizeResult'];
    }

    /**
     * @param ResponseParser $responseParser
     * @return bool
     */
    protected function isSuccess(ResponseParser $responseParser)
    {
        $authDetails = $this->extractResult($responseParser)['AuthorizationDetails'];

        return
            $this->extractStatusCode($responseParser) == self::STATUS_CODE_SUCCESS
            && !empty($authDetails['AuthorizationStatus']['State'])
            && $authDetails['AuthorizationStatus']['State'] != self::AUTH_STATUS_DECLINED;
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AmazonAuthorizationDetailsTransfer
     */
    protected function extractAuthorizationDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['AuthorizationDetails'];

        $autorizationDetails = new AmazonAuthorizationDetailsTransfer();
        $autorizationDetails->setAuthorizationId($result['AmazonAuthorizationId']);
        $autorizationDetails->setAuthorizationReference($result['AuthorizationReferenceId']);

        if (!empty($result['AuthorizationAmount'])) {
            $autorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['AuthorizationAmount']));
        }

        if (!empty($result['CapturedAmount'])) {
            $autorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['CapturedAmount']));
        }

        if (!empty($result['AuthorizationFee'])) {
            $autorizationDetails->setAuthorizationAmount($this->convertPriceToTransfer($result['AuthorizationFee']));
        }

        if (!empty($result['AuthorizationStatus'])) {
            $authStatus = new AmazonStatusTransfer();
            $authStatus->setLastUpdateTimestamp($result['AuthorizationStatus']['LastUpdateTimestamp']);
            $authStatus->setState($result['AuthorizationStatus']['State']);
            $autorizationDetails->setAuthorizationStatus($authStatus);
        }

        if (!empty($result['ExpirationTimestamp'])) {
            $autorizationDetails->setExpirationTimestamp($result['ExpirationTimestamp']);
        }

        if (!empty($result['IdList'])) {
            $autorizationDetails->setIdList($result['IdList']);
        }

        if (!empty($result['SoftDecline'])) {
            $autorizationDetails->setSoftDecline($result['SoftDecline']);
        }

        if (!empty($result['CaptureNow'])) {
            $autorizationDetails->setCaptureNow($result['CaptureNow']);
        }

        if (!empty($result['SellerAuthorizationNote'])) {
            $autorizationDetails->setSellerAuthorizationNote($result['CaptureNow']);
        }

        if (!empty($result['CreationTimestamp'])) {
            $autorizationDetails->setCreationTimestamp($result['CreationTimestamp']);
        }

        return $autorizationDetails;
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AuthorizeOrderAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AuthorizeOrderAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setAuthorizationDetails($this->extractAuthorizationDetails($responseParser));

        return $responseTransfer;
   }
}