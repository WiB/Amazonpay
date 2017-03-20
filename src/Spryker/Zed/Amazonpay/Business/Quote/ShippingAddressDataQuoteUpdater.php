<?php
namespace Spryker\Zed\Amazonpay\Business\Quote;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SetOrderReferenceDetailsAmazonpayResponseTransfer;
use Spryker\Zed\Amazonpay\AmazonpayConfig;
use Spryker\Zed\Amazonpay\Business\Api\Adapter\QuoteAdapterInterface;

class ShippingAddressDataQuoteUpdater implements QuoteUpdaterInterface
{
    /**
     * @var SetOrderReferenceDetailsAmazonpayResponseTransfer
     */
    protected $apiResponse;

    /**
     * @param QuoteAdapterInterface $executionAdapter
     * @param AmazonpayConfig $config
     */
    public function __construct(
        QuoteAdapterInterface $executionAdapter,
        AmazonpayConfig $config
    ) {
        $this->executionAdapter = $executionAdapter;
        $this->config = $config;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     *
     * @return QuoteTransfer
     */
    public function update(QuoteTransfer $quoteTransfer)
    {
        $this->apiResponse = $this->executionAdapter->call($quoteTransfer);

        if ($this->apiResponse->getHeader()->getIsSuccess()) {
            $quoteTransfer->setShippingAddress($this->apiResponse->getShippingAddress());
        }

        return $quoteTransfer;
    }
}
