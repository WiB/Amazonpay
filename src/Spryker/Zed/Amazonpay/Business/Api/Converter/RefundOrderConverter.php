<?php
namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer;
use Generated\Shared\Transfer\RefundOrderAmazonpayResponseTransfer;
use PayWithAmazon\ResponseParser;

class RefundOrderConverter extends AbstractResponseParserConverter
{
    /**
     * @param ResponseParser $responseParser
     *
     * @return array
     */
    protected function extractResult(ResponseParser $responseParser)
    {
        return $responseParser->toArray()['RefundResult'];
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return AmazonpayRefundDetailsTransfer
     */
    protected function extractRefundDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['RefundDetails'];

        $refundDetails = new AmazonpayRefundDetailsTransfer();
        $refundDetails->setRefundId($result['AmazonRefundId']);
        $refundDetails->setRefundReferenceId($result['RefundReferenceId']);
        $refundDetails->setRefundAmount($this->convertPriceToTransfer(
            $result['RefundAmount']
        ));
        $refundDetails->setStatus($result['RefundStatus']['State']);

        if (!empty($result['SellerRefundNote'])) {
            $refundDetails->setRefundReferenceId($result['SellerRefundNote']);
        }

        return $refundDetails;
    }

    /**
     * @param ResponseParser $responseParser
     *
     * @return RefundOrderAmazonpayResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new RefundOrderAmazonpayResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setRefundDetails($this->extractRefundDetails($responseParser));

        return $responseTransfer;
    }

}
