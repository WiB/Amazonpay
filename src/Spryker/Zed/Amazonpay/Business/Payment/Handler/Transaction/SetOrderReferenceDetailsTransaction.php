<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Converter\ConverterInterface;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;

class SetOrderReferenceDetailsTransaction extends AbstractPaymentHandler
{
    /**
     * @param AmazonpayAdapterInterface $adapter
     * @param ConverterInterface $converter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        AmazonpayAdapterInterface $adapter,
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
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $this->executionAdapter->setOrderReferenceDetails($quoteTransfer);
        $response = $this->executionAdapter->confirmOrderReference($quoteTransfer);
        $response = $this->executionAdapter->getOrderReferenceDetails($quoteTransfer);

        return $this->converter->toTransactionResponseTransfer($response);
    }

}
