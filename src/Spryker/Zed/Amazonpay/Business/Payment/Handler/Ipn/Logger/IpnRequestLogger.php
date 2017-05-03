<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpayIpnLog;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;

class IpnRequestLogger implements IpnRequestLoggerInterface
{

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     * @param \Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay $paymentAmazonpay
     *
     * @return void
     */
    public function log(AbstractTransfer $ipnRequest, SpyPaymentAmazonpay $paymentAmazonpay)
    {
        $ipnLog = new SpyPaymentAmazonpayIpnLog();

        $ipnLog->setMessage(json_encode($ipnRequest->toArray()));
        $ipnLog->setMessageId($ipnRequest->getMessage()->getMessageId());
        $ipnLog->setFkPaymentAmazonpay($paymentAmazonpay->getIdPaymentAmazonpay());
        $ipnLog->save();
    }

}
