<?php

/**
 * Apache OSL-2
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Refund\Business\RefundFacadeInterface;

class AmazonpayToRefundBridge implements AmazonpayToRefundInterface
{

    /**
     * @var \Spryker\Zed\Refund\Business\RefundFacade
     */
    protected $refundFacade;

    /**
     * @param \Spryker\Zed\Refund\Business\RefundFacadeInterface $refundFacade
     */
    public function __construct(RefundFacadeInterface $refundFacade)
    {
        $this->refundFacade = $refundFacade;
    }

    /**
     * @param array $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return \Generated\Shared\Transfer\RefundTransfer
     */
    public function calculateRefund(array $salesOrderItems, SpySalesOrder $salesOrderEntity)
    {
        return $this->refundFacade->calculateRefund($salesOrderItems, $salesOrderEntity);
    }

    /**
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return bool
     */
    public function saveRefund(RefundTransfer $refundTransfer)
    {
        return $this->refundFacade->saveRefund($refundTransfer);
    }

}
