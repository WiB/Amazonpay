<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer;
use PayWithAmazon\ResponseParser;

class RefundOrderConverter extends AbstractResponseParserConverter
{

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'RefundResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer
     */
    protected function extractRefundDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['RefundDetails'];

        $refundDetails = new AmazonpayRefundDetailsTransfer();
        $refundDetails->setAmazonRefundId($result['AmazonRefundId']);
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
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayRefundOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayRefundOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setRefundDetails($this->extractRefundDetails($responseParser));

        return $responseTransfer;
    }

}
