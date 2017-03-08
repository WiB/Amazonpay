<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

class GetOrderReferenceDetailsTransaction extends AbstractPaymentHandler
{
    public function __construct(
        Aa $adapter,
        ConverterInterface $converter,
        AmazonpayConfig $config
    ) {
        parent::__construct(
            $adapter,
            $converter,
            $config
        );
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $response = $this->adapter->getOrderReferenceDetails($quoteTransfer);

        return $this->converter->toTransactionResponseTransfer($response);
    }

}