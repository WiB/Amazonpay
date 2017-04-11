<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;


use Generated\Shared\Transfer\AmazonpayCaptureDetailsTransfer;
use Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer;
use Generated\Shared\Transfer\AmazonpayStatusTransfer;
use PayWithAmazon\ResponseParser;

class CaptureOrderConverter extends AbstractResponseParserConverter
{

    const CAPTURE_STATUS_DECLINED = 'Declined';
    const CAPTURE_STATUS_PENDING = 'Pending';
    const CAPTURE_STATUS_COMPLETED = 'Completed';

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return 'CaptureResult';
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayCaptureDetailsTransfer
     */
    protected function extractCaptureDetails(ResponseParser $responseParser)
    {
        $result = $this->extractResult($responseParser)['CaptureDetails'];

        $captureDetails = new AmazonpayCaptureDetailsTransfer();
        $captureDetails->setAmazonCaptureId($result['AmazonCaptureId']);
        $captureDetails->setCaptureReferenceId($result['CaptureReferenceId']);

        if (!empty($result['CaptureAmount'])) {
            $captureDetails->setCaptureAmount($this->convertPriceToTransfer($result['CaptureAmount']));
        }

        if (!empty($result['CaptureFee'])) {
            $captureDetails->setCaptureFee($this->convertPriceToTransfer($result['CaptureFee']));
        }

        if (!empty($result['CaptureStatus'])) {
            $captureStatus = new AmazonpayStatusTransfer();
            $captureStatus->setLastUpdateTimestamp($result['CaptureStatus']['LastUpdateTimestamp']);
            $captureStatus->setState($result['CaptureStatus']['State']);
            $captureDetails->setCaptureStatus($captureStatus);

            $captureDetails->setIsDeclined(
                $result['CaptureStatus']['State'] === self::CAPTURE_STATUS_DECLINED
            );

            $captureDetails->setIsPending(
                $result['CaptureStatus']['State'] === self::CAPTURE_STATUS_PENDING
            );

            $captureDetails->setIsCompleted(
                $result['CaptureStatus']['State'] === self::CAPTURE_STATUS_COMPLETED
            );
        }

        if (!empty($result['IdList'])) {
            $captureDetails->setIdList(array_values($result['IdList'])[0]);
        }

        if (!empty($result['SellerCaptureNote'])) {
            $captureDetails->setSellerCaptureNote($result['SellerCaptureNote']);
        }

        if (!empty($result['CreationTimestamp'])) {
            $captureDetails->setCreationTimestamp($result['CreationTimestamp']);
        }

        return $captureDetails;
    }

    /**
     * @param \PayWithAmazon\ResponseParser $responseParser
     *
     * @return \Generated\Shared\Transfer\AmazonpayCaptureOrderResponseTransfer
     */
    public function convert(ResponseParser $responseParser)
    {
        $responseTransfer = new AmazonpayCaptureOrderResponseTransfer();
        $responseTransfer->setHeader($this->extractHeader($responseParser));
        $responseTransfer->setCaptureDetails($this->extractCaptureDetails($responseParser));

        return $responseTransfer;
    }

}
