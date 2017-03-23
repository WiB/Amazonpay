<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\OrderTransfer;
use Orm\Zed\Amazonpay\Persistence\SpyPaymentAmazonpay;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AbstractAdapter;
use Spryker\Zed\Amazonpay\Persistence\AmazonpayQueryContainerInterface;

abstract class AbstractOrderTransaction extends AbstractTransaction implements OrderTransactionInterface
{
    /**
     * @var AmazonpayQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var SpyPaymentAmazonpay
     */
    protected $paymentEntity;

    public function __construct(
        AbstractAdapter $executionAdapter,
        AmazonpayConfig $config,
        AmazonpayQueryContainerInterface $amazonpayQueryContainer
    ) {
        parent::__construct($executionAdapter, $config);

        $this->queryContainer = $amazonpayQueryContainer;
    }

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return OrderTransfer
     */
    public function execute(OrderTransfer $orderTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($orderTransfer);
        $orderTransfer->getAmazonpayPayment()->setResponseHeader($this->apiResponse->getHeader());
        $this->paymentEntity =
            $this->queryContainer->queryPaymentByOrderReferenceId(
                    $orderTransfer->getAmazonpayPayment()->getOrderReferenceId()
                )
                ->findOne();

        return $orderTransfer;
    }

}
