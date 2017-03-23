<?php
namespace Spryker\Zed\Amazonpay\Dependency\Facade;

use Spryker\Zed\Sales\Business\SalesFacadeInterface;

class AmazonpayToSalesBridge implements AmazonpayToSalesInterface
{

    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    public function __construct(SalesFacadeInterface $salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function getOrderByIdSalesOrder($idSalesOrder)
    {
        return $this
            ->salesFacade
            ->getOrderByIdSalesOrder(
                $idSalesOrder
            );
    }

}
