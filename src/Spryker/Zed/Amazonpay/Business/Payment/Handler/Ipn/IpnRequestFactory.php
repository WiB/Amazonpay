<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Generated\Shared\Transfer\AmazonpayIpnPaymentAuthorizeRequestTransfer;
use Spryker\Shared\Amazonpay\AmazonpayConstants;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger\IpnRequestLoggerInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

class IpnRequestFactory implements IpnRequestFactoryInterface
{

    /**
     * @var AmazonpayToOmsInterface $omsFacade
     */
    protected $omsFacade;

    /**
     * @var AmazonpayQueryContainerInterface $amazonpayQueryContainer
     */
    protected $amazonpayQueryContainer;

    /**
     * @var IpnRequestLoggerInterface $ipnRequestLogger
     */
    protected $ipnRequestLogger;

    public function __construct(
        AmazonpayToOmsInterface $omsFacade,
        AmazonpayQueryContainerInterface $amazonpayQueryContainer,
        IpnRequestLoggerInterface $ipnRequestLogger
    ) {
        $this->omsFacade = $omsFacade;
        $this->amazonpayQueryContainer = $amazonpayQueryContainer;
        $this->ipnRequestLogger = $ipnRequestLogger;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnRequestHandlerInterface
     */
    public function createConcreteIpnRequestHandler(AbstractTransfer $ipnRequest)
    {
        switch ($ipnRequest->getNotificationType()) {
            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_AUTHORIZE:
                if ($ipnRequest->getAuthorizationDetails()->getIsDeclined()) {
                    return new IpnPaymentAuthorizeDeclineHandler(
                        $this->omsFacade,
                        $this->amazonpayQueryContainer,
                        $this->ipnRequestLogger
                    );
                } else {
                    return new IpnPaymentAuthorizeOpenHandler(
                        $this->omsFacade,
                        $this->amazonpayQueryContainer,
                        $this->ipnRequestLogger
                    );
                }

            break;
        }
    }

}
