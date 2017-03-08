<?php

namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\AmazonpayAdapterInterface;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Payment\Handler\AbstractPaymentHandler;
use Spryker\Zed\Ratepay\Business\Api\Converter\ConverterInterface;

class ConfirmOrderReferenceTransaction extends AbstractPaymentHandler
{
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
     * @return \Generated\Shared\Transfer\BillpayTransactionResponseTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $response = $this->adapter->confirmOrderReference($quoteTransfer);

        return $this->converter->toTransactionResponseTransfer($response);
    }

}
