<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

abstract class IpnAbstractOrderReferenceHandler extends IpnAbstractTransferRequestHandler
{
    /**
     * @param AbstractTransfer $amazonpayIpnOrderReferenceOpenTransfer
     *
     * @return SpyPaymentAmazonpay
     */
    protected function retrievePaymentEntity(AbstractTransfer $amazonpayIpnOrderReferenceOpenTransfer)
    {
        return $this->amazonpayQueryContainer->queryPaymentByOrderReferenceId(
            $amazonpayIpnOrderReferenceOpenTransfer->getAmazonOrderReferenceId()
        )
            ->findOne();
    }

}
