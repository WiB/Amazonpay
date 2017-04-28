<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class IpnAbstractPaymentRefundHandler extends IpnAbstractTransferRequestHandler
{

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $amazonpayIpnPaymentRefundRequestTransfer
     *
     * @return \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay
     */
    protected function retrievePaymentEntity(AbstractTransfer $amazonpayIpnPaymentRefundRequestTransfer)
    {
        return $this->amazonpayQueryContainer->queryPaymentByRefundReferenceId(
            $amazonpayIpnPaymentRefundRequestTransfer->getRefundDetails()->getRefundReferenceId()
        )
            ->findOne();
    }

    /**
     * @return string
     */
    protected function getOmsEventId()
    {
        return AmazonpayConstants::OMS_EVENT_UPDATE_REFUND_STATUS;
    }

}
