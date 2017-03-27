<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Refund\Business\RefundFacade;

class AmazonpayToRefundBridge implements AmazonpayToRefundInterface
{
    /**
     * @var RefundFacade
     */
    protected $refundFacade;

    /**
     * @param RefundFacade $refundFacade
     */
    public function __construct(RefundFacade $refundFacade)
    {
        $this->refundFacade = $refundFacade;
    }

    /**
     * @param array $salesOrderItems
     * @param SpySalesOrder $salesOrderEntity
     *
     * @return \Generated\Shared\Transfer\RefundTransfer
     */
    public function calculateRefund(array $salesOrderItems, SpySalesOrder $salesOrderEntity)
    {
       return $this->refundFacade->calculateRefund($salesOrderItems, $salesOrderEntity);
    }

    /**
     * @param RefundTransfer $refundTransfer
     *
     * @return bool
     */
    public function saveRefund(RefundTransfer $refundTransfer)
    {
        return $this->refundFacade->saveRefund($refundTransfer);
    }

}
