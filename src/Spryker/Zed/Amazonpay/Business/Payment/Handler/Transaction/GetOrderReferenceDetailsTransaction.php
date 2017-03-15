<?php
namespace Spryker\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use Generated\Shared\Transfer\GetOrderReferenceDetailsAmazonpayResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\GetOrderReferenceDetailsAdapter;

class GetOrderReferenceDetailsTransaction extends AbstractQuoteTransaction
{
    /**
     * @var GetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param GetOrderReferenceDetailsAdapter $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        GetOrderReferenceDetailsAdapter $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function execute(QuoteTransfer $quoteTransfer)
    {
        $quoteTransfer = parent::execute($quoteTransfer);

        if ($quoteTransfer->getAmazonPayment()->getResponseHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($this->apiResponse->getShippingAddress());

            if ($this->apiResponse->getBillingAddress()) {
                $quoteTransfer->setBillingAddress($this->apiResponse->getBillingAddress());
            } else {
                $quoteTransfer->setBillingAddress($this->apiResponse->getShippingAddress());
                $quoteTransfer->setBillingSameAsShipping(true);
            }

            $quoteTransfer->setOrderReference($quoteTransfer->getAmazonPayment()->getOrderReferenceId());
        }

        return $quoteTransfer;
    }

}