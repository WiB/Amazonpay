<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn;

use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\Ipn\Logger\IpnRequestLoggerInterface;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsBridge;
use Spryker\Zed\Amazonpay\Dependency\Facade\AmazonpayToOmsInterface;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

abstract class IpnAbstractTransferRequestHandler implements IpnRequestHandlerInterface
{

    /**
     * @var AmazonpayToOmsBridge $omsFacade
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
     * @param AbstractTransfer $amazonpayIpnRequestTransfer
     */
    public function handle(AbstractTransfer $amazonpayIpnRequestTransfer)
    {
        $paymentEntity = $this->retrievePaymentEntity($amazonpayIpnRequestTransfer);
        $paymentEntity->setOrderReferenceStatus($this->getOmsStatusName());
        $paymentEntity->save();

        $this->omsFacade->triggerEvent(
            $this->getOmsEventId(),
            $paymentEntity->getSpySalesOrder()->getItems(),
            []
        );

        $this->ipnRequestLogger->log($amazonpayIpnRequestTransfer);
    }

    /**
     * @param AbstractTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer
     *
     * @return SpyPaymentAmazonpay
     */
    abstract protected function retrievePaymentEntity(
        AbstractTransfer $amazonpayIpnPaymentAuthorizeRequestTransfer
    );

    /**
     * @return string
     */
    abstract protected function getOmsEventId();

    /**
     * @return string
     */
    abstract protected function getOmsStatusName();

}
