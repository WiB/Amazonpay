<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Api\Converter;

use Generated\Shared\Transfer\AmazonpayPriceTransfer;
use Generated\Shared\Transfer\AmazonpayStatusTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Converter\Details\AuthorizationDetailsConverter;

abstract class AbstractConverter
{

    const STATUS_DECLINED = 'Declined';
    const STATUS_PENDING = 'Pending';
    const STATUS_OPEN = 'Open';
    const STATUS_CLOSED = 'Closed';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_SUSPENDED = 'Suspended';

    /**
     * @param array $priceData
     *
     * @return \Generated\Shared\Transfer\AmazonpayPriceTransfer
     */
    protected function convertPriceToTransfer(array $priceData)
    {
        $priceTransfer = new AmazonpayPriceTransfer();

        $priceTransfer->setAmount($priceData['Amount']);
        $priceTransfer->setCurrencyCode($priceData['CurrencyCode']);

        return $priceTransfer;
    }

    /**
     * @param array $statusData
     *
     * @return AmazonpayStatusTransfer
     */
    protected function convertStatusToTransfer(array $statusData)
    {
        $status = new AmazonpayStatusTransfer();
        $status->setLastUpdateTimestamp($statusData['LastUpdateTimestamp']);
        $status->setState($statusData['State']);

        if (!empty($statusData['ReasonCode'])) {
            $status->setReasonCode($statusData['ReasonCode']);
            $status->setIsReauthorizable(
                $statusData['ReasonCode'] === AmazonpayConstants::REASON_CODE_SELLER_CLOSED
                || $statusData['ReasonCode'] === AmazonpayConstants::REASON_CODE_EXPIRED_UNUSED
            );

            $status->setIsPaymentMethodInvalid(
                $statusData['ReasonCode'] === AmazonpayConstants::REASON_CODE_PAYMENT_METHOD_INVALID
            );
        }

        if ($statusData['State'] === static::STATUS_DECLINED) {
            $status->setIsSuspended($status->getIsPaymentMethodInvalid());
            $status->setIsDeclined(true);
        }

        if ($statusData['State'] === static::STATUS_SUSPENDED) {
            $status->setIsSuspended(true);
            $status->setIsDeclined(true);
        }

        $status->setIsPending(
            $statusData['State'] === static::STATUS_PENDING
        );

        $status->setIsOpen(
            $statusData['State'] === static::STATUS_OPEN
        );

        $status->setIsClosed(
            $statusData['State'] === static::STATUS_CLOSED
        );

        $status->setIsCompleted(
            $statusData['State'] === static::STATUS_COMPLETED
        );

        return $status;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     * @param string $name
     *
     * @return \Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected function updateNameData(AbstractTransfer $transfer, $name)
    {
        $names = explode(' ', $name, 2);

        if (count($names) >= 2) {
            $transfer->setFirstName($names[0]);
            $transfer->setLastName($names[1]);
        } else {
            $transfer->setFirstName($name);
            $transfer->setLastName($name);
        }

        return $transfer;
    }

}
