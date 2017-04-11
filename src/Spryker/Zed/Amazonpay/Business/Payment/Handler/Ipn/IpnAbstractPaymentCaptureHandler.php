<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class IpnAbstractPaymentCaptureHandler extends IpnAbstractTransferRequestHandler
{
    /**
     * @param AbstractTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer
     *
     * @return SpyPaymentAmazonpay
     */
    protected function retrievePaymentEntity(AbstractTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer)
    {
        return $this->amazonpayQueryContainer->queryPaymentByCaptureReferenceId(
                $amazonpayIpnPaymentAuthorizeRequestTransfer->getCaptureDetails()->getCaptureReferenceId()
            )
            ->findOne();
    }

    /**
     * @return string
     */
    protected function getOmsEventId()
    {
        return 'update_capture_status';
    }

}
