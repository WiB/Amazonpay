<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

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
        switch ($ipnRequest->getMessage()->getNotificationType()) {
            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_AUTHORIZE:
                return $this->createIpnPaymentAuthorizeHandler($ipnRequest);

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_CAPTURE:
                return $this->createIpnPaymentCaptureHandler($ipnRequest);

            case AmazonpayConstants::IPN_REQUEST_TYPE_PAYMENT_REFUND:
                return $this->createIpnPaymentRefundHandler($ipnRequest);
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnRequestHandlerInterface
     */
    protected function createIpnPaymentAuthorizeHandler(AbstractTransfer $ipnRequest)
    {
        if ($ipnRequest->getAuthorizationDetails()->getIsDeclined()) {
            return new IpnPaymentAuthorizeDeclineHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        } elseif ($ipnRequest->getAuthorizationDetails()->getIsOpen()) {
            return new IpnPaymentAuthorizeOpenHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnRequestHandlerInterface
     */
    protected function createIpnPaymentCaptureHandler(AbstractTransfer $ipnRequest)
    {
        if ($ipnRequest->getCaptureDetails()->getIsDeclined()) {
            return new IpnPaymentCaptureDeclineHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        } elseif ($ipnRequest->getCaptureDetails()->getIsCompleted()) {
            return new IpnPaymentCaptureCompletedHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        }
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $ipnRequest
     *
     * @return \Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\IpnRequestHandlerInterface
     */
    protected function createIpnPaymentRefundHandler(AbstractTransfer $ipnRequest)
    {
        if ($ipnRequest->getRefundDetails()->getIsDeclined()) {
            return new IpnPaymentRefundDeclineHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        } elseif ($ipnRequest->getRefundDetails()->getIsCompleted()) {
            return new IpnPaymentRefundCompletedHandler(
                $this->omsFacade,
                $this->amazonpayQueryContainer,
                $this->ipnRequestLogger
            );
        }
    }

}
