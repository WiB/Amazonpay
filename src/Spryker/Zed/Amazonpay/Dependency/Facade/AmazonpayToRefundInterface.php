<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Generated\Shared\Transfer\RefundTransfer;

interface AmazonpayToRefundInterface
{
    /**
     * @param array $salesOrderItems
     * @param SpySalesOrder $salesOrderEntity
     *
     * @return RefundTransfer
     */
    public function calculateRefund(array $salesOrderItems, SpySalesOrder $salesOrderEntity);

    /**
     * @param RefundTransfer $refundTransfer
     *
     * @return bool
     */
    public function saveRefund(RefundTransfer $refundTransfer);
}
