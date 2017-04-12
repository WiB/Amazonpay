<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter\Details;

use Generated\Shared\Transfer\AmazonpayRefundDetailsTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\AbstractArrayConverter;

class RefundDetailsConverter extends AbstractArrayConverter
{

    const CAPTURE_STATUS_DECLINED = 'Declined';
    const CAPTURE_STATUS_PENDING = 'Pending';
    const CAPTURE_STATUS_COMPLETED = 'Completed';

    /**
     * @param array $refundDetailsData
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    public function convert(array $refundDetailsData)
    {
        $refundDetails = new AmazonpayRefundDetailsTransfer();
        $refundDetails->setAmazonRefundId($refundDetailsData['AmazonRefundId']);
        $refundDetails->setRefundReferenceId($refundDetailsData['RefundReferenceId']);
        $refundDetails->setRefundAmount($this->convertPriceToTransfer(
            $refundDetailsData['RefundAmount']
        ));

        if (!empty($refundDetailsData['RefundStatus'])) {
            $this->convertStatusToTransfer($refundDetailsData['RefundStatus']);
//            $refundStatus = new AmazonpayStatusTransfer();
//            $refundStatus->setLastUpdateTimestamp($refundDetailsData['RefundStatus']['LastUpdateTimestamp']);
//            $refundStatus->setState($refundDetailsData['RefundStatus']['State']);
//            $refundDetails->setRefundStatus($refundStatus);
//
//            $refundDetails->setIsDeclined(
//                $refundDetailsData['CaptureStatus']['State'] === self::CAPTURE_STATUS_DECLINED
//            );
//
//            $refundDetails->setIsPending(
//                $refundDetailsData['CaptureStatus']['State'] === self::CAPTURE_STATUS_PENDING
//            );
//
//            $refundDetails->setIsCompleted(
//                $refundDetailsData['CaptureStatus']['State'] === self::CAPTURE_STATUS_COMPLETED
//            );
        }

        if (!empty($refundDetailsData['SellerRefundNote'])) {
            $refundDetails->setRefundReferenceId($refundDetailsData['SellerRefundNote']);
        }

        return $refundDetails;

    }

}